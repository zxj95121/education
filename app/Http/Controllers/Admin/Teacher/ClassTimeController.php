<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassTime;

class ClassTimeController extends Controller
{
    public function setClassTime(Request $request)
    {
    	$type1 = ClassTime::where('type', 1)
    		->where('status', '1')
    		->select('id', 'low', 'high')
    		->get();
    	$type2 = ClassTime::where('type', 2)
    		->where('status', '1')
    		->select('id', 'low', 'high')
    		->get();
    	return view('admin.teacher.classTime', ['type1'=>$type1,'type2'=>$type2]);
    }

    public function newTime(Request $request)
    {
    	$type = $request->input('classType');
    	$time1 = $request->input('time1');
    	$time2 = $request->input('time2');

    	$flight = new ClassTime();
    	$flight->type = $type;
    	$flight->low = $time1;
    	$flight->high = $time2;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*修改time*/
    public function editTime(Request $request)
    {
    	$id = $request->input('id');
    	$time1 = $request->input('time1');
    	$time2 = $request->input('time2');

    	ClassTime::where('id', $id)
    		->update(['low'=>$time1,'high'=>$time2]);

    	return response()->json(['errcode'=>0]);
    }

    /*删除time*/
    public function deleteTime(Request $request)
    {
    	$id = $request->input('id');

    	$flight = ClassTime::find($id);
    	$flight->status = 0;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }
}
