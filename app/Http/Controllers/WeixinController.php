<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EclassOrder;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;
use App\Models\Bill;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\EclassPriceController;
use App\Models\ParentInfo;
use App\Models\ClassPackage;
use App\Models\NewUser;
use App\Models\HalfBuyRecord;
use App\Models\TeacherOne;

class WeixinController extends Controller
{
    public function notify(Request $request)
    {
    	$postStr = file_get_contents('php://input');
    	if (!empty($postStr)){
    		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    		if($postObj->result_code == 'SUCCESS'){
    			$order = BigOrder::where('order_no',$postObj->out_trade_no)->first();
    			$order->pay_status = 1;
    			$order->save();
    			$bill = Bill::where('oid',$order->id)->where('type', 'EC')->get();
    			if(count($bill) == 0){
    				$bill = new Bill();
    				$bill->oid = $order->id;
    				$bill->save();

                    $bid = $order->id;
                    $eclassObj = EclassOrder::where('bid', $bid)
                        ->where('status', '1')
                        ->first();
    				$userObj = NewUser::find($eclassObj->uid);
    				$twoName = EclassPriceController::getName($eclassObj->tid, 3);
    				$firstName = EclassPriceController::getName($eclassObj->tid, 0);
    				TemplateController::send($userObj->openid,'关于双师Class订单支付成功的通知',$firstName,$twoName,$order->price,$bill->created_at,$userObj->nickname,'订单支付成功，请耐心等待管理员审核','http://'.$_SERVER["SERVER_NAME"].'/front/parent/myClassOrder/oauth');
    			}
    		}
    	}
    	return true;
    }


    public function otherClassNotify(Request $request)
    {
        $postStr = file_get_contents('php://input');
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if($postObj->result_code == 'SUCCESS'){
                $order_no = $postObj->out_trade_no;

                $order = ClassPackageOrder::where('order_no',$order_no)->first();
                $order->pay_status = 1;
                $order->save();
                $bill = Bill::where('oid',$order->id)->where('type', 'CP')->get();

                if(count($bill) == 0){
                    $bill = new Bill();
                    $bill->oid = $order->id;
                    $bill->type = 'CP';
                    $bill->save();
                    $cpObj = ClassPackage::find($order->cid);
                    $caseNameObj = NewUser::find($order->uid);
                    TemplateController::send($caseNameObj->openid,'关于订单支付成功的通知','课程套餐',$cpObj->name,$order->price,$bill->created_at,$caseNameObj->nickname,'订单支付成功','');
                }
            }
        }

        return true;
    }

    public function notifyHalfBuy(Request $request)
    {
        $postStr = file_get_contents('php://input');
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if($postObj->result_code == 'SUCCESS'){
                $order_no = $postObj->out_trade_no;

                $order = HalfBuyRecord::where('order_no',$order_no)->first();
                $order->pay_status = 1;
                $order->save();
                $bill = Bill::where('oid',$order->id)->where('type', 'HB')->get();

                if(count($bill) == 0){
                    $bill = new Bill();
                    $bill->oid = $order->id;
                    $bill->type = 'HB';
                    $bill->save();
                    $classObj = TeacherOne::find($order->tid);
                    $caseNameObj = NewUser::find($order->uid);
                    TemplateController::send($caseNameObj->openid,'关于订单支付成功的通知','半价购课',$classObj->name,$order->price,$bill->created_at,$caseNameObj->nickname,'订单支付成功','');
                }
            }
        }

        return true;
    }
}
