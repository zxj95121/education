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
use App\Models\ParentChild;
use App\Models\EclassOrder;
class HomeController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
		$res = $this->userType($openid);
    	if (count($res['userType'])){
    		$parentinfo = ParentInfo::where('openid',$openid)->select('id')->first();
    		$child = ParentChild::where('pid',$parentinfo->id)->where('status',1)->select('id','sex','name')->get();
    		$orderstatus[1] = EclassOrder::where('uid',$parentinfo->id)
    			->where('pay_status', 0)
    			->count();
    		$orderstatus[2] = EclassOrder::where('uid',$parentinfo->id)
	    		->where('pay_status', '1')
	    		->where('confirm_status', '1')
	    		->where('status', '1')
	    		->count();
    		$orderstatus[3] = EclassOrder::where('uid',$parentinfo->id)
    			->where('complete',1)
				->where('status', 1)
				->count();
    		return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0],'child'=>$child,'orderstatus'=>$orderstatus]);
    	} else {
    		return redirect('/front/register');
    	}
    }
	public function userType($openid)
	{
		$res['userType'] = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get();
		if(count($res['userType']) == 0){
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

	private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
