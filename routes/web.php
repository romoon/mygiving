<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// User 認証不要
Route::get('/', 'FrontController@index');
Route::get('/index', 'FrontController@index');
// Route::get('/', function () { return redirect('/index'); });
// Route::get('/index', function () { return view('/index'); });

// User ログイン後
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('user/giving/create', 'User\GivingController@add');
    Route::post('user/giving/create', 'User\GivingController@create');
    Route::get('user/giving/index', 'User\GivingController@index');
    Route::get('user/giving/edit', 'User\GivingController@edit');
    Route::post('user/giving/edit', 'User\GivingController@update');
    Route::get('user/giving/delete', 'User\GivingController@delete');
    Route::get('user/profile/edit', 'User\ProfileController@edit');
    Route::post('user/profile/edit', 'User\ProfileController@update');
    Route::get('user/profile/index', 'User\ProfileController@index');
    Route::post('user/profile/index', 'User\ProfileController@index');
});

// Admin 認証不要
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/login'); });
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login');
});

// Admin ログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
    // Route::post('/home', 'Admin\HomeController@index')->name('admin.home');
});
