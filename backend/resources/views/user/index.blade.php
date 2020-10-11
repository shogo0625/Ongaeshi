@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">ユーザー一覧</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">
                                <h5 style="display: inline">
                                    @if($user->image_path === null)
                                    <a href="/user/{{ $user->id }}"><img src="{{ asset('images/user.png') }}" width="65" height="65"></a>
                                    @else
                                    <a href="/user/{{ $user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $user->image_path) }}" width="65" height="65"></a>
                                    @endif
                                    <a href="/user/{{ $user->id }}">{{ $user->name }}</a>
                                </h5>
                                <div class="float-right mt-3">
                                    @if(Auth::user()->is_following($user->id))
                                    <form action="/user/{{ $user->id }}/unfollow" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-outline-danger">フォロー解除</button>
                                    </form>
                                    @else
                                    <form action="/user/{{ $user->id }}/follow" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
