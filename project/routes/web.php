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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });

    //Route::get('/', 'HomeController@index');

    Route::get('/{id?}/{sid?}', function ($id = null, $sid = null) {
        return App::make("App\Http\Controllers\HomeController")->index($id, $sid);
    });
});
