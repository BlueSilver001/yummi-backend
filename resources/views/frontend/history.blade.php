@extends('layouts.front')
@section('content')
<div class="container cart">
    <div class="card mt-5">
        <div class="card-header bg-primary text-light text-center inline-block p-4">
            <h3 class=""> <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                History of orders</h3>

            <div class="clearfix"></div>
        </div>
        <div class="card-body">

            @if (isset($products))

                @foreach ($products as $product)
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 text-center">
                        <img class="img-responsive" src="{{asset('uploads/products/'.$product->image.'.jpg')}}" width="70%" alt="{{$product->image}}">

                    </div>
                    <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                        <h4 class="product-name"><strong>{{$product->name}}</strong></h4>
                        <h4>
                            <small>{{$product->description}}</small>
                        </h4>
                    </div>
                    <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                        <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                            <h6><strong> {!!(\Session::get('currency')=='USD' ? '$'.round($product->price*$rate,2)
                                    :$product->price.'&euro;') !!}
                                    <span class="text-muted">x</span>
                                    {{        $product->quantity}}

                                </strong></h6>

                        </div>
                        <div class="col-4 col-sm-4 col-md-4">
                            <a href="{{route('front.addtocart',$product->id)}}" class="btn btn-outline-success btn-xs">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>

                    </div>


            </div>
            <hr>

                @endforeach
            @else
            <div class="text-center h1">Your order history is empty</div>
            @endif



        </div>
    </div>
</div>
</div>
@endsection
