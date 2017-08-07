<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassFree;
use App\Models\NewUser;
class ClassFreeController extends Controller
{
    public function setActiveTime()
    {
    	$freeObj = ClassFree::where('class_free.status',1)
    				->leftJoin('new_user','class_free.uid','new_user.id')
    				->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type')
    				->where('new_user.id','!=','')
    				->where('class_free.active_time',Null)
    				->paginate(10);
    	return view('admin.classFree.setActiveTime',['res'=>$freeObj]);
    }
    public function setActiveTimeInspect(Request $request)
    {
    	$active_date = substr($request->input('active_time'),0,10);
    	$count = ClassFree::where('active_date',$active_date)->where('status',1)->count();
    	return response()->json(['code' => 1 , 'count'=>$count]);

    }
    public function setActiveTimePost(Request $request)
    {
    	$ids = $request->input('ids');
    	$active_time = $request->input('active_time');
    	for($i = 0; $i < count($ids); $i++){
    		
    		$freeObj = ClassFree::find($ids[$i]);
    		$freeObj->active_time = $active_time;
    		$freeObj->active_date = substr($active_time,0,10);
    		$freeObj->save();
    	}
    	return response()->json(['code' => '1']);
    }
    public function index()
    {
    	$freeObj = ClassFree::where('class_free.status',1)
	    	->leftJoin('new_user','class_free.uid','new_user.id')
	    	->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type')
	    	->where('new_user.id','!=','')
	    	->where('class_free.type',1)
	    	->paginate(10);
    	return view('admin.classFree.index',['res'=>$freeObj]);
    }
    public function notice()
    {
    	$freeObj = ClassFree::where('class_free.status',1)
	    	->leftJoin('new_user','class_free.uid','new_user.id')
	    	->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type')
	    	->where('new_user.id','!=','')
	    	->where('class_free.active_time','!=',Null)
	    	->where('class_free.type',0)
	    	->paginate(10);
    	return view('admin.classFree.notice',['res'=>$freeObj]);
    }
    public function noticePost(Request $reqeust)
    {
    	$ids = $request->input('ids');
    	for($i = 0; $i < count($ids); $i++){
    		$freeObj = ClassFree::find($ids[$i]);
    		/*发送用户通知  */
    		$userObj = NewUser::find($ids[$i]);
    		$phone = $userObj->phone;
    		$code[] = $userObj->nickname;
    		$code[] = $freeObj->active_time.''.'';
    		require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
    		$result = postPhoneCodeSms($phone, $code, 32502);
    		if ($result['result'] == '') {
    			$freeObj->type = 1;
    			$freeObj->save();
    		}
    	}
    	return response()->json(['code' => '1']);
    }
}
