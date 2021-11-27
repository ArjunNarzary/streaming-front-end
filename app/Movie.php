<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
   
    public function genres()
    {
        return $this->belongsToMany('App\Genre','genre_movies');
    }

    public function casts()
    {
        return $this->belongsToMany('App\Cast','cast_movies')->withPivot('role');;
    }

    public function crews()
    {
        return $this->belongsToMany('App\Crew','crew_movies')->withPivot('designation');
    }

    public function posters()
    {
        return $this->hasMany('App\MoviePoster');
    }

    public function reviews()
    {
        return $this->belongsToMany('App\User','movie_reviews')->withPivot('review','rating','created_at');
    }

    public function avgReview()
    {
        return $this->hasMany('App\MovieReview')->average('rating');
    }

    public function countReview()
    {
        return $this->hasMany('App\MovieReview')->count('user_id');
    }
}
