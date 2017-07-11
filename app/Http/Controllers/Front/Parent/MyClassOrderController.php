<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyClassOrderController extends Controller
{
    public function index()
    {
    	return view('front.views.parent.myClassOrder');
    }
}
