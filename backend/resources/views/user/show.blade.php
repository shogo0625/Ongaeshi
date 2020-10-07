@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header text-center">ユーザーページ</div>

                    <div class="card-body">
                        <p class="mt-2">{{ $user->name }}</p>
                        <p class="mt-2">{{ $user->about_me }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
