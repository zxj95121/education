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
	 return view('error403');
});

Route::get('/html/{name}',function($name){
    return redirect('/html?res='.$name);
});
Route::get('/html', 'HtmlController@index');

Route::any('/wxpay/notify','WeixinController@notify');
//<!------------Wechat文件夹----------------------->
/*微信接入主程序*/
Route::any('/wechatIndex', 'Wechat\WechatIndexController@index');
Route::any('/wechatIndexCatchon', 'Wechat\WechatIndexCatchonController@index');

Route::any('/weixin/notify','HtmlController@notify');
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

    $router->get('/parentInfo', 'ManagerController@parentInfo');
    $router->get('/teacherInfo', 'ManagerController@teacherInfo');
    $router->post('/expect','ManagerController@expect');//教学社区
    
    
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
  	
  	$router->get('/schoolManage', 'Setting\SchoolController@schoolManage'); //学校管理
  	$router->post('/schoolone/add','Setting\SchoolController@schooloneAdd');//学科分类添加
  	$router->post('/schoolone/edit','Setting\SchoolController@schooloneEdit');//学科分类修改
  	$router->post('/schoolone/delete','Setting\SchoolController@schooloneDelete');//学科分类删除
  	$router->post('/schooltwo/add','Setting\SchoolController@schooltwoAdd');//学科添加
  	$router->post('/schooltwo/edit','Setting\SchoolController@schooltwoEdit');//学科修改
  	$router->post('/schooltwo/delete','Setting\SchoolController@schooltwoDelete');//学科删除

    /*爱好特长设置*/
    $router->get('/hobbyManage', 'Setting\HobbyController@hobbyManage');//爱好管理列表页
    $router->post('/hobbyManage/newHobby', 'Setting\HobbyController@newHobby');//爱好新增
    $router->post('/hobbyManage/hideHobby', 'Setting\HobbyController@hideHobby');//爱好新增

    /*班级设置*/
    $router->get('/classSetting', 'Setting\ClassSettingController@index');
    $router->post('/classSetting/add', 'Setting\ClassSettingController@add');
    $router->post('/classSetting/edit', 'Setting\ClassSettingController@edit');
    $router->post('/classSetting/delete', 'Setting\ClassSettingController@delete');

    /*节假日设置*/
    $router->get('/festivalSetting', 'Setting\FestivalSettingController@index');
    $router->post('/festivalSetting/add', 'Setting\FestivalSettingController@add');
    $router->post('/festivalSetting/change', 'Setting\FestivalSettingController@change');

  	/**
  	 * 双师classOne*/
  	$router->get('/doubleTeacher','Teacher\DoubleTeacherController@doubleTeacher');//列表
  	$router->get('/teacherone/add','Teacher\DoubleTeacherController@oneAdd');//添加
  	$router->post('/teacherone/add_post','Teacher\DoubleTeacherController@oneAdd_post');
  	$router->get('/teacherone/edit','Teacher\DoubleTeacherController@oneEdit');//修改
  	$router->post('/teacherone/edit_post','Teacher\DoubleTeacherController@oneEdit_post');
  	$router->get('/teacherone/delete','Teacher\DoubleTeacherController@oneDelete');
  	$router->get('/teacherone/hide','Teacher\DoubleTeacherController@oneHide');
  	/**
  	 * 双师classTwo  
  	 * */
  	$router->get('/teachertwo','Teacher\DoubleTeacherController@teacherTwo');
  	$router->get('/teachertwo/add','Teacher\DoubleTeacherController@twoAdd');
  	$router->post('/teachertwo/add_post','Teacher\DoubleTeacherController@twoAdd_post');
  	$router->get('/teachertwo/edit','Teacher\DoubleTeacherController@twoEdit');
  	$router->post('/teachertwo/edit_post','Teacher\DoubleTeacherController@twoEdit_post');
  	$router->get('/teachertwo/delete','Teacher\DoubleTeacherController@twoDelete');
  	$router->get('/teachertwo/hide','Teacher\DoubleTeacherController@twoHide');
  	/**
  	 * 双师classThree
  	 * */
  	$router->get('/teacherthree','Teacher\DoubleTeacherController@teacherThree');
  	$router->get('/teacherthree/add','Teacher\DoubleTeacherController@threeAdd');
  	$router->post('/teacherthree/add_post','Teacher\DoubleTeacherController@threeAdd_post');
  	$router->get('/teacherthree/edit','Teacher\DoubleTeacherController@threeEdit');
  	$router->post('/teacherthree/edit_post','Teacher\DoubleTeacherController@threeEdit_post');
  	$router->get('/teacherthree/delete','Teacher\DoubleTeacherController@threeDelete');
  	$router->get('/teacherthree/hide','Teacher\DoubleTeacherController@threeHide');
  	/**
  	 * 双师classFour
  	 * */
  	$router->get('/teacherfour','Teacher\DoubleTeacherController@teacherFour');
  	$router->get('/teacherfour/add','Teacher\DoubleTeacherController@fourAdd');
  	$router->post('/teacherfour/add_post','Teacher\DoubleTeacherController@fourAdd_post');
  	$router->get('/teacherfour/edit','Teacher\DoubleTeacherController@fourEdit');
  	$router->post('/teacherfour/edit_post','Teacher\DoubleTeacherController@fourEdit_post');
  	$router->get('/teacherfour/delete','Teacher\DoubleTeacherController@fourDelete');
  	$router->get('/teacherfour/hide','Teacher\DoubleTeacherController@fourHide');

    /*双师class价格课程设置*/
    $router->get('/classPrice', 'Teacher\ClassPriceController@classPrice');
    $router->post('/classPrice/newPrice', 'Teacher\ClassPriceController@newPrice');

    /*双师class课程设置*/
    $router->get('/setClassTime', 'Teacher\ClassTimeController@setClassTime');
    $router->post('/setClassTime/newTime', 'Teacher\ClassTimeController@newTime');
    $router->post('/setClassTime/editTime', 'Teacher\ClassTimeController@editTime');
    $router->post('/setClassTime/deleteTime', 'Teacher\ClassTimeController@deleteTime');

    $router->get('/classProgress', 'Teacher\ProgressController@index');

    /*双师class订单管理*/
    $router->get('/eclassOrderList', 'EclassOrderController@list');
    $router->post('/eclassOrderList/confirmOK', 'EclassOrderController@confirmOK');
    $router->post('/eclassOrderList/confirmXX', 'EclassOrderController@confirmXX');//驳回审核

    /*退款*/
    $router->any('/tuikuan', 'EclassOrderController@tuikuan');
    /*查订单用户的信息*/
    $router->post('/classOrder/useDetail', 'EclassOrderController@useDetail');
    $router->post('/classOrder/useDetails', 'EclassOrderController@useDetails');
    $router->post('/classOrder/keAdd', 'EclassOrderController@keAdd');//给订单分配新的课时
    $router->post('/classOrder/deleteKeshi', 'EclassOrderController@deleteKeshi');//给订单分配新的课时


    /*待请求审核*/
      /*学校审核*/
    $router->get('/applySchool', 'Review\SchoolController@applySchool');
    $router->post('/applySchool/failed', 'Review\SchoolController@failed');/*驳回申请*/
    $router->post('/applySchool/success', 'Review\SchoolController@success');/*驳回申请*/
      /*爱好申请*/
    $router->get('/applyHobby', 'Review\HobbyController@applyHobby');
    $router->post('/applyHobby/failed', 'Review\HobbyController@failed');/*驳回申请*/
    $router->post('/applyHobby/success', 'Review\HobbyController@success');/*驳回申请*/

    /*账单流水*/
    $router->get('/bill', 'BillController@bill');
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
    $router->get('/parent/myClassOrder/oauth', 'Parent\MyClassOrderController@oauth');
	
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
    /*信息跳转*/
    $router->get('/selectTeacherType','UserInfoController@selectTeacherType');
    $router->get('/selectParentType','UserInfoController@selectParentType');
        /*teacher信息保存*/
    $router->post('/tsave_headimg', 'UserInfoController@t_headimg');
    $router->post('/tsave_nickname', 'UserInfoController@t_nickname');
    $router->post('/tsave_name', 'UserInfoController@t_name');
    $router->post('/tsave_sex', 'UserInfoController@t_sex');
    $router->post('/tsave_birth', 'UserInfoController@t_birth');
    $router->post('/tsave_money', 'UserInfoController@t_money');
    $router->post('/tsave_status', 'UserInfoController@t_status');
    $router->post('/tsave_school', 'UserInfoController@t_school');
    $router->post('/tsave_community', 'UserInfoController@t_community');
    $router->post('/tsave_hobby', 'UserInfoController@t_hobby');
    $router->post('/tsave_teachYear', 'UserInfoController@t_teachYear');
    $router->post('/tsave_project', 'UserInfoController@t_project');

      /*parent*/
    $router->post('/tsave_place', 'UserInfoController@t_place');
    $router->post('/tsave_surname', 'UserInfoController@t_surname');

      /*获取社区信息*/
    $router->post('/getCommunity', 'UserInfoController@getCommunity');
    /*申请添加学校*/
    $router->post('/addNewSchool', 'UserInfoController@addNewSchool');
    /*申请添加爱好特长*/
    $router->post('/addNewHobby', 'UserInfoController@addNewHobby');

	/*双师class  */
    $router->get('/twoClass','TwoClassController@index');
	$router->get('/twoClasstwo','TwoClassController@two');
	$router->get('/twoClassthree','TwoClassController@three');
	$router->get('/twoClassfour','TwoClassController@four');
  $router->post('/twoClass/getpid', 'TwoClassController@getpid');
	/*双师class后退  */
	$router->get('/twoClassback','TwoClassController@back');


  /*parent模块，child相关*/
  $router->get('/parent/addChild', 'Parent\ChildController@addChild');
  /*parent模块，购买相关*/
  $router->post('/parent/checkMessage', 'Parent\PayClassController@checkMessage');
  /*/parent/myClassOrder*/
  $router->get('/parent/myClassOrder', 'Parent\MyClassOrderController@index');

      /*新订单*/
  $router->get('/parent/newEclassOrder', 'Parent\PayClassController@newEclassOrder');
  $router->get('/parent/newEclassOrder2','Parent\PayClassController@newEclassOrder2');
  $router->get('/parent/showPayEclassOrder','Parent\PayClassController@showPayEclassOrder');
  $router->get('/parent/weixinpay','Parent\PayClassController@weixinpay');
  /*设置上课时间期望*/
  $router->get('/setClassTime', 'Parent\ClassTimeController@setClassTime');
  $router->post('/setClassTime/selectType', 'Parent\ClassTimeController@selectType');/*ajax请求是否加辰自动排课*/
  $router->post('/setClassTime/selectTime', 'Parent\ClassTimeController@selectTime');/*ajax请求选课*/
  $router->post('/setClassTime/cancleTime', 'Parent\ClassTimeController@cancleTime');/*ajax取消选择*/
  $router->post('/setClassTime/setAll', 'Parent\ClassTimeController@setAll');/*ajax设置所有*/
});

/*-------------*/

/*微信用户展示（需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware'=>['front','domainAdmin']], function ($router) {
});
