<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" href="{{ asset('getThrills/img/logo-icon.png') }}">
      <title>getThrills.com - Register for Movies, Events, Sports Booking</title>
      <!-- Custom fonts for this template-->
      <link href="{{ asset('getThrills/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="{{ asset('getThrills/css/osahan.min.css') }}" rel="stylesheet">
   </head>
   <body class="bg-gradient-primary">
      <div class="container">
         <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
               <!-- Nested Row within Card Body -->
               <div class="row">
                  <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                  <div class="col-lg-7">
                     <div class="p-5">
                        <div class="text-center">
                           <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="exampleFirstName" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                 @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-sm-6">
                                 <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" name="last_name" id="exampleLastName" placeholder="Last Name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                              </div>

                              @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div class="form-group">
                              <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">

                              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="exampleInputPassword" placeholder="Password" required autocomplete="new-password">

                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="col-sm-6">
                                 <input type="password" class="form-control form-control-user" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password" required autocomplete="new-password">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary btn-user btn-block">
                           Register Account
                           </button>
                           <hr>
                           <a href="index.html" class="btn btn-google btn-user btn-block">
                           <i class="fab fa-google fa-fw"></i> Register with Google
                           </a>
                           <a href="index.html" class="btn btn-facebook btn-user btn-block">
                           <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                           </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="text-center">
                           <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
       <!-- Bootstrap core JavaScript-->
       <script src="{{ asset('getThrills/vendor/jquery/jquery.min.js') }}"></script>
       <script src="{{ asset('getThrills/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
       <!-- Core plugin JavaScript-->
       <script src="{{ asset('getThrills/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
       <!-- Custom scripts for all pages-->
       <script src="{{ asset('getThrills/js/osahan.min.js') }}"></script>
</html>
