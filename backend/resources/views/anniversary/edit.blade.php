@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">恩返しリマインダー編集</div>
                    <div class="card-body">
                        <form action="/anniversary/{{ $anniversary->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">何の日</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}" id="title" name="title" autofocus="true" value="{{ old('title', $anniversary->title) }}">
                                <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">メモ（どんなお祝いをもらったとか、相手の好きなものとか）</label>
                                <textarea class="form-control{{ $errors->has('description') ? ' border-danger' : '' }}" id="description" name="description" rows="5">{{ old('description', $anniversary->description) }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="date">いつ</label>
                                <input type="date" class="col-md-4 form-control{{ $errors->has('date') ? ' border-danger' : '' }}" id="date" name="date" value="{{ old('date', $anniversary->date->format('Y-m-d')) }}">
                                <small class="form-text text-danger">{!! $errors->first('date') !!}</small>
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <label for="reminder">知らせてほしいとき（通知不要の場合、未入力）</label>
                                    <input type="number" class="form-control{{ $errors->has('reminder') ? ' border-danger' : '' }}" id="reminder" name="reminder" min="0" value="{{ old('reminder') }}">
                                    <small class="form-text text-danger">{!! $errors->first('reminder') !!}</small>
                                </div>
                                <div class="col-auto">
                                    <label for=""></label>
                                    <select class="form-control mt-2" name="unit" id="remind-unit">
                                        <option value="hours">時間前</option>
                                        <option value="days">日前</option>
                                    </select>
                                </div>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="この内容で編集">
                        </form>
                        <a class="btn btn-sm btn-primary float-right" href="/anniversary/{{ $anniversary->id }}"><i class="fas fa-arrow-circle-up"></i> 詳細ページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
