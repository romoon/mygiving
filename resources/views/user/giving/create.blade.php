@extends('layouts.app')

@section('title', 'Givingの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Givingの新規作成</h2>
                <form action="{{ action('User\GivingController@create') }}" method="post" enctype="multipart/form-data">
                    <!-- error check -->
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">日付</label>
                        <div class="col-md-10">
                            <!-- old('date') -->
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}" placeholder="2020-06-15">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Giving</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="giving" value="{{ old('giving') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">適用</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="purpose" rows="3">{{ old('purpose') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="登録">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                          <a href="{{ asset('user/giving/index') }}" role="button" class="btn btn-outline-rmngreen">Givingの一覧</a>
                          <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-outline-rmngreen">マイページ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
