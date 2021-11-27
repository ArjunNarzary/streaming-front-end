@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')

@endsection
<!--DESCRIPTION META TAG END HERE-->

@section('title')

@section('CSS')
<style>
     @media only screen and (max-width: 500px){
         footer{
             margin-bottom: 3.5rem;
         }
         .bottom-nav{
            display: block;
        }
    }
</style>
@endsection

<!--Bottom Nav-->
@section('bottom_nav')
<div class="bottom-nav">
    <div class="bottom-box d-flex pl-4">
         <a class="active" href="/">
              <i class="ml-1 fas fa-fw fa-home"></i>
            <span class="d-block">Home</span>
        </a>
         <a  href="{{route('movies.all')}}">
            <i class="ml-1 fas fa-fw fa-film"></i>
            <span class="d-block">Movies</span>
        </a>
         <a href="{{route('series.all')}}">
            <i class="ml-1 fas fa-fw fa-tv"></i>
            <span class="d-block">Series</span>
        </a>
        <a href="{{route('user.profile')}}">
            <i class="ml-1 fas fa-fw fa-user-circle"></i>
            <span class="d-block">Profile</span>
        </a>
    </div>
</div>
@endsection

@section('content')

<!--Begin Page Content -->
<div class="container-md-fluid">

    <!-------SLIDER------->
    <div class="osahan-slider">
        @foreach($carouselMovie as $movie)
            <div class="osahan-slider-item"><a href="{{ route('movie.view', ['id' => $movie->slug]) }}"><img src="{{asset('storage/carousals/'.$movie->carousal)}}" class="img-fluid rounded" alt="..." ></a></div>
        @endforeach
        @foreach($carouselSeason as $season)
            <div class="osahan-slider-item"><a href="{{ route('season.view', ['id' => $season->slug]) }}"><img src="{{asset('storage/carousals/'.$season->carousal)}}" class="img-fluid rounded" alt="..." ></a></div>
        @endforeach
         </div>
    <!-------SLIDEREND------->



    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
        <h1 class="h5 mb-0 text-gray-900"> Movies</h1>
        <a href="{{ route('movies.all') }}" class="d-inline-block mt-2 mt-md-0 text-xs">View All <i class="fas fa-eye fa-sm"></i></a>
    </div>
    <!-- Content Row -->
    <div class="mobile-width">
    <div class="row mobile-width-box">
            @foreach($movies as $movie)
            <div class="col-3 mb-2 mb-md-3 mt-2 hvr-shrink">
            <div class="card m-card shadow border-0">
                <a href="{{ route('movie.view', ['id' => $movie->slug]) }}">
                    <div class="m-card-cover">
                        <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                        <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i>{{$movie->avgReview()*20}}<span>%</span> </h6>
                        <small class="text-muted">{{$movie->countReview()}}</small>
                        </div>
                        <img class="img-fluid rounded-top" src="{{asset('storage/movies/'.$movie->banner)}}" max-height="420">
                    </div>
                    <div class="card-body p-1 pb-2 pb-md-3 p-md-3">
                        <h5 class="card-title text-gray-900 mb-0 mb-md-1">{{$movie->title}}</h5>
                        <p class="card-text"><small class="text-muted">Release Date</small> <small class="text-danger"><i class="d-md-inline d-none fas fa-calendar-alt fa-sm text-gray-400"></i>{{Carbon\Carbon::parse($movie->release_date)->format('d M')}}<span class="text-white float-right rounded m-1 p-1 bg-success">@if($movie->premium_status==2)Rent @else Free @endif</span></small> </p>
                    </div>
                </a>
            </div>
            </div>
            @endforeach
    </div>
</div>



<!-- Page Heading -->
<div class="d-flex align-items-center justify-content-between mt-2 mb-3">
        <h1 class="h5 mb-0 text-gray-900">TV Series</h1>
        <a href="{{ route('series.all') }}" class="d-inline-block mt-2 mt-md-0 text-xs">View All <i class="fas fa-eye fa-sm"></i></a>
    </div>
    <!-- Content Row -->
    <div class="mobile-width">
    <div class="row mobile-width-box">
            @foreach($series as $serie)
            <div class="col-3 mb-2">
            <div class="card m-card shadow border-0">
                <a href="{{ route('series.view', ['id' => $serie->slug]) }}">
                    <div class="m-card-cover">
                      
                        <img class="img-fluid rounded-top" src="{{asset('storage/series/'.$serie->banner)}}" max-height="420">
                    </div>
                    <div class="card-body p-1 pb-2 pb-md-3 p-md-3">
                        <h5 class="card-title text-gray-900 mb-0 mb-md-1">{{$serie->title}}</h5>
                        <p class="card-text"><small class="text-muted">First Air Date</small> <small class="text-danger"><i class="d-md-inline d-none fas fa-calendar-alt fa-sm text-gray-400"></i>{{Carbon\Carbon::parse($serie->release_date)->format('d M')}}</small> </p>
                    </div>
                </a>
            </div>
            </div>
           @endforeach

    </div>
    </div>


   
   


</div>
<!-- /.container-fluid -->

@endsection
