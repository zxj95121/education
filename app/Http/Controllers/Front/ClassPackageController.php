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

    	$packageObj = ClassPackage::find($cid);
        /*查用户的代金券余额*/
        $userObj = NewUser::where('openid', $openid)
            ->get()[0];
        $voucher = $userObj->voucher;
    	return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj]);
    }

    /*支付订单oauth*/
    public function newOrderOauth(Request $request)
    {
    	/*cid表示class_package的ID*/
    	$classPackageId = $request->input('cid');
    	Session::put('classPackageId', $classPackageId);

    	return redirect(OauthController::getUrl(8, 0));
    }

    public function newOrderPost(Request $request)
    {
        $order_no = $request->input('order_no');
        $cid = $request->input('cid');
        $voucher = $request->input('voucher');
        $price = $requet->input('price');
        $uid = $request->input('uid');
        $count = $request->input('count');

        $flight = new ClassPackageOrder;
        $flight->cid = $cid;
        $flight->uid = $uid;
        $flight->count = $count;
        $flight->price = $price;
        $flight->order_no = $order_no;
        $flight->voucher = $voucher;
        $flight->save();

        $userObj = NewUser::where('openid', Session::get('openid'))
            ->select('id', 'voucher')
            ->get()[0];
        $newVou = $userObj->voucher-88*$vouocher;
        $flight = NewUser::find($userObj->id);
        $flight->voucher = $newVou;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }
}
