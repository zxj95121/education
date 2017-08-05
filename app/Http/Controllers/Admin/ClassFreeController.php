<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassFree;
use App\Models\ClassFreeActiveTime;
class ClassFreeController extends Controller
{
    public function index()
    {
    	$freeObj = ClassFree::where('class_free.status',1)
    				->leftJoin('new_user','class_free.uid','new_user.id')
    				->select('class_free.id','new_user.nickname','new_user.phone','class_free.active_time')
    				->paginate(10);
    	return view('admin.classFree.index',['res'=>$freeObj]);
    }
    public function setActiveTime()
    {
    	$classfreetime = ClassFreeActiveTime::find(1);
    	return view('admin.classFree.setActiveTime',['res'=>$classfreetime]);
    }
    public function setActiveTimePost(Request $request)
    {
    	$classfreetime = ClassFreeActiveTime::find(1);
    	$classfreetime->start_time = $request->input('start_time');
    	$classfreetime->end_time = $request->input('end_time');
    	$classfreetime->save();
    	return response()->json(['code' => '200']);
    }
}
