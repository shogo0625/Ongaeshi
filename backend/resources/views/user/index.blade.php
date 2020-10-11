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
                                <h5>
                                    <a href="/user/{{ $user->id }}">{{ $user->name }}</a>
                                    @if($user->image_path === null)
                                    <a href="/user/{{ $user->id }}"><img src="{{ asset('images/user.png') }}" width="60" height="60"></a>
                                    @else
                                    <a href="/user/{{ $user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $user->image_path) }}" width="60" height="60"></a>
                                    @endif
                                </h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-success btn-sm" href="/anniversary/create"><i class="fas fa-plus-circle"></i> 新しい恩返しリマインダーを登録</a>
                <a class="btn btn-sm btn-primary float-right" href="/anniversary"><i class="fas fa-arrow-circle-up"></i> 一覧ページへ</a>
            </div>
        </div>
    </div>
</div>
@endsection
