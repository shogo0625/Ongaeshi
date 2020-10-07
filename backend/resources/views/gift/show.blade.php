@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header text-center">ギフトの詳細</div>

                    <div class="card-body">
                        <h3><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈る側のギフト' : 'もらう側のギフト' }}</span></h3>
                        <h4 class="mt-4 card-title">{{ $gift->title }}</h4>
                        <p class="mt-3 card-text">{{$gift->content}}</p>
                        @if($gift->image_path !== null)
                        <img src="{{ asset('storage/gift_images/' . $gift->image_path) }}" width="400" height="280">
                        @endif
                        <div class="mt-4">
                            <a class="btn btn-sm btn-light" href="/gift/{{ $gift->id }}/edit"><i class="fas fa-edit"></i> このギフトを編集</a>
                            <form style="display: inline" action="/gift/{{ $gift->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="このギフトを削除" onclick='return confirm("「{{ $gift->title }}」を削除してよろしいですか？")'>
                            </form>
                            <p class="float-right">{{ $gift->created_at->format('Y/m/d H:m') }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <a class="btn btn-sm btn-primary float-right" href="/gift"><i class="fas fa-arrow-circle-up"></i> 一覧ページへ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
