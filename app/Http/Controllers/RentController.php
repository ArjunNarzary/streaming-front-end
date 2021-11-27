<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

use App\Season;

use App\RentedMovie;

use App\RentedSeries;

use App\RentedMovieBilling;

use App\RentedSeriesBilling;

use Carbon\Carbon;

class RentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function movie($slug)
    {
        $movie = Movie::where('slug',$slug)->where('premium_status',2)->firstOrFail();
        $rented_movie = RentedMovie::where('user_id',Auth()->user()->id)->where('movie_id',$movie->id)->first();
        if($rented_movie != NULL && $rented_movie->status == 1)
        {
            return redirect()->route('movie.view',$movie->slug);
        }
        else{
            return view('rent.movie',compact('movie'));
        }
    }

    public function season($slug)
    {
        $season = Season::where('slug',$slug)->where('premium_type',2)->firstOrFail();
        $rented_series = RentedSeries::where('user_id',Auth()->user()->id)->where('season_id',$season->id)->first();
        if($rented_series != NULL && $rented_series->status == 1)
        {
            return redirect()->route('season.view',$season->slug);
        }
        else{
            return view('rent.season',compact('season'));
        }
    }

    public function payment(Request $request)
    {
        $movie = Movie::where('slug',$request->input('slug'))->firstOrFail();
        $slug = $movie->slug;
        $current = Carbon::now();
        // add Time Period to the current time
        $rent_expiry = $current->addDay(7);

        $rented_movie = RentedMovie::where('user_id',Auth()->user()->id)->where('movie_id',$movie->id)->first();

        if($rented_movie != NULL)
        {
            if($rented_movie->status == 1)
            {
                return redirect()->route('movie.view',$slug);
            }
            else{
                $rented_movie->rent_expiry = $rent_expiry;
                $rented_movie->status = 1;
                $rented_movie->save();
            }
            
        }
        else
        {
            $rented_movie = new RentedMovie;
            $rented_movie->user_id = Auth()->user()->id;
            $rented_movie->movie_id = $movie->id;
            $rented_movie->rent_expiry = $rent_expiry;
            $rented_movie->status = 1;
            $rented_movie->save();
        }

        $billing = new RentedMovieBilling;
        $billing->user_id = Auth()->user()->id;
        $billing->movie_id = $movie->id;
        $billing->amount = $movie->amount;
        $billing->payment_status = 1;
        $billing->save();

        return view('rent.rent-successful',compact('slug'));
    }

    public function seasonPayment(Request $request)
    {
        $season = Season::where('slug',$request->input('slug'))->firstOrFail();
        $slug = $season->slug;
        $current = Carbon::now();
        // add Time Period to the current time
        $rent_expiry = $current->addDay(7);

        $rented_series = RentedSeries::where('user_id',Auth()->user()->id)->where('season_id',$season->id)->first();

        if($rented_series != NULL)
        {
            if($rented_series->status == 1)
            {
                return redirect()->route('season.view',$slug);
            }
            else{
                $rented_series->rent_expiry = $rent_expiry;
                $rented_series->status = 1;
                $rented_series->save();
            }
            
        }
        else
        {
            $rented_series = new RentedSeries;
            $rented_series->user_id = Auth()->user()->id;
            $rented_series->season_id = $season->id;
            $rented_series->rent_expiry = $rent_expiry;
            $rented_series->status = 1;
            $rented_series->save();
        }

        $billing = new RentedSeriesBilling;
        $billing->user_id = Auth()->user()->id;
        $billing->season_id = $season->id;
        $billing->amount = $season->amount;
        $billing->payment_status = 1;
        $billing->save();

        return view('rent.series-rent-successful',compact('slug'));
    }
}
