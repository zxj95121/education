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

/*前台错误指向地址*/
Route::get('/front/error_403',function(){
	echo '访问被禁止了';
});

/*微信接入主程序*/
Route::any('/wechatIndex','Wechat\WechatIndexController@index');

/*
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/

*/

/*管理后台组*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin']], function ($router) {
    $router->get('/dashboard','HomeController@index');
    $router->get('/login','HomeController@login');;
});

/*
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/

*/

/*微信用户展示（不需要身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front'], function ($router) {
	/*网页授权*/
    $router->get('/oauth','OauthController@index');
    /*验证码GD*/
    $router->get('/getNumberImage','ImageBuilderController@getNumberImage');

    $router->get('/home','HomeController@index');
    /*用户身份绑定*/
    $router->get('/register','LoginController@register');
});


/*微信用户展示（需要身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware'=>['front']], function ($router) {
    $router->get('/oauth2','OauthController@index2');
});
