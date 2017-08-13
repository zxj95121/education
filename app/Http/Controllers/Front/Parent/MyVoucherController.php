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

        $count = NewUser::where('openid', $openid)
            ->count();

        if ($count <= 0) {
            $access_token = Wechat::get_access_token();
            // /*获取用户个人详细信息*/
            $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
            $userinfo = Wechat::curl($url);

            $flight = new NewUser();
            $flight->openid = $openid;
            $flight->type = 0;
            $flight->voucher = 0;
            $flight->nickname = $userinfo['nickname'];
            $flight->headimg = $userinfo['headimgurl'];
            $flight->uid = 0;
            $flight->worker_id = 0;
            $flight->save();
        }
        
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

    /*立即使用中间判断*/
    public function use()
    {
        if (Session::has('openid')) {
            $str = '/front/home#eclass';
        } else {
            $str = '/front/classPackage/list';
        }

        return redirect($str);
    }
}
