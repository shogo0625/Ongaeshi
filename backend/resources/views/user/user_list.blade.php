<ul class="list-group">
    @foreach($users as $a_user)
        <li class="list-group-item">
            <h5 style="display: inline">
                @if($a_user->image_path === null)
                <a href="/user/{{ $a_user->id }}"><img class="rounded" src="{{ asset('images/user.png') }}" width="65" height="65"></a>
                @else
                <a href="/user/{{ $a_user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $a_user->image_path) }}" width="65" height="65"></a>
                @endif
                <a href="/user/{{ $a_user->id }}">{{ $a_user->name }}</a>
            </h5>
            @auth
            <div class="float-right mt-3">
                @if(Auth::user()->is_following($a_user->id))
                <form action="/user/{{ $a_user->id }}/unfollow" method="post" class="follow" id="{{ $a_user->id }}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" id="user_page_id" name="user_page_id" value="{{ isset($user) ? $user->id : '' }}">
                    <input type="hidden" id="tab_name" name="tab_name" value="">
                    <button type="submit" class="btn btn-outline-danger">フォロー解除</button>
                </form>
                @elseif($a_user->id !== Auth::id())
                <form action="/user/{{ $a_user->id }}/follow" method="post" class="follow" id="{{ $a_user->id }}">
                    @csrf
                    <input type="hidden" id="user_page_id" name="user_page_id" value="{{ isset($user) ? $user->id : '' }}">
                    <input type="hidden" name="tab_name" name="tab_name" value="">
                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
                @endif
            </div>
            @endauth
        </li>
    @endforeach
</ul>
