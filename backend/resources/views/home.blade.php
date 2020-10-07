@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">直近の恩返し予定</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($anniversaries as $anniversary)
                            <li class="list-group-item">
                                <a href="/anniversary/{{ $anniversary->id }}">{{ $anniversary->title }}</a>
                                <span class="float-right">{{ $anniversary->date->format('Y年m月d日') }}（{{ $anniversary->showRemindTimeForAnniversary() }}）</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-success btn-sm" href="/anniversary/create"><i class="fas fa-plus-circle"></i> 新しい恩返しリマインダーを登録</a>
                <a class="btn btn-sm btn-primary float-right" href="/anniversary"><i class="fas fa-arrow-circle-up"></i> 一覧ページへ</a>
            </div>
        </div>
    </div>
</div>
@endsection
