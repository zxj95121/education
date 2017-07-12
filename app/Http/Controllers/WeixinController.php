<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EclassOrder;
use App\Models\Bill;
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
    			$bill = Bill::where('transaction_id',$postObj->transaction_id)->get();
    			if(count($bill) == 0){
    				$bill = new Bill();
    				$bill->oid = $order->id;
    				$bill->save();
    			}
    		}
    	}
    	return true;
    }

}
