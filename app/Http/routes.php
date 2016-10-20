<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* ログイン画面の表示 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
/* ログイン処理 */
Route::post('auth/login', 'Auth\AuthController@postLogin');
/* ログアウト */
Route::get('auth/logout', 'Auth\AuthController@getLogout');
/* ユーザー登録画面の表示 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
/* ユーザー登録処理 */
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/poker/standby', 'PokerController@standby');
Route::get('/poker/playPoker', 'PokerController@playPoker');
