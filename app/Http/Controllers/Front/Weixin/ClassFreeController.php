<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;
use App\Http\Controllers\Front\TestingPhoneController;
use App\Models\ClassFree;

class ClassFreeController extends Controller
{
   	public function index(Request $request)
   	{
   		return view('front.views.weixin.classFree'); 
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
   				return  response()->json(['code'=>2,'msg'=>'请勿重复领取']);
   			}else{
   				$freeObj = new ClassFree();
   				$freeObj->uid = $new_user_id;
   				$freeObj->save();
   				return response()->json(['code'=>1,'msg'=>'已经领取成功']);
   			}
   		} else {
   			return response()->json(['code'=>-1]);
   		}
   	}
}
