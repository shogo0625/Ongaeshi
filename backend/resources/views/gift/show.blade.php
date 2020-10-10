@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header text-center">ギフトの詳細</div>

                    <div class="card-body">
                        <div class="float-right">
                            <h5>
                                <span class="mt-3 mr-2">By : <a href="/user/{{ $gift->user->id }}">{{ $gift->user->name }}</a></span>
                                @if($gift->user->image_path !== null)
                                <a href="/user/{{ $gift->user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $gift->user->image_path) }}" width="60" height="60"></a>
                                @endif
                            </h5>
                        </div>
                        <h3><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈る側のギフト' : 'もらう側のギフト' }}</span></h3>
                        <h4 class="mt-4 card-title">{{ $gift->title }}</h4>
                        <p class="mt-3 card-text">{{$gift->content}}</p>
                        @if($gift->image_path !== null)
                        <a href="/storage/gift_images/{{$gift->image_path}}" data-lightbox="storage/gift_images/{{$gift->image_path}}" data-title="{{ $gift->title }}">
                            <img src="{{ asset('storage/gift_images/' . $gift->image_path) }}" width="400" height="280">
                        </a><br>
                        <i class="fa fa-search-plus"></i> クリックして拡大
                        @endif
                        @if($gift->user->id === auth()->id())
                        <div class="row mt-4 mb-3 ml-1">
                            <a class="btn btn-sm btn-light" href="/gift/{{ $gift->id }}/edit"><i class="fas fa-edit"></i> このギフトを編集</a>
                            <form style="display: inline" action="/gift/{{ $gift->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger ml-2" type="submit" value="このギフトを削除" onclick='return confirm("「{{ $gift->title }}」を削除してよろしいですか？")'>
                            </form>
                        </div>
                        @endif
                        <div class="row">
                            <div class="offset-md-5 col-md-5 text-right">
                                <span class="mr-3"><i class="fas fa-comment" aria-hidden="true"></i> {{ $gift->gift_comments->count() }} コメント</span>
                                @if($gift->is_liked_by(Auth::id()))
                                <form name="delete_like_{{ $gift->id }}" style="display: inline" action="/gift/{{ $gift->id }}/like" method="post">
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
                    </div>
                </div>
                @if($gift->gift_comments->count() > 0)
                    @foreach($gift->gift_comments as $gift_comment)
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <span>{{ $gift_comment->created_at->format('Y/m/d H:m') }}</span>
                            </div>
                            <div class="row">
                                <span class="mt-2 mr-1">By : <a href="/user/{{ $gift_comment->user->id }}">{{ $gift_comment->user->name }}</a></span>
                                @if($gift_comment->user->image_path !== null)
                                <a href="/user/{{ $gift_comment->user->id }}"><img class="rounded" src="{{ asset('storage/user_images/' . $gift_comment->user->image_path) }}" width="45" height="45"></a>
                                @endif
                            </div>
                            <p class="mt-3">{{ $gift_comment->comment }}</p>
                            @if($gift_comment->user->id === auth()->id())
                            <form style="display: inline" action="/gift/{{ $gift->id }}/gift_comment/{{ $gift_comment->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger float-right" type="submit" value="コメントを削除" onclick='return confirm("このコメントを削除してよろしいですか？")'>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-body">
                            <span class="text-secondary">コメントはまだありません。</span>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <form action="/gift/{{ $gift->id }}/gift_comment" method="POST">
                        @csrf
                        <div class="form-group mt-4 mx-4">
                            <textarea class="form-control{{ $errors->has('comment') ? ' border-danger' : '' }}" id="comment" name="comment" rows="4">{{ old('comment') }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('comment') !!}</small>
                        </div>
                        <input class="float-right btn btn-sm btn-outline-primary mx-4 mb-3" type="submit" value="コメントする">
                    </form>
                </div>
                <div class="mt-2">
                    <a class="btn btn-sm btn-primary float-right" href="/gift"><i class="fas fa-arrow-circle-up"></i> 一覧ページへ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
