@extends('layouts.front')
@section('content')
<header class="masthead">
    <div class="container-fluid h-100 text-white">
        <div class="row h-100 align-items-center">
            <div class="col-8 text-left ml-md-5">
                <h1 class="font-weight-light">YUMMI PIZZA BEST IN TOWN</h1>
                <p class="lead">Delivery to your home adress all over town</p>
            </div>
        </div>
    </div>
</header>


<div class="pt-5 pb-3 bg-danger text-center text-white">
    <h1 class="">OUR LATEST PIZZA</h1>
</div>
</div>
<div class="container mt-5">
    <div class="row">
        @foreach ($products as $product)

        <div class="col-md-4">
            <div class="card h-100 shadow ">
                <img class="card-img-top img-fluid" src="{{$product->image()}}" alt="">
                <div class="card-body bg-light">
                    <h3 class="card-title font-weight-bold ">{{$product->name}}</h3>

                    <p class="card-text py-2">{{$product->description}}
                    </p>
                    <hr>

                    <h5> Price:

                        {!!(\Session::get('currency')=='USD' ? '$'.$product->rate() :$product->price.'&euro;') !!}
                        </h5>

                </div>
                <div class="card-footer inline-block
                align-middle" style="vertical-align: middle!important;">
                    <div class="float-left align-middle">
                        <p>Product information</p>

                    </div>
                    <div class="float-right align-middle" >
                        <a href="{{route('front.addtocart',$product->id)}}\" class=" btn btn-danger">Add to cart</a>
                        <br>

                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="my-5 text-center">
        <a href="#" class="btn btn-danger btn-lg">See all our products</a>
    </div>
</div>
@if (session('status'))
<script> function openModal() {
$('#exampleModal').modal('show');

}
window.onload=openModal;

</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">    {{ session('status') }}
        </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-outline-info mr-auto" data-dismiss="modal">Continue shopping</button>
         <a href="{{Route('front.cart')}}" class="btn btn-success">Go to your shopping cart</a>
        </div>
      </div>
    </div>
  </div>
  @endif
  @if (session('ordercomplete'))
  <script> function openModal() {
  $('#exampleModal').modal('show');

  }
  window.onload=openModal;

  </script>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">    {{ session('ordercomplete') }}
          </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-footer">
                  <button type="button" class="btn btn-outline-info mr-auto" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endif
@endsection
