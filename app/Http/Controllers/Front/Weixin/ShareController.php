<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewUser;
use App\Models\UserShare;
use App\Models\HalfBuyInfo;
use App\Models\HalfBuyRecord;
use App\Models\TeacherOne;
use App\Models\ClassPrice;

use App\Http\Controllers\Wechat\OauthController;
use Session;
use Wechat;
class ShareController extends Controller
{
	public function index(Request $request)
	{
		$openid = Session::get('openid');
		
		$data = $this->select($openid);

		$userinfo = $data['userinfo'];
		$uid = $data['uid'];

		if($userinfo['subscribe'] == 0){
			/*被分享未关注  */
			if(Session::get('share')){
				$id = Session::get('share')['id'];
				$userObj = NewUser::find($id);
				if ($userObj->openid != $openid) {
					$usershare_count = UserShare::where('openid',$openid)->count();
					if ($usershare_count < 1){
						$usershare = new UserShare();
						$usershare->openid = $openid;
						$usershare->subscribe = 0;
						$usershare->pid = $id;
						$usershare->save();
						Session::forget('share');
					}
				}
			}
		}

		/*用户半价信息*/
		$halfObj = HalfBuyInfo::where('uid', $uid)
			->get()[0];

		$halfClassCount = TeacherOne::where('half_buy', 1)->count();
		if ($halfClassCount == 0) {
			/*没有半价课*/
			exit;
		}

		$halfClassObj = TeacherOne::where('half_buy', 1)
			->select('id', 'name')
			->get()[0];

		if (HalfBuyRecord::where('uid', $uid)->count() > 0) {
			$buyCount = HalfBuyRecord::where('uid', $uid)
				->where('status', 1)
				->select('count(record_num) as num')
				->get()[0]->num;
		} else {
			$buyCount = 0;
		}

		/*查用户推荐个数*/
			/*未关注*/
			// $ShareCount = UserShare::where('pid',$uid)->where('status',1)->count();
    		//更新成功关注状态
      		$openids = UserShare::where('pid',$uid)
      			->where('status', 1)
      			->where('subscribe', 0)
      			->select('openid','id')
      			->get();

    		foreach ($openids as $value2) {
    			$openid0 = $value2->openid0;
    			$access_token = Wechat::get_access_token();
    			$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid0.'&lang=zh_CN';
    			$userinfo = Wechat::curl($url);
    			if ($userinfo['subscribe'] == 1) {
    				$usershare = UserShare::find($value2->id);
    				$usershare->subscribe = 1;
    				$usershare->save();
    			}
    		} 

    		/*更新完之后查总个数，并进行更新*/
    		$shareCount = UserShare::where('pid', $uid)
    			->where('status', '1')
    			->where('subscribe', '1')
    			->count();

    		/*更新用户半价券*/
    		HalfBuyInfo::where('uid', $uid)
    			->update(['ticket_num'=>$shareCount]);


		$newuser = NewUser::where('openid',$openid)->get();
		if (count($newuser) > 0) {
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth?id=".$newuser[0]->id);
		} else{
			$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/share/oauth");
		}
		return view('front.views.weixin.share',['news'=>$news,'halfObj'=>$halfObj,'halfClassObj'=>$halfClassObj,'buyCount'=>$buyCount]);
	}
	/*oauth*/
	public function oauth(Request $request)
	{
		if($request->input('id')){
			$share['id'] = $request->input('id');
			Session::put('share',$share);
		}
		return redirect(OauthController::getUrl(7, 0));
	}

	/*halfBuyOrder用户进行购买*/

	public function halfBuyOrder(Request $request)
	{
		$halfClassCount = TeacherOne::where('half_buy', 1)->count();
		if ($halfClassCount == 0) {
			/*没有半价课*/
			exit;
		}

		$halfClassObj = TeacherOne::where('half_buy', 1)
			->select('id', 'name')
			->get()[0];


		$price = ClassPrice::where('tid', $halfClassObj->id)
			->where('status', '1')
			->orderBy('id')
			->select('price')
			->get()[0];



		/*/*用户半价信息*-/*/
		$uid = NewUser::where('openid', Session::get('openid'))
			->select('id')
			->get()[0]->id;
		$halfObj = HalfBuyInfo::where('uid', $uid)
			->get()[0];

		return view('front.views.weixin.halfBuyOrder', ['halfClassObj'=>$halfClassObj, 'halfObj'=>$halfObj,'price'=>$price]);
	}

	public function makeOrder(Request $request)
	{
		$num = (int)$request->input('num');

		$halfClassObj = TeacherOne::where('half_buy', 1)
			->select('id', 'name')
			->get()[0];


		$price = ClassPrice::where('tid', $halfClassObj->id)
			->where('status', '1')
			->orderBy('id')
			->select('price')
			->get()[0];

		$uid = NewUser::where('openid', Session::get('openid'))
			->select('id')
			->get()[0]->id;

		$flight = new HalfBuyRecord();
		$flight->order_no = 'HB'.date('Y-m-d H:i:s').rand(10000,99999);
		$flight->uid = $uid;
		$flight->tid = $halfClassObj->id;
		$flight->record_num = $num;
		$flight->price = $num*((int)number_format(0.5*$price->price, 2));
		$flight->save();

		$oid = $flight->id;
		/*更新剩余,更新已使用*/
		$ticket = HalfBuyInfo::where('uid', $uid)
			->select('ticket_num', 'used_num')
			->get()[0];

		$ticket_num = (int)($ticket->ticket_num) - $num;
		$used_num = (int)($ticket->used_num) + $num;

		HalfBuyInfo::where('uid', $uid)
			->update(['ticket_num'=>$ticket_num, 'used_num'=>$used_num]);

		return response()->json(['errcode'=>0,'oid'=>$oid]);

	}

	/*支付order订单*/

	public function payOrder(Request $request)
	{
		$id = $request->input('id');

		$orderObj = HalfBuyRecord::where('half_buy_record.id', $id)
			->leftJoin('teacher_on as to', 'to.id', 'half_buy_record.tid')
			->select('to.name', 'half_buy_record.*')
			->get()[0];
		return view('front.views.weixin.payOrder', ['orderobj'=>$orderObj]);
	}

	/*用户判断，new_user表以及half_buy_info表*/

	private function select($openid)
	{
		$exists = NewUser::where('openid', $openid)
			->count();

		$access_token = Wechat::get_access_token();
		/*获取用户个人详细信息*/
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
		$userinfo = Wechat::curl($url);

		if (!$exists) {
			/*不存在*/
			$flight = new NewUser();
			$flight->openid = $openid;
			$flight->type = 0;
			$flight->voucher = 0;
			$flight->nickname = $userinfo['nickname'];
			$flight->headimgurl = $userinfo['headimgurl'];
			$flight->worker_id = 0;
			$flight->save();
 
			$uid = $flight->id;
		} else {
			$uid = NewUser::where('openid', $openid)
				->select('id')
				->get()[0]
				->id;
		}

		$buyExists = HalfBuyInfo::where('uid', $uid)
			->count();

		if (!$buyExists) {
			/*不存在buy_info*/
			$flight = new HalfBuyInfo();
			$flight->uid = $uid;
			$flight->ticket_num = 0;
			$flight->save();
		}

		$data['userinfo'] = $userinfo;
		$data['uid'] = $uid;
		return $data;
	}
	
}
