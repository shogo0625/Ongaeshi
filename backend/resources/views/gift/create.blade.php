@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ギフト投稿</div>
                    <div class="card-body">
                        <form action="/gift" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}" id="title" name="title" autofocus="true" value="{{ old('title') }}">
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
                                <textarea class="form-control{{ $errors->has('content') ? ' border-danger' : '' }}" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('content') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="image_path">画像</label>
                                <input type="file" class="col-md-4 form-control{{ $errors->has('image_path') ? ' border-danger' : '' }}" id="image_path" name="image_path" value="{{ old('image_path') }}">
                                <small class="form-text text-danger">{!! $errors->first('image_path') !!}</small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="このギフトを投稿">
                        </form>
                        <a class="btn btn-primary float-right" href="/gift"><i class="fas fa-arrow-circle-up"></i> 戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
