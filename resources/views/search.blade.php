@extends('layouts.app')

@section('css')
    <style>
        .list-group-item {
            margin-bottom: 10px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container col-md-5 align-content-center">
        <h1>Search Results...</h1>
        <hr>
        <ul class="list-group">
            @foreach($result as $res)
                <li class="list-group-item disabled">
                    <div class="row">
                        <div class="col-sm-1">
                            <img class="rounded-circle"  width="35px" height="35px" src="{{ url($res->avatar) }}" alt="" />
                        </div>
                        <div class="col-sm">
                            <h3>{{$res->name}}</h3>
                        </div>
                        <div class="col-sm text-right">
                            <a href="{{ route('profile', ['id' => $res->uuid]) }}" class="btn btn-sm btn-primary">Visit Profile</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection