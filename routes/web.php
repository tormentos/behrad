<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('verifiedphone');

Route::get('phone/verify', 'App\Http\Controllers\PhoneNumberVerifyController@show')->name('phoneverification.show');
Route::post('phone/verify', 'App\Http\Controllers\PhoneNumberVerifyController@verify')->name('phoneverification.verify');
