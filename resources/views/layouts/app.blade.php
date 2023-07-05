<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Scripts -->
    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/popper.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/axios.min.js') }}"></script>
    <script src="{{ url('js/vue.js') }}"></script>
    <script src="{{ url('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('fontawesome/css/all.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand " id="nav">
       
        <a class="navbar-brand" href="{{ url('/') }}">
            SquaHR
        </a>
        <img style="margin-left: -20px" src="{{url('/asset/www_boxed.svg')}}" width="50px" alt="logo">


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i
                                    class="fa fa-arrow-right-from-bracket  "></i></a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"
                                    aria-hidden="true"></i></a>
                        </li>
                    @endif
                @else


                    <li class="nav-item dropdown">
                        <button id="navbarDropdown" class="nav-link avatar" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end" style="min-width:200px;margin:0px !important"
                            aria-labelledby="navbarDropdown">
                            <div class="dropdown-item">
                                <a >
                                    <span><i class="fa fa-user" aria-hidden="true"></i></span> {{Auth::user()->name}}
                                </a>
                            </div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span style="margin-right: 5px"> <i class="fa fa-arrow-right-from-bracket"></i></span>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest
            </ul>
        </div>

    </nav>  
    <div style="width: 100%;height: 50px"></div>    

        @yield('content')
</body>

</html>
