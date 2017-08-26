<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ModifyPriceRecord;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;

class MessageRecordController extends Controller
{
    public function modifyPrice()
    {
    	$recordObj = ModifyPriceRecord::where('modify_price_record.status', 1)
    		->leftJoin('new_user as nu', 'nu.id', 'modify_price_record.uid')
    		->leftJoin('admin_info as ai', 'ai.openid', 'nu.openid')
    		->orderBy('modify_price_record.id', 'desc')
    		->select('ai.name','modify_price_record.*')
    		->paginate(10);

    	foreach($recordObj as $key=>$value) {
    		if ($value->which == 1) {
    			$orderno = BigOrder::find($value->order_no)->order_no;
    		} elseif ($value->which == 2) {
    			$orderno = ClassPackageOrder::find($value->order_no)->order_no;
    		} else {
    			$orderno = '';
    		}
  			$recordObj[$key]->no = $orderno;
    	}
    	return view('admin.record.modifyPrice', ['recordObj'=>$recordObj]);
    }
}
