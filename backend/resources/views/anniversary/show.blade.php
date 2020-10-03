@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">恩返しの予定</div>

                    <div class="card-body">
                        <h3><span class="badge badge-primary">{{ $anniversary->date->format('Y年m月d日') }}</span></h3>
                        <h4 class="mt-4">{{ $anniversary->title }}</h4>
                        <p class="mt-3">{{$anniversary->description}}</p>
                        <p class="mt-3 mb-3">通知時刻：{{ $anniversary->reminder === null ? '未設定' : $anniversary->reminder->format('m月d日 H時') }}</p>
                        <a class="btn btn-sm btn-light" href="/anniversary/{{ $anniversary->id }}/edit"><i class="fas fa-edit"></i> この予定を編集</a>
                        <form class="float-right" style="display: inline" action="/anniversary/{{ $anniversary->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="この予定を削除" onclick='return confirm("「{{ $anniversary->title }}」を削除してよろしいですか？")'>
                        </form>
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
