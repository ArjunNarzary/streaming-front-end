<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    public function genres()
    {
        return $this->belongsToMany('App\Genre','series_genres');
    }

    public function crews()
    {
        return $this->belongsToMany('App\Crew','series_crews')->withPivot('designation');
    }

    public function posters()
    {
        return $this->hasMany('App\SeriesPoster');
    }

    public function seasons()
    {
        return $this->hasMany('App\Season');
    }
}
