@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">ユーザー一覧</div>

                <div class="card-body">
                    <div class="infinite-scroll">
                        @include('user.user_list', ['users' => $users])
                        <div class="mt-2">
                            {{ $users->links("vendor/pagination/default") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
