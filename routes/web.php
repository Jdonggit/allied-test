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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//將用戶重新導向至OAuth提供程序
Route::get('login/google', 'App\Http\Controllers\SocialController@redirectToProvider')->name('google.login');

//在身份驗證之後接收來自提供程序的回調。
Route::get('login/google/callback', 'App\Http\Controllers\SocialController@handleProviderCallback');