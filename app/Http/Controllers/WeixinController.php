<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeixinController extends Controller
{
    public function notify(Request $request)
    {
    	$date = $request->all();
    	$date = json_decode($date);
    	dump($date);
    	die;
    	if($date != ''){
    		DB::table('ceshi')->insert([
    				['text'=>$date]
    		]);
    	}
    }

}
