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
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/trade_list', 'App\Http\Controllers\TradeController@trade');
Route::get('/multi_list', 'App\Http\Controllers\MultiController@multi');

Route::get('/login', function () {
    return view('login_from');
});
Route::get('/logout','App\Http\Controllers\RegisterController@logout')->name('logout');

Route::post('/master','App\Http\Controllers\RegisterController@login')->name('login');
Route::get('/master','App\Http\Controllers\RegisterController@master');
Route::get('/master/{id}', 'App\Http\Controllers\RegisterController@master')->name('index');

Route::get('/register', function () {
    return view('register');
});
Route::post('/complete','App\Http\Controllers\RegisterController@register')->name('register');

Route::get('/lose_password', function () {
    return view('lose_password');
})->middleware('guest')->name('password.request');
Route::post('/reset_password','App\Http\Controllers\RegisterController@reset')->name('reset');
Route::get('/reset_password','App\Http\Controllers\RegisterController@reset');

Route::post('reset_complete','App\Http\Controllers\RegisterController@complete');

Route::get('/trade_recuruit', function() {
    return view('trade_recuruit');
});
Route::get('/multi_recruit', function() {
    return view('multi_recruit');
});
Route::post('/recuruit_complete','App\Http\Controllers\TradeController@recruit');
Route::post('/recruit_complete','App\Http\Controllers\MultiController@recruit')->name('complete');

Route::get('/recuruit_complete', function() {
    return view('recuruit_complete');
});
Route::get('/recruit_complete', function() {
    return view('recuruit_complete');
});

Route::get('/trade_update/{id}','App\Http\Controllers\TradeController@update');
Route::post('/update_complete','App\Http\Controllers\TradeController@complete')->name('trade_update');

Route::get('/multi_update/{id}','App\Http\Controllers\MultiController@update');
Route::post('/multi_update_complete','App\Http\Controllers\MultiController@complete')->name('multi_update');

Route::get('/trade_delete','App\Http\Controllers\TradeController@delete');
Route::get('/multi_delete','App\Http\Controllers\MultiController@delete');

Route::get('/trade/{id}','App\Http\Controllers\TradeController@detail');
Route::get('/multi/{id}','App\Http\Controllers\MultiController@detail');

Route::get('/user/{u_id}','App\Http\Controllers\UserController@user');


Route::post('/good/{id}','App\Http\Controllers\UserController@good')->name('good');
Route::post('/ungood/{id}','App\Http\Controllers\UserController@ungood');

Route::get('/master_multi','App\Http\Controllers\UserController@multi');
Route::get('/master_multi/{id}','App\Http\Controllers\UserController@mastermulti');

Route::get('/master_trade','App\Http\Controllers\UserController@trade');
Route::get('/master_trade/{id}','App\Http\Controllers\UserController@mastertrade');

Route::post('/multi_coment/{id}','App\Http\Controllers\MultiController@coment');
Route::post('/trade_coment/{id}','App\Http\Controllers\TradeController@coment');

Route::get('/multi_coment_delete/{id}','App\Http\Controllers\MultiController@comentDelete');
Route::get('/trade_coment_delete/{id}','App\Http\Controllers\tradeController@comentDelete');

Route::get('/coment_list/{id}','App\Http\Controllers\UserController@masterComent');
Route::get('/coment_list','App\Http\Controllers\UserController@coment');