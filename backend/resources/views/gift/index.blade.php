@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">
                    みんなのギフト投稿
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($gifts as $gift)
                            <li class="list-group-item">
                                <div class="float-right">
                                    <span class="mt-2 mr-1">By : <a href="/user/{{ $gift->user->id }}">{{ $gift->user->name }}</a></span>
                                    @if($gift->user->image_path !== null)
                                    <a href="/user/{{ $gift->user->id }}"><img src="{{ asset('storage/user_images/' . $gift->user->image_path) }}" width="45" height="45"></a>
                                    @endif
                                </div>
                                <h4><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈る側のギフト' : 'もらう側のギフト' }}</span></h4>
                                <a class="card-title" href="/gift/{{ $gift->id }}">{{ $gift->title }}</a>
                                <p class="card-text">{{ $gift->content }}</p>
                                @if($gift->image_path !== null)
                                <img src="{{ asset('storage/gift_images/' . $gift->image_path) }}" width="200" height="140">
                                @endif
                                <div class="row">
                                    <span class="offset-md-10">{{ $gift->created_at->format('Y/m/d H:m') }}</span>
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
