<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;
use App\Http\Controllers\Front\TestingPhoneController;
use App\Models\ClassFree;
use App\Models\ClassFreeActiveTime;
class ClassFreeController extends Controller
{
   	public function index(Request $request)
   	{
   		$timeObj = ClassFreeActiveTime::find(1);
   		return view('front.views.weixin.classFree',['freeTime'=>$timeObj]); 
   	}
   	public function oauth()
   	{
   		return redirect(OauthController::getUrl(12, 0));
   	}
   	public function add_post()
   	{
   		$new_user_id = TestingPhoneController::is_phone();
   		if ($new_user_id) {
   			$freeObj = ClassFree::where('uid',$new_user_id)->first();
   			if(isset($freeObj->id)){
   				if(empty($freeObj->active_time)){
   					return response()->json(['code'=>3,'msg'=>'未填写预约时间','id'=>$freeObj->id]);
   				}else{
   					return  response()->json(['code'=>2,'msg'=>'请勿重复领取']);
   				}
   			}else{
   				$freeObj = new ClassFree();
   				$freeObj->uid = $new_user_id;
   				$freeObj->save();
   				return response()->json(['code'=>1,'msg'=>'已经领取成功','id'=>$freeObj->id]);
   			}
   		} else {
   			return response()->json(['code'=>-1]);
   		}
   	}
   	public function add_time(Request $request)
   	{
   		$active_time = $request->input('active_time');
   		$id = $request->input('id');
   		$timeCount = ClassFree::where('active_time',$active_time)->count();
   		if ($timeCount >= 12) {
   			return response()->json(['code'=>-1]);
   		} else {
   			$freeObj =  ClassFree::find($id);
   			$freeObj->active = $active_time;
   			$freeObj->save();
   			return response()->json(['code'=>1]);
   		}
   	}
}
