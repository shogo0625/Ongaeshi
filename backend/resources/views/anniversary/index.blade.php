@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-future-tab" data-toggle="pill" href="#pills-future" role="tab" aria-controls="pills-future" aria-selected="true">未来の恩返し</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#pills-past" role="tab" aria-controls="pills-past" aria-selected="false">過去の恩返し</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-future" role="tabpanel" aria-labelledby="pills-future-tab">
                    <ul class="list-group">
                        @foreach($future_anniversaries as $anniversary)
                            <li class="list-group-item">
                                <a href="/anniversary/{{ $anniversary->id }}">{{ $anniversary->title }}</a>
                                <span class="float-right">{{ $anniversary->date->format('Y年m月d日') }}（{{ $anniversary->showRemindTimeForAnniversary() }}）</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
                    <ul class="list-group">
                        @foreach($past_anniversaries as $anniversary)
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
            </div>
        </div>
    </div>
</div>
@endsection
