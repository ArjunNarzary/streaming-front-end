<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('getThrills/img/logo-icon.png') }}">
    <title>stream.getThrills.com | Rent Successful</title>
      <!-- Custom fonts for this template-->
      <link href="{{ asset('getThrills/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="{{ asset('getThrills/css/osahan.min.css') }}" rel="stylesheet">
      <!--Custom CSS-->
      <link href="{{ asset('getThrills/css/custom.css') }}" rel="stylesheet">
    <style>
        html, body{
            font-size: 23px;
        }
        body{
            background-color: #00b552;
            overflow: hidden
        }
        .box-container{
            position: relative;
            width: 100vw;
            height: 100vh;
        }
        .message-box{
            width: 70%;
            min-height: 60%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
        }
        .ticked{
            font-size: 2.2rem;
        }
        .booking{
            font-size: 1rem;
        }
        @media only screen and (max-width: 1025px) and (max-height: 801px){
            html, body{
                font-size: 22px !important;
            }
        }
        @media only screen and (max-width: 1025px) and (max-height: 601px){
            html, body{
                font-size: 19px !important;
            }
        }
        @media only screen and (max-width: 700px){
            html, body{
                font-size: 20px !important;
            }
            .message-box{
                width: 80%;
                height: auto;
                min-height: auto;
            }
        }
        @media only screen and (max-width: 450px){
            html, body{
                font-size: 16px !important;
            }
        }
        @media only screen and (max-width: 380px){
            html, body{
                font-size: 13px !important;
            }
        }
    </style>
</head>
<body>
    <section class="box-container">
        <div class="message-box p-3">
           <div class="ticked text-center">
               <i class="fas fa-check text-success"></i>
               <p style="font-size: 0.8em; line-height: 1em;">Thank You</p>
            </div>
            <div class="booking text-center px-5 py-3">
                <p>Your payment is completed . Your bill has been sent to your email address and Mobile number.</p>
            </div>
           
                <p class="text-center">Your content is ready to be viewed. </p> 
                <div class="d-flex justify-content-around pb-3">
                <a href="{{ route('movie.view',$slug) }}"><button class="btn btn-danger text-uppercase">Watch Now</button></a>
            </div>    
        </div>
    </section>

     <!-- Bootstrap core JavaScript-->
     <script src="{{ asset('getThrills/vendor/jquery/jquery.min.js') }}"></script>
     <script src="{{ asset('getThrills/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
