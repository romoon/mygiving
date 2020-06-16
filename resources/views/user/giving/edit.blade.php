@extends('layouts.app')

@section('title', 'Givingの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Givingの編集</h2>
                <form action="{{ action('User\GivingController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="date">日付</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="date" value="{{ $giving_form->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="giving">Giving</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="giving" value="{{ $giving_form->giving }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="purpose">適用</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="purpose" rows="3">{{ $giving_form->purpose }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="id" value="{{ $giving_form->id }}">
                            <input type="hidden" name="user_id" value="{{ $giving_form->user_id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="更新">
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
