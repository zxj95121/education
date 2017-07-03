<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\UserType;
use Session;

class HomeController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');

    	$userType = UserType::where('openid', $openid)
			->select('type', 'uid')
			->get()[0];
		
    	return view('front.views.home.homepage',['userType'=>$userType]);
    }

   public function homeOauth()
   {
   		return redirect(OauthController::getUrl(4, 0));
   }
}
