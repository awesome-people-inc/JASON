@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="message-div">
            <chat-room :conversation="{{ $conversation }}" :current-user="{{ Auth::user() }}"></chat-room>
        </div>
    </div>
@endsection