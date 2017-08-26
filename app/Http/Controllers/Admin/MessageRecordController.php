<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ModifyPriceRecord;

class MessageRecordController extends Controller
{
    public function modifyPrice()
    {
    	$recordObj = ModifyPriceRecord::where('modify_price_record.status', 1)
    		->leftJoin('new_user as nu', 'nu.id', 'modify_price_record.uid')
    		->leftJoin('admin_info as ai', 'ai.openid', 'nu.openid')
    		->leftJoin('big_order as bo', 'bo.id', 'modify_price_record.order_no')
    		->orderBy('modify_price_record.id', 'desc')
    		->select('ai.name','bo.order_no as no','modify_price_record.*')
    		->paginate(10);
    	return view('admin.record.modifyPrice', ['recordObj'=>$recordObj]);
    }
}
