<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EclassOrder;
use App\Models\UserType;
use App\Http\Controllers\EclassPriceController;
use App\Models\OrderClassTime;
use App\Models\ParentChild;

use App\Http\Controllers\Wechat\OauthController;
use Session;

class MyScheduleController extends Controller
{
    public function orderList()
    {
    	$openid = Session::get('openid');
    	$front_id = $this->getUid($openid);

    	/*授课中订单*/
    	$teachingObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', '1')
    		->where('confirm_status', '1')
    		->where('status', '1')
    		->orderBy('id', 'desc')
    		->get()
    		->toArray();

    	foreach ($teachingObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$teachingObj[$key]['name'] = $name;


    		/*查看是否已经安排课表*/
    		$order_id = $value['id'];
    		$schedule = OrderClassTime::where('order_id', $order_id)
    			->where('status', '1')
    			->count();
    		if ($schedule > 0) {
    			$teachingObj[$key]['schedule'] = '1';
    		} else {
    			$teachingObj[$key]['schedule'] = '0';
    		}
    	}
    	
    	return view('front.views.parent.myScheduleOrder', [
    		'teachingObj' => $teachingObj
    	]);
    }

    /*查看课表页*/
    public function schedule(Request $request)
    {
    	$id =$request->route( 'id' );
    	/*查出订单的授课孩子*/
    	$orderObj = EclassOrder::find($id);
    	$child = $orderObj->child;
    	$childObj = ParentChild::find($child);
    	$childName = $childObj->name;
    	return view('front.views.parent.mySchedule',['childName'=>$childName]);
    }

    /*oauth*/
    public function oauth()
	{
   		return redirect(OauthController::getUrl(6, 0));
	}

	private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
