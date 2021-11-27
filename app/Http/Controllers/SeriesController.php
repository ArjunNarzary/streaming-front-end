<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Series;

use App\Season;

use App\Episode;

use App\Subscriber;

use App\RentedSeries;

use CloudFrontUrlSigner;

use Carbon\Carbon;


class SeriesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $series = Series::latest()->where('status',1)->get();
        return view('series/index',compact('series'));
    }

    public function details($slug)
    {
        $series = Series::where('slug',$slug)->firstOrFail();
        return view('series/details',compact('series'));
        
    }

    function hoursandmins($time, $format = '%02dh : %02dm')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function seasonDetails($slug)
    {
        $season = Season::where('slug',$slug)->firstOrFail();
        $user_id = Auth()->user()->id;

        if($season->premium_type == 1)
        {
            $subscriber = Subscriber::where('user_id',$user_id)->first();
            if($subscriber!=NULL)
            {
                $current_date = Carbon::now();
                $expiry = Carbon::parse($subscriber->plan_expiry);
                if($expiry->lt($current_date))
                $subscriber->status = 0;
                $subscriber->save();
            }
    
            if($subscriber==NULL || $subscriber->status==0)
            {
                return redirect()->route('user.mysubscription');
            }
        }
        
        //Checking for rented content
       else if($season->premium_type == 2)
       {
            $data = RentedSeries::where('user_id',$user_id)->where('season_id',$season->id)->first();
            //return $data;

            if($data != NULL)
            {
                $current_date = Carbon::now();
                $expiry = Carbon::parse($data->rent_expiry);
                if($expiry->lt($current_date))
                $data->status = 0;
                $data->save();
            }

            if($data == NULL || $data->status==0)
            {
                return redirect()->route('rent.series',$season->slug);
            }
       }

       $watchlists = Auth()->user()->seasonWatchlists()->get(); 
       $watchlisted = 0;
       foreach($watchlists as $watchlist)
       {
           if($watchlist->pivot->season_id == $season->id )
           {
               $watchlisted = 1;
           }
       }

       $reviews = $season->reviews()->get();
       $reviewed = 0;
       foreach($reviews as $review)
       {
           if($review->pivot->user_id == Auth()->user()->id )
           {
               $reviewed = 1;
           }
       }

        return view('series/season/details',compact('season','watchlisted','reviews','reviewed'));
        
    }

    public function getEpisodeVideo($slug)
    {
        $episode = Episode::where('slug',$slug)->firstOrFail();
        $status = RentedSeries::where('user_id',AUth()->user()->id)->where('season_id',$episode->season_id)->first();

        if($status != NULL)
        { 
            $url = config('filesystems.disks.s3.url') . '/'.$episode->link;
            $signedUrl = CloudFrontUrlSigner::sign($url,Carbon::now()->addHours(3));

            $arr['data'] = $signedUrl;
            echo json_encode($arr);
            exit;
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }


}
