<?php

namespace App\Http\Controllers\Admin\OtherClass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminPower;
use App\Models\ClassPackage;
use App\Models\ClassPackageOrder;
use App\Models\ModifyPricePasswd;
use App\Models\ModifyPriceRecord;

use Session;

class OtherClassAddController extends Controller
{
    public function add()
    {
    	$packageObj = ClassPackage::where('status', '1')
    		->get();

        $SERVER_NAME = $_SERVER['SERVER_NAME'];;
    	return view('admin.otherClass.add', ['package'=>$packageObj,'SERVER_NAME'=>$SERVER_NAME]);
    }

    public function addPost(Request $request)
    {
    	$name = $request->input('name');
        $price = $request->input('price');
    	$standardPrice = $request->input('standardPrice');
    	$number = $request->input('number');

    	$flight = new ClassPackage();
    	$flight->name = $name;
        $flight->price = $price;
    	$flight->standard_price = $standardPrice;
    	$flight->number = $number;
    	$flight->save();

    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    public function editPost(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $standardPrice = $request->input('standardPrice');
        $number = $request->input('number');
        $id = $request->input('id');

        $flight = ClassPackage::find($id);
        $flight->name = $name;
        $flight->price = $price;
        $flight->standard_price = $standardPrice;
        $flight->number = $number;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*设置内容*/
    public function setShow(Request $request)
    {
    	$id = $request->input('pid');
    	$package = ClassPackage::where('id', $id)
    		->get()[0];
    	return view('admin.otherClass.setShow', ['package'=>$package]);
    }

    public function setShowPost(Request $request)
    {
    	$id = $request->input('id');
    	$html = $request->input('html');

    	$flight = ClassPackage::find($id);
    	$flight->show = $html;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*delete*/
    public function delete(Request $request)
    {
    	$id = $request->input('id');

    	$flight = ClassPackage::find($id);
    	$flight->status = 0;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*订单*/
    public function orderList(Request $request)
    {
        $cid = $request->input('cid');
        $packageObj = ClassPackage::find($cid);

        /*查订单*/
        $orderObj = ClassPackageOrder::where('class_package_order.cid', $cid)
            ->where('class_package_order.status', 1)
            ->leftJoin('new_user as nu', 'nu.id', 'class_package_order.uid')
            ->select('nu.nickname', 'nu.phone as phone', 'class_package_order.*' ,'nu.paty as patynum','nu.id as userId')
            ->orderBy('class_package_order.created_at', 'desc')
            ->paginate(10);
        // dd($orderObj->toArray());

        /*查该管理员的管理权限*/
        $powerObj = AdminPower::where('uid', Session::get('admin_id'))
            ->select('modify_price')
            ->get()[0];

        return view('admin.otherClass.orderList', ['package'=>$packageObj,'orderObj'=>$orderObj,'cid'=>$cid,'powerObj'=>$powerObj]);
    }

    public function getStandardPrice(Request $request)
    {
        $cid = $request->input('cid');

        $price = ClassPackage::find($cid)->standard_price;

        return response()->json(['errcode'=>0,'price'=>$price]);
    }

    /*xiugai价格*/
    public function editECPrice(Request $request)
    {
        $oid = $request->input('oid');
        $price = $request->input('price');
        $passwd = $request->input('psd');
        $type = $request->input('type');

        $flight = ClassPackageOrder::find($oid);

        $passwd2 = ModifyPricePasswd::where('status', '1')
            ->first();
        if ($passwd2->passwd == $passwd) {
            $pre = $flight->price;
            $flight->price = $price;
            $flight->voucher_num = 0;
            $flight->save();
            $orderno = $flight->order_no;

            /*存记录*/
            $admin_id = Session::get('admin_id');
            
            $fli = new ModifyPriceRecord();
            $fli->uid = $admin_id;
            $fli->pre = $pre;
            $fli->now = $price;
            $fli->type = $type;
            $fli->which = 2;
            $fli->order_no = $oid;
            $fli->save();

            return response()->json(['errcode'=>0]);
        }
        return response()->json(['errcode'=>1]);
    }
}
