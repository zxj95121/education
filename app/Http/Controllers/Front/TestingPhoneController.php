<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewUser;
use Session;
use Wechat;
class TestingPhoneController extends Controller
{
	public static function is_phone()
	{
		$openid = Session::get('openid');
		$newuserObj = NewUser::where('openid',$openid)->get();
		if (isset($newuserObj[0]) && !empty($newuserObj[0]->phone)) {
			return $newuserObj[0]->id;
		}else{
			return false;
		}
	}

	public function phoneCheck()
	{
		$openid = Session::get('openid');
		$newuserObj = NewUser::where('openid',$openid)->get();
		if (isset($newuserObj[0]) && !empty($newuserObj[0]->phone)) {
			return response()->json(['errcode'=>0]);
		}else{
			return response()->json(['errcode'=>1]);
		}
	}
	/*进行发送手机验证码*/
	public function phoneCode(Request $request)
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
		$count =  NewUser::where('phone', $phone)->count();
		if ($count != 0 ) {
			return response()->json(['errcode'=>2,'reason'=>'手机号已经注册']);
		}
		$phoneCode[] = ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
		$result = postPhoneCodeSms($phone, $phoneCode);
	
		Session::put('phone', $phone);
		Session::put('phoneCode', $phoneCode[0]);
	
		if ($result['result'] == '') {
			/*判断是否发送成功*/
			return response()->json(['errcode'=>0,'phoneCode'=>$phoneCode]);
		} else {
			return response()->json(['errcode'=>3,'reason'=>'验证码发送失败，请重试']);
		}
		/**
		 * 返回true，发送验证码成功，否则发送失败
		 */
	}
	public function save_phone(Request $request)
	{
		$phone = $request->input('phone');
		$phoneCode = $request->input('phoneCode');
		if ($phoneCode != Session::get('phoneCode')) {
			return response()->json(['errcode'=>2,'reason'=>'验证码错误']);
		}
		if ($phone != Session::get('phone')) {
			return response()->json(['errcode'=>3,'reason'=>'手机号错误。']);
		}
		$openid = Session::get('openid');
		$newuserObj = NewUser::where('openid',$openid)->get();
		if(!isset($newuserObj[0])){
			$access_token = Wechat::get_access_token();
			/*获取用户个人详细信息*/
			$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
			$userinfo = Wechat::curl($url);
			$newObj = new NewUser();
			$newObj->openid = $openid;
			$newObj->type = 0;
			$newObj->phone = $phone;
			$newObj->nickname = $userinfo['nickname']; 
			$newObj->headimg = $userinfo['headimgurl'];
			$newObj->uid = 0;
			$newObj->save();
		}else if(empty($newuserObj[0]->phone)){
			$newObj = NewUser::find($newuserObj[0]->id);
			$newObj->phone = $phone;
			$newObj->save();
		}
		return response()->json(['errcode'=>1]);
	}

}
