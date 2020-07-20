@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dodaj novu kategoriju</div>

                <div class="card-body">
                    @error('name')
                <div class="alert alert-danger">


                        <p>Назив је обавезан и мора имати минимум 3 карактера</p>

                </div>
                @enderror

                    <form action="{{route('category.update',$category->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="name">Naziv kategorije</label>
                          <input type="name"  class="form-control @error('name') is-invalid   @enderror" name="name" id="name"
                        aria-describedby="name" placeholder="Upisite naziv kategorije" value="{{old('name',$category->name)}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Sacuvaj</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
