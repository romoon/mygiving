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
        ->latest('date')
        ->paginate(10); // ->get();
    } else {
        $posts = Giving::where('user_id', $currentuser)
        ->latest('date')
        ->paginate(10); // ->get();
    }
    return view('user.giving.index', ['posts' => $posts, 'keyword' => $keyword]);
  }

  public function edit(Request $request)
  {
      $giving = Giving::find($request->id);
      if (empty($giving)) {
        abort(404);
      }
      return view('user.giving.edit', ['giving_form' => $giving]);
  }

  public function update(Request $request)
  {
      $this->validate($request, Giving::$rules);
      $giving = Giving::find($request->id);
      $giving_form = $request->all();
      unset($giving_form['_token']);

      $giving->fill($giving_form)->save();

      return redirect('user/giving/index');
  }

  public function delete(Request $request)
  {
      $giving = Giving::find($request->id);
      $giving->delete();

      return redirect('user/giving/index');
  }

}
