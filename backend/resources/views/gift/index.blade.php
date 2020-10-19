@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-11">
            <form action="{{ url('/gift') }}" method="GET">
                <div class="form-row">
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="keyword" id="keyword" value="{{ $keyword }}" placeholder="キーワード検索">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="genre" id="genre">
                            <option value="">全てのジャンル</option>
                            <option value="sender">贈る側のギフト</option>
                            <option value="receiver">もらう側のギフト</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input class="btn btn-success btn-block" type="submit" value="検索">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">
                    みんなのギフト投稿
                </div>

                <div class="card-body">
                    <div class="infinite-scroll">
                        @include('gift.gift_list', ['gifts' => $gifts])
                        <div class="mt-2">
                            {{ $gifts->links("vendor/pagination/default") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
