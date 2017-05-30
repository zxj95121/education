<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Config;

class DashBoardController extends Controller
{
    public function getAdminBasic()
    {
    	$site_name = Config::get('constants.site_name');
    	return response()->json(['errcode'=>0,'site_name'=>$site_name]);
    }
}
