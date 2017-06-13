<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    public function communityManage()
    {
    	return view('admin.os.communityManage');
    }
}
