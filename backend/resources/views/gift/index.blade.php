@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <form action="{{ url('/gift') }}" method="GET">
                <input type="text" name="keyword" value="{{ $keyword }}">
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
