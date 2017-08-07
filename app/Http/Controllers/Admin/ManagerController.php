<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminInfo;
use App\Models\UserType;
use App\Models\TeacherDetail;
use App\Models\TeacherInfo;
use App\Models\ParentDetail;
use App\Models\ParentInfo;
use App\Models\CommunityCommunity;
use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\Hobby;
use App\Models\NewUser;
use App\Models\UserShare;
use App\Models\AdminPower;
use App\Models\BigOrder;
use App\Models\EclassOrder;
use App\Models\Bill;
use App\Models\SchoolApply;
use App\Models\HobbyApply;
use App\Models\ContactChat;
use App\Models\HalfBuyInfo;
use App\Models\HalfBuyRecord;

use Session;
use Wechat;
use DB;

class ManagerController extends Controller
{
    public function managerList()
    {
    	$adminInfo = AdminInfo::where('admin_info.status', '=', '1')
    		->orwhere('admin_info.status', '-1')
            ->leftJoin('admin_power as ap', 'ap.uid', 'admin_info.id')
    		->orderby('admin_info.status', 'desc')
            ->orderby('admin_info.id')
            ->select('admin_info.nickname', 'admin_info.id as aid', 'admin_info.name', 'admin_info.phone', 'admin_info.identity', 'admin_info.status as aStatus', 'admin_info.count', 'ap.*')
    		->paginate(10);

        $power = array();
        foreach($adminInfo as $value) {
            $power[$value->aid]['set_power'] = $value->set_power;
            $power[$value->aid]['chat'] = $value->chat;
        }
        $power = json_encode($power);
    	$manageInfo = AdminInfo::find(Session::get('admin_id'));
        $powerInfo = AdminPower::where('uid', Session::get('admin_id'))
            ->where('status', '1')
            ->first();
    	return view('admin.people.managerList',['adminInfo'=>$adminInfo,'manageInfo'=>$manageInfo, 'power'=>$power,'powerInfo'=>$powerInfo]);
    }

    /*待审核管理员*/
    public function managerReview()
    {
    	$adminInfo = AdminInfo::where('status', '0')
    		->paginate(10);
    	return view('admin.people.managerReview', ['adminInfo'=>$adminInfo]);
    }

    /*待审核的管理员的相关操作*/
    public function reviewOperate(Request $request)
    {
    	$id = $request->input('id');
    	$index = $request->input('index');

    	$flight = AdminInfo::find($id);
    	
    	if ($index == 1) {
    		$flight->delete();

            $flight_ut = UserType::where('type', '1')
                ->where('uid', $id)
                ->delete();
    	} else {
    		$flight->status = 1;
    		$flight->save();
    	}
    	return response()->json(['errcode'=>0]);
    }

    /*禁用*/
    public function managerRemove(Request $request)
    {
    	$id = $request->input('id');
    	$admin_id = Session::get('admin_id');
    	if ($admin_id == $id) {
    		return response()->json(['errcode'=>1]);
    		/*自己不能禁用自己*/
    	}
    	$flight = AdminInfo::find($id);
    	$flight->status = -1;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }

    public function managerOpen(Request $request)
    {
    	$id = $request->input('id');
    	$flight = AdminInfo::find($id);
    	$flight->status = 1;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }

    /*家长信息*/
    public function parentInfo(Request $request)
    {
    	$res = ParentDetail::where('parent_detail.status','1')
    	->leftJoin('parent_info','parent_detail.pid','=','parent_info.id')
    	->select('parent_info.name as nickname','parent_info.id','parent_detail.name','parent_info.phone','sex','type','address','place')
    	->paginate(10);
    	for($i = 0; $i < count($res); $i++){
    		if(isset($res[$i]->address)){ 
    			$address3 = CommunityCommunity::where('id',$res[$i]->address)
    			->select('aid','name')
    			->get();
    			$address2 = CommunityArea::where('id',$address3[0]->aid)
    			->select('cid','name')
    			->get();
    			$address1 = CommunityCity::where('id',$address2[0]->cid)
    			->select('name')
    			->get();
    			$res[$i]->address = $address1[0]->name.$address2[0]->name.$address3[0]->name;
    		}
    	}
    	return view('admin.people.parentInfo',['res'=>$res]);
    }

    /*教师信息*/
    public function teacherInfo(Request $request)
    {
    	$res = TeacherDetail::where('teacher_detail.status','1')
    		->leftJoin('teacher_info','teacher_detail.tid','teacher_info.id')
    		->select('teacher_info.name as nickname','teacher_info.id','teacher_detail.name','phone','sex','type','project','find_status','address','money','hobby','subject')
    		->paginate(10);

    	for($i = 0; $i < count($res); $i++){
    		
    		$arr = explode('-',$res[$i]->money);
    		if(isset($arr[1]) && $arr[1] == 1){
    			$res[$i]->money = $arr[0].'/月';
    		}else if($arr[0]){
    			$res[$i]->money = $arr[0].'/'.$arr[1].'分钟';
    		}else{
    			$res[$i]->money = '暂未填写';
    		}
            if( !empty( $res[$i]->hobby ) ){
                $arr1 = explode('-',$res[$i]->hobby);

                $hobby = '';

                for ($j = 0; $j < count($arr1); $j++){
                    $hobbyObj = Hobby::find($arr1[$j]);
                    $hobby = $hobby.'、'.$hobbyObj->name;
                }
                $res[$i]->aihao = substr($hobby,3);
            }else{
                 $res[$i]->aihao = '';
            }
/*    		if(count($arr1) > 0){
    			for ($j = 0; $j < count($arr1); $j++) {
    				$hobbyObj = Hobby::find($arr1[$j]);
    				$hobby = $hobby.'、'.$hobbyObj->name;
    			}
    			$res[$i]->aihao = substr($hobby,3,strlen($hobby));
    		}else{
    			$res[$i]->aihao = '';
    		}*/
    	}
        return view('admin.people.teacherInfo',['res'=>$res]);
    }
    public function expect(Request $request)
    {
    	$id = $request->input('id');
    	$teacher = TeacherDetail::find($id);
    	if (empty($teacher->address)) {
    		return response()->json(['code'=>233]);
    	}
    	$arr = explode('-',$teacher->address);
    	for($i = 0; $i < count($arr); $i++){
    		$address3 = CommunityCommunity::where('id',$arr[$i])
    		->select('aid','name')
    		->get();
    		$address2 = CommunityArea::where('id',$address3[0]->aid)
    		->select('cid','name')
    		->get();
    		$address1 = CommunityCity::where('id',$address2[0]->cid)
    		->select('name')
    		->get();
    		$res[$i] = $address1[0]->name.$address2[0]->name.$address3[0]->name;
    	}
    	return response()->json(['code'=>200,'res'=>$res]);
    }
    public function share(Request $request)
    {
    	$phone = $request->input('phone');
    	$Shareobj = UserShare::where('user_share.status', '1')
    				->leftJoin('new_user', 'user_share.pid', 'new_user.id');
    	$str = '';
    	if ($phone) {
    		$Shareobj = $Shareobj->where('new_user.phone', 'like', $phone.'%');
    		$str .= '&phone='.$phone;	
    	}
    	$Shareobj = $Shareobj->orderBy('user_share.created_at', 'desc')
                        ->where('new_user.id', '!=', '')
    					->select('user_share.id','user_share.pid','new_user.nickname','new_user.type','new_user.phone')
    					->groupBy('user_share.pid')
    					->paginate(10);
    	foreach ($Shareobj as $key => $value) {
    		//总分享数量
    		$Shareobj[$key]['count'] = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status',1)->count();
    		//更新成功关注状态
      		$openids = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status', 1)->where('subscribe' ,0)->select('openid','id')->get();
/*     		foreach ($openids as $value2) {
    			$openid = $value2->openid;
    			$access_token = Wechat::get_access_token();
    			$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
    			$userinfo = Wechat::curl($url);
    			if ($userinfo['subscribe'] == 1) {
    				$usershare = UserShare::find($value2->id);
    				$usershare->subscribe = 1;
    				$usershare->save();
    			}
    		}   */
    		//用户成功关注数量
			$Shareobj[$key]['succeed'] = UserShare::where('pid',$Shareobj[$key]['pid'])->where('status',1)->where('subscribe',1)->count();

            /*用户的半价券*/
            $uid = $Shareobj[$key]['pid'];
            /*在别人的代码上改*/
            $halfBuyInfo = HalfBuyInfo::where('uid', $uid)
                ->first();
            $Shareobj[$key]['ticket'] = $halfBuyInfo;
            /*半价券购买订单状态*/
            $halfBuyRecordStatus = HalfBuyRecord::where('uid', $uid)
                ->where('status', 1)
                ->where('pay_status', 1)
                ->where('confirm_status', 0)
                ->count();
            $Shareobj[$key]['confirm'] = $halfBuyRecordStatus;
    	}

    	return view('admin.share',['res'=>$Shareobj, 'str'=>$str, 'phone'=>$phone]);
    }


    /*ajax getRecords*/
    public function getRecords(Request $request)
    {
        $uid = $request->input('uid');
        $records = HalfBuyRecord::where('half_buy_record.uid', $uid)
            ->where('half_buy_record.status', '1')
            ->where('half_buy_record.pay_status', 1)
            ->leftJoin('teacher_one as to', 'to.id', 'half_buy_record.tid')
            ->orderBy('half_buy_record.confirm_status')
            ->select('half_buy_record.*', 'to.name')
            ->get();

        return response()->json(['errcode'=>0,'record'=>$records]);
    }

    /*ajax confirmRecord*/
    public function confirmRecord(Request $request)
    {
        $rid = $request->input('rid');

        $flight = HalfBuyRecord::find($rid);
        $flight->confirm_status = 1;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }



    public function setPower(Request $request) {
        // $admin_id = Session::get('admin_id');
        $id = $request->input('id');

        $power = $request->input('power');

        AdminPower::where('uid', $id)
            ->where('status', '1')
            ->update($power);

        return response()->json(['errcode'=>0]);
    }

    public function deleteTeacher(Request $request)
    {
        $id = $request->input('id');
        $flight = TeacherInfo::find($id);
        $openid = $flight->openid;

        // $userInfo = UserType::where('uid', $id)
        //     ->where('type', 3)
        //     ->select('openid', 'id')
        //     ->first();
        // $user_id = $userInfo->id;

        /*查出所有的big_order*/
        $BigOrder = BigOrder::where('openid', $openid)
            ->select('id')
            ->get();

        DB::beginTransaction();
        /*删除订单表和交易表*/
        foreach ($BigOrder as $value) {
            $bid = $value->bid;
            EclassOrder::where('bid', $bid)->delete();
            Bill::where('oid', $bid)->delete();
            BigOrder::where('id', $bid)->delete();
        }

        $nid = NewUser::where('openid', $openid)->first();

        ContactChat::where('uid', $nid)->delete();

        HobbyApply::where('openid', $openid)->delete();
        SchoolApply::where('openid', $openid)->delete();
        UserShare::where('openid', $openid)->delete();
        TeacherInfo::where('openid', $openid)->delete();
        TeacherDetail::where('tid', $id)->delete();
        UserType::where('openid', $openid)->delete();
        NewUser::where('openid', $openid)->delete();
        AdminInfo::where('openid', $openid)->delete();

        DB::commit();
        return response()->json(['errcode'=>0]);
    }

    public function deleteParent(Request $request)
    {
        $id = $request->input('id');
        $flight = ParentInfo::find($id);
        $openid = $flight->openid;

        /*查出所有的big_order*/
        $BigOrder = BigOrder::where('openid', $openid)
            ->select('id')
            ->get();

        DB::beginTransaction();
        /*删除订单表和交易表*/
        foreach ($BigOrder as $value) {
            $bid = $value->bid;
            EclassOrder::where('bid', $bid)->delete();
            Bill::where('oid', $bid)->delete();
            BigOrder::where('id', $bid)->delete();
        }

        $nid = NewUser::where('openid', $openid)->first();

        ContactChat::where('uid', $nid)->delete();

        HobbyApply::where('openid', $openid)->delete();
        SchoolApply::where('openid', $openid)->delete();
        UserShare::where('openid', $openid)->delete();
        ParentInfo::where('openid', $openid)->delete();
        ParentDetail::where('pid', $id)->delete();
        UserType::where('openid', $openid)->delete();
        NewUser::where('openid', $openid)->delete();
        AdminInfo::where('openid', $openid)->delete();

        DB::commit();
        return response()->json(['errcode'=>0]);
    }
}
