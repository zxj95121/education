<?php

namespace App\Http\Controllers;

require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Data.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeixinController extends WxPayNotify
{
    public function notify(Request $request)
    {
    	$this->Handle(false);
    }
    //查询订单
    public function Queryorder($transaction_id)
    {
    	$input = new WxPayOrderQuery();
    	$input->SetTransaction_id($transaction_id);
    	$result = WxPayApi::orderQuery($input);
    	if(array_key_exists("return_code", $result)
    			&& array_key_exists("result_code", $result)
    			&& $result["return_code"] == "SUCCESS"
    			&& $result["result_code"] == "SUCCESS")
    	{
    		return true;
    	}
    	return false;
    }
    
    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
    	DB::table('ceshi')->insert([
    			['text'=>$data]
    	]);
    	return true;
    }
}
