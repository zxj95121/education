<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DateType;

class FestivalSettingController extends Controller
{
    public function index()
    {
    	$today = date('Y-m-d');
    	$dateObj = DateType::where('day', '>=', $today)
    		->where('status', '1')
    		->orderBy('day')
    		->get();
    	return view('admin.os.festivalManage',['dateObj'=>$dateObj]);
    }

    public function add(Request $request)
    {
    	$date = $request->input('date');
    	$hospital_select = $request->input('hospital_select');
    	$future = $request->input('future');

    	$array = array();
    	$result = array();
    	for ($i = 0; $i < $future; $i++) {
    		$count = DateType::where('day', $date)
    			->where('status', '1')
    			->count();

    		if ($count > 0) {
    			$array[] = $date;
    		} else {
    			$flight = new DateType();
    			$flight->day = $date;
    			$flight->type = $hospital_select;
    			$flight->save();
    			$len = count($result);
    			$result[$len]['id'] = $flight->id;
    			$result[$len]['day'] = $date; 
    		}

    		$time = strtotime($date)+86400;
    		$date = date('Y-m-d', $time);
    	}

    	return response()->json(['errcode'=>'0','useful'=>$result,'nouse'=>$array]);
    }

    /*改变类型*/
    public function change(Request $request)
    {
    	$id = $request->input('id');

    	$flight = DateType::find($id);
    	$type = $flight->type;
    	$type = ($type == 1) ? '0':'1';
    	$flight->type = $type;
    	$flight->save();

    	return response()->json(['errcode'=>0,'type'=>$type]);
    }
}
