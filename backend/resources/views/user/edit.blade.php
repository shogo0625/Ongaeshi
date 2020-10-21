@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">ユーザー情報編集</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{ $user->id }}" enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">ユーザー名</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">プロフィール画像</label>
                            <div class="col-md-7">
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" value="{{ old('image_path') }}">
                                <small class="form-text text-dark">変更がない場合は、今までの画像が適用されます（元の画像を<a href="/delete-images/user/{{ $user->id }}" onclick='return confirm("元の画像を削除してよろしいですか？")'>リセット</a>）</small>
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about_me" class="col-md-3 col-form-label text-md-right">自己紹介文</label>
                            <div class="col-md-7">
                                <textarea id="about_me" type="text" class="form-control @error('about_me') is-invalid @enderror" name="about_me" autocomplete="about_me" rows="10">{{ old('about_me', $user->about_me) }}</textarea>
                                @error('about_me')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit" class="btn btn-primary">この内容で登録</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3 mr-2 float-right">
                        <form style="display: inline" action="/user/{{ $user->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="アカウントを削除" onclick='return confirm("一度アカウントを削除すると復元できなくなります。\nアカウントを削除してよろしいですか？")'>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
