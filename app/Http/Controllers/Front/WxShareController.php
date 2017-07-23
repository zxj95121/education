<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WxShareController extends Controller
{
    public function index(Request $request)
    {
    	$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://wechat.catchon-edu.cn/admin/img/index.png', "Url" =>'http://wechat.catchon-edu.cn/front/home');
		return view('front.views.fenxiang',[news=>$news]);
    }
}
