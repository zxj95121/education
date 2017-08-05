<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinController extends Controller
{
    public function coin()
    {
    	$openid = Session::get('openid');
    	if (!$openid) {
    		return redirect('/front/coin/oauth');
    	}
    	echo 'fasdfdsfasf';
    }

    public function oauth()
    {
    	return redirect(OauthController::getUrl(13, 0));
    }
}
