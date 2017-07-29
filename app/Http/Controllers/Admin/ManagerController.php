<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use App\Models\UserType;
use App\Models\TeacherDetail;
use App\Models\ParentDetail;
use App\Models\CommunityCommunity;
use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\Hobby;
use App\Models\NewUser;
use App\Models\UserShare;
use App\Models\AdminPower;

use Session;
use Wechat;
class ManagerController extends Controller
{
    public function managerList()
    {
    	$adminInfo = AdminInfo::where('admin_info.status', '=', '1')
    		->orwhere('admin_info.status', '-1')
            ->leftJoin('admin_power as ap', 'ap.uid', 'admin_info.id')
    		->orderby('admin_info.status', 'desc')
            ->orderby('admin_info.id')
            ->select('admin_info.nickname', 'admin_info.id as aid', 'admin_info.name', 'admin_info.phone', 'admin_info.identity', 'admin_info.status as aStatus', 'admin_info.count', 'ap.*')
    		->paginate(10);

        $power = array();
        foreach($adminInfo as $value) {
            $power[$value->aid]['set_power'] = $value->set_power;
            $power[$value->aid]['chat'] = $value->chat;
        }
        $power = json_encode($power);
    	$manageInfo = AdminInfo::find(Session::get('admin_id'));
        $powerInfo = AdminPower::where('uid', Session::get('admin_id'))
            ->where('status', '1')
            ->first();
    	return view('admin.people.managerList',['adminInfo'=>$adminInfo,'manageInfo'=>$manageInfo, 'power'=>$power,'powerInfo'=>$powerInfo]);
    }

    /*待审核管理员*/
    public function managerReview()
    {
    	$adminInfo = AdminInfo::where('status', '0')
    		->paginate(10);
    	return view('admin.people.managerReview', ['adminInfo'=>$adminInfo]);
    }

    /*待审核的管理员的相关操作*/
    public function reviewOperate(Request $request)
    {
    	$id = $request->input('id');
    	$index = $request->input('index');

    	$flight = AdminInfo::find($id);
    	
    	if ($index == 1) {
    		$flight->delete();

            $flight_ut = UserType::where('type', '1')
                ->where('uid', $id)
                ->delete();
    	} else {
    		$flight->status = 1;
    		$flight->save();
    	}
    	return response()->json(['errcode'=>0]);
    }

    /*禁用*/
    public function managerRemove(Request $request)
    {
    	$id = $request->input('id');
    	$admin_id = Session::get('admin_id');
    	if ($admin_id == $id) {
    		return response()->json(['errcode'=>1]);
    		/*自己不能禁用自己*/
    	}
    	$flight = AdminInfo::find($id);
    	$flight->status = -1;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }

    public function managerOpen(Request $request)
    {
    	$id = $request->input('id');
    	$flight = AdminInfo::find($id);
    	$flight->status = 1;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }

    /*家长信息*/
    public function parentInfo(Request $request)
    {
    	$res = ParentDetail::where('parent_detail.status','1')
    	->leftJoin('parent_info','parent_detail.pid','=','parent_info.id')
    	->select('parent_info.name as nickname','parent_detail.id','parent_detail.name','parent_info.phone','sex','type','address','place')
    	->paginate(10);
    	for($i = 0; $i < count($res); $i++){
    		if(isset($res[$i]->address)){ 
    			$address3 = CommunityCommunity::where('id',$res[$i]->address)
    			->select('aid','name')
    			->get();
    			$address2 = CommunityArea::where('id',$address3[0]->aid)
    			->select('cid','name')
    			->get();
    			$address1 = CommunityCity::where('id',$address2[0]->cid)
    			->select('name')
    			->get();
    			$res[$i]->address = $address1[0]->name.$address2[0]->name.$address3[0]->name;
    		}
    	}
    	return view('admin.people.parentInfo',['res'=>$res]);
    }

    /*教师信息*/
    public function teacherInfo(Request $request)
    {
    	$res = TeacherDetail::where('teacher_detail.status','1')
    		->leftJoin('teacher_info','teacher_detail.tid','teacher_info.id')
    		->select('teacher_info.name as nickname','teacher_detail.id','teacher_detail.name','phone','sex','type','project','find_status','address','money','hobby','subject')
    		->paginate(10);
    	if(isset($res->hobby)){
    		
    	}
    	for($i = 0; $i < count($res); $i++){
    		
    		$arr = explode('-',$res[$i]->money);
    		if(isset($arr[1]) && $arr[1] == 1){
    			$res[$i]->money = $arr[0].'/月';
    		}else if($arr[0]){
    			$res[$i]->money = $arr[0].'/'.$arr[1].'分钟';
    		}else{
    			$res[$i]->money = '暂未填写';
    		}
            if( !empty( $res[$i]->hobby ) ){
                $arr1 = explode('-',$res[$i]->hobby);

                $hobby = '';

                for ($j = 0; $j < count($arr1); $j++){
                    $hobbyObj = Hobby::find($arr1[$j]);
                    $hobby = $hobby.'、'.$hobbyObj->name;
                }
                $res[$i]->aihao = substr($hobby,3,strlen($hobby));
            }else{
                 $res[$i]->aihao = '';
            }
/*    		if(count($arr1) > 0){
    			for ($j = 0; $j < count($arr1); $j++) {
    				$hobbyObj = Hobby::find($arr1[$j]);
    				$hobby = $hobby.'、'.$hobbyObj->name;
    			}
    			$res[$i]->aihao = substr($hobby,3,strlen($hobby));
    		}else{
    			$res[$i]->aihao = '';
    		}*/
    	}
        return view('admin.people.teacherInfo',['res'=>$res]);
    }
    public function expect(Request $request)
    {
    	$id = $request->input('id');
    	$teacher = TeacherDetail::find($id);
    	if (empty($teacher->address)) {
    		return response()->json(['code'=>233]);
    	}
    	$arr = explode('-',$teacher->address);
    	for($i = 0; $i < count($arr); $i++){
    		$address3 = CommunityCommunity::where('id',$arr[$i])
    		->select('aid','name')
    		->get();
    		$address2 = CommunityArea::where('id',$address3[0]->aid)
    		->select('cid','name')
    		->get();
    		$address1 = CommunityCity::where('id',$address2[0]->cid)
    		->select('name')
    		->get();
    		$res[$i] = $address1[0]->name.$address2[0]->name.$address3[0]->name;
    	}
    	return response()->json(['code'=>200,'res'=>$res]);
    }
    public function share(Request $request)
    {
    	$phone = $request->input('phone');
    	$Shareobj = UserShare::where('user_share.status', '1')
    				->leftJoin('new_user', 'user_share.pid', 'new_user.id');
    	$str = '';
    	if ($phone) {
    		$Shareobj = $Shareobj->where('new_user.phone', 'like', $phone.'%');
    		$str .= '&phone='.$phone;	
    	}
    	$Shareobj = $Shareobj->orderBy('user_share.created_at', 'desc')
    					->select('user_share.id','user_share.pid','new_user.nickname','new_user.type','new_user.phone')
    					->groupBy('user_share.pid')
    					->paginate(10);
    	foreach ($Shareobj as $key => $value) {
    		//总分享数量
    		$Shareobj[$key]['count'] = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status',1)->count();
    		//更新成功关注状态
      		$openids = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status', 1)->where('subscribe' ,0)->select('openid','id')->get();
    		foreach ($openids as $value2) {
    			$openid = $value2->openid;
    			$access_token = Wechat::get_access_token();
    			$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
    			$userinfo = Wechat::curl($url);
    			if ($userinfo['subscribe'] == 1) {
    				$usershare = UserShare::find($value2->id);
    				$usershare->subscribe = 1;
    				$usershare->save();
    			}
    		}  
    		//用户成功关注数量
			$Shareobj[$key]['succeed'] = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status',1)->where('subscribe',1)->count();
    	}
    	return view('admin.share',['res'=>$Shareobj, 'str'=>$str, 'phone'=>$phone]);
    }


    public function setPower(Request $request) {
        // $admin_id = Session::get('admin_id');
        $id = $request->input('id');

        $power = $request->input('power');

        AdminPower::where('uid', $id)
            ->where('status', '1')
            ->update($power);

        return response()->json(['errcode'=>0]);
    }
}
