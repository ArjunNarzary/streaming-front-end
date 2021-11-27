@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')

@endsection
<!--DESCRIPTION META TAG END HERE-->

@section('title', 'Profile')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <section class="pt-5 pb-5 bg-gradient-primary text-white pl-4 pr-4 inner-profile mb-4">
           <div class="row gutter-2 gutter-md-4 align-items-end">
              <div class="col-md-6 text-center text-md-left">
              <img class="img-profile rounded-circle" src="{{ auth::user()->avatar != NULL ? asset('storage/avatar/'.auth::user()->avatar) : asset('storage/avatar/default.jpg')}}" height="150px" width="auto"> 
                 <h4 class="mb-1">{{ auth::user()->first_name }} {{ auth::user()->last_name }}</h4>
              </div>
              <div class="col-md-6 text-center text-md-right">
                 <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">Change Profile Picture</button>
                 <a href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn btn-light">Sign out</a>
              </div>
           </div>
        </section>

      <!-- Modal to Change Profile Picture-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
        
            <div class="modal-body">
            <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
            @csrf
            <div class="row gutter-1">
            <div class="col-md-6">
                             <div class="form-group">
                                <label for="avatar">Update Profile Picture</label>
                                <input id="avatar" type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" required>

                                @error('avatar')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
            </div>
            </div>
            <div class="row">
                          <div class="col">
                             <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                       </div>
            </form>
         
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
      </div>

        <div class="row">
           <div class="col-xl-3 col-lg-3">
              <div class="bg-white p-3 widget shadow rounded mb-4">
                 <div class="nav nav-pills flex-column lavalamp" id="sidebar-1" role="tablist">
                    <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('user.profile') }}" role="tab" ><i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
                    <a class="nav-link {{ request()->is('profile/watchlist') ? 'active' : '' }}"  href="{{ route('user.watchlist') }}" role="tab" ><i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i> Watchlist</a>
                    <a class="nav-link {{ request()->is('profile/password') ? 'active' : '' }}" href="{{ route('user.password') }}" role="tab"><i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i> Account Settings</a>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</a>
                 </div>
              </div>
           </div>
           <div class="col-xl-9 col-lg-9">
              <div class="bg-white p-3 widget shadow rounded mb-4">
                 <div class="tab-content" id="myTabContent">
                    <!-- profile -->
                    <div class="tab-pane fade {{ request()->is('profile') ? 'show active' : '' }}" id="sidebar-1-1" role="tabpanel" aria-labelledby="sidebar-1-1">
                       <!-- Page Heading -->
                       <div class="d-sm-flex align-items-center justify-content-between mb-3">
                          <h1 class="h5 mb-0 text-gray-900">Profile</h1>
                       </div>
                       <form method="post" action="{{ route('profile.save') }}">
                           @csrf
                       <div class="row gutter-1">
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? auth::user()->first_name }}" required>

                                @error('first_name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? auth::user()->last_name }}" required>

                                @error('last_name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? auth::user()->phone }}" placeholder="Your phone number">

                                @error('phone')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? auth::user()->email }}" required>

                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                       
                       </div>
                       <div class="row">
                          <div class="col">
                             <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                       </div>
                    </form>
                    </div>
                    <!-- orders -->
                    <div class="tab-pane fade {{ request()->is('profile/watchlist') ? 'show active' : '' }}" id="sidebar-1-2" role="tabpanel" aria-labelledby="sidebar-1-2">
                       <!-- Page Heading -->
                      
                       <div class="d-sm-flex align-items-center justify-content-between mb-3">
                          <h1 class="h5 mb-0 text-gray-900">Movies</h1>
                       </div>
                       <!-- Content Row for Movies -->
                       <div class="row">
                       @if(count($movies)>=1)
                       @foreach($movies as $movie)
                          <div class="col-xl-3 col-md-6 mb-4">
                             <div class="card m-card shadow border-0">
                                <a href="{{ route('movie.view', ['id' => $movie->slug]) }}">
                                   <div class="m-card-cover">
                                      
                                      <img src="{{asset('storage/movies/'.$movie->banner)}}" class="card-img-top" alt="...">
                                   </div>
                                   <div class="card-body p-3">
                                      <h5 class="card-title text-gray-900 mb-1">{{$movie->title}}</h5>
                                   </div>
                                </a>
                                <div class="card-body pl-2 pr-2 pb-2 pt-0">
                                      <a  href="{{route('user.removeWatchlist',['slug'=>$movie->slug])}}" class="btn btn-danger btn-block btn-sm"><i class="fas fa-trash" aria-hidden="true"></i> Remove </a>
                                </div>
                             </div>
                          </div>
                         @endforeach
                         @else
                         <h3 class="h5 m-4 text-gray-900">Your Watchlist is currently empty</h3>
                         @endif
                       </div>
                       <div class="d-sm-flex align-items-center justify-content-between mb-3">
                          <h1 class="h5 mb-0 text-gray-900">TV Series</h1>
                       </div>
                        <!-- Content Row for TV Series -->
                        <div class="row">
                       @if(count($seasons)>=1)
                       @foreach($seasons as $season)
                          <div class="col-xl-3 col-md-6 mb-4">
                             <div class="card m-card shadow border-0">
                                <a href="{{ route('season.view', ['id' => $season->slug]) }}">
                                   <div class="m-card-cover">
                                      
                                      <img src="{{asset('storage/series/seasons/'.$season->cover)}}" class="card-img-top" alt="...">
                                   </div>
                                   <div class="card-body p-3">
                                      <h5 class="card-title text-gray-900 mb-1">{{$season->series->title}}</h5>
                                      <h5 class="card-title text-gray-900 mb-1">{{$season->title}}</h5>
                                   </div>
                                </a>
                                <div class="card-body pl-2 pr-2 pb-2 pt-0">
                                      <a  href="{{route('user.removeSeasonWatchlist',['slug'=>$season->slug])}}" class="btn btn-danger btn-block btn-sm"><i class="fas fa-trash" aria-hidden="true"></i> Remove </a>
                                </div>
                             </div>
                          </div>
                         @endforeach
                         @else
                         <h3 class="h5 m-4 text-gray-900">Your Watchlist is currently empty</h3>
                         @endif
                       </div>
                      
                    </div>
             
                    <!-- payments -->
                    <div class="tab-pane fade {{ request()->is('profile/password') ? 'show active' : '' }}" id="sidebar-1-4" role="tabpanel" aria-labelledby="sidebar-1-4">
                       <!-- Page Heading -->
                       <div class="d-sm-flex align-items-center justify-content-between mb-3">
                          <h1 class="h5 mb-0 text-gray-900">Account Settings</h1>
                       </div>
                       <form method="post" action="{{ route('profile.password') }}">
                           @csrf
                       <div class="row gutter-1">
                          <div class="col-12">
                             <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Password">

                                @error('current_password')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{  $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="password">New Password</label>
                                <input id="password" type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="New Password">

                                @error('password')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                <label for="password_confirmation">Retype New Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                             </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col">
                             <button type="submit" class="btn btn-primary" id="change-password">Save Changes</button>
                          </div>
                       </div>
                    </form>
                    </div>
                 </div>
                 <!-- / content -->
              </div>
           </div>
        </div>
     </div>
     <!-- /.container-fluid -->

@endsection

@section('JS')
<script>
    $(document).ready(function() {

      //   $(document).on('click', '#change-password', function() {
      //       var old_pass = $('#old_pass').val();
      //       var password = $('#password').val();
      //       var password_confirmation = $('#password_confirmation').val();
      //       console.log("ok");
      //       $.ajax({
      //           url: "{{ route('profile.password') }}",
      //           method: "post",
      //           data: {
      //               old_pass : old_pass,
      //               password : password,
      //               password_confirmation : password_confirmation,
      //           }

      //       },
      //       success: function(data){
      //           console.log(data);
      //       },
      //       error: function(response) {
      //           console.log("error");
      //       })
      //   });

    }) //reay function
</script>
@endsection
