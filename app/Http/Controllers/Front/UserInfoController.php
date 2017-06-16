<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use Session;

class UserInfoController extends Controller
{
    public function parent()
    {
    	return view('front.views.user_info.user_info_parent_add');
    }

    public function teacher()
    {
    	return view('front.views.user_info.user_info_teacher_add');
    }

    public function t_headimg(Request $request)
    {
    	$openid = Session::get('openid');
    	$base64 = $request->input('img');

    	$img = base64_decode($base64);
    	$name = date('YmdHis').rand(1000,9999).'.png';
		$size = file_put_contents($_SERVER['DOCUMENT_ROOT'].'/images/userinfo/'.$name, $img);//保存图片，返回的是字节数

		AdminInfo::where('openid', $openid)
			->update(['headimg'=>'/images/userinfo/'.$name]);
    	return response()->json(['errcode'=>0,'img'=>$img]);
    }
}