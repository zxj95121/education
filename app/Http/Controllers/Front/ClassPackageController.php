<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPackage;
use App\Models\NewUser;
use App\Models\ClassPackageOrder;

use App\Http\Controllers\Wechat\OauthController;

use Session;

class ClassPackageController extends Controller
{
    public function index(Request $request)
    {
    	$id = $request->input('id', '');
    	if (!$id) {
    		/*没有带id参数*/
    		return redirect('/front/error403');
    	}

    	$package = ClassPackage::find($id);

    	return view('front.views.classPackage.show', ['package'=>$package]);
    }

    /*支付订单*/
    public function newOrder()
    {
    	$cid = Session::get('classPackageId');
    	$openid = Session::get('openid');

        $package = ClassPackage::find($cid);
        /*查用户的代金券余额*/
        $userObj = NewUser::where('openid', $openid)
            ->get()[0];
        $voucher = $userObj->voucher;


        $order_no = 'OP'.date('YmdHis').rand(10000, 99999);
        $price = (float)$package->price;
        $vnum = floor($price/1000);
        $vouNum = 0;
        for ($i = 0; $i < $vnum; $i++) {
            if (($voucher-88)>=0) {
                $voucher -= 88;
                $vouNum++;
            }
        }
        $price = $price-(88*$vouNum);
        $cid = $package->id;
        $uid = $userObj->id;
        $count = $package->number;

        $flight = new ClassPackageOrder();
        $flight->cid = $cid;
        $flight->uid = $uid;
        $flight->count = $count;
        $flight->price = $price;
        $flight->order_no = $order_no;
        $flight->voucher_num = $vouNum;
        $flight->save();
    	
        Session::put('package_order_no', $order_no);
        Session::put('package_order_price', $price);
        Session::put('package_order_vouNum', $vouNum);
    	
        return redirect('/front/classPackage/newOrder2');
    }

    public function newOrder2()
    {
        $order_no = Session::get('package_order_no');
        $price = Session::get('package_order_price');
        $vouNum = Session::get('package_order_vouNum');

        // Session::forget('package_order_no');
        // Session::forget('package_order_price');
        // Session::forget('package_order_vouNum');

        $cid = Session::get('classPackageId');
        $openid = Session::get('openid');

        $packageObj = ClassPackage::find($cid);
        /*查用户的代金券余额*/
        $userObj = NewUser::where('openid', $openid)
            ->get()[0];
        $voucher = $userObj->voucher;
        // return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj]);
        return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj,'price'=>$price,'vouNum'=>$vouNum,'order_no'=>$order_no]);
    }

    /*支付订单oauth*/
    public function newOrderOauth(Request $request)
    {
    	/*cid表示class_package的ID*/
    	$classPackageId = $request->input('cid');
    	Session::put('classPackageId', $classPackageId);

    	return redirect(OauthController::getUrl(8, 0));
    }
}
