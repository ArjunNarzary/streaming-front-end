@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')

@endsection
<!--DESCRIPTION META TAG END HERE-->

@section('title', 'Movies')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-md-fluid">
                  <div class="row">

                     <div class="col-xl-3 col-lg-3">
                        <div class="bg-white p-3 widget shadow rounded mb-4">
                        <div class="">
                           <div class="position-absolute bg-white shadow-sm rounded text-center p-1 m-1 love-box">
                              <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i></h6>
                              <small class="text-muted"></small>
                           </div>

                           <img class="img-fluid rounded hvr-grow" src="{{asset('storage/series/'.$series->banner)}}" height="420">
                        </div>
                        </div>
                        
                     </div>
                     <div class="col-xl-9 col-lg-9">
                        <div class="bg-white info-header shadow rounded mb-4">
                           <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                              <div class="col-lg-7 m-b-4">
                                 <h3 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{$series->title}} <small>{{Carbon\Carbon::parse($series->release_date)->format('Y')}}</small></h3>
                                 <p class="mb-0 text-gray-800"><small class="text-muted"><i class="fas fa-film fa-fw fa-sm mr-1"></i>
                                 @if(count($series->genres)>=1)
                                  @foreach($series->genres as $genre)
                                    {{$genre->name}}/
                                  @endforeach
                                  @else
                                    Genre Not Available
                                  @endif
                                </small> 
                                </p>
                              </div>
                              
                           </div>
                          
                        
                        </div>
                        <div class="bg-white p-3 widget shadow rounded mb-4">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Summary</a>
                              </li>
                             
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#crew" role="tab" aria-controls="crew" aria-selected="false">Crew
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="posters-tab" data-toggle="tab" href="#posters" role="tab" aria-controls="posters" aria-selected="false">Posters</a>
                              </li>
                              
                             

                           </ul>
                           <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                 
                                 <h3 class="mt-0 mb-3 text-dark overview">Overview</h3>
                                 <p class="text-dark">{!!$series->description!!}</p>

                              </div>
                            
                              
                              <div class="tab-pane fade" id="crew" role="tabpanel" aria-labelledby="crew-tab">
                                 <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">CREW</h5>
                                 <div class="row">
                                 @if(count($series->crews)>=1)
                                 @foreach($series->crews as $crew)
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="artist-list mb-3">
                                          <a class="d-flex align-items-center" href="#">
                                             <div class="dropdown-list-image mr-3">
                                             <img class="rounded-circle hvr-grow" src="{{asset('storage/crews/'.$crew->photo)}}" width="120" height="140">
                                                <div class="status-indicator bg-success"></div>
                                             </div>
                                             <div class="font-weight-bold">
                                                <div class="text-truncate">{{$crew->name}}</div>
                                                <div class="text-truncate text-dark"><small>{{$crew->pivot->designation}}</small></div>
                                             </div>
                                          </a>
                                       </div>

                                    </div>
                                 @endforeach
                                   @else
                                    <div class="col-xl-12 col-md-6 mb-4"><span>Not Available.</span></div>
                                    @endif
                                 </div>
                              </div>
                             
                              <div class="tab-pane fade" id="posters" role="tabpanel" aria-labelledby="posters-tab">
                              <div class="row">
                               @if(count($series->posters)>=1)
                               @foreach($series->posters as $poster)
                                <div class="col-xl-3 col-md-6 col-6 mb-4">
                                            <img class="img-fluid" src="{{asset('storage/posters/'.$poster->poster)}}" height="300" width="200">
                                </div>
                                @endforeach
                               @else
                                    <div class="col-xl-12 col-md-6 mb-4"><span>Not Available.</span></div>
                               @endif
                            </div>
                              </div>
                              

                           </div>
                        </div>
                        
                    
                        <div class="bg-white p-3 widget shadow rounded mb-4">
                           <h1 class="h5 mb-1 text-gray-900">Seasons</h1>
                           <div class="row">

                              <div class="col-xl-12 col-lg-12">
                                 <div class="row">
                                    @foreach($series->seasons as $season)
                                    <div class="col-xl-3 col-md-6 col-6 mb-4 hvr-shrink">
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
                                                <h5 class="card-title text-gray-900 mb-1">{{$season->title}}</h5>
                                                <p class="card-text"><small class="text-muted">First Air Date</small> <small class="text-danger"><i class="d-md-inline d-none fas fa-calendar-alt fa-sm text-gray-400"></i> {{Carbon\Carbon::parse($season->release_date)->format('d M ')}}<span class="text-white rounded m-1 p-1 bg-success float-right">@if($season->premium_type==2)Rent @else Free @endif</span></small> </p>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>



                              </div>
                              </div>
                        </div>



                     </div>
                  </div>
              
                

               </div>
               <!-- /.container-fluid -->
@endsection

