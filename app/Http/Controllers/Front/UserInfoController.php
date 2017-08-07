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
use App\Models\SchoolOne;
use App\Models\SchoolTwo;
use App\Models\SchoolApply;
use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\CommunityCommunity;
use App\Models\Hobby;
use App\Models\HobbyApply;
use App\Models\NewUser;

use Session;

class UserInfoController extends Controller
{
    public function parent()
    {
        $openid = Session::get('openid');

        $userInfo = ParentInfo::where('openid', $openid)
            ->get()[0];
        $userDetail = ParentDetail::where('pid', $userInfo->id)
            ->get()[0];

        if (!$userDetail->type) {
            return redirect('/front/selectParentType');
        }

        /*初始化出生日期用*/
        if ($userDetail->birth) {
            $times = strtotime($userDetail->birth.'-1');
            $time[] = date('Y', $times);
            $time[] = date('m', $times);
            $time[1] = str_replace('0', '', $time[1]);
        } else {
            $time = '';
        }
        
        /*初始化用*/
        // if ($userDetail->money) {
        //     $moneys = explode('-', $userDetail->money);
        //     $money[] = $moneys[0];
        //     $money[] = $moneys[1];
        // } else {
        //     $money = '';
        // }

        // /*查询学校信息*/  /*以及教学年份*/
        // if ($userDetail->type == 1) {
        //     /*大学生教师*/
        //     $schoolInfo_one = SchoolOne::where('school_one.is_student', 1)
        //         ->where('school_one.status', 1)
        //         ->select('id', 'name')
        //         ->get();
        // } else if ($userDetail->type == 2) {
        //     /*职业教师*/
        //     $schoolInfo_one = SchoolOne::where('school_one.is_student', 0)
        //         ->where('school_one.status', 1)
        //         ->select('id', 'name')
        //         ->get();
        // }

        // $k = 0;
        // foreach ($schoolInfo_one as $value) {
        //     $id1 = $value->id;
        //     $schoolInfo[$k] = array();
        //     $schoolInfo[$k]['id1'] = $id1;
        //     $schoolInfo[$k]['name1'] = $value->name;
        //     $schoolInfo[$k]['two'] = array();
        //     $schoolInfo_two = SchoolTwo::where('pid', $id1)
        //         ->where('status', 1)
        //         ->select('id', 'name')
        //         ->get();
        //     foreach ($schoolInfo_two as $v) {
        //         $schoolInfo[$k]['two'][] = array('id2'=>$v->id, 'name2'=>$v->name);
        //     }
        //     $k++;
        // }

        // //根据userDetail->school读出相应信息
        // if ($userDetail->school)
        //     $schoolObj = SchoolTwo::find($userDetail->school);
        // else
        //     $schoolObj = '';

        /*查取社区信息*/
        $flight = $this->returnUserFlight($openid, 1);
        $cInfo = $flight->address;
        if ($cInfo == '') {
            $addressStr = '';
        } else {
            $address = $cInfo;
            $addData = CommunityCommunity::where('id', $address)
                ->select('name')
                ->get()[0];
            $addressStr = $addData->name;
        }

        // /*查特长爱好*/
        // $typeObj = Hobby::where('status', 1)
        //     ->select('type')
        //     ->distinct('type')
        //     ->orderBy('type')
        //     ->get();
        // $typeArr = array();
        // foreach ($typeObj as $key => $value) {
        //     $hobbyDetail = Hobby::where('status', 1)
        //         ->where('type', $value->type)
        //         ->select('id', 'name')
        //         ->get();
        //     foreach ($hobbyDetail as $k => $v) {
        //         $typeArr[$value->type][$k]['id'] = $v->id;
        //         $typeArr[$value->type][$k]['name'] = $v->name;
        //     }
        // }

        // /*查用户的特长爱好*/
        // if ($userDetail->hobby == '') {
        //     $hobbyData = '';
        // } else {
        //     $fli = Hobby::find(substr($userDetail->hobby, 0, 1));
        //     $hobbyData = $fli->name;
        //     if (strpos($userDetail->hobby, '-') > 0) {
        //         $hobbyData .= '等';
        //     }
        // }

        return view('front.views.user_info.user_info_parent_add',['openid'=>$openid,'userInfo'=>$userInfo,'userDetail'=>$userDetail,'birthTime'=>$time,'addressStr'=>$addressStr]);
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

        /*初始化出生日期用*/
        if ($userDetail->birth) {
            $times = strtotime($userDetail->birth.'-1');
            $time[] = date('Y', $times);
            $time[] = date('m', $times); 
            $time[1] = str_replace('0', '', $time[1]);
        } else {
            $time = '';
        }

        /*初始化用*/
        if ($userDetail->money) {
            $moneys = explode('-', $userDetail->money);
            $money[] = $moneys[0];
            $money[] = $moneys[1];
        } else {
            $money = '';
        }

        /*查询学校信息*/  /*以及教学年份*/
        if ($userDetail->type == 1) {
            /*大学生教师*/
            $schoolInfo_one = SchoolOne::where('school_one.is_student', 1)
                ->where('school_one.status', 1)
                ->select('id', 'name')
                ->get();
        } else if ($userDetail->type == 2) {
            /*职业教师*/
            $schoolInfo_one = SchoolOne::where('school_one.is_student', 0)
                ->where('school_one.status', 1)
                ->select('id', 'name')
                ->get();
        }
		$k = 0;
		foreach ($schoolInfo_one as $value) {
			$id1 = $value->id;
			$schoolInfo[$k] = array();
			$schoolInfo[$k]['id1'] = $id1;
			$schoolInfo[$k]['name1'] = $value->name;
			$schoolInfo[$k]['two'] = array();
			$schoolInfo_two = SchoolTwo::where('pid', $id1)
			->where('status', 1)
			->select('id', 'name')
			->get();
			foreach ($schoolInfo_two as $v) {
				$schoolInfo[$k]['two'][] = array('id2'=>$v->id, 'name2'=>$v->name);
			}
			$k++;
		}


        //根据userDetail->school读出相应信息
        if ($userDetail->school)
            $schoolObj = SchoolTwo::find($userDetail->school);
        else
            $schoolObj = '';

        /*查取社区信息*/
        $flight = $this->returnUserFlight($openid, 1);
        $cInfo = $flight->address;
        if ($cInfo == '') {
            $addressStr = '';
        } else {
            $address = explode('-', $cInfo);
            $addData = CommunityCommunity::where('id', $address[0])
                ->select('name')
                ->get()[0];
            if (count($address) > 0) {
                $addressStr = $addData->name.'等';
            } else {
                $addressStr = $addData->name;
            }
        }

        /*查特长爱好*/
        $typeObj = Hobby::where('status', 1)
            ->select('type')
            ->distinct('type')
            ->orderBy('type')
            ->get();
        $typeArr = array();
        foreach ($typeObj as $key => $value) {
            $hobbyDetail = Hobby::where('status', 1)
                ->where('type', $value->type)
                ->select('id', 'name')
                ->get();
            foreach ($hobbyDetail as $k => $v) {
                $typeArr[$value->type][$k]['id'] = $v->id;
                $typeArr[$value->type][$k]['name'] = $v->name;
            }
        }

        /*查用户的特长爱好*/
        if ($userDetail->hobby == '') {
            $hobbyData = '';
        } else {
            $fli = Hobby::find(substr($userDetail->hobby, 0, 1));
            $hobbyData = $fli->name;
            if (strpos($userDetail->hobby, '-') > 0) {
                $hobbyData .= '等';
            }
        }

    	return view('front.views.user_info.user_info_teacher_add',['openid'=>$openid,'userInfo'=>$userInfo,'userDetail'=>$userDetail,'birthTime'=>$time,'money'=>$money,'schoolInfo'=>$schoolInfo,'schoolObj'=>$schoolObj,'addressStr'=>$addressStr,'typeArr'=>$typeArr,'hobbyData'=>$hobbyData]);
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

    public function selectParentType(Request $request)
    {
        $openid = Session::get('openid');

        if ($request->input('type')) {
            $type = $request->input('type');
            $userInfo = ParentInfo::where('openid', $openid)
            ->get()[0];
            ParentDetail::where('pid', $userInfo->id)
                ->update(['type'=>$type]);
            return redirect('/front/user_info_parent');
        }

        $userInfo = ParentInfo::where('openid', $openid)
            ->get()[0];
        return view('front/views.user_info.user_parent_redirect');   
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

        /*new_user表*/
        NewUser::where('openid', $openid)
            ->update(['nickname'=>$value]);

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
        $flight->money = '';
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*选择学校*/
    public function t_school(Request $request)
    {
        $id2 = $request->input('id2');
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid,1);
        $flight->school = $id2;
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

    /*parent端的place*/
    public function t_place(Request $request)
    {
        $value = $request->input('value');
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid,1);
        $flight->place = $value;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*parent端的surname*/
    public function t_surname(Request $request)
    {
        $value = $request->input('value');
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid,1);
        $flight->surname = $value;
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

    /*hobby*/
    public function t_hobby(Request $request)
    {
        $hobby = $request->input('hobby');
        $openid = Session::get('openid');

        if ($hobby != '') {

            $flight = $this->returnUserFlight($openid, 1);
            $flight->hobby = $hobby;
            $flight->save();

            $valueId = substr($hobby, -1);
            $hbData = Hobby::find($valueId);
            if (strpos($hobby, '-') > 0)
                $resp = $hbData->name.'等';
            else
                $resp = $hbData->name;
        } else {
            $resp = '';
        }
        return response()->json(['errcode'=>0,'html'=>$resp]);
    }

    /*年份*/
    public function t_teachYear(Request $request)
    {
        $year = $request->input('year');
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid,1);
        $flight->teachYear = $year;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*添加新学校*/
    public function addNewSchool(Request $request)
    {
        $name = $request->input('name');
        $openid = Session::get('openid');

        $flight = new SchoolApply();
        $flight->name = $name;
        $flight->openid = $openid;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }
    /*添加新的爱好特长*/
    public function addNewHobby(Request $request)
    {
        $name = $request->input('name');
        $openid = Session::get('openid');

        $flight = new HobbyApply();
        $flight->name = $name;
        $flight->openid = $openid;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*保存社区信息*/
    public function t_community(Request $request)
    {
        $address = $request->input('address');
        
        $openid = Session::get('openid');

        $str = '';
        foreach ($address as $value) {
            if ($value) {
                $str .= $value.'-';
            }
        }
        $str = substr($str, 0, -1);

        $flight = $this->returnUserFlight($openid, 1);
        $flight->address = $str;
        $flight->save();

        $html = CommunityCommunity::where('id', $value)
            ->select('name')
            ->get()[0];

        return response()->json(['errcode'=>0,'html'=>$html]);
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

    /*post请求社区信息*/
    public function getCommunity()
    {
        $openid = Session::get('openid');

        $flight = $this->returnUserFlight($openid, 1);
        $cInfo = $flight->address;
        if ($cInfo == '') {
            $addressArr = '';
        } else {
            $address = explode('-', $cInfo);
            foreach ($address as $v) {
                if ($v)
                    $addressArr[$v] = $v;
            }
        }

        $communityOne = CommunityCity::where('status', 1)
            ->select('id', 'name')
            ->get();
        $communityInfo = array();
        foreach ($communityOne as $key => $value) {
            $communityInfo[$key]['id'] = $value->id;
            $communityInfo[$key]['name'] = $value->name;
            $communityInfo[$key]['next'] = array();

            $communityTwo = CommunityArea::where('status', '1')
                ->where('cid', $value->id)
                ->select('id', 'name', 'cid')
                ->get();

            foreach ($communityTwo as $k => $v) {
                $communityInfo[$key]['next'][$k]['id'] = $v->id;
                $communityInfo[$key]['next'][$k]['cid'] = $v->cid;
                $communityInfo[$key]['next'][$k]['name'] = $v->name;
                $communityInfo[$key]['next'][$k]['next'] = array();

                $communityThree = CommunityCommunity::where('status', 1)
                    ->where('aid', $v->id)
                    ->select('id', 'name', 'aid')
                    ->get();

                foreach ($communityThree as $p => $q) {
                    $communityInfo[$key]['next'][$k]['next'][$p]['id'] = $q->id;
                    $communityInfo[$key]['next'][$k]['next'][$p]['name'] = $q->name;
                    $communityInfo[$key]['next'][$k]['next'][$p]['aid'] = $q->aid;
                }
            }
        }

        $data['communityInfo'] = $communityInfo;
        $data['address'] = $addressArr;
        return response()->json($data);
    }
}