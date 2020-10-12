@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link border border-primary active" id="pills-future-tab" data-toggle="pill" href="#pills-future" role="tab" aria-controls="pills-future" aria-selected="true">未来の恩返し</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border border-primary" id="pills-past-tab" data-toggle="pill" href="#pills-past" role="tab" aria-controls="pills-past" aria-selected="false">過去の恩返し</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-future" role="tabpanel" aria-labelledby="pills-future-tab">
                            @if($future_anniversaries->count() == 0)
                                <div class="list-group">
                                    <span class="m-2">登録されている未来の恩返しリマインダーはありません。</span>
                                </div>
                            @else
                                @include('anniversary.anniversary_list', ['anniversaries' => $future_anniversaries])
                                <div class="mt-3">
                                    {{ $future_anniversaries->links() }}
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
                            @if($past_anniversaries->count() == 0)
                                <div class="list-group">
                                    <span class="m-2">登録されている過去の恩返しリマインダーはありません。</span>
                                </div>
                            @else
                                @include('anniversary.anniversary_list', ['anniversaries' => $past_anniversaries])
                                <div class="mt-3">
                                    {{ $past_anniversaries->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <a class="btn btn-success btn-sm" href="/anniversary/create"><i class="fas fa-plus-circle"></i> 新しい恩返しリマインダーを登録</a>
            </div>
        </div>
    </div>
</div>
@endsection
