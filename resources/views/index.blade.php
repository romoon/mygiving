@extends('layouts.app')

@section('title', 'MyGivingトップ')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4>今年の総Giving</h4>
            <h2>{{ $thisyeargivings }}円</h2><br/>
          <hr style="border-top:3px double lightgray;">
            <h4>これまでの総Giving</h4>
            <h2>{{ $allgivings }}円</h2>
          </div>
        </div>
        <hr style="border-top:3px double lightgray;">
        <div class="row">
            <div class="col-md-12">
                <h2>Give and Give!</h2>
                <p>MyGiving-Pocketbookは</br>プレゼントや差し入れ、寄付など</br>人のために使ったお金を記録します。</p>
            </div>
        </div>
        <hr style="border-top:3px double lightgray;">
        <div class="row">
            <!-- Left column  -->
            <div class="col-md-6">
                <div class="mt-4">
                    <h2>今年の総Giving</br>ランキング</h2>
                    <table class="table">
                    <thead>
                        <tr>
                            <th width="20%">順位</th>
                            <th width="20%">ニックネーム</th>
                            <th width="20%">総Giving</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($rank_givings as $rank_giving)
                          @if( $i > 10 )
                            @break
                          @endif
                          <tr>
                              <td>{{ $i }}</td>
                              <td>{{ $rank_giving['nickname'] }}さん</td>
                              <td>{{ $rank_giving['giving'] }}円</td>
                          </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="mt-4">
                <hr style="border-top:3px double lightgray;">
              </div>
              <div class="mt-4">
                <h2>今年のGiving</br>年収割合ランキング</h2>
                <table class="table">
                <thead>
                    <tr>
                        <th width="20%">順位</th>
                        <th width="20%">ニックネーム</th>
                        <th width="20%">年収割合</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1 ?>
                    @foreach($rank_rates as $rank_rate)
                      @if( $i > 10 )
                        @break
                      @endif
                      <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $rank_rate['nickname'] }}さん</td>
                          <td>{{ \Str::limit($rank_rate['rate'],4) }}%</td>
                      </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
                </table>
                </div>
            </div>
            <!-- Right column  -->
            <div class="col-md-6">
              <div class="mt-4">
                <h2>最近のGiving</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="20%">日付</th>
                            <th width="20%">ニックネーム</th>
                            <th width="20%">Giving</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($allrecentgivings as $giving)
                          @if( $i > 10 )
                            @break
                          @endif
                          <tr>
                            <td>{{ \Str::limit($giving['updated_at'], 10) }}</td>
                            <td>{{ \Str::limit($giving['nickname'], 20) }}さん</td>
                            <td>{{ \Str::limit($giving['giving'], 20) }}</td>
                          </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr style="border-top:3px double lightgray;">
                <div class="row">
                  <div class="col-md-10 mx-auto mt-3">
                    <a href="{{ route('login') }}" role="button" class="btn btn-primary">User Login</a>
                    <a href="{{ route('admin.login') }}" role="button" class="btn btn-danger">Admin Login</a>
                    <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-outline-rmngreen">マイページ</a>
                    <a href="{{ asset('user/giving/index') }}" role="button" class="btn btn-outline-rmngreen">Givingの一覧</a>
                    <a href="{{ asset('user/giving/create') }}" role="button" class="btn btn-outline-rmngreen">Givingの新規作成</a>
                    <a href="{{ action('User\ProfileController@edit') }}" role="button" class="btn btn-warning">ユーザー情報の編集</a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
