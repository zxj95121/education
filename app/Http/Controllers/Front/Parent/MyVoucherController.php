<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;
use App\Models\NewUser;

use Session;

class MyVoucherController extends Controller
{
    public function index()
    {
    	$openid = Session::get('openid');
    	$userinfo = NewUser::where('openid', $openid)
    		->select('nickname', 'voucher')
    		->first();

    	return view('front.views.parent.myVoucher', ['userinfo'=>$userinfo]);
    }

    public function oauth()
    {
    	if (Session::has('openid')) {
    		return redirect('/front/parent/myVoucher');
    	} else {
    		return redirect(OauthController::getUrl(9, 1));
    	}
    }
}
