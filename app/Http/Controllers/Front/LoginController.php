<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\TeacherInfo;
use App\Models\ParentInfo;

use Session;
use Wechat;
use Hash;
use Identity;

class LoginController extends Controller
{
	/*账号绑定*/
    public function register(){
        $redi = Session::get('openid');
        dd($redi);
        $res= Identity::check();
        dd($res);
        if (!Identity::check())
            return redirect('/front/error_403');
        $openid = Session::get('openid');
        $access_token = Session::get('oauth_access_token');

        /*获取用户个人详细信息*/
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.
            $access_token.'&openid='.
            $openid.'&lang=zh_CN';
        $userinfo = Wechat::curl($url);
        if (array_key_exists('openid', $userinfo)) {
            /*成功获取用户信息*/
            $nickname = $userinfo['nickname'];
            $headimgurl = $userinfo['headimgurl'];
            Session::forget('openid');
            Session::forget('access_token');
        } else {
            return redirect('/front/error_403');
        }
    	return view('front.views.index',['openid'=>$openid,'nickname'=>$nickname,'headimgurl'=>$headimgurl]);
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
        * @return errcode 1     手机号格式不正确
        * @return errcode 2     手机号已注册
        * @return errcode 1     发送成功
    	*/
        $phone = $request->input('phone');

        $result_phone = preg_match('/^1\d{10}$/', $phone);
        if (!$result_phone) {
            return response()->json(['errcode'=>1,'reason'=>'手机号格式不正确']);
        }

        /*查该手机是否已经绑定过*/
        $count_parent = ParentInfo::where('phone', $phone)
            ->count();
        $count_teacher = TeacherInfo::where('phone', $phone)
            ->count();
        if ($count_teacher != 0 || $count_parent != 0) {
            return response()->json(['errcode'=>2,'reason'=>'手机号已经注册']);
        }
    	// $phoneCode = ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    	$phoneCode = 8888;
        Session::put('phone', $phone);
    	Session::put('phoneCode', $phoneCode);
    	return response()->json(['errcode'=>0,'phoneCode'=>$phoneCode]);
    	/**
    	* 返回true，发送验证码成功，否则发送失败
    	*/
    }

    /*进行新增用户信息*/
    private function registerSubmit(Request $request)
    {
        /**
        * @see post请求
        * @param openid    openid
        * @param nickname  nickname
        * @param headimgurl headimgurl
        * @param phone     手机号码
        * @param password1 密码1
        * @param password2 密码2
        * @param role      身份（1或2,1为学生家长，2为辅导老师）
        * @return errcode 0     成功
                          1     参数不合法
                          2     密码不一致
                          3     手机号验证失败
        */

        $phone = $request->input('phone');
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');
        $role = $request->input('role');
        $openid = $request->input('openid');
        $nickname = $request->input('nickname');
        $headimgurl = $request->input('headimgurl');

        $result_phone = preg_match('/^1\d{10}$/', $phone);
        $result_password1 = preg_match('/^[a-zA-Z0-9_]{6,18}$/', $password1);
        $result_password2 = preg_match('/^[a-zA-Z0-9_]{6,18}$/', $password1);
        $result_role = preg_match('/^[1-2]{1}$/', $role);

        if (!$result_role || !$result_password2 || !$result_password1 || !$result_phone) {
            return response()->json(['errcode'=>1,'reason'=>'参数不合法']);
        }
        if ($password1 != $password2) {
            return response()->json(['errcode'=>2,'reason'=>'密码不一致']);
        }
        if ($phone != Session::get('phone')) {
            return response()->json(['errcode'=>3,'reason'=>'手机号或验证码验证失败。']);
        }

        if ($role == 1) {
            $flight = new ParentInfo();
        } else {
            $flight = new TeacherInfo();
        }
        $flight->openid = $openid;
        $flight->phone = $phone;
        $flight->name = $nickname;
        $flight->password = Hash::make($password1);
        $flight->headimgurl = $headimgurl;
        $flight->save();

        Session::forget('phoneCode');
        Session::forget('phone');

        return response()->json(['errcode'=>0]);
    }

    // /*进行判断图片验证码是否正确,正确则自动发送短信验证码*/
    // public function checkImageNumber(Request $request)
    // {
    //     /**
    //     * @see post
    //     * @param imageNumber图片验证码
    //     * @param phone手机号码
    //     * @return errcode为0才成功
    //     * @return 10001 参数不合法
    //     */
    //     $imageNumber = $request->input('imageNumber');
    //     $phone = $request->input('phone');
    //     $result = preg_match('/^\d{4}$/', $phone);
    //     $result_phone = preg_match('/^1[34578]\d{9}$/', $phone);

    //     if (!$result || !$result_phone) {
    //         return response()->json(['errcode'=>1001,'reason'=>'参数不合法']);
    //     }

    //     if($imageNumber == Session::get('number_image')){
    //         $result = $this->phoneCode($phone);
    //         if ($result) {
    //             return response()->json(['errcode'=>0,'reason'=>'验证码发送成功!']);
    //         } else {
    //             return response()->json(['errcode'=>1003,'reason'=>'验证码发送失败']);
    //         }
    //     } else {
    //         return response()->json(['errcode'=>1000,'reason'=>'验证码错误!']);
    //     }
    // }

    // /*进行注册确认*/
    // public function confirm(Request $request)
    // {
    // 	/** 
    // 	* @author 张贤健
    // 	* @see post请求
    // 	* @param phoneCode 四位数验证码
    //     * @param phone 手机号码

    // 	* @return   0				正确
    // 	*			1000			验证码错误
    // 	*			1001			存在参数不合法
    // 	*			1002			验证码已失效
    // 	*/
    // 	$postCode = $request->input('phoneCode');
    //     $phone = $request->input('phone');
    //     $result_postCode = preg_match('/^\d{4}$/', $postCode);
    // 	$result_phone = preg_match('/^1[34578]\d{9}$/', $phone);
    // 	if (!$result_postCode || !$result_phone) {
    // 		return response()->json(['errcode'=>1001,'reason'=>'参数不合法']);
    // 	}
    // 	if (Session::get('phoneCode')) {
    // 		if (Session::get('phoneCode') == $postCode) {
    //             if (Session::get('phoneCode') == Session::get('phone')) {
    //                 Session::forget('phoneCode');
    // 	    		Session::forget('phone');
    // 	    		return response()->json(['errcode'=>0,'reason'=>'验证码正确']);
    //             } else {
    //                 return response()->json(['errcode'=>1002,'reason'=>'验证码失效']);
    //             }
	   //  	} else {
	   //  		return response()->json(['errcode'=>1000,'reason'=>'验证码错误']);
	   //  	}
    // 	} else {
    // 		return response()->json(['errcode'=>1002,'reason'=>'验证码失效']);
    // 	}
    // }
}
