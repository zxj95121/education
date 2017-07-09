<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeixinController extends Controller
{
    public function notify(Request $request)
    {
		DB::table('ceshi')->insert([
    		['text'=>'123']
		]);
    }
}
