<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  @guest style="background: linear-gradient(rgba(0,0,255, 0.5), rgba(0,0,255, 0.5)), url('/img/enter.jpeg') center center no-repeat;" @endguest>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'J A S O N') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body
        @guest
            style="background: linear-gradient(rgba(0,0,255, 0.5), rgba(0,0,255, 0.5)), url('/img/enter.jpeg') center center no-repeat; color: #ffffff;"
        @else
        style="background: url('/img/background.jpg') center center no-repeat; background-size: cover"
        @endguest
>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark">
            <a class="navbar-brand ml-md-4" href="{{ url('/') }}">J.A.S.O.N</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-right ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        <li class="nav-item mr-md-3">
                            <form class="form-inline">
                                <input class="form-control-sm mr-sm-1" type="search" placeholder="Search" name="search" autocomplete="off" aria-label="Search">
                                <button class="btn btn-outline-light btn-sm my-2 my-sm-1" type="submit">Search</button>
                            </form>
                        </li>
                        {{--<li class="nav-item">
                            <a class="nav-link" href="#">
                                Notifications <span class="badge badge-pill badge-light">10</span>
                            </a>
                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Story Wall</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile', ['id' => Auth::user()->uuid]) }}">My Profile</a>
                        </li>
                        <li class="dropdown nav-item show mr-md-4">
                            <a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item zoom" href="#">Edit Profile</a>
                                </li>
                                <hr>
                                <li>
                                    <a class="dropdown-item zoom" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</html>
