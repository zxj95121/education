<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminPower;
use App\Models\AdminInfo;

use Session;

class PowerController extends Controller
{
    public function getPower(Request $request)
    {
    	$admin_id = Session::get('admin_id');

    	$powerObj = AdminPower::where('admin_power.uid', $admin_id)
    		->leftJoin('admin_info as ai', 'ai.id', 'admin_power.uid')
    		->where('admin_power.status', '1')
    		->select('ai.identity', 'admin_power.*')
    		->first();

    	return response()->json(['errcode'=>0,'power'=>$powerObj]);
    }
}
