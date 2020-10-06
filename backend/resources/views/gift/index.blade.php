@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    みんなのギフト投稿
                    <a class="btn btn-success btn-sm float-right" style="display: inline" href="/gift/create"><i class="fas fa-plus-circle"></i> 新しいギフトを投稿</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($gifts as $gift)
                            <li class="list-group-item">
                                <h4><span class="badge badge-{{ $gift->user_position === 'sender' ? 'danger' : 'primary' }}">{{ $gift->user_position === 'sender' ? '贈る側のギフト' : 'もらう側のギフト' }}</span></h4>
                                <a class="card-title" href="/gift/{{ $gift->id }}">{{ $gift->title }}</a>
                                <p class="card-text">{{ $gift->content }}</p>
                                {{-- image入れる --}}
                                <span class="float-right">{{ $gift->created_at->format('Y/m/d H:m') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
