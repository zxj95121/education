<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyVoucherController extends Controller
{
    public function index()
    {
    	return view('front.views.parent.myVoucher');
    }
}