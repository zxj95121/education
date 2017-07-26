<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BigOrder;
use App\Models\EclassOrder;
use App\Models\TeacherThree;
use App\Models\TeacherTwo;

class EclassBigOrderController extends Controller
{
    public function list(Request $request)
    {
    	$order_no = $request->input('orderno');
    	$pay_select = $request->input('pay_select');
    	$confirm_select = $request->input('confirm_select');
    	$date0 = $request->input('date0');
    	$date1 = $request->input('date1');
        // $stuName = $request->input('stuName');


    	$orderList = BigOrder::where('big_order.status', '1')
    		->leftJoin('new_user as nu', 'nu.openid', 'big_order.openid');
    		// ->leftJoin('teacher_three as th', 'th.id', 'big_order.tid')
    		// ->leftJoin('teacher_two as tt', 'tt.id', 'th.pid')
    		// ->leftJoin('teacher_one as to', 'to.id', 'tt.pid')
            // ->leftJoin('parent_child as pc', 'pc.id', 'big_order.child');

    	$str = '';

    	if ($order_no) {
    		$orderList = $orderList->where('big_order.order_no', 'like', $order_no.'%');
    		$str .= '&orderno='.$order_no;
    	}
    	if ($pay_select != null) {
    		$orderList = $orderList->where('big_order.pay_status', $pay_select);
    		$str .= '&pay_select='.$pay_select;
    	}
    	if ($confirm_select != null) {
    		$orderList = $orderList->where('big_order.confirm_status', $confirm_select);
    		$str .= '&confirm_select='.$confirm_select;
    	}
    	if ($date0 && $date1) {
    		$orderList = $orderList->where('big_order.created_at', '>=', $date0)
    			->where('big_order.created_at', '<=', $date1);
    		$str .= '&date0='.$date0;
    		$str .= '&date1='.$date1;
    	}
        // if ($stuName) {
        //     $orderList = $orderList->where('pc.name', 'like', '%'.$stuName.'%');
        //     $str .= '&stuName='.$stuName;
        // }

    	$orderList = $orderList->orderBy('big_order.created_at', 'desc')
    		->select('nu.phone as phone', 'nu.nickname as nickname', 'big_order.*')
    		->paginate(5);
    	return view('admin.eclassBigOrderList',['orderList'=>$orderList,'str'=>$str,'order_no'=>$order_no,'pay_select'=>$pay_select,'confirm_select'=>$confirm_select,'date0'=>$date0,'date1'=>$date1]);
    }


    /*确认通过该订单*/
    public function confirmOK(Request $request)
    {
        $id = $request->input('id');

        $flight = BigOrder::find($id);
        $flight->confirm_status = 1;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*驳回订单*/
    public function confirmXX(Request $request)
    {
        $id = $request->input('id');
        $flight = BigOrder::find($id);
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

    /*获取订单详情*/
    public function getOrderDetail(Request $request)
    {
        $id = $request->input('id');

        $orderDetail = EclassOrder::where('eclass_order.bid', $id)
            ->leftJoin('teacher_three as tt', 'tt.id', 'eclass_order.tid')
            ->leftJoin('teacher_two as two', 'two.id', 'tt.pid')
            ->select('tt.name as name3', 'two.name as name2', 'two.id as id2', 'tt.id as id3', 'eclass_order.*')
            ->groupBy('two.id')
            ->get();
        dd($orderDetail->toArray());
    }
}
