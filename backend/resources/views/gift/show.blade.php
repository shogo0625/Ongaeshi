@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">ギフトの詳細</div>

                    <div class="card-body">
                        <h3><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈ったギフト' : 'もらったギフト' }}</span></h3>
                        <h4 class="mt-4 card-title">{{ $gift->title }}</h4>
                        <p class="mt-3 card-text">{{$gift->content}}</p>
                        <a class="btn btn-sm btn-light" href="/gift/{{ $gift->id }}/edit"><i class="fas fa-edit"></i> このギフトを編集</a>
                        <form style="display: inline" action="/gift/{{ $gift->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="このギフトを削除" onclick='return confirm("「{{ $gift->title }}」を削除してよろしいですか？")'>
                        </form>
                        <p class="float-right">{{ $gift->created_at->format('Y/m/d H:m') }}</p>
                    </div>
                </div>
                <!--
                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
                -->
            </div>
        </div>
    </div>
@endsection
