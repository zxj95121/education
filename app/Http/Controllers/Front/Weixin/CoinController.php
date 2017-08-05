<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;
use Session;

class CoinController extends Controller
{
    public function coin()
    {
    	$openid = Session::get('openid');
    	if (!$openid) {
    		return redirect('/front/coin/oauth');
    	}
    	
    	return view('front.views.weixin.coin');
    }

    public function oauth()
    {
    	return redirect(OauthController::getUrl(13, 0));
    }
}
