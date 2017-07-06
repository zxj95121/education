<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use App\Models\ClassTime;
use App\Models\UserType;
use Session;

class ClassTimeController extends Controller
{
    public function setClassTime(Request $request)
    {
    	$front_id = $this->getUid(Session::get('openid'));

    	$classType[] = ClassTime::where('status', 1)
    		->where('type', '1')
    		->select('id', 'low', 'high')
    		->orderBy('low')
    		->get();
    	$classType[] = ClassTime::where('status', 1)
    		->where('type', '2')
    		->select('id', 'low', 'high')
    		->orderBy('low')
    		->get();

        $userClass = ParentDetail::find($front_id);
        $userClass = explode('-', $userClass->prefer_time);
    	return view('front.views.parent.setClassTime',['classType'=>$classType,'userClass'=>$userClass]);
    }

    public function selectType(Request $request)
    {
    	$status = $request->input('status');

    	$front_id = $this->getUid(Session::get('openid'));

    	ParentDetail::where('id', $front_id)
    		->update(['prefer_type'=>$status]);
    		
    	return response()->json(['errcode'=>0]);
    }

    public function selectTime(Request $request)
    {
    	$id = $request->input('id');
    	$front_id = $this->getUid(Session::get('openid'));

    	$flight = ParentDetail::find($front_id);
    	$prefer_time = $flight->prefer_time;
    	if (!$prefer_time || strpos($prefer_time, '-') === 0) {
    		/*空和负数说明一开始用户没有选择任何东西*/
    		$flight->prefer_time = $id;
    	} else {
    		/*说明这里有东西*/
    		$flight->prefer_time = $prefer_time.'-'.$id;
    	}
    	$flight->save();
		return response()->json(['errcode'=>0]);
    }

    /*取消选择*/
    public function cancleTime(Request $request)
    {
    	$id = $request->input('id');
    	$front_id = $this->getUid(Session::get('openid'));

    	$flight = ParentDetail::find($front_id);
    	$prefer_time = $flight->prefer_time;

    	$times = explode('-', $prefer_time);
        var_dump($times);
    	if (count($times) <= 1) {
    		$prefer_time = '';
    	} else {
    		$prefer_time = '';
    		foreach ($times as $v) {
    			if ($v != $id)
    				$prefer_time .= $v+'-';
    		}
    		$prefer_time = substr($prefer_time, 0, -1);
    	}
        var_dump($prefer_time);
        dd(1);
    	$flight->prefer_time = $prefer_time;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
