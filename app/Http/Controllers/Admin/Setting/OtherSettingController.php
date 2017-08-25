<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminPower;
use App\Models\ModifyPricePasswd;

use Session;

class OtherSettingController extends Controller
{
    public function index()
    {
    	$admin_id = Session::get('admin_id');

    	$powerObj = AdminPower::where('admin_power.uid', $admin_id)
    		->leftJoin('admin_info as ai', 'ai.id', 'admin_power.uid')
    		->where('admin_power.status', '1')
    		->select('ai.identity', 'admin_power.*')
    		->first();


    	$modifyPricePasswd = ModifyPricePasswd::where('status', 1)
    		->first();
    	if ($modifyPricePasswd) {
    		$modifyPricePasswd = $modifyPricePasswd->passwd;
    	} else {
    		$modifyPricePasswd = '';
    	}

    	return view('admin.os.other', ['powerObj'=>$powerObj,'modifyPricePasswd'=>$modifyPricePasswd]);
    }

    /*设置改价口令*/
    public function modifyPrice(Request $request)
    {
    	$val = $request->input('val');

    	$flight = ModifyPricePasswd::where('status', 1)
    		->first();

    	if ($flight) {
    		$flight->passwd = $val;
    		$flight->save();
    	} else {
    		$flight = new ModifyPricePasswd();
    		$flight->passwd = $val;
    		$flight->save();
    	}
    }
}
