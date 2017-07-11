<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\BanJi;

class ClassSettingController extends Controller
{
    public function index()
    {
    	// 班级设置
    	$banji = BanJi::where('status', 1)
    		->get();
    	return view('admin.os.classManage',[
    		'banji' => $banji
    	]);
    }

    public function add(Request $request)
    {
    	$name = $request->input('name');
    	$flight = new BanJi();
    	$flight->name = $name;
    	$flight->people = 12;
    	$flight->save();
    	return response()->json(['errcode'=>0, 'id'=>$flight->id]);
    }

    public function edit(Request $request) {
    	$id = $request->input('id');
    	$name = $request->input('name');
    	$flight = BanJi::find($id);
    	$flight->name = $name;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }

    public function delete(Request $request) {
    	$id = $request->input('id');
    	$flight = BanJi::find($id);
    	$flight->status = 0;
    	$flight->save();
    	return response()->json(['errcode'=>0]);
    }
}
