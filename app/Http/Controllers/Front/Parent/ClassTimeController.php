<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;

class ClassTimeController extends Controller
{
    public function setClassTime(Request $request)
    {
    	return view('front.views.parent.setClassTime');
    }

    public function selectType(Request $request)
    {
    	$status = $request->input('status');

    	$openid = Session::get('openid');

    	ParentDetail::where('openid', $openid)
    		->update(['prefer_type', $status]);
    		
    	return response()->json(['errcode'=>0]);
    }
}
