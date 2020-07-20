@extends('layouts.front')
@section('content')
<div class="container pb-5 lr">
    <div class="py-5 text-center">
        <h2>Checkout </h2>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger mt-4">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>

      </div>
      @endif
    <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
      </h4>
      <ul class="list-group mb-3">
        @php
        $total=0;
        @endphp
        @foreach ($products as $product)

        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{$product->name}}</h6>
          </div>
          <span class="text-muted">
            {!!(\Session::get('currency')=='USD' ? '$'.$product->rate()
            :$product->price.'&euro;') !!}
            <span class="text-muted">x</span> @foreach ($ids as $key=>$id)
            @if ($product->id==$id)

            {{$quanitity[$id]}}
            @php
            $total=$product->price*$quanitity[$id];
            @endphp
            @endif
            @endforeach
          </span>
        </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Delivery</h6>
            </div>
            <span class="text-muted">
              {!!(\Session::get('currency')=='USD' ? '$'.(10*$rate)              :'10&euro;') !!}
            </span>
          </li>

        <li class="list-group-item d-flex justify-content-between">
          <span>Total {{(\Session::get('currency')=='USD' ? '(USD)': '(EUR)')}}</span>
          <strong>{!!(\Session::get('currency')=='USD' ? '$'.round(($rate*$total)+10,2)
            :($total+10).'&euro;') !!}</strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4> <div class="float-right">


      </div>
      <form class="needs-validation" method="post" action="{{route('front.saveorder')}}">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Insert your first and last name" required>
            <div class="invalid-feedback">
                Please enter a your first and last name.
              </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
          </div>

        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>




        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
    </div>
  </div></div>
@endsection
