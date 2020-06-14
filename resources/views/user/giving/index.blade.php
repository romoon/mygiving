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
                            <input type="submit" class="btn btn-primary" value="検索">
                            <a href="{{ action('User\GivingController@index', $keyword=null) }}"role="button" class="btn btn-outline-primary">リセット</a>
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
                                            <!-- {{-- action('User\GivingController@edit', ['id' => $giving->id]) --}} -->
                                            <a href="" role="button" class="btn btn-outline-primary">編集</a>
                                            <!-- {{-- action('User\GivingController@delete', ['id' => $giving->id]) --}} -->
                                            <a href="" role="button" class="btn btn-outline-danger">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-10 mt-4">
            <!-- {{ asset('user/giving/index') }} -->
            <a href="{{ asset('user/giving/index') }}" role="button" class="btn btn-outline-success">Givingの一覧</a>
            <!-- {{ asset('user/giving/create') }} -->
            <a href="{{ asset('user/giving/create') }}" role="button" class="btn btn-outline-success">Givingの新規作成</a>
            <!-- {{ asset('/user/profile/index') }} -->
            <a href="" role="button" class="btn btn-outline-success">マイページ</a>
          </div>
        </div>
    </div>
@endsection
