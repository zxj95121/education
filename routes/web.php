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
    $router->post('/apply/phoneCode', 'HomeController@phoneCode');
    $router->post('/apply/submit', 'HomeController@submit');
});

/*管理后台组*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin','domainAdmin']], function ($router) {
    $router->get('/dashboard','HomeController@index');
    /*登录部分*/
    $router->get('/login','HomeController@login');
    /*获取后台公共部分详情*/
    $router->post('/getAdminBasic', 'DashBoardController@getAdminBasic');

    /*用户管理部分*/
    $router->get('/managerList', 'ManagerController@managerList');
    $router->get('/managerReview', 'ManagerController@managerReview');
    $router->post('/reviewOperate', 'ManagerController@reviewOperate');
    $router->post('/managerRemove', 'ManagerController@managerRemove');
    $router->post('/managerOpen', 'ManagerController@managerOpen');

    $router->get('/parentReview', 'ManagerController@parentReview');//学生家长审核
    $router->get('/teacherReview', 'ManagerController@teacherReview');//教师审核
    
    /* 系统参数设置  */
    $router->get('/communityManage', 'Setting\CommunityController@communityManage'); //社区管理
    $router->post('/community/city/add', 'Setting\CommunityController@cityAdd');
    $router->post('/community/area/add', 'Setting\CommunityController@areaAdd');
    $router->post('/community/community/add', 'Setting\CommunityController@communityAdd');
    $router->post('/community/getAll', 'Setting\CommunityController@getAll');
    $router->post('/community/editName', 'Setting\CommunityController@editName');
    $router->post('/community/communityDelete', 'Setting\CommunityController@communityDelete');

    $router->get('/subjectManage', 'Setting\SubjectController@subjectManage'); //学科管理
  	$router->post('/subjectone/add','Setting\SubjectController@subjectoneAdd');//学科分类添加
  	$router->post('/subjectone/edit','Setting\SubjectController@subjectoneEdit');//学科分类修改
  	$router->post('/subjectone/delete','Setting\SubjectController@subjectoneDelete');//学科分类删除
  	$router->post('/subjecttwo/add','Setting\SubjectController@subjecttwoAdd');//学科添加
  	$router->post('/subjecttwo/edit','Setting\SubjectController@subjecttwoEdit');//学科修改
  	$router->post('/subjecttwo/delete','Setting\SubjectController@subjecttwoDelete');//学科删除
  	
});


/*----------------------------------------------------------------*/


/*用户端不需要微信身份的路由放这*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware' => ['domainAdmin']], function ($router) {
    /*验证码GD*/
    $router->get('/getNumberImage','ImageBuilderController@getNumberImage');

    $router->get('/home','HomeController@index');
    // $router->get('/homepage','HomeController@homepage');
    // oauth进行跳的路由
    $router->get('/register/oauth','LoginController@oauth');
    $router->get('/home/oauth', 'HomeController@homeOauth');

});

/*-------------*/

/*微信用户展示（需要微信但不需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware' => ['wechat','domainAdmin']], function ($router) {
    /*用户身份绑定*/
    $router->get('/register','LoginController@register');
    $router->post('/register/phoneCode','LoginController@phoneCode');
    $router->post('/register/registerSubmit','LoginController@registerSubmit');

    /*主页*/
    $router->get('/home', 'HomeController@home');

    /*补充信息页*/
    $router->get('/user_info_parent','UserInfoController@parent');
    $router->get('/user_info_teacher','UserInfoController@teacher');

        /*teacher信息保存*/
    $router->post('/tsave_headimg', 'UserInfoController@t_headimg');
    $router->post('/tsave_nickname', 'UserInfoController@t_nickname');
    $router->post('/tsave_name', 'UserInfoController@t_name');
    $router->post('/tsave_project', 'UserInfoController@t_project');
});

/*-------------*/

/*微信用户展示（需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware'=>['front','domainAdmin']], function ($router) {
});
