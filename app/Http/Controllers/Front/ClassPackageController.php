<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPackage;
use App\Models\NewUser;
use App\Models\ClassPackageOrder;

use App\Http\Controllers\Wechat\OauthController;

use Session;
use Wechat;

class ClassPackageController extends Controller
{
    public function index(Request $request)
    {
    	$id = $request->input('id', '');
    	if (!$id) {
    		/*没有带id参数*/
    		return redirect('/front/error_403');
    	}

        /*查package是否可用*/

    	$package = ClassPackage::find($id);

        if ($package->status == 1) {
        	return view('front.views.classPackage.show', ['package'=>$package]);
        } else {
            return redirect('/front/error_403');
        }
    }

    /*支付订单*/
    public function newOrder()
    {
        $cid = Session::get('classPackageId');
        $hasOrder = Session::get('hasOrder');
        if ($hasOrder == '1') {
            Session::put('hasOrder', '0');
            return redirect('/front/classPackage?id='.$cid);
        }
    	
    	$openid = Session::get('openid');

        /*判断new_user表有没有*/
        $newUserCount = NewUser::where('openid', $openid)
            ->count();
        if ($newUserCount == 0) {
            /*将这个数据存入new_user表*/
            $access_token = Wechat::get_access_token();
            /*获取用户个人详细信息*/
            $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
            $userinfo = Wechat::curl($url);

            $flight = new NewUser();
            $flight->openid = $openid;
            $flight->type = 0;
            $flight->voucher = 0;
            $flight->nickname = $userinfo['nickname'];
            $flight->headimg = $userinfo['headimgurl'];
            $flight->worker_id = 0;
            $flight->save();
        }

        $package = ClassPackage::find($cid);
        /*查用户的代金券余额*/
        $userObj = NewUser::where('openid', $openid)
            ->get()[0];
        $voucher = $userObj->voucher;


        $order_no = 'CP'.date('YmdHis').rand(10000, 99999);
        $price = (float)$package->price;
        $vnum = floor($price/1000);
        $vouNum = 0;
        for ($i = 0; $i < $vnum; $i++) {
            if (($voucher-88)>=0) {
                $voucher -= 88;
                $vouNum++;
            }
        }

        $prePrice = $price;
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
        Session::put('prePrice', $prePrice);

        Session::put('hasOrder', '0');
    	
        return redirect('/front/classPackage/newOrder2');
    }

    public function newOrder2()
    {
        Session::put('hasOrder', '1');
        $order_no = Session::get('package_order_no');
        $price = Session::get('package_order_price');
        $vouNum = Session::get('package_order_vouNum');
        $prePrice = Session::get('prePrice');

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

        /*查这个用户有没有输入手机号*/
        $phone = NewUser::where('openid', $openid)
            ->first()
            ->phone;
        return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj,'price'=>$price,'vouNum'=>$vouNum,'order_no'=>$order_no,'phone'=>$phone,'prePrice'=>$prePrice]);
    }

    /*支付订单oauth*/
    public function newOrderOauth(Request $request)
    {
    	/*cid表示class_package的ID*/
    	$classPackageId = $request->input('cid');
        Session::put('hasOrder', '0');
    	Session::put('classPackageId', $classPackageId);

    	return redirect(OauthController::getUrl(8, 0));
    }


    /*classPackage列表页*/
    public function list()
    {
        $obj = ClassPackage::where('status', 1)
            ->select('id', 'name', 'price')
            ->get();

        return view('front.views.classPackage.list', ['obj'=>$obj]);
    }

    /*classPackage另支付*/
    public function payShow(Request $request)
    {
        $id = $request->input('id');
        $order_no = 'CP'.date('YmdHis').rand(10000,99999);

        $flight = ClassPackageOrder::find($id);
        $flight->order_no = $order_no;
        $flight->save();

        $price = $flight->price;
        $vouNum = $flight->voucher_num;
        $prePrice = $price + 88*$vouNum;


        $cid = $flight->cid;
        $openid = Session::get('openid');

        $packageObj = ClassPackage::find($cid);
        /*查用户的代金券余额*/
        $userObj = NewUser::where('openid', $openid)
            ->get()[0];
        $voucher = $userObj->voucher;
        // return view('front.views.classPackage.orderPay', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj]);

        /*查这个用户有没有输入手机号*/
        $phone = NewUser::where('openid', $openid)
            ->first()
            ->phone;
        return view('front.views.classPackage.orderPay2', ['package'=>$packageObj,'voucher'=>$voucher,'userObj'=>$userObj,'price'=>$price,'vouNum'=>$vouNum,'order_no'=>$order_no,'phone'=>$phone,'prePrice'=>$prePrice]);
    }
}
