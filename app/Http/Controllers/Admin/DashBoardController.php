<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use Config;
use Session;

class DashBoardController extends Controller
{
    public function getAdminBasic()
    {
    	$site_name = Config::get('constants.site_name');
    	$computer_footer = Config::get('constants.computer_footer');
    	$admin_id = Session::get('admin_id');
    	$adminInfo = AdminInfo::find($admin_id);
    	return response()->json(['errcode'=>0,'site_name'=>$site_name,'computer_footer'=>$computer_footer,'adminInfo'=>$adminInfo]);
    }
}
