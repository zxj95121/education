<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewUser;
use App\Models\UserShare;
use App\Http\Controllers\Wechat\OauthController;
use Session;
use Wechat;
class ShareController extends Controller
{
	public function index(Request $request)
	{
		$openid = Session::get('openid');
		$access_token = Wechat::get_access_token();
		
		/*获取用户个人详细信息*/
		$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.
				$access_token['access_token'].'&openid='.
				$openid.'&lang=zh_CN';
		$userinfo = Wechat::curl($url);
		dump($userinfo);
		$subscribe = $userinfo['subscribe'];

		$id = $request->input('id');
		$type = $request->input('type');
		if($id){
			$newuser = NewUser::find($id);
			$usershare = new UserShare();
			$usershare->openid = $newuser->openid;
			$usershare->subscribe = $subscribe;
			$usershare->save();
		}
		$newuser = NewUser::where('openid',$openid)->get()[0];
		if($newuser->id){
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth?type=".$newuser->type."&&id=".$newuser->id);
		}else{
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth");
		}
		return view('share',['news'=>$news]);
	}
	/*oauth*/
	public function oauth(Request $request)
	{
		return redirect(OauthController::getUrl(7, 0));
	}
	
}
