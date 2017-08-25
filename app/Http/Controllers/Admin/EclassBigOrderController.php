<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BigOrder;
use App\Models\EclassOrder;
use App\Models\TeacherThree;
use App\Models\TeacherTwo;
use App\Models\AdminPower;
use App\Models\ModifyPricePasswd;
use App\Models\ModifyPriceRecord;

use App\Http\Controllers\EclassPriceController;

use Session;

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

    	$arg = array();

    	if ($order_no) {
    		$orderList = $orderList->where('big_order.order_no', 'like', $order_no.'%');
    		// $str .= '&orderno='.$order_no;
            $arg['orderno'] = $order_no;
    	}
    	if ($pay_select != null) {
    		$orderList = $orderList->where('big_order.pay_status', $pay_select);
    		// $str .= '&pay_select='.$pay_select;
            $arg['pay_select'] = $pay_select;
    	}
    	if ($confirm_select != null) {
    		$orderList = $orderList->where('big_order.confirm_status', $confirm_select);
    		// $str .= '&confirm_select='.$confirm_select;
            $arg['confirm_select'] = $confirm_select;
    	}
    	if ($date0 && $date1) {
    		$orderList = $orderList->where('big_order.created_at', '>=', $date0)
    			->where('big_order.created_at', '<=', $date1);
    		$str .= '&date0='.$date0;
    		$str .= '&date1='.$date1;
            $arg['date0'] = $date0;
            $arg['date1'] = $date1;
    	}
        // if ($stuName) {
        //     $orderList = $orderList->where('pc.name', 'like', '%'.$stuName.'%');
        //     $str .= '&stuName='.$stuName;
        // }

    	$orderList = $orderList->orderBy('big_order.created_at', 'desc')
    		->select('nu.phone as phone', 'nu.nickname as nickname', 'big_order.*' , 'nu.paty as patynum' ,'nu.id as userId')
    		->paginate(10);
            // dd($orderList);
        $child = array();
        foreach ($orderList as $value) {
            $bigOrderId = $value->id;
            $childObj = EclassOrder::where('eclass_order.bid', $bigOrderId)
                ->leftJoin('new_user as nu', 'nu.id', 'eclass_order.uid')
                ->leftJoin('parent_info as pi', 'pi.id', 'nu.uid')
                ->leftJoin('parent_child as pc', 'pc.pid', 'pi.id')
                ->where('pc.status', '1')
                ->select('pc.name as name', 'pc.id as id')
                ->get();
            $child[$bigOrderId] = array();
            foreach($childObj as $key => $value) {
                $child[$bigOrderId][$key]['id'] = $value->id;
                $child[$bigOrderId][$key]['name'] = $value->name;
            }
        }

        /*查该管理员的管理权限*/
        $powerObj = AdminPower::where('uid', Session::get('admin_id'))
            ->select('modify_price')
            ->get()[0];
    	return view('admin.eclassBigOrderList',['orderList'=>$orderList,'arg'=>$arg,'order_no'=>$order_no,'pay_select'=>$pay_select,'confirm_select'=>$confirm_select,'date0'=>$date0,'date1'=>$date1,'child'=>$child,'powerObj'=>$powerObj]);
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
    
        return response()->json(['errcode'=>0,'obj'=>$Obj]);
    }

    /*获取订单的标准价*/
    public function getOrderStandardPrice(Request $request)
    {
        $oid = $request->input('oid');
        $price = EclassPriceController::getStandardPrice($oid);
        return response()->json(['errcode'=>0, 'price'=>$price]);
    }

    public function editECPrice(Request $request)
    {
        $oid = $request->input('oid');
        $price = $request->input('price');
        $passwd = $request->input('psd');
        $type = $request->input('type');

        $flight = BigOrder::find($oid);

        $passwd2 = ModifyPricePasswd::where('status', '1')
            ->first();
        if ($passwd2->passwd == $passwd) {
            $pre = $flight->price;
            $flight->price = $price;
            $flight->save();

            /*存记录*/
            $admin_id = Session::get('admin_id');
            
            $fli = new ModifyPriceRecord();
            $fli->uid = $admin_id;
            $fli->pre = $pre;
            $fli->now = $price;
            $fli->type = $type;
            $fli->save();

            return response()->json(['errcode'=>0]);
        }
        return response()->json(['errcode'=>1]);
    }
}
