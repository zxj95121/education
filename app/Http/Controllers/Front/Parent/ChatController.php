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
    	$count = ParentInfo::where('openid', $openid)->count();
    	if ($count == 0) {
    		return redirect('/front/error_403');
    	}
    	$parentObj = ParentInfo::where('openid', $openid)->first();
    	return view('front.views.parent.chat', ['parentObj'=>$parentObj]);
    }
}
