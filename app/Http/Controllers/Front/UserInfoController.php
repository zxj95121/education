<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use App\Models\ParentInfo;
use App\Models\TeacherInfo;
use App\Models\ParentDetail;
use App\Models\TeacherDetail;
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
    	$openid = Session::get('openid');

        $userInfo = TeacherInfo::where('openid', $openid)
            ->get()[0];
        $userDetail = TeacherDetail::where('tid', $userInfo->id)
            ->get()[0];

        if (!$userDetail->type) {
            return redirect('/front/selectTeacherType');
        }

        if ($userDetail->birth) {
            $times = strtotime($userDetail->birth.'-1');
            $time[] = date('Y', $times);
            $time[] = date('m', $times); 
        } else {
            $time = '';
        }
        dd($time);
    	return view('front.views.user_info.user_info_teacher_add',['openid'=>$openid,'userInfo'=>$userInfo,'userDetail'=>$userDetail]);
    }

    public function selectTeacherType(Request $request)
    {
        $openid = Session::get('openid');

        if ($request->input('type')) {
            $type = $request->input('type');
            $userInfo = TeacherInfo::where('openid', $openid)
            ->get()[0];
            TeacherDetail::where('tid', $userInfo->id)
                ->update(['type'=>$type]);
            return redirect('/front/user_info_teacher');
        }

        $userInfo = TeacherInfo::where('openid', $openid)
            ->get()[0];
        return view('front/views.user_info.user_teacher_redirect');   
    }

    /*修改teacher的头像*/
    public function t_headimg(Request $request)
    {
    	$openid = $request->input('openid');
    	$base64 = $request->input('img');
    	$base64_image = str_replace(' ', '+', $base64);
    	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
    		$img = base64_decode(str_replace($result[1], '', $base64_image));
    		$name = date('YmdHis').rand(1000,9999).'.png';
			$size = file_put_contents($_SERVER['DOCUMENT_ROOT'].'/images/userinfo/'.$name, $img);//保存图片，返回的是字节数
		}

		$flight = $this->returnUserFlight($openid);

		$headimg = $flight->headimg;
		$flight->headimg = '/images/userinfo/'.$name;

		if (strpos($headimg, '/images/userinfo/') === 0) {
			unlink($_SERVER['DOCUMENT_ROOT'].$headimg);
		}

		$flight->save();
    	echo json_encode(array('errcode'=>0,'imgurl'=>'/images/userinfo/'.$name));
    }

    /*改教师昵称*/
    public function t_nickname(Request $request)
    {
    	$value = $request->input('value');
    	$openid = $request->input('openid');

    	$flight = $this->returnUserFlight($openid);
    	$flight->name = $value;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    public function t_name(Request $request)
    {
    	$value = $request->input('value');
    	$openid = $request->input('openid');

    	$flight = $this->returnUserFlight($openid,1);
    	$flight->name = $value;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    public function t_sex(Request $request) 
    {
        $openid = Session::get('openid');
        $sex = $request->input('sex');
        $flight = $this->returnUserFlight($openid,1);
        $flight->sex = $sex;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    public function t_birth(Request $request)
    {
        $openid = Session::get('openid');
        $birth = $request->input('birth');

        $flight = $this->returnUserFlight($openid,1);
        $flight->birth = $birth;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    public function t_status(Request $request) 
    {
        $openid = Session::get('openid');
        $status = $request->input('status');
        $flight = $this->returnUserFlight($openid,1);
        $flight->find_status = $status;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    public function t_project(Request $request)
    {
    	$value = $request->input('value');
    	$openid = Session::get('openid');

    	$flight = $this->returnUserFlight($openid,1);
    	$flight->project = $value;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    public function t_money(Request $request)
    {
        $value = $request->input('value');
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid,1);
        $flight->money = $value;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    private function returnUserFlight($openid,$type=0)
    {
    	/*type默认为0表示该info表*/
    	$user = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get()[0];
		$uid = $user->uid;

		if ($type == 0) {
			switch ($user->type) {
				case '1':
					$flight = AdminInfo::find($uid);
					break;
				case '2':
					$flight = ParentInfo::find($uid);
					break;
				case '3':
					$flight = TeacherInfo::find($uid);
                    break;
			}
		} else {
			switch ($user->type) {
				case '2':
					$flight = ParentDetail::find($uid);
					break;
				case '3':
					$flight = TeacherDetail::find($uid);
                    break;
			}
		}
		return $flight;
    }
}