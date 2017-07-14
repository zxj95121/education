<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EclassOrder;
use App\Models\UserType;
use App\Http\Controllers\EclassPriceController;

use App\Http\Controllers\Wechat\OauthController;
use App\Models\EclassProgress;
use App\Models\TeacherFour;
use Session;

class MyClassOrderController extends Controller
{
    public function index()
    {
    	$openid = Session::get('openid');
    	$front_id = $this->getUid($openid);
    	/*查订单详情*/
    	$noPayObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', 0)
    		->where('status', 1)
    		->orderBy('id', 'desc')
    		->get()
    		->toArray();
    	foreach ($noPayObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$noPayObj[$key]['name'] = $name;
    	}

    	/*查待审核订单*/
    	$noConfirmObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', '1')
    		->where('confirm_status', '0')
    		->where('status', '1')
    		->orderBy('id', 'desc')
    		->get()
    		->toArray();
    	foreach ($noConfirmObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$noConfirmObj[$key]['name'] = $name;
    	}

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
    	}
    	
    	/*已完成订单*/
		$complete = EclassOrder::where('uid', $front_id)
			->where('complete',1)
			->where('status', 1)
			->orderBy('id', 'desc')
			->get()
			->toArray();
		foreach ($complete as $key => $value) {
			$tid = $value['tid'];
			$name = EclassPriceController::getName($tid,1,' 》');
			$complete[$key]['name'] = $name;
		}
    	return view('front.views.parent.myClassOrder', [
    		'noPayObj' => $noPayObj,
    		'noConfirmObj' => $noConfirmObj,
    		'teachingObj' => $teachingObj,
    		'complete' => $complete
    	]);
    }


    /*oauth*/
    public function oauth()
	{
   		return redirect(OauthController::getUrl(5, 0));
	}

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
    public function details(Request $request)
    {
		$id = $request->input('id');
		$fourMid = EclassProgress::where('oid',$id)->where('status',1)->select('fid','oid')->orderBy('id','desc')->first();
    	$order = EclassOrder::find($id);
		$all = TeacherFour::where('pid',$order->tid)->where('status',1)->get();
    	foreach($all as $key => $value){
    		if(isset($fourMid) && $value->id <= $fourid){
    			$all[$key]['zhuangtai'] = 1;
    		}else{
    			$all[$key]['zhuangtai'] = 0;
    		}
    	}
    	return view('front.views.parent.details',['res'=>$all]);
    }
}