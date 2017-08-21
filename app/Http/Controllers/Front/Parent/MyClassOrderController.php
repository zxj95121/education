<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EclassOrder;
use App\Models\UserType;
use App\Http\Controllers\EclassPriceController;

use App\Http\Controllers\Wechat\OauthController;
use App\Models\EclassProgress;
use App\Models\TeacherFour;
use App\Models\ParentChild;
use App\Models\NewUser;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;

use Session;

class MyClassOrderController extends Controller
{
    public function index()
    {
        $openid = Session::get('openid');

        if (!$openid) {
            return redirect('/front/parent/myClassOrder/oauth');
        }

        $userObj = NewUser::where('openid', $openid)
            ->get();
        
        /*查订单详情*/
        $noPayObj = BigOrder::where('openid', $openid)
            ->where('pay_status', 0)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->where('complete', '0')
            ->get()
            ->toArray();
        // foreach ($noPayObj as $key => $value) {
        //     $tid = $value['tid'];
        //     $name = EclassPriceController::getName($tid,1,' 》');
        //     $noPayObj[$key]['name'] = $name;
        // }


        /*查待审核订单*/
        $noConfirmObj = BigOrder::where('openid', $openid)
            ->where('pay_status', '1')
            ->where('confirm_status', '0')
            ->where('status', '1')
            ->where('complete', '0')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        // foreach ($noConfirmObj as $key => $value) {
        //     $tid = $value['tid'];
        //     $name = EclassPriceController::getName($tid,1,' 》');
        //     $noConfirmObj[$key]['name'] = $name;
        // }


        /*授课中订单*/
        $teachingObj = BigOrder::where('openid', $openid)
            ->where('pay_status', '1')
            ->where('confirm_status', '1')
            ->where('status', '1')
            ->where('complete', '0')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        // foreach ($teachingObj as $key => $value) {
        //     $tid = $value['tid'];
        //     $name = EclassPriceController::getName($tid,1,' 》');
        //     $teachingObj[$key]['name'] = $name;
        // }



        /*查其他课程未支付*/
        $noPayObj2 = ClassPackageOrder::where('class_package_order.status', 1)
            ->leftJoin('new_user as nu', 'nu.id', 'class_package_order.uid')
            ->leftJoin('class_package as cp', 'class_package_order.cid', 'cp.id')
            ->where('nu.openid', $openid)
            ->where('class_package_order.pay_status', 0)
            ->orderBy('class_package_order.id', 'desc')
            ->select('class_package_order.*', 'cp.name')
            ->get()
            ->toArray();
        /*查其他课程排课中*/
        /*查其他课程授课中*/
        $teachingObj2 = ClassPackageOrder::where('class_package_order.status', 1)
            ->leftJoin('new_user as nu', 'nu.id', 'class_package_order.uid')
            ->leftJoin('class_package as cp', 'class_package_order.cid', 'cp.id')
            ->where('nu.openid', $openid)
            ->where('class_package_order.pay_status', 1)
            ->orderBy('class_package_order.id', 'desc')
            ->select('class_package_order.*', 'cp.name')
            ->get()
            ->toArray();

        return view('front.views.parent.myClassOrder', [
            'noPayObj' => $noPayObj,
            'noPayObj2' => $noPayObj2,
            'noConfirmObj' => $noConfirmObj,
            'teachingObj' => $teachingObj,
            'teachingObj2' => $teachingObj2,
            'userObj' => $userObj
            // 'complete' => $complete
        ]);


    }

    public function index2()
    {
    	$openid = Session::get('openid');
    	$front_id = $this->getUid($openid);
    	/*查订单详情*/
    	$noPayObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', 0)
    		->where('status', 1)
    		->orderBy('id', 'desc')
            ->where('complete', '0')
    		->get()
    		->toArray();
    	foreach ($noPayObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$noPayObj[$key]['name'] = $name;
    	}

    	/*查待审核订单*/
    	$noConfirmObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', '1')
    		->where('confirm_status', '0')
    		->where('status', '1')
            ->where('complete', '0')
    		->orderBy('id', 'desc')
    		->get()
    		->toArray();
    	foreach ($noConfirmObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$noConfirmObj[$key]['name'] = $name;
    	}

    	/*授课中订单*/
    	$teachingObj = EclassOrder::where('uid', $front_id)
    		->where('pay_status', '1')
    		->where('confirm_status', '1')
    		->where('status', '1')
            ->where('complete', '0')
    		->orderBy('id', 'desc')
    		->get()
    		->toArray();
    	foreach ($teachingObj as $key => $value) {
    		$tid = $value['tid'];
    		$name = EclassPriceController::getName($tid,1,' 》');
    		$teachingObj[$key]['name'] = $name;
    	}
    	
    	/*已完成订单*/
		$complete = EclassOrder::where('uid', $front_id)
			->where('complete',1)
			->where('status', 1)
			->orderBy('id', 'desc')
			->get()
			->toArray();
		foreach ($complete as $key => $value) {
			$tid = $value['tid'];
			$name = EclassPriceController::getName($tid,1,' 》');
			$complete[$key]['name'] = $name;
		}
    	return view('front.views.parent.myClassOrder', [
    		'noPayObj' => $noPayObj,
    		'noConfirmObj' => $noConfirmObj,
    		'teachingObj' => $teachingObj,
    		'complete' => $complete
    	]);
    }


    /*oauth*/
    public function oauth()
	{
   		return redirect(OauthController::getUrl(5, 0));
	}

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
    public function details(Request $request)
    {
		$id = $request->input('id');
		$fourMid = EclassProgress::where('oid',$id)->where('status',1)->select('fid','oid')->orderBy('id','desc')->first();
    	$order = EclassOrder::find($id);
		$all = TeacherFour::where('pid',$order->tid)->where('status',1)->get();
    	$child = ParentChild::find($order->child);
    	$classname = EclassPriceController::getName($order->tid);
    	foreach($all as $key => $value){
    		if(isset($fourMid) && $value->id <= $fourMid->fid){
    			$all[$key]['zhuangtai'] = 1;
    		}else{
    			$all[$key]['zhuangtai'] = 0;
    		}
    	}
    	return view('front.views.parent.details',['res'=>$all,'childname'=>$child->name,'classname'=>$classname]);
    }

        /*获取订单详情*/
    public function getOrderDetail(Request $request)
    {
        $id = $request->input('id');

        $TwoObj = EclassOrder::where('eclass_order.bid', $id)
            ->leftJoin('teacher_three as tt', 'tt.id', 'eclass_order.tid')
            ->leftJoin('teacher_two as two', 'two.id', 'tt.pid')
            ->leftJoin('teacher_one as to', 'to.id', 'two.pid')
            ->where('eclass_order.status', 1)
            ->select('to.id as id1', 'to.name as name1','two.name as name2', 'two.id as id2')
            ->groupBy('two.id')
            ->get();

        $Obj = array();
        // dd($TwoObj);
        foreach ($TwoObj as $key => $value) {
            $id2 = $value->id2;
            $Obj[$key]['id'] = $id2;
            $Obj[$key]['name'] = $value->name2; 
            $Obj[$key]['name1'] = $value->name1; 
            $Obj[$key]['id1'] = $value->id1;
            $orderDetail = EclassOrder::where('eclass_order.bid', $id)
                ->leftJoin('teacher_three as tt', 'tt.id', 'eclass_order.tid')
                ->leftJoin('teacher_two as two', 'two.id', 'tt.pid')
                ->where('eclass_order.status', 1)
                ->where('two.id', $id2)
                ->select('two.name as name2', 'two.id as id2', 'tt.name as name3', 'tt.id as id3', 'eclass_order.*')
                ->get()->toArray();
            $Obj[$key]['detail'] = $orderDetail;
        }

        $openid = Session::get('openid');
        $count = BigOrder::find($id)
            ->paty;

        return response()->json(['errcode'=>0,'obj'=>$Obj,'count'=>$count]);
    }


    public function deleteOrderDetail(Request $request){
        // 删除订单
        $id = $request->input('id');
        EclassOrder::where('eclass_order.bid', $id)
            ->update(['status'=>0]);
        $flight = BigOrder::find($id);
        $flight->status = 0;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }


    public function deleteOrderDetail2(Request $request){
        // 删除订单
        $id = $request->input('id');

        $flight = ClassPackageOrder::find($id);
        $flight->status = 0;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }
}