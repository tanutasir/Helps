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
use Session;
use Illuminate\Http\Request;

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/', function ($id = null, $sid = null){
        return view('home');
    });

    Route::get('/', function ($id = null, $sid = null) {
        return App::make("App\Http\Controllers\HomeController")->home($id, $sid);
    })->where(['id' => '[0-9]+', 'sid' => '[0-9]+']);

    Route::get('/{id}', function ($id = null, $sid = null) {
        Session::put("id", $id);
        return App::make("App\Http\Controllers\HomeController")->page($id, $sid);
    })->where(['id' => '[0-9]+', 'sid' => '[0-9]+']);

    Route::get('/{id}/{sid}', function ($id = null, $sid = null) {
        Session::put("id", $id);
        Session::put("sid", $sid);
        return App::make("App\Http\Controllers\HomeController")->slavePage($id, $sid);
    })->where(['id' => '[0-9]+', 'sid' => '[0-9]+']);

    Route::any('/modal', 'NestedSetController@modal');
    Route::get('/slave', 'NestedSetController@slave');
});

Route::get('/tree/data', 'NestedSetController@data');
Route::get('/treeslave/data', 'NestedSetController@dataSlave');