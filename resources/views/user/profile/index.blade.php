@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
  <div class="container">
    <div class="row">
      <h2>{{ Auth::user()->name }}さんのマイページ</h2>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2>Giving総額</h2>
        <h2>{{ $usertotal }}円</h2><br/>
      </div>
    </div>
    <div class="row">
      <!-- Left column  -->
      <div class="col-md-6">
        <h2>今年のGiving率</h2>
        <h2>年収の約{{ \Str::limit($givingrate,4) }}％をGivingしています。</h2><br/>
        <h2>Givingランキング</h2>
        <!-- ランキングの表示 -->
        <?php $i=1 ?>
        @foreach($usersums as $value)
          @if( $value['user_id'] == $currentuser )
            @break
          @endif
        <?php $i++ ?>
        @endforeach
        <h2>第{{ $i }}位</h2>
      </div>
      <!-- Right column  -->
      <div class="col-md-6">
        <h2>最近のGiving</h2>
        <table class="table">
            <thead>
                <tr>
                    <th width="20%">日付</th>
                    <th width="20%">Giving</th>
                    <th width="30%">適用</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentgivings as $giving)
                    @if($loop->iteration < 6)
                        <tr>
                            <td>{{ \Str::limit($giving->date, 20) }}</td>
                            <td>{{ \Str::limit($giving->giving, 20) }}</td>
                            <td>{{ \Str::limit($giving->purpose, 30) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <h2>Givingグラフ</h2>
          <div class="container" style="width:60%">
              <canvas id="canvas"></canvas>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <a href="{{ asset('user/giving/index') }}" role="button" class="btn btn-outline-success">Givingの一覧</a>
        <a href="{{ asset('user/giving/create') }}" role="button" class="btn btn-outline-success">Givingの新規作成</a>
        <a href="{{ action('User\ProfileController@edit') }}" role="button" class="btn btn-warning">ユーザー情報の編集</a>
        <a href="{{ asset('/index') }}" role="button" class="btn btn-outline-success">MyGivingトップ</a>
      </div>
    </div>
  </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>
<script>
window.onload = function() {
    ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar', // ここは bar にする必要があります
        data: barChartData,
        options: complexChartOption
    });
};
</script>

<script>
// データ
var giving_arr = JSON.parse('<?php echo $monthtotal; ?>');

var barChartData = {
    labels: ['1月','2月','3月','4月','5月','6月','7月',
        '8月','9月','10月','11月','12月'
    ],
    datasets: [
    {
        label: 'Monthly Givings',
        data: giving_arr,
        borderColor : "rgba(0,146,134,0.8)",
        backgroundColor : "rgba(0,146,134,0.5)",
    }
  ]
  }
</script>

<script>
var complexChartOption = {
    responsive: true,
    scales: {
        yAxes: [{
            ticks: {
                min: 0,
            },
        }],
    }
};
</script>
