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
Route::get('auth/login', [
        'middleware' => 'auth',
        'uses' => 'Auth\AuthController@getLogin'
]);

/* ログイン処理 */
Route::post('auth/login', [
        'middleware' => 'auth',
        'uses' => 'Auth\AuthController@postLogin'
]);

/* ログアウト */
Route::get('auth/logout', [
        'middleware' => 'auth',
        'uses' => 'Auth\AuthController@getLogout'
]);

/* ユーザー登録画面の表示 */
Route::get('auth/register', [
        'middleware' => 'auth',
        'uses' => 'Auth\AuthController@getRegister'
]);

/* ユーザー登録処理 */
Route::post('auth/register', [
        'middleware' => 'auth',
        'uses' => 'Auth\AuthController@postRegister'
]);

/* ??????? */
Route::auth();

/* ゲーム選択画面の表示 */
Route::get('/home', [
        'middleware' => 'auth',
        'uses' => 'HomeController@index'
]);

/* pokerスタート画面の表示 */
Route::get('/poker/start', [
        'middleware' => 'auth',
        'uses' => 'PokerController@start'
]);

/* カード選択画面の表示 */
Route::get('/poker/select', [
        'middleware' => 'auth',
        'uses' => 'PokerController@select'
]);

/* 勝敗判定画面の表示 */
Route::post('/poker/judge', [
        'middleware' => 'auth',
        'uses' => 'PokerController@judge'
]);

/* Ajaxのテスト */
Route::get('/start/ajax', [
        'middleware' => 'auth',
        'uses' => 'PokerController@getAjax'
]);