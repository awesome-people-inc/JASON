@foreach($posts as $post)
    @if($post->type == 'CRUMB')
        <div class="zoom jumbotron-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1">
                        <img class="rounded-circle"  width="35px" height="35px" src="{{ url(\App\User::find($post->user_id)->profile->avatar) }}" alt="" />
                    </div>
                    <div class="col-sm">
                        <h4 class="text-left samaran">{{ \App\User::find($post->user_id)->name }}</h4>
                    </div>
                    <div class="col-sm">
                        <h6 class="text-right">{{ $post->created_at->diffForHumans() }}</h6>
                    </div>
                </div>
                <h1 class="display-4" id="post-crumb">{{ $post->content }}</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="#" class="badge badge-primary text-left" onclick="liker({{ $post->id }})">Likes : <span class="likes"> {{ $post->likes }}</span></a>
                    </div>
                    @if($post->user_id === Auth::id())
                        <div class="col-sm-6 text-right">
                            <a href="#" class="badge badge-info">Edit</a>
                            &nbsp;&nbsp;
                            <a href="#" class="badge badge-info">Delete</a>
                        </div>
                    @endif
                </div>
                <hr class="my-4">
            </div>
        </div>
    @endif
    @if($post->type == 'THOUGHT')
        <div class="zoom jumbotron-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1">
                        <img class="rounded-circle"  width="35px" height="35px" src="{{ url(\App\User::find($post->user_id)->profile->avatar) }}" alt="" />
                    </div>
                    <div class="col-sm">
                        <h4 class="text-left samaran">{{ \App\User::find($post->user_id)->name }}</h4>
                    </div>
                    <div class="col-sm">
                        <h6 class="text-right">{{ $post->created_at->diffForHumans() }}</h6>
                    </div>
                </div>
                <p class="lead" id="post-thought">{{ $post->content }}</p>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="#" class="badge badge-primary text-left" onclick="liker({{ $post->id }})">Likes : <span class="likes"> {{ $post->likes }}</span></a>
                    </div>
                    @if($post->user_id === Auth::id())
                        <div class="col-sm-6 text-right">
                            <a href="#" class="badge badge-info">Edit</a>
                            &nbsp;&nbsp;
                            <a href="#" class="badge badge-info">Delete</a>
                        </div>
                    @endif
                </div>
                <hr class="my-4">
            </div>
        </div>
    @endif
@endforeach