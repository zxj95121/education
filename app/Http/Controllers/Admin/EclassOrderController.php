<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EclassOrder;
use App\Models\ParentInfo;

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
    	return view('admin.eclassOrderList', ['orderList'=>$orderList,'str'=>$str,'order_no'=>$order_no,'pay_select'=>$pay_select,'confirm_select'=>$confirm_select,'date0'=>$date0,'date1'=>$date1]);
    }

    /*确认通过该订单*/
    public function confirmOK(Request $request)
    {
    	$id = $request->input('id');
    }
}
