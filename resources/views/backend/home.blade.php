@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2 mb-3">
        <h1 class="text-dark">Dashboard</h1>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Num. of Categories
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$categories->count()}}
                            </div>
                        </div>
                        <div class="col-auto                                ">
                            <span class="h1 text-primary"> <i class="fas fa-list"></i>
                            </span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Num. of Products
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$products->count()}}

                            </div>
                        </div>
                        <div class="col-auto">

                            <span class="h1 text-success"><i class="fas fa-pizza-slice"></i>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Num of orders</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <span class="h1 text-info"> <i class="fas fa-scroll"></i> </span> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Exchange Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$rate}}</div>
                        </div>
                        <div class="col-auto">
                            <span class="h1 text-danger"> <i class="fas fa-hand-holding-usd"></i> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-primary">Add new Category</div>
                <div class="card-body">
                    <form method="post" action="{{route('category.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Write name of new category of products</label>
                            <input type="input" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{old('name')}}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">

                <div class="card-header">Add or update Exchange rate </div>

                <div class="card-body ">
                    <a href="{{route('rates')}}" class="btn btn-success btn-block">Add or update Exchange rate </a>

                </div>
            </div>
            <div class="card mt-4">

                <div class="card-header">List of users </div>

                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr><th>User</th>
                                <th>Last update</th>

                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr><td>{{$user->name}}</td>
                                <td>{{$user->updated_at->format('d.m.Y H:i')}}</td>

                               @if ($user->role==1)
                               <td><a href="{{route('setadmin',$user->id)}}" onClick="return confirm('Are you sure?');" class="btn btn-warning">Delete admin role</a></td>

                                @else
                                <td><a href="{{route('setadmin',$user->id)}}" onClick="return confirm('Are you sure?');" class="btn btn-success">Set admin</a></td>


                               @endif

                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header ">
                    <h4 class=" text-info text-center font-weight-bold">Categories</h4>
                </div>

                <div class="card-body">
                    <div>
                        <table class="table table-striped text-center">
                            <thead>
                                <tr class="bg-primary text-light ">
                                    <th scope="col">Name of category</th>
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
            <div class="card mt-4">
                <div class="card-header ">
                    <h4 class=" text-info text-center font-weight-bold">Products</h4>
                    <div class="float-right"> <a href="{{route('product.create')}}"
                            class="p-2 d-inline btn btn-success ">Add new product</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Updated at</th>
                                <th scope="col">Editor</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>{{$product->price}}&euro;</td>
                                <td>{{$product->updated_at->format('d.m.Y H:i')}}</td>
                                <td>{{$product->author->name}}</td>
                                <td><a href="{{route('product.edit',$product->id)}}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('product.destroy',$product->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onClick="return confirm('Are you sure?');">
                                            Delete</button>
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
@endsection
