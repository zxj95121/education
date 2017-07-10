<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class WeixinController extends Controller
{
    public function notify(Request $request)
    {
     	$date = $request->all();
    	Storage::put('a.txt', $date); 
    	$postStr = file_get_contents('php://input');
    		DB::table('ceshi')->insert([
    				'text'=>$postStr
    		]);
    }

}
