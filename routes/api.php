<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//
//Route::group(['middleware'=>'auth:api'], function () {
//
//
//    Route::group(['prefix' => 'user'], function () {
//
//            Route::post('login', 'App\Http\Controllers\api\LoginController@login');
//            Route::get('logout', 'App\Http\Controllers\api\LoginController@logout');
//            Route::get('getAll', 'App\Http\Controllers\api\user\UserController@get_all');
//
//    });
//});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\api\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\api\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\api\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\api\AuthController@me');
    Route::get('getAll', 'App\Http\Controllers\api\user\UserController@get_all');

});
