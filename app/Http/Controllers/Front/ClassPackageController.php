<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPackage;
use App\Models\NewUser;

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
    	return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher]);
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
