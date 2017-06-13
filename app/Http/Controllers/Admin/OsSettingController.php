<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OsSettingController extends Controller
{
    public function communityManage()
    {
    	return view('admin.os.communityManage');
    }
}
