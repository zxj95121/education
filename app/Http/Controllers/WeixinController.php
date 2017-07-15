<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EclassOrder;
use App\Models\Bill;
use App\Http\Controllers\TemplateController;
use App\Models\ParentInfo;

class WeixinController extends Controller
{
    public function notify(Request $request)
    {
    	$postStr = file_get_contents('php://input');
    	if (!empty($postStr)){
    		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    		if($postObj->result_code == 'SUCCESS'){
    			$order = EclassOrder::where('order_no',$postObj->out_trade_no)->first();
    			$order->pay_status = 1;
    			$order->save();
    			$bill = Bill::where('oid',$order->id)->get();
    			if(count($bill) == 0){
    				$bill = new Bill();
    				$bill->oid = $order->id;
    				$bill->save();
    				$parentObj = ParentInfo::find($uid);
    				$name = EclassPriceController::getName($order->tid, 2);
    				$firstName = EclassPriceController::getName($order->tid, 0);
    				TemplateController::send($parentObj->openid,'关于双师Class订单支付成功的通知',$firstName,$name,$order->price,$bill->created_at,$parentObj->name,'订单支付成功，请耐心等待管理员审核');
    			}
    		}
    	}
    	return true;
    }

}
