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
    	if($res['userType']->count() <= 0){
    		return redirect('/front/register');
    	}
		
    	return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0]]);
    }
	public function userType($openid)
	{
		$res['userType'] = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get();
		switch($res['userType'][0]->type){
			case '1':
				$res['data'] = AdminInfo::where('openid',$openid)->get();
				break;
			case '2':
				$res['data'] = ParentInfo::where('openid',$openid)->get();
				break;
			case '3';
				$res['data'] = TeacherInfo::where('openid',$openid)->get();
				break;
		}
		return $res;
	}
	public function homeOauth()
	{
   		return redirect(OauthController::getUrl(4, 0));
	}
}
