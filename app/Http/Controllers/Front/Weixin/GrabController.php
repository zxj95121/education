<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;
use App\Models\NewUser;
use App\Models\Discount;
use App\Models\UserDiscount;
use Session;
class GrabController extends Controller
{
    public function index(Request $request)
    {
    	
    	$id = $request->input('id');
    	$discountObj = Discount::find($id);
    	return view('front.views.weixin.grab', ['res'=>$discountObj]);
    }
    public function join(Request $request)
    {
    	$id = Session::get('grab')['id'];
    	Session::forget('grab');
    	$openid = Session::get('openid');
    	$newuserObj = NewUser::where('openid',$openid)->get();
    	if (isset($newuserObj[0])) {
    		//判断是否输入手机号
    		$discountObj = Discount::find($id);
    		if($discountObj->status == -1){
    			//活动已结束
    			return response()->json(['code'=>2]);
    		}	
    		$time1 = time();
    		$time2 = strtotime($discountObj->start_time);
    		$cha = ceil(($time2-$time1)/86400);////60s*60min*24h    
    		if ($cha < 7 && $cha > 0) {
    			//活动正进行，进行报名参加;
    			$userdiscountObj = UserDiscount::where('uid',$newuserObj[0]->id)->where('discount_id',$discountObj->id)->get();
    			if (isset($userdiscountObj[0])){
    				return response()->json(['code'=>4, 'msg'=>'已参加该活动']);
    			}else{
    				$userdiscountObj = new UserDiscount();
    				$userdiscountObj->uid = $newuserObj[0]->id;
    				$userdiscountObj->discount_id = $discountObj->id;
    				$userdiscountObj->save();
    				return response()->json(['code'=>1, 'msg'=>'参加该活动成功，请注意微信通知']);
    			}
    		} else if ($cha <= 0){
    			//活动已经结束;
    			$discountObj->status = -1;
    			$discountObj->save();
    			return response()->json(['code'=>2, 'msg'=>'活动已经结束，感谢您的参与']);
    		} else {
    			//活动未开始
    			return response()->json(['code'=>3, 'msg'=>'活动还未开始，敬请期待']);
    		}
    	} else {
    		return response()->json(['code'=>-1]);
    	}
    	
    }
    /*oauth*/
    public function oauth(Request $request)
    {
    	if($request->input('id')){
    		$grab['id'] = $request->input('id');
    		Session::put('grab',$grab);
    	}
    	return redirect(OauthController::getUrl(10, 0));
    }
}
