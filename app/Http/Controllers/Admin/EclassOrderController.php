<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EclassOrder;
use App\Models\ParentInfo;
use App\Models\ParentDetail;
use App\Models\BanJi;
use App\Models\OrderClassTime;
use App\Models\ClassTime;
use App\Models\Bill;

use App\Http\Controllers\EclassPriceController;

use Session;

class EclassOrderController extends Controller
{
    public function list(Request $request)
    {
    	// dd($request->all());
    	// if($request->all())
    		// dd($request->all());
    	$order_no = $request->input('orderno');
    	$pay_select = $request->input('pay_select');
    	$confirm_select = $request->input('confirm_select');
    	$date0 = $request->input('date0');
    	$date1 = $request->input('date1');


    	$orderList = EclassOrder::where('eclass_order.status', '1')
    		->leftJoin('parent_info as pi', 'pi.id', 'eclass_order.uid')
    		->leftJoin('teacher_three as th', 'th.id', 'eclass_order.tid')
    		->leftJoin('teacher_two as tt', 'tt.id', 'th.pid')
    		->leftJoin('teacher_one as to', 'to.id', 'tt.pid');

    	$str = '';

    	if ($order_no) {
    		$orderList = $orderList->where('eclass_order.order_no', 'like', $order_no.'%');
    		$str .= '&orderno='.$order_no;
    	}
    	if ($pay_select != null) {
    		$orderList = $orderList->where('eclass_order.pay_status', $pay_select);
    		$str .= '&pay_select='.$pay_select;
    	}
    	if ($confirm_select != null) {
    		$orderList = $orderList->where('eclass_order.confirm_status', $confirm_select);
    		$str .= '&confirm_select='.$confirm_select;
    	}
    	if ($date0 && $date1) {
    		$orderList = $orderList->where('eclass_order.created_at', '>=', $date0)
    			->where('eclass_order.created_at', '<=', $date1);
    		$str .= '&date0='.$date0;
    		$str .= '&date1='.$date1;
    	}

    	$orderList = $orderList->orderBy('eclass_order.created_at', 'desc')
    		->select('pi.phone as phone', 'pi.name as nickname', 'to.name as name1', 'tt.name as name2', 'th.name as name3', 'eclass_order.*')
    		->paginate(5);
    	// dd($orderList->toArray());

        /*获取班级信息*/
        $classObj = BanJi::where('status', '1')
            ->get();

        /*获取课时信息*/
        $classTime = ClassTime::where('status', '1')
            ->get();

    	return view('admin.eclassOrderList', ['orderList'=>$orderList,'str'=>$str,'order_no'=>$order_no,'pay_select'=>$pay_select,'confirm_select'=>$confirm_select,'date0'=>$date0,'date1'=>$date1,
                'classObj'=>$classObj,
                'classTime'=>$classTime
            ]);
    }

    /*确认通过该订单*/
    public function confirmOK(Request $request)
    {
    	$id = $request->input('id');

        $flight = EclassOrder::find($id);
        $flight->confirm_status = 1;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*驳回审核*/
    public function confirmXX(Request $request) {
        $id = $request->input('id');
        $flight = EclassOrder::find($id);
        require_once $_SERVER['DOCUMENT_ROOT']."/php/WxPayAPI/lib/tuikuan.php";
        if($res['result_code'] === 'SUCCESS'){
        	$flight->confirm_status = 2;
        	$flight->pay_status = 2;
        	$flight->save();
        	$bill = new Bill();
        	$bill->type = 'EC-';
        	$bill->oid = $flight->id;
        	$bill->save();
        	return response()->json(['errcode'=>0]);
        }else{
        	return response()->json(['errcode'=>1,'msg'=>$res['err_code_des']]);
        }
    }
	public function tuikuan(){
		return view('admin.tuikuan');
	}
    public function useDetail(Request $request)
    {
        $id = $request->input('id');

        $orderObj = EclassOrder::find($id);

        $uid = $orderObj->uid;

        $parentObj = ParentDetail::find($uid);

        $result['time'] = explode('-', $parentObj->prefer_time);
        $result['classTimes'] = $parentObj->classTimes;
        $result['time_remark'] = $parentObj->time_remark;

        /*获取订单的信息*/
        
        $result['order_class_time'] = OrderClassTime::where('order_class_time.order_id', $id)
            ->where('order_class_time.status', '1')
            ->leftJoin('class', 'class.id', 'order_class_time.class_id')
            ->leftJoin('class_time as ct', 'ct.id', 'order_class_time.ct_id')
            ->select('ct.low as low', 'ct.high as high', 'class.name as cname', 'order_class_time.id as id', 'order_class_time.week as week','order_class_time.type as type')
            ->get();

        return response()->json(['errcode'=>0,'result'=>$result]);
    }

    /*每次改变条件进行查询*/
    public function useDetails(Request $request)
    {
        $week = $request->input('week');
        $keshi = $request->input('keshi');
        $class = $request->input('class');

        /*获取课时\班级信息*/
        $Banji = BanJi::where('status', '1')
            ->get();
        $array = array();
        foreach ($Banji as $value) {
            $cid = $value->id;
            $obj = OrderClassTime::where('class_id', $cid)
                ->where('ct_id', $keshi)
                ->where('week', $week)
                ->where('status', '1');
            $array[$cid]['count'] = $obj->count();
            $obj = $obj->distinct('order_id')
                ->get();

            $arr = array();
            foreach ($obj as $v) {
                $flight = EclassOrder::find($v->order_id);
                if (!in_array($flight->tid, $arr))
                    $arr[] = $flight->tid;
            }
            $array[$cid]['kcCount'] = count($arr);

            if ($cid == $class) {
                /*这个需要找具体课程名称*/
                $nameArr = array();
                foreach ($arr as $p) {
                    $name = EclassPriceController::getName($p);
                    $nameArr[] = $name;
                }
            }
        }
        // OrderClassTime::where('week', $week)
            // ->where('ct_id', $keshi);
        return response()->json(['errcode'=>0,'nameArr'=>$nameArr,'classDetail'=>$array]);
    }

    /*给订单分配新的课时*/
    public function keAdd(Request $request)
    {
        $week = $request->input('week');
        $keshi = $request->input('keshi');
        $class = $request->input('class');
        $id = $request->input('id');
        $checkbox = $request->input('checkbox');

        $count = OrderClassTime::where('order_id', $id)
            ->where('week', $week)
            ->where('ct_id', $keshi)
            ->where('status', '1')
            ->count();
        if($count > 0) {
            return response()->json(['errcode'=>1,'reason'=>'添加失败！该时间该订单已有课时安排']);
        }

        /*查已有课时安排次数*/
        // $orderObj = EclassOrder::find($id);
        // $uid = $orderObj->uid;
        // $classTimes = ParentDetail::find($uid)->classTimes;
        // $times = OrderClassTime::where('order_id', $id)
        //     ->where('status', '1')
        //     ->count();

        // if ($times >= $classTimes) {
        //     return response()->json(['errcode'=>1,'reason'=>'添加失败！该订单课时安排已到客户期望次数']);
        // }

        $flight = new OrderClassTime();
        $flight->order_id = $id;
        $flight->class_id = $class;
        $flight->type = $checkbox;
        $flight->ct_id = $keshi;
        $flight->week = $week;
        $flight->save();

        return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    /*删除已分配课时*/
    public function deleteKeshi(Request $request)
    {
        $id = $request->input('id');

        $flight = OrderClassTime::find($id);
        $flight->status = 0;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }
}