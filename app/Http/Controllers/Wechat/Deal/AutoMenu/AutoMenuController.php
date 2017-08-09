<?php

namespace App\Http\Controllers\Wechat\Deal\AutoMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoMenuController extends Controller
{
    public function index()
    {
    	/*后台设置首页*/
    	return view('admin.wechat.autoMenu');
    }
}
