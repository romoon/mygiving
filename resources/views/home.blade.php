@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-rmngreen" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br/>

                    <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-rmngreen">マイページ</a>
                    <a href="{{ asset('/index') }}" role="button" class="btn btn-outline-rmngreen">MyGivingトップ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
