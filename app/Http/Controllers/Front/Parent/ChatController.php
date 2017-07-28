<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentInfo;

use Session;

class ChatController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
    	$parentObj = ParentInfo::where('openid', $openid)->first();
    	return view('front.views.parent.chat', ['parentObj'=>$parentObj]);
    }
}
