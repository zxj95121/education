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
use Session;

class ManagerController extends Controller
{
    public function managerList()
    {
    	$adminInfo = AdminInfo::where('status', '=', '1')
    		->orwhere('status', '-1')
    		->orderby('status', 'desc')
    		->paginate(10);

    	$manageInfo = AdminInfo::find(Session::get('admin_id'));
    	return view('admin.people.managerList',['adminInfo'=>$adminInfo,'manageInfo'=>$manageInfo]);
    }

    /*待审核管理员*/
    public function managerReview()
    {
    	$adminInfo = AdminInfo::where('status', '0')
    		->paginate(10);
    	return view('admin.people.managerReview',['adminInfo'=>$adminInfo]);
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
    		if($arr[1] == 1){
    			$res[$i]->money = $arr[0].'/月';
    		}else{
    			$res[$i]->money = $arr[0].'/'.$arr[1].'分钟';
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
    	$Shareobj = UserShare::where('user_share.status', '1')
    				->leftJoin('new_user', 'user_share.pid', 'new_user.id')
    				->select('user_share.id','user_share.pid','new_user.nickname','new_user.type','new_user.phone')
    				->groupBy('user_share.pid')
    				->get();
    	
    	foreach ($Shareobj as $key => $value) {
    		$Shareobj[$key]['count'] = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status',1)->count();
    	}
    	dump($Shareobj);
    }
}
