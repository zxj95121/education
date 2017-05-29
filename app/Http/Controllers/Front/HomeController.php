<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\OauthController;

class HomeController extends Controller
{
    public function index()
    {
    	return view('front.views.index');
    }

    /*进行网址跳转*/
    public function oauth()
    {
    	return redirect(OauthController::getUrl(1));
    }
}
