<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追記
use Illuminate\Support\Facades\HTML;
use App\Models\User;
use App\Models\Giving;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index() {
      //  全ユーザー、全期間の Givingの合計
      $allgivings = Giving::sum('giving');

      //  全ユーザー、今年の Givingの合計
      $now = Carbon::now();
      $thisyeargivings = Giving::whereyear('updated_at', $now->year)
      ->sum('giving');

      //  表示ユーザーの配列化
      $users=User::where('publication',1)->get();

      foreach($users as $val) {
        $val1=$val->id;
        $users_c[] = array('id'=> $val1);
      }
      $users_l = array_column($users_c, 'id'); // array=[1,2,3,5,...]


      //  各ユーザー、今年の Givingランキング
      foreach ($users as $user) {
        $key = $user->id;
        $value = $user->nickname;
        $value2 = $user->givings()->whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('giving');
        $rank_givings[$key]=array('giving' => $value2, 'nickname' => $value);
      }
      // 最初の値でソートされる
      arsort($rank_givings);

      //  各ユーザー、今年のGiving率ランキング
      foreach ($users as $user) {
        $key = $user->id;
        $value = $user->nickname;
        $value7 = $user->income;
        $value2 = $user->givings()->whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('giving');
        $value8 = $value2 / ($value7*10000) *100;
        $rank_rates[$key]=array('rate' => $value8, 'nickname' => $value);
      }
      arsort($rank_rates);

      //   全ユーザー、最近の Giving
      $preallrecentgivings = Giving::whereIn('user_id',$users_l)->latest('updated_at')->get();

      foreach ($preallrecentgivings as $val) {
        $value6 = $val->user()->get();
        $value3 = $value6[0]->nickname;
        $value4 = $val->giving;
        $value5 = $val->updated_at;
        $allrecentgivings[]=array('nickname' => $value3, 'giving' => $value4, 'updated_at' => $value5);
      }

      return view('index',[
          'allgivings' => $allgivings,
          'thisyeargivings' => $thisyeargivings,
          'rank_givings' => $rank_givings,
          'rank_rates' => $rank_rates,
          'allrecentgivings' => $allrecentgivings
      ]);
    }

}
