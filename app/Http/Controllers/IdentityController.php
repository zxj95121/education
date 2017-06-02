<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class IdentityController extends Controller
{
    public static function check(Request $request)
    {
    	return Session::get('openid')?'1':'0';
    }
}
