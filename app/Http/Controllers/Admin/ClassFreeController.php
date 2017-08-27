<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassFree;
use App\Models\NewUser;
class ClassFreeController extends Controller
{
/*     public function setActiveTime()
    {
    	$freeObj = ClassFree::where('class_free.status',1)
    				->leftJoin('new_user','class_free.uid','new_user.id')
    				->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type')
    				->where('new_user.id','!=','')
    				->where('class_free.active_time',Null)
    				->paginate(10);
    	return view('admin.classFree.setActiveTime',['res'=>$freeObj]);
    } */
    public function setActiveTimeInspect(Request $request)
    {
    	$active_date = substr($request->input('active_time'),0,10);
    	$ids = $request->input('ids');
    	$num = 0;
    	for($i = 0; $i < count($ids); $i++){
    		$freeObj = ClassFree::find($ids[$i]);
    		if ($freeObj->active_date == $active_date ) {
    			$num++;
    		}
    	}
    	$count = ClassFree::where('active_date',$active_date)->where('status',1)->count();
    	$count = $count - $num;
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
/*     public function index(Request $request)
    {
    	$str = '';
    	$querytime = $request->input('hiddencxdate');
    	$freeObj = ClassFree::where('class_free.status',1)
	    	->leftJoin('new_user','class_free.uid','new_user.id')
	    	->where('new_user.id','!=','')
	    	->where('class_free.type',1);
    	if($querytime){
    		$freeObj = $freeObj->where('active_date',$querytime);
    		$str .= '&hiddencxdate='.$querytime;
    	}
    		$freeObj = $freeObj->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type')
    							->orderBy('class_free.updated_at')
    							->paginate(10);
    	return view('admin.classFree.index',['res'=>$freeObj,'str'=>$str,'querytime'=>$querytime]);
    } */
    public function notice(Request $request)
    {
    	$querytime = $request->input('hiddencxdate');
    	$querytype = $request->input('querytype');
    	$complete = $request->input('complete');
    	$str = '';
    	$freeObj = ClassFree::where('class_free.status',1)
	    	->leftJoin('new_user','class_free.uid','new_user.id')
	    	->where('new_user.id','!=','');
    	if($querytime){
    		$freeObj = $freeObj->where('active_date',$querytime);
    		$str .= '&hiddencxdate='.$querytime;
    	}
    	if($querytype != NULL){
    		$freeObj = $freeObj->where('class_free.type',$querytype);
    		$str .= '&type='.$querytype;
    	}
    	if($complete != NULL){
    		$freeObj = $freeObj->where('class_free.complete',$complete);
    		$str .= '&complete='.$complete;
    	}
    	$freeObj = $freeObj->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time','class_free.type','complete','class_free.created_at')
    	           ->orderBy('class_free.created_at')
                    ->orderBy('class_free.type')
                    ->orderBy('class_free.complete')
    				->paginate(10);
    	return view('admin.classFree.notice',['res'=>$freeObj,'str'=>$str,'querytime'=>$querytime,'querytype'=>$querytype,'complete'=>$complete]);
    }
    public function noticePost(Request $request)
    {
    	$ids = $request->input('ids');
    	for($i = 0; $i < count($ids); $i++){
    		$freeObj = ClassFree::find($ids[$i]);
    		/*发送用户通知  */
    		$userObj = NewUser::find($freeObj->uid);
    		$phone = $userObj->phone;
    		$code[] = $userObj->nickname;
    		$time = $freeObj->active_time;
    		$mm = date('a',strtotime($time));
    		if($mm == 'am'){
    			$mm = '上午';
    		}else{
    			$mm = '下午';
    		}
    		$code[] = date('Y-m-d',strtotime($time)).''.$mm.''.date('h:i',strtotime($time));
    		$code[] = '芜湖柏庄时代广场三楼加辰教育';
    		require_once($_SERVER['DOCUMENT_ROOT'].'/php/Qcloud/Sms/SmsSenderDemo.php');
    		$result = postPhoneCodeSms($phone, $code, 33644);
    		if ($result['result'] == '') {
    			$freeObj->type = 1;
    			$freeObj->save();
    		}
    	}
    	return response()->json(['code' => '1']);
    }
    public function completePost(Request $request){
    	$ids = $request->input('ids');
    	for($i = 0; $i < count($ids); $i++){
    		$freeObj = ClassFree::find($ids[$i]);
    		$freeObj->complete = 1;
    		$freeObj->save();
    	}
    	return response()->json(['code'=>'1']);
    }
}
