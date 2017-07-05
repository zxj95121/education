<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use Session;

class ClassTimeController extends Controller
{
    public function setClassTime(Request $request)
    {
    	return view('front.views.parent.setClassTime');
    }

    public function selectType(Request $request)
    {
    	$status = $request->input('status');

    	$front_id = Session::get('front_id');

    	ParentDetail::where('id', $front_id)
    		->update(['prefer_type'=>$status]);
    		
    	return response()->json(['errcode'=>0]);
    }
}
