<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Giving;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $profile = \Auth::user();

        return view('user.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        $this->validate($request, \Auth::user()::$rules);
        $profile = \Auth::user();
        $profile_form = $request->all();
        unset($profile_form['_token']);

        $profile->fill($profile_form)->save();

        return redirect('user/profile/index');
    }

    public function index()
    {
        //  ログイン中のユーザーの、今年の、Givingの合計
        $currentuser = \Auth::user();
        $now = Carbon::now();
        $usertotal = Giving::where('user_id', $currentuser->id)
        ->whereYear('date', $now->year)
        ->sum('giving');

        //  ログイン中のユーザーの、今年の、Giving率
        $givingrate = $usertotal / ($currentuser->income*10000)*100;

        //  ログイン中のユーザーの、月ごとの、Givingの合計
        for ($i=1; $i<13; $i++) {
            $monthgiving = Giving::where('user_id', $currentuser->id)
            ->whereYear('date', $now->year)
            ->whereMonth('date',$i)
            ->sum('giving');

            $pregiving_l[]= array('giving' => $monthgiving);
        }
        $giving_l = array_column($pregiving_l, 'giving');
        $monthtotal = json_encode($giving_l);

        // Givingからログイン中のユーザーのデータをdate順に並べる
        $recentgivings = Giving::where('user_id', $currentuser->id)
        ->latest('date')
        ->get();

        // Givingテーブルで、各ユーザーの今年の総Givingの合計を求め、大きい順に並べ替える
        $usersums = Giving::whereyear('date', $now->year)
        ->get()
        // ユーザーIDごとにGivingの合計を求める
        ->groupBy('user_id')
        ->map(function ($day) {
            return ["user_id" => $day[0]->user_id, "giving" => $day->sum("giving")];
          })
        // 割合が高い順に並べ替える
        ->sortByDesc('giving');

        return view('user.profile.index', [
          'currentuser' => $currentuser,
          'usertotal' => $usertotal,
          'givingrate' => $givingrate,
          'monthtotal' => $monthtotal,
          'recentgivings' => $recentgivings,
          'usersums' => $usersums,
        ]);
    }
}
