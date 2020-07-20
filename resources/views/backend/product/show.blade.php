@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pizza') }}:<h2>{{$pizza->name}}</h2></div>

                <div class="card-body">
                <div class="row"><div class="col-6">
                    <div class=" mt-5" id="price">{{__('Price:')}} {{$pizza->price}}&euro;</div>
                    <br>
                    <div id="description" class="text-muted">{{__('Description:')}}<br>
                        {{ $pizza->description}}
                    </div></div>
                <div class="col-6"><img src="{{$pizza->image()}}" class="img-fluid img-thumbnail" alt=""></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
