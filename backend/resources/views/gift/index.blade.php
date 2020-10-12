@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">
                    みんなのギフト投稿
                </div>

                <div class="card-body">
                    @include('gift.gift_list', ['gifts' => $gifts])
                    <div class="mt-3">
                        {{ $gifts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
