<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

use App\Subscriber;

use App\RentedMovie;

use CloudFrontUrlSigner;

use Carbon\Carbon;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $movies = Movie::latest()->where('status',1)->get();
        return view('movie/index',compact('movies'));
    }

    public function details($slug)
    {
        $movie = Movie::where('slug',$slug)->firstOrFail();
        $user_id = Auth()->user()->id;

        //Checking for subscription based content
        if($movie->premium_status == 1)
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
       else if($movie->premium_status == 2)
       {
            $data = RentedMovie::where('user_id',$user_id)->where('movie_id',$movie->id)->first();

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
                return redirect()->route('rent.movie',$movie->slug);
            }
       }

       
        $duration = $this->hoursandmins($movie->length);

        $watchlists = Auth()->user()->watchlists()->get(); 
        $watchlisted = 0;
        foreach($watchlists as $watchlist)
        {
            if($watchlist->pivot->movie_id == $movie->id )
            {
                $watchlisted = 1;
            }
        }

        $reviews = $movie->reviews()->get();
        $reviewed = 0;
        foreach($reviews as $review)
        {
            if($review->pivot->user_id == Auth()->user()->id )
            {
                $reviewed = 1;
            }
        }
        
        $url = config('filesystems.disks.s3.url') . '/'.$movie->link;
        $signedUrl = CloudFrontUrlSigner::sign($url,Carbon::now()->addHours(3));
       
        return view('movie/details',compact('movie','duration','signedUrl','watchlisted','reviews','reviewed'));
        
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
}
