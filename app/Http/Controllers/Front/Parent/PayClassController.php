<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use App\Models\UserType;

use Session;

class PayClassController extends Controller
{
    public function checkMessage(Request $request)
    {
    	$openid = Session::get('openid');

		$id = $this->getUid($openid);

		$flight = ParentDetail::find($id);

		$result = array();
		$k = 0;
		if ($flight->address == '') {
			$result[$k]['word'] = '所在社区';
			$result[$k++]['reason'] = '未填写';
		}
		if ($flight->place == '') {
			$result[$k]['word'] = '栋单元楼层';
			$result[$k++]['reason'] = '未填写';
		}

		$selectTime = explode('-', $flight->prefer_time);
		if($flight->prefer_type == 0 && count($selectTime) < 3) 
			$noTime = true;
		else
			$noTime = false;
    	return view('front.views.home.checkMessageResult', ['result'=>$result,'noTime'=>$noTime]);
    }

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
