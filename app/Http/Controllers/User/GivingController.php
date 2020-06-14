<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Giving;
use Illuminate\Support\Facades\DB;

class GivingController extends Controller
{
    //
    public function add()
  {
      return view('user.giving.create');
  }

  public function create(Request $request)
  {
    $this->validate($request, Giving::$rules);

    $giving = new Giving;
    $form = $request->all();
    unset($form['_token']);

    $giving->fill($form)->save();

    return redirect('user/giving/create');
  }

  public function index(Request $request)
  {
    $currentuser = \Auth::user()->id;
    $keyword = $request->keyword;
    if ($keyword != '') {
        $posts = Giving::where('user_id', $currentuser)
        ->where('purpose', 'like', '%'.$keyword.'%')
        ->orwhere('date', 'like', '%'.$keyword.'%')
        ->paginate(10); // ->get();
    } else {
        $posts = Giving::where('user_id', $currentuser)
        ->paginate(10); // ->get();
    }
    return view('user.giving.index', ['posts' => $posts, 'keyword' => $keyword]);
  }

  public function edit(Request $request)
  {

  }

  public function update(Request $request)
  {

  }

  public function delete(Request $request)
  {

  }

}
