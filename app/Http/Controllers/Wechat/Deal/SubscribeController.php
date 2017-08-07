<?php

namespace App\Http\Controllers\Wechat\Deal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NewUser;
use App\Models\UserShare;
use App\Models\HalfBuyInfo;

class SubscribeController extends Controller
{
    public function subscribe($openid)
    {
    	/*关注的时候，判断是不是被别人分享关注的*/
    	$this->share($openid);
    }

	private function share($openid)
	{
		$count = UserShare::where('openid', $openid)
    		->count();

    	if ($count > 0) {
    		UserShare::where('openid', $openid)
    			->update(['subscribe'=>'1']);


    		$uid = UserShare::where('openid', $openid)
    			->select('pid')
    			->get()[0]
    			->pid;
    		$msg = HalfBuyInfo::where('uid', $uid)
    			->first();
    		$ticket = $msg->ticket_num + 1;
    		HalfBuyInfo::where('uid', $uid)
    			->update(['ticket'=>$ticket]);
    	}
	}
}
