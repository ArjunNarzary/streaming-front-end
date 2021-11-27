@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')
 <style>
      .remodal-close {
      }
      .remodal {
      max-width: 100% !important;
      background: transparent !important;
      }

      @media only screen and (max-width: 600px) {
      .remodal {
         padding: 2px !important;
         max-width: 100% !important;
         background: transparent !important;
      }
      .remodal-close {
         top: -31px;
         left:-9px;
      }
      
      }
      .remodal, .remodal-wrapper, video {
      width: 100vw;
      max-height: 100vh;
      }
 </style>
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

                           <img class="img-fluid rounded hvr-grow" src="{{asset('storage/series/seasons/'.$season->cover)}}" height="420">
                        </div>
                        </div>
                        
                     </div>
                     <div class="col-xl-9 col-lg-9">
                        <div class="bg-white info-header shadow rounded mb-4">
                           <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                              <div class="col-lg-7 m-b-4">
                                 <h3 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{$season->series->title}}</h3>
                                 <h3 class="text-gray-900 mb-0 mt-0 font-weight-bold">{{$season->title}} <small>({{Carbon\Carbon::parse($season->release_date)->format('Y')}})</small></h3>
                              </div>
                              <div class="col-lg-5 text-right">
                              <p class="mb-0 mt-2 text-gray-900"><span class="text-white rounded  px-2 py-1 bg-success">@if($season->premium_type==2)Rent @else Free @endif</span></p>
                              </div>
                           </div>
                           <div class="row d-flex align-items-center justify-content-between py-3 px-4">
                              <div class="col-lg-6 m-b-4">
                              </div>
                              <div class="col-lg-5 text-right">
                              @if($watchlisted == 0)
                               <a  href="{{route('user.addSeasonWatchlist',['slug'=>$season->slug])}}" class="d-sm-inline-block btn btn-warning  shadow-sm text-light"><i class="fa fa-plus" aria-hidden="true"></i> Watchlist </a>
                              @else
                              <a  href="{{route('user.removeSeasonWatchlist',['slug'=>$season->slug])}}" class="d-sm-inline-block btn btn-success  shadow-sm text-light"><i class="fa fa-check" aria-hidden="true"></i> Watchlist </a>
                              @endif
                              </div>
                           </div>
                        
                        </div>
                        <div class="bg-white p-3 widget shadow rounded mb-4">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Summary</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cast
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Reviews</a>
                              </li>
                           </ul>
                           <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                 
                                 <h3 class="mt-0 mb-3 text-dark overview">Overview</h3>
                                 <p class="text-dark">{!!$season->description!!}</p>

                              </div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                 <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">CAST</h5>
                                 <div class="row">
                                 @if(count($season->casts)>=1)
                                 @foreach($season->casts as $cast)
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="artist-list mb-3">
                                          <a class="d-flex align-items-center" href="#">
                                             <div class="dropdown-list-image mr-3">
                                             <img class="rounded-circle hvr-grow" src="{{asset('storage/casts/'.$cast->photo)}}" width="120" height="140">
                                                <div class="status-indicator bg-success"></div>
                                             </div>
                                             <div class="font-weight-bold">
                                                <div class="text-truncate">{{$cast->name}}</div>
                                                <div class="text-truncate text-dark"><small>{{$cast->pivot->role}}</small></div>
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
                              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                               <div class="card-body p-0 reviews-card">
                               @foreach($reviews as $review)
                               <div class="media mb-4">
                                       <img class="d-flex mr-3 rounded-circle" src="{{ $review->avatar != NULL ? asset('storage/avatar/'.$review->avatar) : asset('storage/avatar/default.jpg')}}"  alt="">
                                       <div class="media-body">
                                          <div class="mt-0 mb-1">
                                             <span class="h6 mr-2 font-weight-bold text-gray-900">{{$review->first_name}} {{$review->last_name}}</span> <span><i class="fa fa-calendar"></i> {{Carbon\Carbon::parse($review->pivot->created_at)->format('M d , Y')}}</span>
                                             <div class="stars-rating float-right"> <i class="fa fa-star {{ $review->pivot->rating > 0 ? ' active' : '' }}"></i>
                                                <i class="fa fa-star {{ $review->pivot->rating > 1 ? ' active' : '' }}"></i>
                                                <i class="fa fa-star {{ $review->pivot->rating > 2 ? ' active' : '' }}"></i>
                                                <i class="fa fa-star {{ $review->pivot->rating > 3 ? ' active' : '' }}"></i>
                                                <i class="fa fa-star {{ $review->pivot->rating > 4 ? ' active' : '' }}"></i>  <span class="rounded bg-warning text-dark pl-1 pr-1">{{$review->pivot->rating}}/5</span>
                                             </div>
                                          </div>
                                          <p>{{$review->pivot->review}}</p>
                                       </div>
                              </div>
                              @endforeach
                              </div>
                              @if($reviewed==0)
                              <div class="p-4 bg-light rounded mt-4">
                                    <h5 class="card-title mb-4">Leave a Review</h5>
                                    <form method="post" action="{{route('user.season.review',['slug'=>$season->slug])}}">
                                       @csrf
                                       <div class="row">
                                          <div class="control-group form-group col-lg-4 col-md-4">
                                             <div class="controls">
                                                <label>Rating <span class="text-danger">*</span></label>
                                                <select class="form-control custom-select" name="rating" required>
                                                   <option value="1">1 Star</option>
                                                   <option value="2">2 Star</option>
                                                   <option value="3">3 Star</option>
                                                   <option value="4">4 Star</option>
                                                   <option value="5">5 Star</option>
                                                </select>
                                                @error('rating')
                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                             </div>
                                          </div>
                                       </div>
                                       <div class="control-group form-group">
                                          <div class="controls">
                                             <label>Review <span class="text-danger">*</span></label>
                                             <textarea rows="3" cols="100" class="form-control" name="review" required></textarea>
                                             @error('review')
                                                   <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="text-right">
                                          <button type="submit" class="btn btn-primary">Post Review</button>
                                       </div>
                                    </form>
                                 </div>
                                 @endif
                              </div>
                           
                        
                            

                           </div>
                        </div>
                        
                        <div class="bg-white info-header shadow rounded mb-4">
                           <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                              <div class="col-lg-7 m-b-4">
                                 <h6 class="text-gray-900 mb-0 mt-0 font-weight-bold"> Episodes({{$season->total_episodes}})</h6>
                              </div>
                             
                           </div>
                           <div class="row d-flex align-items-center justify-content-between py-3 px-4">
                           @foreach($season->episodes as $episode)
                           <div class="row m-2 border-bottom">
                              <div class="col-lg-3 m-b-4">
                                 <img class=" m-2" src="{{asset('storage/series/episodes/'.$episode->banner)}}" width="120" height="140">
                              </div>
                              <div class="col-lg-9 ">
                               <h6 class="mt-2 text-dark"><a  href="#modal" data-value="{{$episode->slug}}"  class="getEpisode hvr-back-pulse d-sm-inline-block btn btn-primary btn-sm shadow-sm text-light"><i class="fa fa-play" aria-hidden="true"></i> Play </a>
                                   {{$episode->episode_no}}. {{$episode->title}}
                              </h6>
                              <p><small>{{Carbon\Carbon::parse($episode->release_date)->format('M d, Y')}}</small></p>
                               <p>{!!$episode->description!!}</p>
                              </div>
                              </div>
                           @endforeach
                           </div>
                        
                        </div>

                     </div>
                  </div>
                  <section class="remodal" data-remodal-id="modal">
                     <button data-remodal-action="close" class="remodal-close"></button>
                      <video id="my-video" class="video-js vjs-default-skin" controls  width="100%" height="auto"  data-setup="{}">
                     </video>
                  </section>
                

               </div>
               <!-- /.container-fluid -->
@endsection

@section('JS')

<script>

var player = videojs("my-video", {
  autoplay:"muted",
  preload:"none",
  fluid: true
});

$(document).on("opened", ".remodal", function() {
  player.play("muted");
  player.muted(false); // unmute the volume
});

$(document).on("closing", ".remodal", function() {
  player.pause();
});

</script>

<script>
$(document).ready(function(){
 
   $(document).on("click",".getEpisode",function() {
         var id = $(this).attr("data-value");
         console.log(id);
         getEpisode(id);
   });


function getEpisode(id){
 $.ajax({
    
   url: 'getEpisodeVideo/'+id,
   cache:'false',
   type: 'get',
   dataType: 'json',
   success: function(response){

      var video = videojs("my-video", { "controls": true, "autoplay": false, "preload": "auto" }, function(){
            
      });

      video.src(response['data']);             
   }
 });
}

});
</script>
@endsection
