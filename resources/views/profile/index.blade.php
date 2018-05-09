@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <style>
        .nav-item a:hover {
            box-shadow: 1em 1em 2em rgba(6, 6, 14, 0.5);
            background-color: rgb(220, 53, 69);
        }

        .friendCount:hover {
            transform: scale(1.05);
            -webkit-transform: skewY(-4deg);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @widget('profileCard',[], $user)
            </div>
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item zoom">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Posts</a>
                    </li>
                    <li class="nav-item zoom">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="false">Photos</a>
                    </li>
                    <li class="nav-item zoom">
                        <a class="nav-link" id="pills-friends-tab" data-toggle="pill" href="#pills-friends" role="tab" aria-controls="pills-friends" aria-selected="false">Friends</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @widget('feeds',[], $user->id, true)
                    </div>
                    <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">

                    </div>
                    <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab">

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @if($user->id != Auth::user()->id)
                    <div class="card text-center zoom">
                        <div class="card-body">
                            @if(Auth::user()->hasBlocked($user))
                                <button type="submit" onclick="window.location.href='{{ route('unblock', ['user' => $user->id]) }}'" class="btn btn-dark btn-block btn-sm zoom">Unblock</button>
                            @else
                                @if(Auth::user()->isFriendWith($user))
                                    <button type="submit" onclick="window.location.href='{{ route('removeConnection', ['user' => $user->id]) }}'" class="btn btn-warning zoom btn-block btn-sm">Remove Connection</button>
                                @elseif(Auth::user()->hasFriendRequestFrom($user))
                                    <div class="btn-group" role="group" aria-label="friendship">
                                        <button type="submit" onclick="window.location.href='{{ route('acceptRequest', ['user' => $user->id]) }}'" class="btn btn-success zoom btn-sm">Accept Request</button>
                                        <button type="submit" onclick="window.location.href='{{ route('denyRequest', ['user' => $user->id]) }}'" class="btn btn-warning zoom btn-sm">Deny Request</button>
                                    </div>
                                    <br>
                                @elseif(Auth::user()->hasSentFriendRequestTo($user))
                                    <button disabled class="btn btn-light btn-block zoom btn-sm">Connection Request Sent</button>
                                @else
                                    <button type="submit" onclick="window.location.href='{{ route('sendRequest', ['user' => $user->id]) }}'" class="btn btn-primary zoom btn-block btn-sm">Connect</button>
                                @endif
                                <button type="submit" onclick="window.location.href='{{ route('block', ['user' => $user->id]) }}'" class="btn btn-danger btn-block zoom btn-sm">Block</button>
                            @endif
                        </div>
                    </div>
                @endif
                <br>
                <div class="card-group zoom">
                    @if($user->id != Auth::user()->id)
                        <div class="card border-primary friendCount">
                            <div class="card-header">
                                <center>Mutual Friends</center>
                            </div>
                            <div class="card-body text-primary">
                                <center><h1>{{ $user->getMutualFriendsCount(Auth::user()) }}</h1></center>
                            </div>
                        </div>
                    @endif
                    <div class="card border-primary friendCount">
                        <div class="card-header">
                            <center>Total Friends</center>
                        </div>
                        <div class="card-body text-primary">
                            <center><h1 class="">{{ $user->getFriendsCount() }}</h1></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection