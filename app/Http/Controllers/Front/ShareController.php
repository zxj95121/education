<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewUser;
use App\Models\UserShare;
use App\Http\Controllers\Wechat\OauthController;
use Session;
class ShareController extends Controller
{
	public function index(Request $request)
	{
		$openid = Session::get('openid');
		if(Session::get('share')){
			$id = Session::get('share')['id'];
			$usershare_count = UserShare::where('openid',$openid)->where('pid',$id)->count();
			if ($usershare_count < 1){
				$usershare = new UserShare();
				$usershare->openid = $openid;
				$usershare->subscribe = 0;
				$usershare->pid = $id;
				$usershare->save();
				Session::forget('share');
			}
		}
		$newuser = NewUser::where('openid',$openid)->get();
		if (count($newuser) > 0) {
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth?id=".$newuser[0]->id);
		} else{
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth");
		}
		return view('share',['news'=>$news]);
	}
	/*oauth*/
	public function oauth(Request $request)
	{
		if($request->input('id')){
			$share['id'] = $request->input('id');
			Session::put('share',$share);
		}
		return redirect(OauthController::getUrl(7, 0));
	}
	
}
