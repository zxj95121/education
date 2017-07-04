<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\UserType;
use Session;
use App\Models\AdminInfo;
use App\Models\ParentInfo;
use App\Models\TeacherInfo;

class HomeController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
		$res = $this->userType($openid);
    	if(count($res['userType'])){
    		return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0]]);
    	}else{
    		return redirect('/front/register');
    	}
    }
	public function userType($openid)
	{
		$res['userType'] = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get();
		if(count($res['userType'])==0){
			return $res;	
		}
		switch($res['userType'][0]->type){
			case '1':
				$res['data'] = AdminInfo::where('id',$res['userType'][0]->uid)->get();
				break;
			case '2':
				$res['data'] = ParentInfo::where('id',$res['userType'][0]->uid)->get();
				break;
			case '3';
				$res['data'] = TeacherInfo::where('id',$res['userType'][0]->uid)->get();
				break;
		}
		return $res;
	}
	public function homeOauth()
	{
   		return redirect(OauthController::getUrl(4, 0));
	}
}
