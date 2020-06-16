@extends('layouts.app')

@section('title', 'ユーザー情報の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ユーザー情報の編集</h2>
                <form action="{{ action('User\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="date">表示名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nickname" value="{{ $profile_form->nickname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">メールアドレス（編集できません）</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="email" value="{{ $profile_form->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">年収</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="income" value="{{ $profile_form->income }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">公開/非公開</label>
                        <div class="col-md-10 can-toggle demo-rebrand-1">
                            <input type="hidden" name="publication" value="0" />
                            @if ($profile_form->publication === 1)
                            <input id="d" type="checkbox" name="publication" value="1" checked />
                            @else
                            <input id="d" type="checkbox" name="publication" value="1" />
                            @endif
                            <label for="d">
                                <div class="can-toggle__switch" data-checked="公開" data-unchecked="非公開"></div>
                                <div class="can-toggle__label-text">　</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            <input type="hidden" name="password" value="{{ $profile_form->password }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="更新">
                            <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-outline-rmngreen">マイページ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
