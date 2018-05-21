<div class="profile">
    <div class="inner">
        <header>
            <div class="masthead">
                <img class="avatar" src="{{ url($user->avatar) }}" alt="{{ $user->name }}" />
            </div>
            <div class="meta">
                <h3 class="name">{{ $user->name }}</h3>
                @if($user->profile->location)
                    <h4 class="title">{{ $user->profile->location }}</h4>
                @endif
                @if($user->profile->facebook_id)
                    <a href="{{ url($user->profile->facebook_url) }}" target="_blank">
                        <div class="icons8-facebook"></div>
                    </a>
                @endif
                @if($user->profile->github_id)
                    <a href="{{ url($user->profile->github_url) }}" target="_blank">
                        <div class="icons8-github"></div>
                    </a>
                @endif
                @if($user->profile->google_id)
                    <a @if($user->profile->google_url) href="{{ url($user->profile->google_url) }}" target="_blank" @endif>
                        <div class="icons8-google"></div>
                    </a>
                @endif
                @if($user->profile->linkedin_id)
                    <a href="{{ url($user->profile->linkedin_url) }}" target="_blank">
                        <div class="icons8-linkedin"></div>
                    </a>
                @endif
            </div>
        </header>
        <div class="content">
            <p>{{ $user->profile->headline }}</p>
        </div>
    </div>
</div>