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
                                    <a href="/user/{{ $gift->user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $gift->user->image_path) }}" width="45" height="45"></a>
                                    @endif
                                </div>
                                <h4><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈る側のギフト' : 'もらう側のギフト' }}</span></h4>
                                <h5 class="mt-3"><a class="card-title" href="/gift/{{ $gift->id }}">{{ $gift->title }}</a></h5>
                                <p class="card-text">{{ $gift->content }}</p>
                                @if($gift->image_path !== null)
                                <a href="/storage/gift_images/{{$gift->image_path}}" data-lightbox="storage/gift_images/{{$gift->image_path}}" data-title="{{ $gift->title }}">
                                    <img src="{{ asset('storage/gift_images/' . $gift->image_path) }}" width="200" height="140">
                                </a><br>
                                <i class="fa fa-search-plus"></i> クリックして拡大
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
