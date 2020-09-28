@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">恩返しリマインダー</div>
                    <div class="card-body">
                        <form action="/anniversary" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">何の日</label>
                                <input type="text" class="form-control" id="title" name="title" autofocus="true" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">メモ（どんなお祝いをもらったとか、相手の好きなものとか）</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">いつ</label>
                                <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <label for="reminder">知らせてほしいとき</label>
                                    <input type="number" class="form-control" id="reminder" name="reminder" min="0" value="{{ old('reminder') }}">
                                </div>
                                <div class="col-auto">
                                    <label for=""></label>
                                    <select class="form-control mt-2" name="unit" id="remind-unit">
                                        <option value="hours">時間前</option>
                                        <option value="days">日前</option>
                                    </select>
                                </div>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="恩返しリストへ登録">
                        </form>
                        <a class="btn btn-primary float-right" href="/anniversary"><i class="fas fa-arrow-circle-up"></i> 戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
