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
    	$num = $request->input('num');
    	$openid = Session::get('openid');

    	$userObj = NewUser::where('openid')
    		->select('id', 'voucher', 'coin')
    		->get()
    		->first();

    	$coin = $userObj->coin;

    	$coin -= $num*100;

    	if ($coin < 0) {
    		return response()->json('errcode'=>1,'reason'=>'请求兑换数量太多');
    	}

    	$voucher = $userObj->voucher + $num;

    	$flight = NewUser::find($userObj->id);
    	$flight->voucher = $voucher;
    	$flight->coin = $coin;
    	$flight->save();


    	return response()->json(['errcode'=>0])
    }
}
