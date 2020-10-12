@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">直近の恩返し予定</div>

                <div class="card-body">
                    @if($anniversaries->count() == 0)
                    <div class="list-group">
                        <span class="m-2">登録されている未来の恩返しリマインダーはありません。</span>
                    </div>
                    @else
                        @include('anniversary.anniversary_list', ['anniversaries' => $anniversaries])
                    @endif
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
