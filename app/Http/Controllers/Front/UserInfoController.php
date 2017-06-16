<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use App\Models\UserType;
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
    	$base64_image = str_replace(' ', '+', $base64);
    	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
    		$img = base64_decode(str_replace($result[1], '', $base64_image));
    		$name = date('YmdHis').rand(1000,9999).'.png';
			$size = file_put_contents($_SERVER['DOCUMENT_ROOT'].'/images/userinfo/'.$name, $img);//保存图片，返回的是字节数
		}

		$user = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get()[0];
		$uid = $user->uid;

		switch ($user->type) {
			case '1':
				$flight = AdminInfo::find($uid);
				break;
			case '2':
				$flight = ParentInfo::find($uid);
				break;
			case '3':
				$flight = TeacherInfo::find($uid);
		}

		$headimg = $flight->headimg;
		$flight->headimg = '/images/userinfo/'.$name;

		if (strpos($headimg, '/images/userinfo/') == 0) {
			unlink($_SERVER['DOCUMENT_ROOT'].$headimg);
		}

		$flight->save();
    	echo json_encode(array('errcode'=>0));
    }
}