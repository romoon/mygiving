@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-rmngreen" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br/>
                    <a href="{{ asset('/admin/index') }}" role="button" class="btn btn-rmngreen">ユーザー一覧</a>
                    <a href="{{ asset('/index') }}" role="button" class="btn btn-rmngreen">MyGivingトップ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
