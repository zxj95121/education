<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class IdentityController extends Controller
{
    public static function check()
    {
    	$openid = session('openid');
    	echo $openid;
    	exit;
    	return Session::get('openid')?'1':'0';
    }
}
