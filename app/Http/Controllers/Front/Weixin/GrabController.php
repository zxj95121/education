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
    	
    	$id = Session::get('grab')['id'];
    	$discountObj = Discount::where('discount.id',$id)
    					->leftJoin('class_package','discount.pid','class_package.id')
    					->select('discount.id','class_package.name','discount.start_time','discount.probability')
    					->get()[0];
    	Session::forget('grab');
    	$discountType = UserDiscount::where('discount_id',$id)->where('status',1)->where('type','!=','0')->count();
    	if ($discountType > 0) {
    		//已经进行过抽奖,公布名单
    		$usercount = UserDiscount::where('discount_id',$id)->where('type',1)->where('status',1)->count();
    		$downtime = time() - strtotime($discountObj->start_time);
    		if ($downtime < $usercount){
    			//未完全显示，需要发送ajax
    			$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
    						->leftJoin('new_user','user_discount.uid','new_user.id')
    						->leftJoin('discount','user_discount.discount_id','discount.id')
    						->leftJoin('class_package','discount.pid','class_package.id')
    						->select('user_discount.id','nickname','class_package.name')
    						->limit($downtime)
    						->get();
    			$code = 233;
    		} else {
    			$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
    					->leftJoin('new_user','user_discount.uid','new_user.id')
    					->leftJoin('discount','user_discount.discount_id','discount.id')
    					->leftJoin('class_package','discount.pid','class_package.id')
    					->select('user_discount.id','nickname','class_package.name')
    					->get();
    			$code = 200;
    		}
    	} else {
    		$newtime = strtotime('2017-07-30 16:16:01');
    		if ($newtime >= strtotime($discountObj->start_time)) {
    			//活动已经开始，进行抽奖
    			$usercount = UserDiscount::where('discount_id',$id)->where('status',1)->count();
    			if($usercount == 1){
    				$userdiscountObj = UserDiscount::where('discount_id',$id)->where('status',1)->first();
    				$userdiscountObj->type = 1;
    				$userdiscountObj->save();
    			}else{
    				$gailv = intval($usercount * $discountObj->probability * 0.01);
    				
    				if ($gailv < 1) {
    					$num = 1;
    				} else {
    					$num = $gailv;
    				}
    				$userdiscountArray = UserDiscount::where('discount_id',$id)->where('status',1)->get()->toArray();
    				$newArray = array_flip(array_rand($userdiscountArray,$num));
    				foreach($userdiscountArray as $key=>$value){
    					if (array_key_exists($key,$newArray)){
    						$type = 1;
    						/* 已中奖 发布通知  */
    					}else{
    						$type = -1;
    					}
    					$userdiscountObj = UserDiscount::find($userdiscountArray[$key]['id']);
    					$userdiscountObj->type = $type;
    					$userdiscountObj->save();
    				}
    			}
    			//已经进行过抽奖,公布名单
    			$usercount = UserDiscount::where('discount_id',$id)->where('type',1)->where('status',1)->count();
    			$downtime = $newtime - strtotime($discountObj->start_time);
    			if ($downtime < $usercount){
    				//未完全显示，需要发送ajax
    				$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
    				->leftJoin('new_user','user_discount.uid','new_user.id')
    				->leftJoin('discount','user_discount.discount_id','discount.id')
    				->leftJoin('class_package','discount.pid','class_package.id')
    				->select('user_discount.id','nickname','class_package.name')
    				->limit($downtime)
    				->get();
    				$code = 233;
    			} else {
    				$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
    				->leftJoin('new_user','user_discount.uid','new_user.id')
    				->leftJoin('discount','user_discount.discount_id','discount.id')
    				->leftJoin('class_package','discount.pid','class_package.id')
    				->select('user_discount.id','nickname','class_package.name')
    				->get();
    				$code = 200;
    			}
    		}
    	}
    	if(!isset($lucky)){
    		$lucky = '';
    		$code = 200;
    	}
    	return view('front.views.weixin.grab', ['res'=>$discountObj,'lucky'=>$lucky,'code'=>$code]);
    }
    public function join(Request $request)
    {
    	$id = $request->input('id');
    	$openid = Session::get('openid');
    	$newuserObj = NewUser::where('openid',$openid)->get();
    	if (isset($newuserObj[0])) {
    		//判断是否输入手机号
    		$discountObj = Discount::find($id);
    		if($discountObj->status == -1){
    			//活动已结束
    			return response()->json(['code'=>2, 'msg'=>'活动已经结束，感谢您的参与']);
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
    //倒计时
    public function countdown(Request $request){
    	dump(Session::has('newtime'));
    	if(Session::has('newtime')){
    		$newtime = Session::get('newtime');
    		$newtime++;
    		Session::put('newtime',$newtime);
    	}else{
    		$newtime = '1501402562';
    		Session::put('newtime',$newtime);
    		dump(Session::all());
    	} 
   		//$newtime = time();
    	$id = $request->input('id');
    	$discountObj = Discount::find($id);
    	$usercount = UserDiscount::where('discount_id',$id)->where('type',1)->where('status',1)->count();
    	$downtime = $newtime - strtotime($discountObj->start_time);
    	echo $downtime.'------'.$usercount;
    	die('hhhhh');
/*     	if ($downtime < $usercount){
    		$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
			    		->leftJoin('new_user','user_discount.uid','new_user.id')
			    		->leftJoin('discount','user_discount.discount_id','discount.id')
			    		->leftJoin('class_package','discount.pid','class_package.id')
			    		->select('user_discount.id','nickname','class_package.name')
			    		->limit($downtime)
			    		->get();
    		$code = 233;
    	} else {
    		$lucky = UserDiscount::where('discount_id',$id)->where('user_discount.type',1)->where('user_discount.status',1)
	    		->leftJoin('new_user','user_discount.uid','new_user.id')
	    		->leftJoin('discount','user_discount.discount_id','discount.id')
	    		->leftJoin('class_package','discount.pid','class_package.id')
	    		->select('user_discount.id','nickname','class_package.name')
	    		->get();
    		$code = 200;
    	} */
    	return response()->json(['lucky' => $lucky, 'code' => $code]);
    }
}
