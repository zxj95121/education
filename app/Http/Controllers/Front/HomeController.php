<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\OauthController;

class HomeController extends Controller
{
    public function home()
    {
    	return view('front.views.home.homepage');
    }

   public function homeOauth()
   {
   		return redirect(OauthController::getUrl(4));
   }
}
