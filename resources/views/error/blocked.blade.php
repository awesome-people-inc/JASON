@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="samaran">Looks Like You Reached A Dead End!</h1>
        </div>
        <div class="row">
            <h4><a href="{{ route('home') }}">Click here to head back home.</a> </h4>
        </div>
    </div>
@endsection