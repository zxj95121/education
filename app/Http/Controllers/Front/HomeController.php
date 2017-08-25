<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\UserType;
use Session;
use App\Models\AdminInfo;
use App\Models\ParentInfo;
use App\Models\TeacherInfo;
use App\Models\ParentChild;
use App\Models\EclassOrder;
use App\Models\ParentDetail;
use App\Models\NewUser;
use App\Models\EclassCart;
use App\Models\SubjectOne;
use App\Models\SubjectTwo;

class HomeController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
        Session::forget('hasOrder');

		$res = $this->userType($openid);
    	if (count($res['userType'])){
    		/*newUserId*/
	    	$newUserId = NewUser::where('openid', $openid)
	    		->select('id')
	    		->get()[0]
	    		->id;

    		if ($res['type'] == '1') {
    			return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0],'newUserId'=>$newUserId]);
    		} elseif ($res['type'] == '2') {
	    		$parentinfo = ParentInfo::where('openid',$openid)->select('id')->first();
	    		$child = ParentChild::where('pid',$parentinfo->id)->where('status',1)->select('id','sex','name')->get();
	    		$orderstatus[1] = EclassOrder::where('uid',$parentinfo->id)
	    			->where('status', '1')
	    			->count();
	    		$orderstatus[2] = EclassOrder::where('uid',$parentinfo->id)
		    		->where('pay_status', '1')
		    		->where('confirm_status', '1')
		    		->where('complete', '0')
		    		->where('status', '1')
		    		->count();
	    		$orderstatus[3] = EclassOrder::where('uid',$parentinfo->id)
	    			->where('complete',1)
					->where('status', 1)
					->count();
				$parentDetail = ParentDetail::where('pid', $res['data'][0]->id)->get()[0];

                /*学科信息查询*/
                $subject = SubjectOne::where('status', 1)
                    ->select('id', 'name')
                    ->get()
                    ->toArray();
                foreach ($subject as $key => $value) {
                    $subject[$key]['two'] = SubjectTwo::where('pid', $value['id'])
                        ->select('id', 'name', 'pid')
                        ->get()
                        ->toArray();
                }
                if ($parentDetail->id == 21) {
                    return view('front.views.home.homepage2',['userType'=>$res['userType'][0],'res'=>$res['data'][0],'child'=>$child,'orderstatus'=>$orderstatus,'parentDetail'=>$parentDetail,'newUserId'=>$newUserId,'subject'=>$subject]);
                }
	    		return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0],'child'=>$child,'orderstatus'=>$orderstatus,'parentDetail'=>$parentDetail,'newUserId'=>$newUserId]);
	    	} elseif ($res['type'] == '3') {
	    		return view('front.views.home.homepage',['userType'=>$res['userType'][0],'res'=>$res['data'][0],'newUserId'=>$newUserId]);
	    	} else {
	    		exit;
	    	}
    	} else {
    		return redirect('/front/register/oauth');
    	}
    }
	public function userType($openid)
	{
		$res['userType'] = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get();
		if(count($res['userType']) == 0){
			return $res;	
		}
		switch($res['userType'][0]->type){
			case '1':
				$res['data'] = AdminInfo::where('id',$res['userType'][0]->uid)->get();
				$res['type'] = $res['userType'][0]->type;
				break;
			case '2':
				$res['data'] = ParentInfo::where('id',$res['userType'][0]->uid)->get();
				$res['type'] = $res['userType'][0]->type;
				break;
			case '3';
				$res['data'] = TeacherInfo::where('id',$res['userType'][0]->uid)->get();
				$res['type'] = $res['userType'][0]->type;
				break;
		}
		return $res;
	}
	public function homeOauth()
	{
   		return redirect(OauthController::getUrl(4, 0));
	}

	private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }


    public function cartStorage(Request $request)
    {
    	$id = $request->input('id');
    	$total = $request->input('total');
    	$arr = json_decode($request->input('arr'), true);
    	$str = '[';
    	foreach ($arr as $key => $value) {
    		if (!$value) {
    			unset($arr[$key]);
    		} else {
    			$str .= '"'.$value.'",';
    		}
    	}
    	if (strlen($str) > 1) {
    		$str = substr($str, 0, -1);
    	}
    	$arr = $str.']';
    	$order = $request->input('order');

    	$count = EclassCart::where('uid', $id)
    		->count();

    	if ($count == 0) {
    		$flight = new EclassCart();
    		$flight->uid = $id;
    		$flight->total = $total;
    		$flight->arr = $arr;
    		$flight->order = $order;
    		$flight->save();
    	} else {
    		EclassCart::where('uid', $id)
    			->update(['order'=>$order,'total'=>$total,'arr'=>$arr]);
    	}
    }


    public function getCartStorage(Request $request)
    {
    	$id = $request->input('id');

    	$count = EclassCart::where('uid', $id)
    		->count();

    	$obj = EclassCart::where('uid', $id)
    		->get();

    	if ($count > 0) {
    		$a = $obj[0];
    		return response()->json(['errcode'=>0,'order'=>$a->order,'arr'=>$a->arr,'total'=>$a->total]);
    	}
    	else {
    		return response()->json(['errcode'=>1]);
    	}
    }
}
