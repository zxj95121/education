<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use App\Models\TeacherFour;
use App\Models\TeacherThree;
use App\Models\TeacherTwo;
use App\Models\TeacherOne;
use App\Models\UserType;
use App\Models\EclassOrder;

use App\Http\Controllers\EclassPriceController;
use Session;

class PayClassController extends Controller
{
	/*新订单*/
	public function newEclassOrder(Request $request)
	{
		$openid = Session::get('openid');
		$uid = $this->getUid($openid);
		/*新订单*/
		$tid = $request->input('id');

		if (strpos($tid, 'id') > 0) {
			$id = Session::get('order_id');
			$flight = EclassOrder::find($id);
			$order_id = $id;
			
			$name = EclassPriceController::getName($tid, 2);
			$firstName = EclassPriceController::getName($tid, 0);
			$flight->classname = $firstName.$name;
		} else {
			/*查取价格*/
			$res = EclassPriceController::getUnitPrice($tid);
			$count = $res['count'];
			$unitPrice = $res['unitPrice'];
			$price = number_format($count*$unitPrice, 2);

			$order_no = date('YmdHis', time()).rand(1000,9999);

			$flight = new EclassOrder();
			$flight->uid = $uid;
			$flight->tid = $tid;
			$flight->order_no = $order_no;
			$flight->count = $count;
			$flight->price = $price;
			$flight->save();

			$order_id = $flight->id;
			Session::put('order_id', $order_id);
			
			$name = EclassPriceController::getName($tid, 2);
			$firstName = EclassPriceController::getName($tid, 0);
			$flight->classname = $firstName.$name;
		}
		return view('front.views.parent.eclassOrder', ['name'=>$name,'order_id'=>$order_id,'flight'=>$flight]);
	}

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

		if(!$result && !$noTime) {
			/*读取课程数量*/
			$pid = $request->input('pid');
			$threeObj = TeacherThree::find($pid);

			$twoid = $threeObj->pid;
			$twoObj = TeacherTwo::find($twoid);

			$oneid = $twoObj->pid;
			$oneObj = TeacherOne::find($oneid);

			// $count = TeacherFour::where('pid', $threeObj->id)
			// 	->where('status', 1)
			// 	->count();
			$name = $oneObj->name.$twoObj->name.$threeObj->name;

			/*查取单价*/
			$res = EclassPriceController::getUnitPrice($pid);
			$count = $res['count'];
			$unitPrice = $res['unitPrice'];
			$price = number_format($count*$unitPrice, 2);
			return view('front.views.home.checkMessageResult', ['result'=>$result,'noTime'=>$noTime,'name'=>$name,'count'=>$count,'price'=>$price,'id'=>$pid]);
		}
    	return view('front.views.home.checkMessageResult', ['result'=>$result,'noTime'=>$noTime]);
    }
	public function weixinpay()
	{
		return view('front.views.parent.weixinpay');
	}

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
