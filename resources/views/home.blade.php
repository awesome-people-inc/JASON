@extends('layouts.app')

@section('css')
    <style>
        body  {
            overflow-y: hidden;
        }

        #feeds {
            position: relative;
            overflow-y: scroll !important;
            overflow-x: hidden;
        }

        #feeds::-webkit-scrollbar {
            width: 0px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */
        }

        .likes {
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @widget('profileCard',[], Auth::user())
        </div>
        <div class="col-md-6">
            <div id="postingArea" onfocusout="sendPost()">
                <div class="zoom jumbotron-fluid"  id="0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-1">
                                <img class="rounded-circle"  width="35px" height="35px" src="{{ url(Auth::user()->avatar) }}" alt="" />
                            </div>
                            <div class="col-sm">
                                <h4 class="text-left samaran">{{ Auth::user()->name }}</h4>
                            </div>
                            {{--<div class="col-sm">
                                <h6 class="text-right">3m ago</h6>
                            </div>--}}
                        </div>
                        <h1 class="display-4" id="post-crumb" contenteditable="true" maxlength="20">Share Something...</h1>
                    </div>
                </div>
                <div class="zoom jumbotron-fluid" id="1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-1">
                                <img class="rounded-circle"  width="35px" height="35px" src="{{ url(Auth::user()->avatar) }}" alt="" />
                            </div>
                            <div class="col-sm">
                                <h4 class="text-left samaran">{{ Auth::user()->name }}</h4>
                            </div>
                            {{--<div class="col-sm">
                                <h6 class="text-right">3m ago</h6>
                            </div>--}}
                        </div>
                        <p class="lead" id="post-thought" contenteditable="true" maxlength="255">Share Something...</p>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
            <hr style="background-color: red; height: 3px; border: none;">
            <div id="feeds">
                @asyncWidget('feeds',[], Auth::id(), false)
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="samaran">What you wanna post?</h3>
                    <hr class="my-4">
                    <div onclick="changePosting()">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="postType" id="postType" value="0">
                            <label class="form-check-label">
                                Crumbs
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="postType" id="postType" value="1">
                            <label class="form-check-label">
                                Thoughts
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="postType" id="postType" value="option1">
                            <label class="form-check-label">
                                Photos
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="postType" id="postType" value="option1">
                            <label class="form-check-label">
                                Videos
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        let type = "";
        let postElementClass = "";
        let height = 0;
        const placeholder = "Share Something...";
        const mainHeight = $(window).height();
        $(document).ready(function () {
            height = mainHeight - 100;
            $('#feeds').css('height', height+'px');
            $('#postingArea').hide();
            $('[contenteditable=true]').keydown(function(e) {
                var max = $(this).attr("maxlength");
                if (e.which != 8 && $(this).text().length > max) {
                    e.preventDefault();
                }
            });
            $('[contenteditable=true]').keyup(function(e) {
                var max = $(this).attr("maxlength");
                if (e.which != 8 && $(this).text().length > max) {
                    e.preventDefault();
                }
            });
        });

        function changePosting() {
            type = document.querySelector('#postType:checked').value;
            $('#postingArea').show();
            if (type ===  "0") {
                height = $('#feeds').height() - $('#postingArea').height() + 90;
                $('#1').hide();
                $('#0').show();
                postElementClass = 'post-crumb';
            }
            else if (type === "1") {
                height = $('#feeds').height() - $('#postingArea').height() + 121;
                $('#0').hide();
                $('#1').show();
                postElementClass = 'post-thought';
            }
            else {
                height = mainHeight - 100;
                $('#postingArea').hide();
            }
            $('#feeds').css('height', height+'px');
        }

        function sendPost() {
            $('#postingArea').hide();
            height = mainHeight - 100;
            $('#feeds').css('height', height+'px');
            let content = document.getElementById(postElementClass).innerText;
            if (content == placeholder || content == "" || content == " " ) {
                return false;
            }
            else {
                axios.put('/post/put',{
                    postContent  : document.getElementById(postElementClass).innerText,
                    type     : type,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).then(function () {
                    new Noty({
                        type        : 'success',
                        layout      : "topCenter",
                        theme       : "nest",
                        text        : "Posted!",
                        timeout     : 2000,
                        progressBar : true,
                        closeWith   : 'click'
                    }).show();
                    $('.form-check-input').prop('checked', false);
                    document.getElementById(postElementClass).innerText = placeholder;
                    console.log("Yay!"); //reload posts
                }).catch(function (err) {
                    console.log(err);
                });
            }
        }

        function liker(postId) {
            if (postId === undefined) {
                return false;
            }

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
        }
    </script>
@endsection