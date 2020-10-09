@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">ギフト編集</div>
                    <div class="card-body">
                        <form action="/gift/{{ $gift->id }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}" id="title" name="title" autofocus="true" value="{{ old('title', $gift->title) }}" required>
                                <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="user_position">ギフト区分</label>
                                <select class="form-control" name="user_position" id="user_position">
                                    <option value="sender">贈る側のギフト</option>
                                    <option value="receiver">もらう側のギフト</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">詳細</label>
                                <textarea class="form-control{{ $errors->has('content') ? ' border-danger' : '' }}" id="content" name="content" rows="5">{{ old('content', $gift->content) }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('content') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="image_path">新しい画像</label>
                                <small class="form-text text-dark">変更がない場合は、今までの画像が適用されます（元の画像を<a href="/delete-images/gift/{{ $gift->id }}" onclick='return confirm("元の画像を削除してよろしいですか？")'>リセット</a>）</small>
                                <input type="file" class="col-md-4 form-control{{ $errors->has('image_path') ? ' border-danger' : '' }}" id="image_path" name="image_path">
                                <small class="form-text text-danger">{!! $errors->first('image_path') !!}</small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="この内容で編集">
                        </form>

                        <a class="btn btn-sm btn-primary float-right" href="/gift/{{ $gift->id }}"><i class="fas fa-arrow-circle-up"></i> 詳細ページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
