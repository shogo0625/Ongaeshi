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
                            <img class="rounded" src="{{ asset('images/user.png') }}" width="180" height="180">
                            @else
                            <a href="/storage/user_images/{{$user->image_path}}" data-lightbox="storage/user_images/{{$user->image_path}}" data-title="{{ $user->name }}">
                                <img class="rounded" src="{{ asset('storage/user_images/' . $user->image_path) }}" width="180" height="180">
                            </a>
                            @endif
                            <h4 class="mt-2">{{ $user->name }}</h4>
                            <p class="mt-4">{{ $user->about_me }}</p>
                            @if($user->id === Auth::id())
                            <a class="btn btn-sm btn-light mb-2" href="/user/{{ $user->id }}/edit"><i class="fas fa-edit"></i> ユーザー情報を編集</a>
                            @elseif(Auth::user()->is_following($user->id))
                            <form action="/user/{{ $user->id }}/unfollow" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-outline-danger mb-2">フォロー解除</button>
                            </form>
                            @else
                            <form action="/user/{{ $user->id }}/follow" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary mb-2">フォローする</button>
                            </form>
                            @endif
                        </div>
                        <ul class="nav nav-tabs justify-content-center mt-2" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="gift-tab" data-toggle="tab" href="#gift" role="tab" aria-controls="gift" aria-selected="true">ギフト</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="following-tab" data-toggle="tab" href="#following" role="tab" aria-controls="following" aria-selected="false">フォロー</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="follower-tab" data-toggle="tab" href="#follower" role="tab" aria-controls="follower" aria-selected="false">フォロワー</a>
                            </li>
                            @if($user->id === Auth::id())
                            <li class="nav-item">
                                <a class="nav-link" id="liked-tab" data-toggle="tab" href="#liked" role="tab" aria-controls="liked" aria-selected="false">いいねしたギフト</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="gift" role="tabpanel" aria-labelledby="gift-tab">
                                @if($own_gifts->count() == 0)
                                    <p class="m-4">ギフト投稿はまだありません。</p>
                                @else
                                     @include('gift.gift_list', ['gifts' => $own_gifts])
                                     <div class="mt-2">
                                         {{ $own_gifts->links() }}
                                     </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab">
                                @if($following_users->count() == 0)
                                    <p class="m-4">フォローしているユーザーはいません。</p>
                                @else
                                    @include('user.user_list', ['users' => $following_users])
                                    <div class="mt-2">
                                        {{ $following_users->links() }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="follower" role="tabpanel" aria-labelledby="follower-tab">
                                @if($follower_users->count() == 0)
                                    <p class="m-4">フォローされているユーザーはいません。</p>
                                @else
                                    @include('user.user_list', ['users' => $follower_users])
                                    <div class="mt-2">
                                        {{ $follower_users->links() }}
                                    </div>
                                @endif
                            </div>
                            @if($user->id === Auth::id())
                            <div class="tab-pane fade" id="liked" role="tabpanel" aria-labelledby="liked-tab">
                                @if($liked_gifts->count() == 0)
                                    <p class="m-4">いいねしたギフト投稿はありません。</p>
                                @else
                                    @include('gift.gift_list', ['gifts' => $liked_gifts])
                                    <div class="mt-2">
                                        {{ $liked_gifts->links() }}
                                    </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
