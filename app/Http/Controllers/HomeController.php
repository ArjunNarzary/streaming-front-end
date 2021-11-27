<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

use App\Series;

use App\Season;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $movies = Movie::latest()->where('status',1)->get()->take(4);
        $series = Series::latest()->where('status',1)->get()->take(4);

        $carouselMovie = Movie::latest()->whereNotNull('carousal')->get();
        $carouselSeason = Season::latest()->whereNotNull('carousal')->get();

        return view('index',compact('movies','series','carouselMovie','carouselSeason'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|max:20|string',
        ]);

        $keyword = $request->input('search');

        $movies = Movie::where([ 
            ['title', 'LIKE', '%' . $keyword . '%'],
        ])->get();

        $series = Series::where([ 
            ['title', 'LIKE', '%' . $keyword . '%'],
        ])->get();

        
        return view('search', compact('movies','keyword','series'));
    }
}
