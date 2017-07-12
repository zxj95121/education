<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EclassOrder;
use App\Http\Controllers\EclassPriceController;

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
    		->get()
    		->toArray();
    	foreach ($noPayObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid);
    		$noPayObj[$key]['name'] = $name;
    	}
    	return view('front.views.parent.myClassOrder', [
    		'noPayObj' => $noPayObj
    	]);
    }

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
