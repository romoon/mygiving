<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Giving;

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

    return redirect('/user/giving/create');
  }

  public function index(Request $request)
  {

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
