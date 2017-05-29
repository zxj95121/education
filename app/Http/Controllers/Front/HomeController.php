<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\Oauth;

class HomeController extends Controller
{
    public function index()
    {
    	return view('front.views.index');
    }

    /*进行网址跳转*/
    public function oauth()
    {
    	return redirect(Oauth::getUrl(1));
    }
}
