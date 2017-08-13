<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\NewUser;

use Session;

class CoinController extends Controller
{
    public function coin()
    {
    	$openid = Session::get('openid');
    	if (!$openid) {
    		return redirect('/front/coin/oauth');
    	}

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
        
    	/*查询加辰币*/
    	$userObj = NewUser::where('openid', $openid)
    		->get()
    		->first();
    	
    	return view('front.views.weixin.coin', ['userObj'=>$userObj]);
    }

    public function oauth()
    {
    	return redirect(OauthController::getUrl(13, 0));
    }

    public function convert(Request $request)
    {
    	$num = (int)$request->input('num');
    	$openid = Session::get('openid');

    	$userObj = NewUser::where('openid', $openid)
    		->select('id', 'voucher', 'coin')
    		->get()
    		->first();

    	$coin = $userObj->coin;

    	$coin -= $num*100;

    	if ($coin < 0) {
    		return response()->json(['errcode'=>1,'reason'=>'请求兑换数量太多']);
    	}

    	$voucher = $userObj->voucher + $num*88;

    	$flight = NewUser::find($userObj->id);
    	$flight->voucher = $voucher;
    	$flight->coin = $coin;
    	$flight->save();


    	return response()->json(['errcode'=>0,'data'=>$flight]);
    }
}
