@extends('layouts.app')

@section('title', 'MyGivingトップ')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1>Give and Give!</h1>
                <p>MyGivingは、プレゼントや寄付など、人のために使ったお金を記録します。</p>
                <hr style="border-top:3px double lightgray;">
            </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-10 text-center">
            <div class="mt-5">
                <h4>今年の総Giving</h4>
            </div>
            <div class="mt-3">
                <h2>{{ $thisyeargivings }}円</h2><br/>
                <hr style="border-top:3px double lightgray;">
            </div>
            <div class="mt-5">
                <h4>これまでの総Giving</h4>
            </div>
            <div class="mt-3">
                <h2>{{ $allgivings }}円</h2>
            </div>
            <div class="mt-5">
                <hr style="border-top:3px double lightgray;">
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
            <!-- Left column  -->
            <div class="col-md-5">
                <div class="mt-5">
                    <h2>今年の総Givingランキング</h2>
                </div>
                <div class="mt-3">
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
                <div class="mt-5">
                <hr style="border-top:3px double lightgray;">
              </div>
              <div class="mt-5">
                <h2>今年のGiving</br>年収割合ランキング</h2>
              </div>
              <div class="mt-3">
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
            <div class="col-md-5">
              <div class="mt-5">
                <h2>最近のGiving</h2>
              </div>
              <div class="mt-3">
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <hr style="border-top:3px double lightgray;">
                  <div class="col-md-10 mx-auto mt-5">
                    <a href="{{ route('login') }}" role="button" class="btn btn-primary">User Login</a>
                    <a href="{{ asset('user/profile/index') }}" role="button" class="btn btn-outline-rmngreen">マイページ</a>
                    <a href="{{ asset('user/giving/index') }}" role="button" class="btn btn-outline-rmngreen">Givingの一覧</a>
                    <a href="{{ asset('user/giving/create') }}" role="button" class="btn btn-outline-rmngreen">Givingの新規作成</a>
                </div>
            </div>
        </div>
    </div>
@endsection
