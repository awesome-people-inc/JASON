<li class="list-group-item">
        <div class="row">
            <div class="col-sm-1">
                <img class="rounded-circle"  width="35px" height="35px" src="{{ url($user1->avatar) }}" alt="" />
            </div>
            <div class="col-sm text-center">
                <h3>{{explode(' ',$user1->name)[0]}}</h3>
            </div>
            <div class="col-sm text-right">
                <a href="{{ route('profile', ['id' => $user1->uuid]) }}" class="btn btn-sm btn-primary">Visit Profile</a>
            </div>
        </div>
</li>