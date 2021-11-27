<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $connection = 'mysql2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function watchlists()
    {
        return $this->belongsToMany('App\Movie', 'getthrills_streaming.watchlists');
    }

    public function seasonWatchlists()
    {
        return $this->belongsToMany('App\Season', 'getthrills_streaming.season_watchlists');
    }

    public function rentedMovies()
    {
        return $this->belongsToMany('App\Movie', 'getthrills_streaming.rented_movies')->withPivot('status', 'rent_expiry');
    }

    public function rentedSeries()
    {
        return $this->belongsToMany('App\Season', 'getthrills_streaming.rented_series')->withPivot('status', 'rent_expiry');
    }
}