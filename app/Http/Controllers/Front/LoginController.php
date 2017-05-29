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
    	return view('front.views.index');
    }

    /*进行网址跳转*/
    public function oauth()
    {
        return redirect(OauthController::getUrl(1));
    }

    /*进行发送手机验证码*/
    private function phoneCode($phone)
    {
    	/**
    	* @see post请求
    	* @param phone 手机号
    	*/
        $phone = $request->input('phone');
    	// $phoneCode = ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    	$phoneCode = 8888;
        Session::put('phone', $phone);
    	Session::put('phoneCode', $phoneCode);
    	return response()->json(true);
    	/**
    	* 返回true，发送验证码成功，否则发送失败
    	*/
    }

    /*进行判断图片验证码是否正确,正确则自动发送短信验证码*/
    public function checkImageNumber(Request $request)
    {
        /**
        * @see post
        * @param imageNumber图片验证码
        * @param phone手机号码
        * @return errcode为0才成功
        * @return 10001 参数不合法
        */
        $imageNumber = $request->input('imageNumber');
        $phone = $request->input('phone');
        $result = preg_match('/^\d{4}$/', $phone);
        $result_phone = preg_match('/^1[34578]\d{9}$/', $phone);

        if (!$result || !$result_phone) {
            return response()->json(['errcode'=>1001,'reason'=>'参数不合法']);
        }

        if($imageNumber == Session::get('number_image')){
            $result = $this->phoneCode($phone);
            if ($result) {
                return response()->json(['errcode'=>0,'reason'=>'验证码发送成功!']);
            } else {
                return response()->json(['errcode'=>1003,'reason'=>'验证码发送失败']);
            }
        } else {
            return response()->json(['errcode'=>1000,'reason'=>'验证码错误!']);
        }
    }

    /*进行注册确认*/
    public function confirm(Request $request)
    {
    	/** 
    	* @author 张贤健
    	* @see post请求
    	* @param phoneCode 四位数验证码
        * @param phone 手机号码

    	* @return   0				正确
    	*			1000			验证码错误
    	*			1001			存在参数不合法
    	*			1002			验证码已失效
    	*/
    	$postCode = $request->input('phoneCode');
        $phone = $request->input('phone');
        $result_postCode = preg_match('/^\d{4}$/', $postCode);
    	$result_phone = preg_match('/^1[34578]\d{9}$/', $phone);
    	if (!$result_postCode || !$result_phone) {
    		return response()->json(['errcode'=>1001,'reason'=>'参数不合法']);
    	}
    	if (Session::get('phoneCode')) {
    		if (Session::get('phoneCode') == $postCode) {
                if (Session::get('phoneCode') == Session::get('phone')) {
                    Session::forget('phoneCode');
    	    		Session::forget('phone');
    	    		return response()->json(['errcode'=>0,'reason'=>'验证码正确']);
                } else {
                    return response()->json(['errcode'=>1002,'reason'=>'验证码失效']);
                }
	    	} else {
	    		return response()->json(['errcode'=>1000,'reason'=>'验证码错误']);
	    	}
    	} else {
    		return response()->json(['errcode'=>1002,'reason'=>'验证码失效']);
    	}
    }
}
