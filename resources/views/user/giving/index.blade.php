@extends('layouts.app')

@section('title', '登録済みGivingの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>{{ Auth::user()->name }}さんのGiving一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-10">
                <form action="{{ action('User\GivingController@index') }}" method="get">
                    <div class="form-group row mt-4">
                      <label class="">検索</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="keyword" value="{{ $keyword }}">
                          </div>
                          <div class="col-md-4">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="検索">
                            <a href="{{ action('User\GivingController@index', $keyword=null) }}" role="button" class="btn btn-outline-rmngreen">リセット</a>
                          </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto mt-4">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">日付</th>
                                <th width="20%">Giving</th>
                                <th width="30%">適用</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $giving)
                                <tr>
                                    <td>{{ \Str::limit($giving->date, 20) }}</td>
                                    <td>{{ \Str::limit($giving->giving, 20) }}</td>
                                    <td>{{ \Str::limit($giving->purpose, 100) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('User\GivingController@edit', ['id' => $giving->id]) }}" role="button" class="btn btn-outline-rmngreen">編集</a>
                                            <a href="{{ action('User\GivingController@delete', ['id' => $giving->id]) }}" role="button" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                  {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-10 mt-4">
            <a href="{{ asset('user/giving/create') }}" role="button" class="btn btn-outline-rmngreen">Givingの新規作成</a>
            <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-outline-rmngreen">マイページ</a>
            <a href="{{ asset('/index') }}" role="button" class="btn btn-outline-rmngreen">MyGivingトップ</a>
          </div>
        </div>
    </div>
@endsection
