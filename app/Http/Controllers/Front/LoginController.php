<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Libraries\Wechat;

use Session;

class LoginController extends Controller
{
	/*账号绑定*/
    public function register(){
    	return view('admin.login');
    }

    /*进行发送手机验证码*/
    public function phoneCode(Request $request)
    {
    	/**
    	* @see post请求
    	* @param 不需要参数
    	*/
    	// $phoneCode = ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    	$phoneCode = 8888;
    	Session::put('phoneCode');
    	return response()->json(true);
    	/**
    	* 返回true，发送验证码成功，否则发送失败
    	*/
    }

    /*检验当前用户的验证码是否正确*/
    public function checkPhoneCode(Request $request)
    {
    	/** 
    	* @author 张贤健
    	* @see post请求
    	* @param phoneCode四位数验证码
    	* @return   0				正确
    	*			1000			验证码错误
    	*			1001			验证码不合法
    	*			1002			验证码已失效
    	*
    	*/
    	$postCode = $request->input('phoneCode');
    	$result = preg_match('/^\d{4}$/', $postCode);
    	if (!$result) {
    		return response()->json(['errcode'=>1001,'reason'=>'验证码不合法']);
    	}
    	if (Session::get('phoneCode')) {
    		if (Session::get('phoneCode') == $postCode) {
	    		Session::forget('phoneCode');
	    		Session::put('phoneCodeOK', true);
	    		return response()->json(['errcode'=>0,'reason'=>'验证码正确']);
	    	} else {
	    		return response()->json(['errcode'=>1000,'reason'=>'验证码错误']);
	    	}
    	} else {
    		return response()->json(['errcode'=>1002,'reason'=>'验证码失效']);
    	}
    }
}
