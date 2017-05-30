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
    return redirect('/admin/dashboard');
});

/*前台错误指向地址*/
Route::get('/front/error_403',function(){
	echo '访问被禁止了';
});

Route::get('/html/{name}',function($name){
    return redirect('/html?res='.$name);
});
Route::get('/html', 'HtmlController@index');


//<!------------Wechat文件夹----------------------->
/*微信接入主程序*/
Route::any('/wechatIndex', 'Wechat\WechatIndexController@index');

/*微信网页授权*/
Route::get('/oauth/getCode', 'Wechat\OauthController@getCode');


/*----------------------------------------------------------------*/

/*管理后台组*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['domainAdmin']], function ($router) {
    /*登录部分*/
    $router->post('/login_scanok','HomeController@scanok');    
    $router->get('/home','HomeController@index');
    $router->get('/scanConfirm/oauth', 'HomeController@scanConfirmOauth');
    $router->get('/scanConfirm', 'HomeController@scanConfirm');
    $router->post('/scanOK', 'HomeController@scan_OK');
    $router->post('/passwordConfirm', 'HomeController@passwordConfirm');
        /*申请后台管理员*/
    $router->get('/applyAdmin', 'HomeController@applyAdmin');
    $router->get('/adminApply', 'HomeController@adminApply');
});

/*管理后台组*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin','domainAdmin']], function ($router) {
    $router->get('/dashboard','HomeController@index');
    /*登录部分*/
    $router->get('/login','HomeController@login');
});


/*----------------------------------------------------------------*/


/*用户端不需要微信身份的路由放这*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware' => ['domainFront']], function ($router) {
    /*验证码GD*/
    $router->get('/getNumberImage','ImageBuilderController@getNumberImage');

    $router->get('/home','HomeController@index');
    // $router->get('/homepage','HomeController@homepage');
    $router->get('/register/oauth','LoginController@oauth');

});

/*-------------*/

/*微信用户展示（需要微信但不需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware' => ['wechat','domainFront']], function ($router) {
    /*用户身份绑定*/
    $router->get('/register','LoginController@register');
    $router->get('/register/phoneCode','LoginController@phoneCode');
    $router->get('/register/registerSubmit','LoginController@registerSubmit');
});

/*-------------*/

/*微信用户展示（需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware'=>['front','domainFront']], function ($router) {
});
