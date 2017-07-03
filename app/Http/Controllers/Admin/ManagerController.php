<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use App\Models\UserType;
use App\Models\TeacherDetail;
use App\Models\ParentDetail;
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
    	->leftJoin('parent_info','parent_detail.pid','parent_info.id')
    	->select('parent_info.name as nickname','parent_detail.id','parent_detail.name','parent_info.phone','sex','type','address','place')
    	->paginate(10);
    	return view('admin.people.parentInfo',['res'=>$res]);
    }

    /*教师信息*/
    public function teacherInfo(Request $request)
    {
    	$res = TeacherDetail::where('teacher_detail.status','1')
    		->leftJoin('teacher_info','teacher_detail.tid','teacher_info.id')
    		->select('teacher_info.name as nickname','teacher_detail.id','teacher_detail.name','phone','sex','type','project','find_status','address','money','hobby','subject')
    		->paginate(10);
        return view('admin.people.teacherInfo',['res'=>$res]);
    }
}
