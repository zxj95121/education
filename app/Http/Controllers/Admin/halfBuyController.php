<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class halfBuyController extends Controller
{
    public function halfBuy()
    {
    	return view('admin.halfBuy');
    }
}
