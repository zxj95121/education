<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassMessage;

class MessageController extends Controller
{
    public function index(Request $request)
    {
    	$res = ClassMessage::where('status',1)
    			->select('id','phone')
    			->paginate(10);
    	return view('admin.classMessage',['res'=>$res]);
    }
    public function add(Request $request)
    {
    	$phone = $request->input('phone');
    	$obj = new ClassMessage();
    	$obj->phone = $phone;
    	$obj->save();
    	return response()->json(['code' => 1]);
    }
    public function edit(Request $request)
    {
    	$id = $request->input('id');
    	$obj = ClassMessage::find($id);
    	$obj->phone = $request->input('phone');
    	$obj->save();
    	return response()->json(['code'=>1]);
    }
    public function delete(Request $request)
    {
    	$id = $request->input('id');
    	$obj = ClassMessage::find($id);
    	$obj->status = 0;
    	$obj->save();
    	return response()->json(['code'=>1]);
    }
    
}
