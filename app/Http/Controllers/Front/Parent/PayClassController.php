<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;

class PayClassController extends Controller
{
    public function checkMessage(Request $request)
    {
    	
    	return view('front.views.home.checkMessageResult');
    }
}
