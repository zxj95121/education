<?php

namespace App\Http\Controllers\Front\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassFreeController extends Controller
{
   	public function index(Request $request)
   	{
   		return view('front.views.weixin.classFree'); 
   	}
}
