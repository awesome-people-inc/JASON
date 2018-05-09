<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>J.A.S.O.N</title>

    <!-- Styles -->
    <style>
        @font-face {
            font-family: 'Samaran';
            src: url('/fonts/SAMAN___.TTF');
        }

        html, body {
            background: linear-gradient(rgba(0,255,255, 0.5), rgba(0,0,255, 0.5)), url('/img/login.jpeg') center center no-repeat;
            background-size: cover;
            color: #ffffff;
            font-family: 'Samaran', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 8rem;
        }

        .links > a {
            padding: 0 25px;
            font-size: 3rem;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            color: #ffffff;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    @endif
    <div class="content">
        <div class="title m-b-md">
            J A S O N
        </div>

        <div class="links">
            <a>Just Another Socially Oriented Network</a>
            <hr style="color: #ffffff;">
        </div>
    </div>
</div>
</body>
</html>
