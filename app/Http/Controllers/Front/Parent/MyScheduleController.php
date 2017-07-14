<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EclassOrder;
use App\Models\UserType;
use App\Http\Controllers\EclassPriceController;
use App\Models\OrderClassTime;
use App\Models\ParentChild;
use App\Models\DateType;

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
    		->where('complete', '0')
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

    	return view('front.views.parent.mySchedule',['childName'=>$childName,'id'=>$id]);
    }

    public function getSchedule(Request $request)
    {
    	$id =$request->input( 'id' );
    	/*查出订单的授课孩子*/
    	$orderObj = EclassOrder::find($id);
    	/*查出该订单至今乃至未来的可用日期*/
    	$orderTime = date('Y-m-d', strtotime($orderObj->created_at));
    	$dateObj = DateType::where('day', '>=', $orderTime)
    		->where('status', '1')
    		->select('day', 'type')
    		->get();

    	/**/
    	$data = array();
    	foreach ($dateObj as $value) {
    		$date = $value->day;
    		$type = $value->type;
    		$week = date('w', strtotime($date));
    		$week = ($week == 0)?'7':$week;

    		$count = OrderClassTime::where('order_id', $id)
    			->where('week', $week)
    			->where('type', $type)
    			->where('status', '1')
    			->count();

    		if ($count <= 0) {
    			$data[$date]['state'] = '0';
    		} else {
    			$data[$date]['state'] = '1';
    			/*继续获取详情*/
    			$KeshiObj = OrderClassTime::where('order_class_time.order_id', $id)
    			->where('order_class_time.week', $week)
    			->where('order_class_time.type', $type)
    			->where('order_class_time.status', '1')
    			->leftJoin('class_time as ct', 'ct.id', 'order_class_time.ct_id')
    			->select('ct.low as low', 'ct.high as high')
    			->get();

    			foreach ($KeshiObj as $value) {
    				$temp['low'] = $value->low;
    				$temp['high'] = $value->high;
    				$data[$date]['detail'][] = $temp;
    			}
    		}
    	}

    	return response()->json(['errcode'=>0,'data'=>$data]);
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
