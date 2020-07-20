@extends('layouts.app')

@section('content')
<div class="container">
    <div class=" justify-content-center">

        <div class="card">
            <div class="card-header ">
                <h4 class=" text-info text-center font-weight-bold">Products</h4>

                <div class="float-right"> <a href="{{route('product.create')}}"
                        class="p-2 d-inline btn btn-success ">Add new product</a>
                </div>


            </div>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row mt-4">

            @foreach ($products as $product)

            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="{{$product->image()}}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{$product->name}}</h4>
                        <p class="card-text">{{$product->description}}
                        </p>
                        Price: {{$product->price}}&euro;
                        <br>{{$product->updated_at->format('d.m.Y H:i')}}
                        <br>{{$product->author->name}}

                    </div>
                    <div class="card-footer">
                        <div class="float-left"> <a href="{{route('product.edit',$product->id)}}"
                                class="btn  btn-warning"><span class="ti-pencil-alt"></span> {{__('Edit')}}</a>
                        </div>
                        <div class="float-right">
                            <form method="POST" action="{{route('product.destroy',$product->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn  btn-danger"
                                    onClick="return confirm('Are you sure?');"><span class="ti-trash"></span>
                                    {{__('Delete')}}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>



    </div>



</div>
@endsection
