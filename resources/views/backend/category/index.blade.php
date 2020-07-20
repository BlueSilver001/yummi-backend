@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class=" text-info text-center font-weight-bold">Categories</h4>

                    <div class="float-right"> <a href="{{route('category.create')}}"
                            class="p-2 d-inline btn btn-success ">Add new category</a>
                    </div>



                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <div class="">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="bg-primary text-light ">
                                    <th scope="col">Name of category</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Time of creation</th>
                                    <th scope="col">Editor</th>
                                    <th scope="col">Time of last updated</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>

                                    <td>{{$category->name}}</td>
                                    <td>{{$category->author->name}}</td>
                                    <td>{{$category->created_at->format('d.m.Y H:i')}}</td>
                                    <td>{{$category->editor->name}}</td>
                                    <td>{{$category->created_at->format('d.m.Y H:i')}}</td>
                                    <td><a href="{{route('category.edit',$category->id)}}"
                                            class="btn btn-warning ">Edit</a></td>
                                    <td>
                                        <form action="{{route('category.destroy',$category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>

@endsection
