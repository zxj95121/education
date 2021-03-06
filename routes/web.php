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
/*微信支付回调  */
Route::any('/wxpay/notify','WeixinController@notify');
/*otherClass支付回调*/
Route::any('/wxpay/notifyOtherClass','WeixinController@otherClassNotify');
/*半价购课支付回调*/
Route::any('/wxpay/notifyHalfBuy','WeixinController@notifyHalfBuy');

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
    /*退出登陆*/
    $router->post('/logout', 'HomeController@logout');
        /*申请后台管理员*/
    $router->get('/applyAdmin', 'HomeController@applyAdmin');
    $router->get('/adminApply', 'HomeController@adminApply');
    $router->post('/apply/phoneCode', 'HomeController@phoneCode');
    $router->post('/apply/submit', 'HomeController@submit');
});

/*管理后台组*/
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin','domainAdmin']], function ($router) {
    $router->get('/dashboard','HomeController@index');

    /*ajax请求权限*/
    $router->post('/getPower', 'PowerController@getPower');
    /*登录部分*/
    $router->get('/login','HomeController@login');
    /*获取后台公共部分详情*/
    $router->post('/getAdminBasic', 'DashBoardController@getAdminBasic');

    /*用户管理部分*/
    $router->get('/managerList', 'ManagerController@managerList');
    $router->get('/managerReview', 'ManagerController@managerReview');
    $router->post('/reviewOperate', 'ManagerController@reviewOperate');
    $router->post('/managerRemove', 'ManagerController@managerRemove');
    $router->post('/manage/setPower', 'ManagerController@setPower');/*设置管理权限*/
    $router->post('/managerOpen', 'ManagerController@managerOpen');

    $router->post('/manage/deleteTeacher', 'ManagerController@deleteTeacher');
    $router->post('/manage/deleteParent', 'ManagerController@deleteParent');

    $router->get('/parentInfo', 'ParentManageController@parentInfo');/*parentManage控制器*/
    $router->post('/parent/addTicket', 'ParentManageController@addTicket');/*parentManage控制器*/
    $router->post('/parent/getVoucherRecord', 'ParentManageController@getVoucherRecord');/*parentManage控制器*/
    $router->post('/parent/dealVoucherRecord', 'ParentManageController@dealVoucherRecord');/*parentManage控制器*/
    $router->post('/parent/addPostPaty', 'ParentManageController@addPaty');/*parentManage控制器*/
    $router->post('/parent/getPatyRecord', 'ParentManageController@getPatyRecord');/*parentManage控制器*/
    $router->post('/parent/dealPatyRecord', 'ParentManageController@dealPatyRecord');/*parentManage控制器*/

    $router->get('/teacherInfo', 'ManagerController@teacherInfo');
    $router->post('/expect','ManagerController@expect');//教学社区
    
    $router->get('/share', 'ManagerController@share');
    $router->post('/share/getRecords', 'ManagerController@getRecords');
    $router->post('/share/confirmRecord', 'ManagerController@confirmRecord');/*确认某个半价购课订单*/
    
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

    /*其他简单设置*/
    $router->get('/otherSetting', 'Setting\OtherSettingController@index');
    $router->post('/otherSetting/modifyPrice', 'Setting\OtherSettingController@modifyPrice');

  	/**
  	 * 双师classOne*/
  	$router->get('/doubleTeacher','Teacher\DoubleTeacherController@doubleTeacher');//列表
  	$router->get('/teacherone/add','Teacher\DoubleTeacherController@oneAdd');//添加
  	$router->post('/teacherone/add_post','Teacher\DoubleTeacherController@oneAdd_post');
  	$router->get('/teacherone/edit','Teacher\DoubleTeacherController@oneEdit');//修改
  	$router->post('/teacherone/edit_post','Teacher\DoubleTeacherController@oneEdit_post');
  	$router->get('/teacherone/delete','Teacher\DoubleTeacherController@oneDelete');
    $router->get('/teacherone/hide','Teacher\DoubleTeacherController@oneHide');
  	$router->post('/teacherone/halfBuy','Teacher\DoubleTeacherController@halfBuy');/*设置半价课*/
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
    $router->post('/classPrice/getTeacherPrice', 'Teacher\ClassPriceController@getTeacherPrice');

    /*双师class课程设置*/
    $router->get('/setClassTime', 'Teacher\ClassTimeController@setClassTime');
    $router->post('/setClassTime/newTime', 'Teacher\ClassTimeController@newTime');
    $router->post('/setClassTime/editTime', 'Teacher\ClassTimeController@editTime');
    $router->post('/setClassTime/deleteTime', 'Teacher\ClassTimeController@deleteTime');

    /*双师class课程进度管理*/
    $router->get('/classProgress', 'Teacher\ProgressController@index');
    $router->post('/classProgress/search', 'Teacher\ProgressController@search');
    $router->post('/classProgress/getClass', 'Teacher\ProgressController@getClass');/*得到这个订单的所有课程*/
    $router->post('/classProgress/setDetailProgerss', 'Teacher\ProgressController@setDetailProgerss');/*设置新的课程进度*/

    /*双师class订单管理*/
    $router->get('/eclassOrderList', 'EclassOrderController@list');
    $router->post('/eclassOrderList/confirmOK', 'EclassOrderController@confirmOK');
    $router->post('/eclassOrderList/confirmXX', 'EclassOrderController@confirmXX');//驳回审核


    // halfBuy半价购课
    // $router->get('/halfBuy', 'HalfBuyController@halfBuy');

    /*免费试听课  */
    $router->get('/classFree/notice', 'ClassFreeController@notice');
    $router->post('/classFree/setActiveTime/inspect', 'ClassFreeController@setActiveTimeInspect');
    $router->post('/classFree/setActiveTime/post', 'ClassFreeController@setActiveTimePost');
    $router->post('/classFree/notice_post', 'ClassFreeController@noticePost');
    $router->post('/classFree/complete_post', 'ClassFreeController@completePost');
    
    /*退款*/
    $router->any('/tuikuan', 'EclassOrderController@tuikuan');
    /*查订单用户的信息*/
    $router->post('/classOrder/useDetail', 'EclassOrderController@useDetail');
    $router->post('/classOrder/useDetails', 'EclassOrderController@useDetails');
    $router->post('/classOrder/keAdd', 'EclassOrderController@keAdd');//给订单分配新的课时
    $router->post('/classOrder/deleteKeshi', 'EclassOrderController@deleteKeshi');//给订单分配新的课时

    /*双师class大订单*/
    $router->get('/eclassBigOrderList', 'EclassBigOrderController@list');
    $router->post('/eclassBigOrderList/confirmXX', 'EclassBigOrderController@confirmXX');/*驳回订单*/
    $router->post('/eclassBigOrderList/confirmOK', 'EclassBigOrderController@confirmOK');/*驳回订单*/
    $router->post('/eclassBigOrderList/getOrderDetail', 'EclassBigOrderController@getOrderDetail');/*驳回订单*/
    /*获取订单标准价*/
    $router->post('/getOrderStandardPrice', 'EclassBigOrderController@getOrderStandardPrice');/**/
    $router->post('/editECPrice', 'EclassBigOrderController@editECPrice');/**/
    // $router->post('/editECPrice2', 'EclassBigOrderController@editECPrice2');/**/

    /*其他class管理*/
    $router->get('/otherClass/add', 'OtherClass\OtherClassAddController@add');
    $router->post('/otherClass/add/addPost', 'OtherClass\OtherClassAddController@addPost');
    $router->post('/otherClass/add/editPost', 'OtherClass\OtherClassAddController@editPost');
    $router->get('/otherClass/add/setShow', 'OtherClass\OtherClassAddController@setShow');
    $router->post('/otherClass/add/setShowPost', 'OtherClass\OtherClassAddController@setShowPost');
    $router->post('/otherClass/add/delete', 'OtherClass\OtherClassAddController@delete');//delete套餐
    /*修改价格*/
    $router->post('/otherClass/getStandardPrice', 'OtherClass\OtherClassAddController@getStandardPrice');
    $router->post('/otherClass/editECPrice', 'OtherClass\OtherClassAddController@editECPrice');

    $router->get('/otherClass/orderList', 'OtherClass\OtherClassAddController@orderList');//

    $router->get('/otherClass/discount', 'OtherClass\DiscountController@index');
    $router->get('/otherClass/discount/add', 'OtherClass\DiscountController@add');
    $router->post('/otherClass/discount/add_post', 'OtherClass\DiscountController@add_post');
    $router->get('/otherClass/discount/edit', 'OtherClass\DiscountController@edit');
    $router->post('/otherClass/discount/edit_post', 'OtherClass\DiscountController@edit_post');
    $router->get('/otherClass/discount/delete', 'OtherClass\DiscountController@delete');
    /*待请求审核*/
      /*学校审核*/
    $router->get('/applySchool', 'Review\SchoolController@applySchool');
    $router->post('/applySchool/failed', 'Review\SchoolController@failed');/*驳回申请*/
    $router->post('/applySchool/success', 'Review\SchoolController@success');/*驳回申请*/
      /*爱好申请*/
    $router->get('/applyHobby', 'Review\HobbyController@applyHobby');
    $router->post('/applyHobby/failed', 'Review\HobbyController@failed');/*驳回申请*/
    $router->post('/applyHobby/success', 'Review\HobbyController@success');/*驳回申请*/

    /*订单短信  */
	$router->get('/classMessage', 'Setting\MessageController@index');
	$router->post('/classMessage/add', 'Setting\MessageController@add');
	$router->post('/classMessage/edit', 'Setting\MessageController@edit');
	$router->post('/classMessage/delete' ,'Setting\MessageController@delete');
    /*用户交流反馈*/

      /*用户沟通*/
    $router->get('/chatShow', 'ChatController@chatShow');
    $router->get('/chatting', 'ChatController@chatting');
    $router->post('/chatting/getPrevMessage', 'ChatController@getPrevMessage');

    /*用户加辰币*/
    $router->get('/coin', 'CoinController@coin');/*加辰币首页*/

    /*账单流水*/
    $router->get('/bill', 'BillController@bill');

    /*其他信息记录*/
    $router->get('/modifyPriceRecord', 'MessageRecordController@modifyPrice');
});


/*----------------------------------------------------------------*/



/*管理后台组*/
Route::group(['prefix' => 'wechat','namespace' => 'Wechat','middleware' => ['admin','domainAdmin']], function ($router) {
    $router->get('/autoMenu','Deal\AutoMenu\AutoMenuController@index');
});

/*-----------------------------------------------------------------*/


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
    /*/parent/myClassOrder*/
  $router->get('/parent/myClassOrder', 'Parent\MyClassOrderController@index');
  $router->post('/parent/getOrderDetail', 'Parent\MyClassOrderController@getOrderDetail');
  $router->post('/parent/deleteOrderDetail', 'Parent\MyClassOrderController@deleteOrderDetail');
  $router->post('/parent/deleteOrderDetail2', 'Parent\MyClassOrderController@deleteOrderDetail2');

    $router->get('/parent/mySchedule/oauth', 'Parent\MyScheduleController@oauth');
      /*myVoucher*/
    $router->get('/parent/myVoucher/oauth', 'Parent\MyVoucherController@oauth');

    /*立即使用中途调整*/
    $router->get('/use_right_away', 'Parent\MyVoucherController@use');

    /*半价购课路由哦*/
    $router->get('/halfBuy', 'HalfBuyController@halfBuy');

    /*-------------------------------------*/
	
	$router->get('/parent/myClassOrder/details', 'Parent\MyClassOrderController@details');

  /*我的加辰币*/
  $router->get('/coin', 'Weixin\CoinController@coin');
  $router->get('/coin/oauth', 'Weixin\CoinController@oauth');/*我的加辰币网页授权*/
  $router->post('/coin/convert', 'Weixin\CoinController@convert');


	/*微信分享  */
	$router->get('/share/oauth', 'Weixin\ShareController@oauth');
  $router->get('/share', 'Weixin\ShareController@index');
  $router->get('/share/halfBuyOrder', 'Weixin\ShareController@halfBuyOrder');
  $router->post('/share/makeOrder', 'Weixin\ShareController@makeOrder');
	$router->get('/share/payOrder', 'Weixin\ShareController@payOrder');


  $router->get('/parent/parentChat/oauth', 'Parent\ChatController@oauth');
    /*parent客服沟通模块*/
  $router->get('/parent/parentChat', 'Parent\ChatController@home');
  $router->post('/chatting/getPrevMessage', 'Parent\ChatController@getPrevMessage');

	/*抢课  */
	$router->get('/grab/oauth', 'Weixin\GrabController@oauth');
	$router->get('/grab', 'Weixin\GrabController@index');
	$router->post('/grab/join', 'Weixin\GrabController@join');
	$router->post('/grab/countdown', 'Weixin\GrabController@countdown');
	
  /*class套餐前端展示*/
  $router->get('/classPackage', 'ClassPackageController@index');
  $router->get('/classPackage/newOrder/oauth', 'ClassPackageController@newOrderOauth');
	
	/*修改手机号  */
  $router->post('/phoneCode', 'TestingPhoneController@phoneCode');
  $router->post('/savePhone', 'TestingPhoneController@save_phone');
  $router->post('/phoneCheck', 'TestingPhoneController@phoneCheck');
  
  /*免费试听课  */
  $router->get('/classFree', 'Weixin\ClassFreeController@index');
  $router->get('/classFree/oauth', 'Weixin\ClassFreeController@oauth');
  $router->post('/classFree/add_post', 'Weixin\ClassFreeController@add_post');
  $router->post('/classFree/add_time', 'Weixin\ClassFreeController@add_time');
  $router->post('/classFree/add_time_post', 'Weixin\ClassFreeController@add_time_post');
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
    /*ajax购物车*/
    $router->post('/cartStorage', 'HomeController@cartStorage');
    $router->post('/getCartStorage', 'HomeController@getCartStorage');

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
  $router->post('/child/post', 'Parent\ChildController@addPost');
  $router->get('/child/editChild', 'Parent\ChildController@editChild');
  $router->post('/child/editPost', 'Parent\ChildController@editPost');
  $router->post('/child/delete', 'Parent\ChildController@deleteChild');
  /*parent模块，购买相关*/
  $router->post('/parent/checkMessage', 'Parent\PayClassController@checkMessage');
  $router->post('/parent/getChild', 'Parent\PayClassController@getChild');
  

  $router->get('/parent/mySchedule', 'Parent\MyScheduleController@orderList');
  $router->get('/parent/mySchedule/schedule/{id}', 'Parent\MyScheduleController@schedule');
  $router->post('/parent/mySchedule/getSchedule', 'Parent\MyScheduleController@getSchedule');

  /*myVoucher*/
  $router->get('/parent/myVoucher', 'Parent\MyVoucherController@index');
   
  
  /*名师定制*/
  $router->post('/tmade/submit', 'Parent\TmadeParentController@submit');//名师定制提交
  $router->post('/tmade/session', 'Parent\TmadeParentController@session');//名师定制session
  
  /*新订单*/
  $router->post('/parent/newEclassOrder', 'Parent\PayClassController@newEclassOrder');
  $router->get('/parent/newEclassOrder2','Parent\PayClassController@newEclassOrder2');
  $router->get('/parent/showPayEclassOrder','Parent\PayClassController@showPayEclassOrder');
  /*设置上课时间期望*/
  $router->get('/setClassTime', 'Parent\ClassTimeController@setClassTime');
  $router->post('/setClassTime/selectType', 'Parent\ClassTimeController@selectType');/*ajax请求是否加辰自动排课*/
  $router->post('/setClassTime/selectTime', 'Parent\ClassTimeController@selectTime');/*ajax请求选课*/
  $router->post('/setClassTime/cancleTime', 'Parent\ClassTimeController@cancleTime');/*ajax取消选择*/
  $router->post('/setClassTime/setAll', 'Parent\ClassTimeController@setAll');/*ajax设置所有*/


  /*class套餐前端展示*/
  $router->get('/classPackage/newOrder', 'ClassPackageController@newOrder');
  $router->get('/classPackage/newOrder2', 'ClassPackageController@newOrder2');
  $router->get('/classPackage/list', 'ClassPackageController@list');
  $router->get('/classPackage/payShow', 'ClassPackageController@payShow');
  // $router->post('/classPackage/newOrderPost', 'ClassPackageController@newOrderPost');
  // $router->get('/classPackage/newOrder2', 'ClassPackageController@newOrder2');/*2读取session内的数据*/
});

/*-------------*/

/*微信用户展示（需要系统身份的路由放这里）*/
Route::group(['prefix' => 'front','namespace' => 'Front','middleware'=>['front','domainAdmin']], function ($router) {
});
