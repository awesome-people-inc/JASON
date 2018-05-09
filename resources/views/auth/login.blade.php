@extends('layouts.app')

@section('content')
    <div class="container col-md-5">
        <h2 class="text-center samaran">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
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
            </div>
            <div class="form-group text-center">
                <br>
                <h3 class="samaran">Login with</h3>
                <a href="{{ url('/login/google') }}"><div class="icons8-google"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/github') }}"><div class="icons8-github"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/facebook') }}"><div class="icons8-facebook"></div></a>&nbsp&nbsp&nbsp&nbsp
                <a href="{{ url('/login/linkedin') }}"><div class="icons8-linkedin"></div></a>
            </div>
        </form>
    </div>
@endsection
