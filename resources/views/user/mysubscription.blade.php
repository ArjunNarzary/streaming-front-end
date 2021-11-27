@extends('layouts.user_layouts.master')
<!--DESCRIPTION META TAG HERE-->
@section('description')
    <style>
        section.pricing {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
    </style>
@endsection
<!--DESCRIPTION META TAG END HERE-->

@section('title', 'Movies')

@section('content')
    <div class="container">
    <div class="">
        <div class="row ">
                <div class="col-md-3 p-3">
                </div>

                <div class="col-md-6  mb-2 mb-md-3 mt-2 ">
                <div class="card m-card shadow border-0 m-3">
                        <div class="card-body p-1 pb-2 pb-md-3 p-md-3">
                        @if ($subscriber==NULL)
                            <p class="card-text">
                            You have not subscribed to any plan yet. Please <a href="{{route('subscription.all')}}">Subscribe</a> to continue enjoying our services.
                            </p>
                            @elseif($subscriber->status==0)
                            <p class="card-text">
                            Your Subscription has been expired. Please <a href="{{route('subscription.all')}}">Subscribe</a> to continue enjoying our services.
                            </p>
                            @else
                            <p class="card-text">
                                Your subscription will expire on <b>{{Carbon\Carbon::parse($subscriber->plan_expiry)->format('M d, Y')}}</b>. You will be informed via email or SMS and can renew only after expiry.
                            </p>
                            @endif
                            </div>
                  
                </div>

                @if ($subscriber!=NULL)
                  <div class="card m-card shadow border-0 text-center">
                    <div class="card-header"> <h6 class="text-dark ">Payment History</h6></div>
                        <div class="card-body p-1 pb-2 pb-md-3 p-md-3">
                        <p>Last Payment : {{Carbon\Carbon::parse($billing->created_at)->format('M d, Y')}}</p> 
                        <a href="">View Printable Receipt</a>
                    </div>
                 </div>
                 @endif

                </div>
                <div class="col-md-3"></div>
        </div>
      </div>
    </div>
@endsection