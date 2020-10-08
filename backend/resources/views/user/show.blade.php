@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header text-center">ユーザーページ</div>

                    <div class="card-body">
                        <div class="text-center">
                            @if($user->image_path !== null)
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
                                            <a class="card-title" href="/gift/{{ $gift->id }}">{{ $gift->title }}</a>
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
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
