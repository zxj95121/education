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
use App\Models\HalfBuyInfo;
use App\Models\TeacherOne;
use App\Models\EclassCart;
use App\Models\ClassMessage;

use PayResult;

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

                    /*加辰比存取*/
                    PayResult::give($order->price, $postObj->openid);
                    /*优惠券扣除*/
                    PayResult::editBigOrderVoucher($postObj->openid, $postObj->out_trade_no);

    				$bill = new Bill();
    				$bill->oid = $order->id;
    				$bill->save();

                    $bid = $order->id;
                    $eclassObj = EclassOrder::where('bid', $bid)
                        ->where('status', '1')
                        ->first();
    				$userObj = NewUser::find($eclassObj->uid);

                    /*购物车清空*/
                    EclassCart::where('uid', $eclassObj->uid)
                        ->update(['total'=>0,'arr'=>'[]','order'=>'{}']);

    				$twoName = EclassPriceController::getName($eclassObj->tid, 3);
    				$firstName = EclassPriceController::getName($eclassObj->tid, 0);
    				TemplateController::send($userObj->openid,'关于双师Class订单支付成功的通知',$firstName,$twoName,$order->price,$bill->created_at,$userObj->nickname,'订单支付成功，请耐心等待管理员审核','http://'.$_SERVER["SERVER_NAME"].'/front/parent/myClassOrder/oauth');
    				$messageObj = ClassMessage::where('status',1)
    					->select('phone')
    					->get();
    				foreach($messageObj as $vo){
    					$phone = $vo->phone;
    					$code[] = $userObj->nickname;
    					$code[] = $firstName;
    					$code[] = $order->price;
    					require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
    					$result = postPhoneCodeSms($phone, $code, 34066);
    				}
    					
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

                    /*加辰比存取*/
                    PayResult::give($order->price, $postObj->openid);
                    /*优惠券扣除*/
                    PayResult::editClassPackageOrderVoucher($postObj->openid, $postObj->out_trade_no);

                    $bill = new Bill();
                    $bill->oid = $order->id;
                    $bill->type = 'CP';
                    $bill->save();
                    $cpObj = ClassPackage::find($order->cid);
                    $caseNameObj = NewUser::find($order->uid);
                    TemplateController::send($caseNameObj->openid,'关于订单支付成功的通知','课程套餐',$cpObj->name,$order->price,$bill->created_at,$caseNameObj->nickname,'订单支付成功','');
                    $messageObj = ClassMessage::where('status',1)
                    	->select('phone')
                    	->get();
                    foreach($messageObj as $vo){
                    	$phone = $vo->phone;
                    	$code[] = $caseNameObj->nickname;
                    	$code[] = $cpObj->name;
                    	$code[] = $order->price;
                    	require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
                    	$result = postPhoneCodeSms($phone, $code, 34066);
                    }
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

                    /*支付成功，进行数据变动*/
                    $ticket = HalfBuyInfo::where('uid', $order->uid)
                        ->select('ticket_num', 'used_num')
                        ->first();
                    $num = (int)$order->record_num;

                    $ticket_num = (int)($ticket->ticket_num) - $num;
                    $used_num = (int)($ticket->used_num) + $num;

                    HalfBuyInfo::where('uid', $order->uid)
                        ->update(['ticket_num'=>$ticket_num, 'used_num'=>$used_num]);
                        /*更新结束*/
                    $messageObj = ClassMessage::where('status',1)
                        ->select('phone')
                        ->get();
                   	foreach($messageObj as $vo){
                   		$phone = $vo->phone;
                        $code[] = $caseNameObj->nickname;
                        $code[] = $classObj->name;
                        $code[] = $order->price;
                        require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
                        $result = postPhoneCodeSms($phone, $code, 34066);
                  	}
                }
            }
        }

        return true;
    }
}
