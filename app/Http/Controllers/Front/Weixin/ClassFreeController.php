<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;
use App\Http\Controllers\Front\TestingPhoneController;
use App\Models\ClassFree;
use App\Models\ClassFreeActiveTime;

use Session;

class ClassFreeController extends Controller
{
   	public function index(Request $request)
   	{
         if (!Session::has('openid')) {
            return redirect('/front/classFree/oauth');
         }
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
   				if($freeObj->type == 0){
   					return response()->json(['code'=>3,'msg'=>'已报名成功，三日内收到具体时间通知']);
   				}else{
   					return  response()->json(['code'=>2,'msg'=>'您已预约，预约的时间是'.$freeObj->active_time]);
   				}
   			}else{
   				$freeObj = new ClassFree();
   				$freeObj->uid = $new_user_id;
   				$freeObj->save();
   				return response()->json(['code'=>1,'msg'=>'已报名成功，三日内收到具体时间通知']);
   			}
   		} else {
   			return response()->json(['code'=>-1]);
   		}
   	}
}
