<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    //
    public function casts()
    {
        return $this->belongsToMany('App\Cast','season_casts')->withPivot('role');;
    }

    public function series()
    {
        return $this->belongsTo('App\Series');
    }

    public function episodes()
    {
        return $this->hasMany('App\Episode');
    }

    public function reviews()
    {
        return $this->belongsToMany('App\User','season_reviews')->withPivot('review','rating','created_at');
    }

    public function avgReview()
    {
        return $this->hasMany('App\SeasonReview')->average('rating');
    }

    public function countReview()
    {
        return $this->hasMany('App\SeasonReview')->count('user_id');
    }
}
