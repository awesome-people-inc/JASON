@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
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
                                <img class="rounded-circle"  width="35px" height="35px" src="{{ url(Auth::user()->profile->avatar) }}" alt="" />
                            </div>
                            <div class="col-sm">
                                <h4 class="text-left samaran">{{ Auth::user()->name }}</h4>
                            </div>
                            {{--<div class="col-sm">
                                <h6 class="text-right">3m ago</h6>
                            </div>--}}
                        </div>
                        <h1 class="display-4" id="post-crumb" contenteditable="true" maxlength="20">What's the update???</h1>
                        <hr class="my-4">
                    </div>
                </div>
                <div class="zoom jumbotron-fluid" id="1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-1">
                                <img class="rounded-circle"  width="35px" height="35px" src="{{ url(Auth::user()->profile->avatar) }}" alt="" />
                            </div>
                            <div class="col-sm">
                                <h4 class="text-left samaran">{{ Auth::user()->name }}</h4>
                            </div>
                            {{--<div class="col-sm">
                                <h6 class="text-right">3m ago</h6>
                            </div>--}}
                        </div>
                        <p class="lead" id="post-thought" contenteditable="true" maxlength="255">Post something amazing...</p>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
            <hr style="background-color: red; height: 3px; border: none;">
            <div id="feeds">
                @widget('feeds',[], Auth::id(), false)
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
        $(document).ready(function () {

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
                $('#1').hide();
                $('#0').show();
                postElementClass = 'post-crumb';
            }
            else if (type === "1") {
                $('#0').hide();
                $('#1').show();
                postElementClass = 'post-thought';
            }
            else {
                $('#postingArea').hide();
            }
            console.log(document.getElementsByClassName('post').innerHTML);
        }

        function sendPost() {
            axios.put('/post/put',{
                postContent  : document.getElementById(postElementClass).innerText,
                type     : type,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).then(function () {
                console.log("Yay!"); //reload posts
            }).catch(function (err) {
                console.log(err);
            });
        }
    </script>
@endsection