@extends('layouts.app')

@section('css')
    <style>
        .google-banner, .linkedin-banner, .github-banner, .facebook-banner {
            display: none;
        }
        .social-icon:hover{
            animation: bounce 1s;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }
        }
    </style>
@endsection

@section('content')
    <div class="container col-md-5">
        <h1 class="text-center samaran">Login With</h1>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            {{--<div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email" required autofocus>
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            </div>
            <div class="form-group">
                <label for="email">Password</label>
                <input type="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Your secret key..." required>
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label">Remember me</label>
            </div>
            <div class="form-check">
                <center><button type="submit" class="btn btn-outline-light btn-lg">Let's go</button></center>
                <br>
                <a class="nav-link text-right" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>--}}
            <div class="form-group text-center social-icons">
                <a href="{{ url('/login/google') }}"><div class="social-icon icons8-google"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/github') }}"><div class="social-icon icons8-github"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/facebook') }}"><div class="social-icon icons8-facebook"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/linkedin') }}"><div class="social-icon icons8-linkedin"></div></a>
            </div>
        </form>
        <br><br>
    </div>
    <div class="container-fluid">
        <div class="jumbotron-fluid">
            <h1 class="text-center banner google-banner">GOOGLE</h1>
            <h1 class="text-center banner facebook-banner">FACEBOOK</h1>
            <h1 class="text-center banner linkedin-banner">LINKEDIN</h1>
            <h1 class="text-center banner github-banner">GITHUB</h1>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.social-icon').each(function (index, value) {
                $(this).hover(function () {
                    var className = $(this).attr('class').split(' ')[1].split('-')[1];
                    $('.banner').hide();
                    $('.' + className + '-banner').css('display', 'block');
                });
            })
        });
    </script>
@endsection
