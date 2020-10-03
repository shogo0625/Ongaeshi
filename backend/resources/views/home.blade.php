@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">直近の恩返し予定</div>

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
        </div>
    </div>
</div>
@endsection
