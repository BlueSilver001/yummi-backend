<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/782284a14b.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
</head>
<body>
    <div class="bg-primary clearfix">
        <div class="container ">
            <div class="float-left text-white py-3 "><i class="fas fa-phone"></i>+123456789</div>
            <div class="float-right inline block">

                <a href="$" class="btn btn-danger py-3">Order online</a>
                @if ( \Session::get('currency')=='USD')
                <a class="btn btn-outline-info ml-5 " href="{{route('setcurrency','EUR')}}">&dollar;</a>
                @else
                <a  href="{{route('setcurrency','USD')}}" class="btn btn-outline-info ml-5 ">&euro;</a>

                @endif
                    </div>

            </div>
        </div>
    </div>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{route('front.home')}}">
                   <img src="{{asset('images/logo-c.png')}}" class="img-fluid" width="100px" alt="Yummi logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav  mr-auto ml-5">
                        <li class="nav-item">
                            <a class="nav-link h4 " href="#"><i aria-hidden="true" class="fas fa-list text-white"></i> Menu </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h4 " href="#"><i class="fas fa-pizza-slice text-white"></i> Products </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <a class="nav-link h4 " href="{{route('front.cart')}}">
                                <i class="fas fa-shopping-cart text-white"></i> Cart </a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('front.history')}}">History</a>
                                    @if (Auth::user()->role==1)
                                    <a class="dropdown-item" href="{{route('home')}}">Admin panel</a>

                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <footer class="py-5 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Yummi Pizza 2020 Developed by <a class="text-light" href="mailto:dubljanin96@gmail.com">  Дубљанин (ツ)</a></p>
        </div>
        <!-- /.container -->
      </footer>
</body>
</html>
