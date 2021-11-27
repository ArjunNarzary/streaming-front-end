@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')

@endsection
<!--DESCRIPTION META TAG END HERE-->
@section('CSS')
   <style>
      .custom_active{
         background-color:blue;
         color:white;
         pointer-events:none;
      }
      .custom_active:hover{
         background-color:blue;
         color:white;
      }
   </style>
@endsection
@section('title', 'Movies')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-md-fluid">

          
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
                     <h1 class="h5 mb-0 text-gray-900">My Rented TV Series</h1>
                  </div>
                  <!-- Content Row -->
                  <div class="row">

                     <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            @foreach($seasons as $season)
                            <div class="col-xl-3 col-md-6 col-12 mb-4 hvr-shrink">
                              <div class="card m-card shadow border-0">
                                 <a href="{{ route('season.view', ['id' => $season->slug]) }}">
                                    <div class="m-card-cover">
                                                <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                                                <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i>{{$season->avgReview()*20}}<span>%</span> </h6>
                                                <small class="text-muted">{{$season->countReview()}}</small>
                                                </div>
                                       <img class="img-fluid rounded-top" src="{{asset('storage/series/seasons/'.$season->cover)}}" height="420">
                                    </div>
                                    <div class="card-body p-3">
                                       <h5 class="card-title text-gray-900 mb-1">{{$season->series->title}}</h5>
                                       <h5 class="card-title text-gray-900 mb-1">{{$season->title}}</h5>
                                       <p class="card-text">@if($season->pivot->status == 0) <span class="text-danger">Expired</span>     @else <span class="text-success">Rent Expires On :</span>  <small class="text-danger"><i class="d-md-inline d-none fas fa-calendar-alt fa-sm text-gray-400"></i> {{Carbon\Carbon::parse($season->pivot->rent_expiry)->format('d M, Y ')}}</small> @endif</p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                           @endforeach
                        </div>

                   

                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
@endsection

