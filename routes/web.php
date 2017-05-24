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


Route::get('/', function () {
});
Route::get('/aaa','SendMessageController@index');
Route::any('/wechatIndex','Wechat\WechatIndexController@index');
// Route::->middleware(CheckAdmin::handle());
// Route::get('/admin/login','Admin\HomeController@login');

Route::group(['middleware' => ['admin']], function ($router) {
    $router->get('/admin/dashboard','Admin\HomeController@index');
    $router->get('/admin/login','Admin\HomeController@login');;
});
