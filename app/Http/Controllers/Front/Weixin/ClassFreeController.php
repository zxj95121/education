<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;
use App\Http\Controllers\Front\TestingPhoneController;
use App\Models\ClassFree;
use App\Models\NewUser;
use Session;

class ClassFreeController extends Controller
{
   	public function index(Request $request)
   	{
         if (!Session::has('openid')) {
            return redirect('/front/classFree/oauth');
         }
   		$userObj = NewUser::where('openid',Session::get('openid'))->first();
   		if(isset($userObj->id)){
   			$freeObj = ClassFree::where('uid',$userObj->id)->first();
   			if(isset($freeObj->id)){
   				$mmsg = '已领取';
   			}else{
   				$mmsg = '免费领取';
   			}
   		}else{
   			$mmsg = '免费领取';
   		}
   		return view('front.views.weixin.classFree',['mmsg'=>$mmsg]); 
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
   				if($freeObj->complete == 1){
   					return	response()->json(['code'=>5,'msg'=>'您已体验免费试听课。如您不满意，请告诉我们；如您满意，请与您的好友分享～谢谢^_^']);
   				}else if($freeObj->active_time){
   					return response()->json(['code'=>4,'msg'=>'你已预约成功，谢谢关注']);
   				}else{
   					return  response()->json(['code'=>2,'msg'=>'您已预约成功，加辰教育将在三日内短信通知您具体上课时间和地点，敬请关注。']);
   					
   				}
   			}else{
   				$freeObj = new ClassFree();
   				$freeObj->uid = $new_user_id;
   				$freeObj->save();
   				return response()->json(['code'=>1,'msg'=>'您已预约成功，加辰教育将在三日内短信通知您具体上课时间和地点，敬请关注。']);
   			}
   		} else {
   			return response()->json(['code'=>-1]);
   		}
   	}
}
