@extends('layouts.front')
@section('content')
<div class="container cart">
    <div class="card mt-5">
        <div class="card-header bg-primary text-light text-center inline-block p-4">
            <h3 class="d-inline"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart</h3>
            <div class="float-right">
                <a href="" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            @php
            $total=0;
            @endphp
            @if (isset($products))

                @foreach ($products as $product)
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2 text-center">
                        <img class="img-responsive" src="{{$product->image()}}" width="70%" alt="{{$product->image}}">

                    </div>
                    <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                        <h4 class="product-name"><strong>{{$product->name}}</strong></h4>
                        <h4>
                            <small>{{$product->description}}</small>
                        </h4>
                    </div>
                    <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                        <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                            <h6><strong> {!!(\Session::get('currency')=='USD' ? '$'.$product->rate()
                                    :$product->price.'&euro;') !!}
                                    <span class="text-muted">x</span> @foreach ($ids as $key=>$id)
                                    @if ($product->id==$id)
                                    {{        $quanitity[$id]}}
                                    @php
                                    $total=$product->price*$quanitity[$id];
                                    @endphp
                                    @endif
                                    @endforeach
                                </strong></h6>

                        </div>
                        <div class="col-4 col-sm-4 col-md-4">
                            <a href="{{route('front.addtocart',$product->id)}}" class="btn btn-outline-success btn-xs">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 text-right">
                            <a href="{{route('front.removefromcart',$product->id)}}"
                                class="btn btn-outline-danger btn-xs">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


            </div>
            <hr>

                @endforeach
            @else
            <div class="text-center h1">Your cart is empty</div>
            @endif



        </div>
        <div class="card-footer">
            <div class="float-left"> Total price: <b> {!!(\Session::get('currency')=='USD' ? '$'.round($rate*$total,2)
                    :$total.'&euro;') !!}</b>
            </div>
            <div class="float-right"> <a href="{{route('front.checkout')}}" class="btn btn-success pull-right">Checkout</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
