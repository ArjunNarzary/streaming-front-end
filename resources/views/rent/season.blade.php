@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')
   
@endsection
<!--DESCRIPTION META TAG END HERE-->

@section('title', 'Movies')

@section('content')
<div class="container-md-fluid">

          
                
                  <div class="row">

                     <div class="col-xl-12 col-lg-12">
                        <div class="row">
                        <div class="col-xl-3"></div>
                            <div class="col-xl-3 col-md-6 col-12 mb-4 hvr-shrink">
                              <div class="card m-card shadow border-0">
                                 <a href="{{ route('season.view', ['id' => $season->slug]) }}">
                                    <div class="m-card-cover">
                                                <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">
                                                <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i>{{$season->avgReview()*20}}<span>%</span> </h6>
                                                <small class="text-muted">{{$season->countReview()}}</small>
                                                </div>
                                       <img class="img-fluid rounded-top" src="{{asset('storage/series/seasons/'.$season->cover)}}" height="420" width="350">
                                    </div>
                                    <div class="card-body p-3">
                                    <h5 class="card-title text-gray-900 mb-1">{{$season->series->title}}</h5>
                                       <h5 class="card-title text-gray-900 mb-1">{{$season->title}}</h5>
                                       <p class="card-text"><small class="text-muted">Release Date</small> <small class="text-danger"><i class="d-md-inline d-none fas fa-calendar-alt fa-sm text-gray-400"></i> {{Carbon\Carbon::parse($season->release_date)->format('d M ')}}<span class="text-white float-right rounded m-1 p-1 bg-success">@if($season->premium_type==2)Rent @else Free @endif</span></small> </p>
                                    </div>
                                 </a>
                              </div>
                           </div>
                           <div class="col-xl-3 col-md-6 col-12 mb-4">
                          
                              <div class="card m-card shadow border-0">
                                    <div class="m-card-cover bg-success">
                                       <h6 class="text-gray-900 text-center m-4 font-weight-bold"><b>Billing Details</b> </h6>
                                       <small class="text-muted"></small>
                                       
                                    </div>
                                    <div class="card-body p-3">
                                       <p class="card-text">Rental Period : 7 days</p>
                                       <p class="card-text">Amount : &#8377; {{number_format($season->amount,2)}}</p>
                                    </div>
                                    <form method="POST" action="{{ route('rent.season.payment') }}">
                                      @csrf 
                                      <input type="hidden" name="slug" value="{{$season->slug}}">
                                      <button type="submit" class="btn btn-primary btn-user btn-block">
                                          Proceed to Payment
                                      </button>
                                    </form>
                              </div>
                           </div>
                           <div class="col-xl-3"></div>
                        </div>
                     </div>
                     
                  </div>

               </div>
@endsection