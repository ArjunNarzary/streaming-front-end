<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('index');
Route::get('/search', 'HomeController@search')->name('search');

Auth::routes(['verify' => true]);

//User Controller
Route::get('/profile', 'UserController@profile')->name('user.profile');
Route::post('/profile', 'UserController@profileSave')->name('profile.save');
Route::get('/profile/password', 'UserController@profilePassword')->name('user.password');
Route::post('/profile/password', 'UserController@PasswordChange')->name('profile.password');
Route::post('/profile/avatar', 'UserController@UpdateProfilePicture')->name('profile.avatar');
Route::get('/profile/watchlist', 'UserController@watchlist')->name('user.watchlist')->middleware('verified');
Route::get('/profile/addwatchlist/{slug}', 'UserController@addWatchlist')->name('user.addWatchlist')->middleware('verified');
Route::get('/profile/removewatchlist/{slug}', 'UserController@removeWatchlist')->name('user.removeWatchlist')->middleware('verified');
Route::post('/movie/review/{slug}', 'UserController@addReview')->name('user.add.review')->middleware('verified');
Route::post('/season/review/{slug}', 'UserController@addSeasonReview')->name('user.season.review')->middleware('verified');
Route::get('/rented/movie','UserController@myRentedMovies')->name('user.rented.movie')->middleware('verified');
Route::get('/rented/series','UserController@myRentedSeries')->name('user.rented.series')->middleware('verified');
Route::get('/profile/addSeasonwatchlist/{slug}', 'UserController@addSeasonWatchlist')->name('user.addSeasonWatchlist')->middleware('verified');
Route::get('/profile/removeSeasonwatchlist/{slug}', 'UserController@removeSeasonWatchlist')->name('user.removeSeasonWatchlist')->middleware('verified');

//Route::get('/mysubscription', 'UserController@mySubscription')->name('user.mysubscription')->middleware('verified');




//Movie Controller
Route::get('/movies/all', 'MovieController@index')->name('movies.all');
Route::get('/movie/{id}', 'MovieController@details')->name('movie.view');

//Series Controller
Route::get('/series/all', 'SeriesController@index')->name('series.all');
Route::get('/series/{id}', 'SeriesController@details')->name('series.view');
Route::get('/{id}', 'SeriesController@seasonDetails')->name('season.view');
Route::get('/getEpisodeVideo/{id}','SeriesController@getEpisodeVideo');



//Subscription Controller
//Route::get('/subscription/all', 'SubscriptionController@index')->name('subscription.all');
//Route::get('/subscription/subscribe/{id}', 'SubscriptionController@subscribe')->name('subscribe');

//Rent Controller
Route::get('/rent/movie/{slug}', 'RentController@movie')->name('rent.movie');
Route::post('/rent/payment', 'RentController@payment')->name('rent.payment');
Route::get('/rent/series/{slug}', 'RentController@season')->name('rent.series');
Route::post('/rent/series/payment', 'RentController@seasonPayment')->name('rent.season.payment');



//Route::get('/subscription/subscribe/{id}', 'SubscriptionController@subscribe')->name('subscribe');



