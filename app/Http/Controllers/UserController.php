<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Movie;
use App\Season;
use App\Watchlist;
use App\SeasonWatchlist;
use App\MovieReview;
use App\SeasonReview;
use App\Subscriber;
use App\SubscriberBilling;
use App\RentedMovie;
use App\RentedSeries;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function profile(){
        $movies = Auth()->user()->watchlists()->get();
        $seasons = Auth()->user()->seasonWatchlists()->get();

        return view('user.profile',compact('movies','seasons'));
    }
    
    public function profilePassword(){
        $movies = Auth()->user()->watchlists()->get();
        $seasons = Auth()->user()->seasonWatchlists()->get();

        return view('user.profile',compact('movies','seasons'));
    }

    public function watchlist(){
        $movies = Auth()->user()->watchlists()->get();
        $seasons = Auth()->user()->seasonWatchlists()->get();

        return view('user.profile',compact('movies','seasons'));
    }

    public function profileSave(Request $request){
         $this->validate($request, [
            'first_name' => 'required|string|max:100|regex:/^[A-Za-z]+$/',
            'last_name' => 'required|string|max:100|regex:/^[A-Za-z]+$/',
            'email' => 'required|email|unique:users,email,'.auth::user()->id,
            'phone' => 'nullable|numeric|digits:10|unique:users,phone,'.auth::user()->id,
        ], [
            'first_name.regex' => 'Space, number and special charecters are not allowed.',
            'flast_name.regex' => 'Space, number and special charecters are not allowed.',
        ]);

        $user = User::find(auth::user()->id);

        if($request->has('first_name'))
        {
            $user->first_name = $request->input('first_name');
        }
    
        if($request->has('last_name'))
        {
            $user->last_name = $request->input('last_name');
        }

        if($request->has('email') && $user->email != $request->input('email') )
        {
            $user->email = $request->input('email');
            $user->email_verified_at = NULL;
        }

        if($request->has('phone'))
        {
            $user->phone = $request->input('phone');
        }

        $user->save();

        return back()->with('success', 'Your profile has been updated successfully.');
    }

    public function PasswordChange(Request $request){
        $this->validate($request, [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $old_pass = $request->input('current_password');

        $user = User::find(auth::user()->id);
        if (Hash::check($old_pass, $user->password)) {

            $password = Hash::make($request->input('password'));
            $user->password = $password;
            $user->save();
            return back()->with('success', 'Your password has been successfully updated.');
        }else{
            return back()->withErrors(array('current_password' => 'Your current password didnot matched.'));
        }

    }

    public function UpdateProfilePicture(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,jpg|max:2000',
        ]);

        $user = Auth()->user();

        if($user->avatar !=NULL)
        {
            if(\File::exists(public_path('storage/avatar/'.$user->avatar))){

                \File::delete(public_path('storage/avatar/'.$user->avatar));
            
              }else{
            
                dd('File does not exists.');
            
              }
        }

        $file = $request->file('avatar');
        $extension = $file->getClientOriginalExtension();
        $filename = "avatar" . '_' . time() . '.' . $extension;
        $location = public_path('storage/avatar/') . $filename;

        //Store image in public folder
        Image::make($file)->resize(150,150)->save($location);

        //Store image filename in database
        $user->avatar = $filename;
        $user->save();
        return back()->with('success', 'Your Profile Picture has been successfully updated.');
    }

    public function addWatchlist($slug)
    {
        $movie = Movie::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;
        $subscriber = Subscriber::where('user_id',$user_id)->first();
        $rented_movie = RentedMovie::where('user_id',Auth()->user()->id)->where('movie_id',$movie->id)->first();

        if(($subscriber==NULL || $subscriber->status==0) && $movie->premium_status==1)
        {
            return redirect()->back()->with('error','This movie can not be added to the watchlist. Please subscribe to continue enjoying our services.');
        }
       
        else if(($rented_movie==NULL || $rented_movie->status==0) && $movie->premium_status==2)
        {
            return redirect()->back()->with('error','This movie can not be added to the watchlist. Please rent the content to continue enjoying our services.');

        }

        $watchlist = Watchlist::where('movie_id',$movie->id)->where('user_id',$user_id)->first();

        if($watchlist == NULL)
        {
            $watchlist = new Watchlist;
            $watchlist->movie_id = $movie->id;
            $watchlist->user_id = Auth()->user()->id;
            $watchlist->save();
            return redirect()->back()->with('success','Movie added to the watchlist');
        }

        else{
            return redirect()->back()->with('error','Movie already added to the watchlist');

        }
       
    }

    public function addSeasonWatchlist($slug)
    {
        $season = Season::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;
        $subscriber = Subscriber::where('user_id',$user_id)->first();
        $rented_series = RentedSeries::where('user_id',Auth()->user()->id)->where('season_id',$season->id)->first();

        if(($subscriber==NULL || $subscriber->status==0) && $season->premium_type==1)
        {
            return redirect()->back()->with('error','This movie can not be added to the watchlist. Please subscribe to continue enjoying our services.');
        }
       
        else if(($rented_series==NULL || $rented_series->status==0) && $season->premium_type==2)
        {
            return redirect()->back()->with('error','This movie can not be added to the watchlist. Please rent the content to continue enjoying our services.');

        }

        $watchlist = SeasonWatchlist::where('season_id',$season->id)->where('user_id',$user_id)->first();

        if($watchlist == NULL)
        {
            $watchlist = new SeasonWatchlist;
            $watchlist->season_id = $season->id;
            $watchlist->user_id = Auth()->user()->id;
            $watchlist->save();
            return redirect()->back()->with('success','Season added to the watchlist');
        }

        else{
            return redirect()->back()->with('error','Season already added to the watchlist');

        }
       
    }

    public function removeWatchlist($slug)
    {
        $movie = Movie::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;

        $watchlist = Watchlist::where('movie_id',$movie->id)->where('user_id',$user_id)->first();

        if($watchlist != NULL)
        {
            $watchlist = Watchlist::where('movie_id',$movie->id)->where('user_id',Auth()->user()->id)->first();
            $watchlist->forceDelete();
            return redirect()->back()->with('success','Movie removed from the watchlist');
        }

        else{
            return redirect()->back()->with('error','Invalid Selection');

        }
        
    }

    public function removeSeasonWatchlist($slug)
    {
        $season = Season::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;

        $watchlist = SeasonWatchlist::where('season_id',$season->id)->where('user_id',$user_id)->first();

        if($watchlist != NULL)
        {
            $watchlist = SeasonWatchlist::where('season_id',$season->id)->where('user_id',Auth()->user()->id)->first();
            $watchlist->forceDelete();
            return redirect()->back()->with('success','Season removed from the watchlist');
        }

        else{
            return redirect()->back()->with('error','Invalid Selection');

        }
        
    }

    public function addReview(Request $request , $slug)
    {
        $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|max:200|string',
        ]);

        $movie = Movie::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;

        $subscriber = Subscriber::where('user_id',$user_id)->first();

        $rented_movie = RentedMovie::where('user_id',Auth()->user()->id)->where('movie_id',$movie->id)->first();

        if(($subscriber==NULL || $subscriber->status==0) && $movie->premium_status==1)
        {
            return redirect()->back()->with('error','You are not allowed to review the movie. Please subscribe to continue enjoying our services.');
        }

        else if(($rented_movie==NULL || $rented_movie->status==0) && $movie->premium_status==2)
        {
            return redirect()->back()->with('error','You are not allowed to review the movie. Please rent the content to continue enjoying our services.');

        }

        $review = MovieReview::where('movie_id',$movie->id)->where('user_id',$user_id)->first();

        if($review == NULL)
        {
            $review = new MovieReview;
            $review->user_id = Auth()->user()->id;
            $review->movie_id = $movie->id;
            $review->rating = $request->input('rating');
            $review->review = $request->input('review');
            $review->save();
            return redirect()->back()->with('success','Your Review has been posted successfully');
        }
        else{
            return redirect()->back()->with('error','You have already posted review for this movie');

        }
    }

    public function addSeasonReview(Request $request , $slug)
    {
        $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|max:200|string',
        ]);

        $season = Season::where('slug',$slug)->firstOrFail();

        $user_id = Auth()->user()->id;

        $subscriber = Subscriber::where('user_id',$user_id)->first();

        $rented_series = RentedSeries::where('user_id',Auth()->user()->id)->where('season_id',$season->id)->first();

        if(($subscriber==NULL || $subscriber->status==0) && $season->premium_type==1)
        {
            return redirect()->back()->with('error','You are not allowed to review the movie. Please subscribe to continue enjoying our services.');
        }

        else if(($rented_series==NULL || $rented_series->status==0) && $season->premium_type==2)
        {
            return redirect()->back()->with('error','You are not allowed to review the movie. Please rent the content to continue enjoying our services.');

        }

        $review = SeasonReview::where('season_id',$season->id)->where('user_id',$user_id)->first();

        if($review == NULL)
        {
            $review = new SeasonReview;
            $review->user_id = Auth()->user()->id;
            $review->season_id = $season->id;
            $review->rating = $request->input('rating');
            $review->review = $request->input('review');
            $review->save();
            return redirect()->back()->with('success','Your Review has been posted successfully');
        }
        else{
            return redirect()->back()->with('error','You have already posted review for this movie');

        }
    }

    public function mySubscription()
    {
        $subscriber = Subscriber::where('user_id',Auth()->user()->id)->first();

        if($subscriber !=NULL)
        {
            $billing = SubscriberBilling::where('subscriber_id',$subscriber->id)->orderBy('created_at', 'desc')->first();
        }
        else
        {
            $billing = NULL;
        }
        
        return view('user.mysubscription',compact('subscriber','billing'));
    }

    public function myRentedMovies()
    {
        $movies = Auth()->user()->rentedMovies()->get();
        //return $movies;
        return view('user.rented_movies',compact('movies'));
    }

    public function myRentedSeries()
    {
         $seasons = Auth()->user()->rentedSeries()->get();
        //return $movies;
        return view('user.rented_series',compact('seasons'));
    }
}
