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
<section class="pricing py-5">
  <div class="container">
    <div class="row">
     @foreach($plans as $plan)
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">{{$plan->name}}</h5>
            <h6 class="card-price text-center">Rs {{$plan->fee+$plan->tax}}<p class="period">{{$plan->time_period}} {{$plan->time_period_type}}</p></h6>
            <hr>
            <p > 
                {!!$plan->description!!}
            </p>
            <a href="{{route('subscribe',['id'=>$plan->id])}}" class="btn btn-block btn-primary text-uppercase">Subscribe</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection