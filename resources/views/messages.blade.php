@extends('layouts.app')

@section('css')
    <style>
        body  {
            overflow-y: hidden;
        }

        .messages {
            position: relative;
            overflow-y: scroll !important;
            overflow-x: hidden;
        }

        .messages::-webkit-scrollbar {
            width: 0px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    @foreach(Auth::user()->getFriends() as $k => $v)
                        <li class="list-group-item">
                            <a href="#" onclick="setId({{ $v->id }})">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <img class="rounded-circle"  width="35px" height="35px" src="{{ url($v->avatar) }}" alt="" />
                                    </div>
                                    <div class="col-sm text-center">
                                        <h3>{{ $v->name }}</h3>
                                    </div>
                                </div>
                            </a>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8 card">
                <div class="card-body messages" style="height: 450px">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Cras justo odio</li>
                    </ul>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="msg" placeholder="Message..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" onclick="sendMsg()" type="button">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var id = undefined;

        function setId(uid) {
            id = uid;
        }

        function sendMsg() {
            var message = document.getElementById('msg').value;
            axios.put('post/like', {
                id      : postId,
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then(function (response) {
                let text = "Some Error Occurred!";
                let type = "error";
                if (response.data.error === false) {
                    text = "Post Liked!";
                    type = "success";
                }
                new Noty({
                    type        : type,
                    layout      : "topCenter",
                    theme       : "nest",
                    text        : text,
                    timeout     : 1500,
                    progressBar : true,
                    closeWith   : 'click'
                }).show();
            }).catch(function () {
                console.log(err);
            })
            document.getElementById('msg').value = "";
        }
    </script>
@endsection