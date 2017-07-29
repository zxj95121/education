<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminPower;

use Session;

class PowerController extends Controller
{
    public function getPower(Request $request)
    {
    	$admin_id = Session::get('admin_id');

    	$powerObj = AdminPower::where('uid', $admin_id)
    		->where('status', '1')
    		->first();

    	return response()->json(['errcode'=>0,'power'=>$powerObj]);
    }
}
