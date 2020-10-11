@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header text-center">ユーザーページ</div>

                    <div class="card-body">
                        <div class="text-center">
                            @if($user->image_path === null)
                            <img src="{{ asset('images/user.png') }}" width="180" height="180">
                            @else
                            <a href="/storage/user_images/{{$user->image_path}}" data-lightbox="storage/user_images/{{$user->image_path}}" data-title="{{ $user->name }}">
                                <img class="rounded" src="{{ asset('storage/user_images/' . $user->image_path) }}" width="180" height="180">
                            </a>
                            @endif
                            <h4 class="mt-2">{{ $user->name }}</h4>
                            <p class="mt-4">{{ $user->about_me }}</p>
                        </div>
                        <ul class="nav nav-tabs justify-content-center mt-2" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="gift-tab" data-toggle="tab" href="#gift" role="tab" aria-controls="gift" aria-selected="true">ギフト</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="gift" role="tabpanel" aria-labelledby="gift-tab">
                                <ul class="list-group">
                                    @foreach($user->gifts()->get() as $gift)
                                        <li class="list-group-item">
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
                                                <div class="offset-md-5 col-md-5 text-right">
                                                    <span class="mr-3"><i class="fas fa-comment" aria-hidden="true"></i> {{ $gift->gift_comments->count() }} コメント</span>
                                                    @if($gift->is_liked_by(Auth::id()))
                                                    <form name="delete_like_{{ $gift->id }}" style="display: inline" action="/gift/{{ $gift->id }}/unlike" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <a href="javascript:delete_like_{{ $gift->id }}.submit()" class="mr-3"><i class="fas fa-heart" aria-hidden="true" style="color: red;"></i> {{ $gift->likes->count() }} いいね</a>
                                                    </form>
                                                    @else
                                                    <form name="create_like_{{ $gift->id }}" style="display: inline" action="/gift/{{ $gift->id }}/like" method="post">
                                                        @csrf
                                                        <a href="javascript:create_like_{{ $gift->id }}.submit()" class="mr-3"><i class="fas fa-heart" aria-hidden="true"></i> {{ $gift->likes->count() }} いいね</a>
                                                    </form>
                                                    @endif
                                                </div>
                                                <span>{{ $gift->created_at->format('Y/m/d H:m') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
