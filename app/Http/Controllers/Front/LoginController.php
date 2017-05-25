<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Libraries\Wechat;

class LoginController extends Controller
{
	/*账号绑定*/
    public function register(){
    	return view('admin.login');
    }

    /*进行发送手机验证码*/
    public function phoneCode()
    {
    	echo 'phoneCode';
    }
}
