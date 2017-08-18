<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use App\Models\CommunityCommunity;
use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\NewUser;
use App\Models\VoucherRecord;
use App\Models\PatyRecord;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;
class ParentManageController extends Controller
{
    /*家长信息*/
    public function parentInfo(Request $request)
    {
    	$tel = $request->input('tel');
    	$name = $request->input('name');
    	$nickname = $request->input('nickname');

    	$req = $request->all();

    	if (count($req) >= 3) {
    		unset($req['_token']);
    		unset($req['page']);
    	}

    	$res = ParentDetail::where('parent_detail.status','1')
    	->leftJoin('parent_info as pi','parent_detail.pid','=','pi.id')
    	->leftJoin('user_type as ut', 'ut.uid', 'pi.id')
    	->where('ut.type', '2')
    	->leftJoin('new_user as nu', 'nu.uid', 'ut.id');

    	/*搜索*/
    	if ($tel) {
    		$res = $res->where('pi.phone', 'like', $tel.'%');
    	} else {
    		$req['tel'] = '';
    	}

    	if ($name) {
    		$res = $res->where('parent_detail.name', 'like', $name.'%');
    	} else {
    		$req['name'] = '';
    	}

    	if ($nickname) {
    		$res= $res->where('pi.name', 'like', $nickname.'%');
    	} else {
    		$req['nickname'] = '';
    	}

    	$res = $res->select('pi.name as nickname','pi.id','nu.id as userId','parent_detail.name','pi.phone','sex','parent_detail.type','address','place', 'nu.voucher as voucher','nu.paty as patynum')
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

    	return view('admin.people.parentInfo',['res'=>$res,'req'=>$req]);
    }


    /*添加优惠券*/
    public function addTicket(Request $request)
    {
    	$id = $request->input('id');/*new_user表的ID*/
    	$num = (int)$request->input('num');

    	$flight = NewUser::find($id);
    	$voucher = $flight->voucher;
    	$flight->voucher = $voucher+$num*88;

    	$flight->save();


        $f2 = new VoucherRecord();
        $f2->uid = $id;
        $f2->voucher = $num*88;
        $f2->save();

    	return response()->json(['errcode'=>0,'voucher'=>$flight->voucher]);
    }


    /*查优惠券*/
    public function getVoucherRecord(Request $request)
    {
        $id = $request->input('id');

        $obj = VoucherRecord::where('uid', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['obj'=>$obj]);
    }

    /*撤销优惠券*/
    public function dealVoucherRecord(Request $request)
    {
        $vid = $request->input('vid');
        $uid = $request->input('uid');

        $flight = VoucherRecord::find($vid);
        $flight->status = 0;
        $voucher = $flight->voucher;
        $flight->save();

        $flight = NewUser::find($uid);
        $vou = $flight->voucher;
        $vou = $vou - $voucher;

        if ($vou < 0)
            $vou = 0;

        $flight->voucher = $vou;

        $flight->save();

        echo $vou;
        exit;
    }
    /*添加paty*/
    public function addPaty(Request $request)
    {
    	$id = $request->input('id');/*new_user表的ID*/
    	$oid = $request->input('oid');
    	$num = (int)$request->input('num');
    	$type = $request->input('type');
    	if(empty($type)){
    		$type = 1;
    	}
    	$userObj = NewUser::find($id);
    	$paty = $userObj->paty;
    	$userObj->paty = $paty + $num;
    
    	$userObj->save();
    	if($type == 1){
    		$orderObj = BigOrder::find($oid);
    	}else{
    		$orderObj = ClassPackageOrder::find($oid);
    		
    	}
    	$paty = $orderObj->paty;
    	$orderObj->paty = $paty + $num;
    	$orderObj->save();
    	
    	$f2 = new PatyRecord();
    	$f2->uid = $id;
    	$f2->borderid = $oid;
    	$f2->number = $num;
    	$f2->type = $type;
    	$f2->save();
    
    	return response()->json(['errcode'=>0,'paty'=>$userObj->paty ,'bpaty'=>$orderObj->paty]);
    }
    /*查paty*/
    public function getPatyRecord(Request $request)
    {
    	$uid = $request->input('id');
    	$oid = $request->input('oid');
    	$type = $request->input('type');
    	if(empty($type)){
    		$type = 1;
    	}
    	$obj = PatyRecord::where('uid', $uid)
    	->where('borderid',$oid)
    	->where('type',$type)
    	->orderBy('created_at', 'desc')
    	->get();
    
    	return response()->json(['obj'=>$obj]);
    }
    /*撤销paty*/
    public function dealPatyRecord(Request $request)
    {
    	$pid = $request->input('pid');
    	$uid = $request->input('uid');
    	$oid = $request->input('oid');
    	$type = $request->input('type');
    	
    	if(empty($type)){
    		$type = 1;
    	}
    	
    	$paty = PatyRecord::find($pid);
    	$paty->status = 0;
    	$number = $paty->number;
    	$paty->save();
    	
    	if($type ==1){
    		$orderObj = BigOrder::find($oid);
    	}else{
    		$orderObj = ClassPackageOrder::find($oid);
    	}
    	$bpaty = $orderObj->paty - $number;
    	if ($bpaty < 0) {
    		$bpaty = 0;
    	}
    	$orderObj->paty = $bpaty;
    	$orderObj->save();
 
    	$paty = NewUser::find($uid);
    	$vou = $paty->paty;
    	$vou = $vou - $number;
    
    	if ($vou < 0)
    		$vou = 0;
    
    		$paty->paty = $vou;
    
    		$paty->save();
    
    	return response()->json(['bpaty'=>$bpaty,'patynum'=>$vou]);
    }
}
