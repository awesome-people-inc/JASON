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
                <hr class="my-4">
            </div>
        </div>
    @endif
@endforeach