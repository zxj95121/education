<?php

namespace App\Http\Controllers\Admin\OtherClass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPackage;

class OtherClassAddController extends Controller
{
    public function add()
    {
    	$packageObj = ClassPackage::where('status', '1')
    		->get();
    	return view('admin.otherClass.add', ['package'=>$packageObj]);
    }

    public function addPost(Request $request)
    {
    	$name = $request->input('name');
    	$price = $request->input('price');
    	$number = $request->input('number');

    	$flight = new ClassPackage();
    	$flight->name = $name;
    	$flight->price = $price;
    	$flight->number = $number;
    	$flight->save();

    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    public function editPost(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $number = $request->input('number');
        $id = $request->input('id');

        $flight = ClassPackage::find($id);
        $flight->name = $name;
        $flight->price = $price;
        $flight->number = $number;
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*设置内容*/
    public function setShow(Request $request)
    {
    	$id = $request->input('pid');
    	$package = ClassPackage::where('id', $id)
    		->get()[0];
    	return view('admin.otherClass.setShow', ['package'=>$package]);
    }

    public function setShowPost(Request $request)
    {
    	$id = $request->input('id');
    	$html = $request->input('html');

    	$flight = ClassPackage::find($id);
    	$flight->show = $html;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*delete*/
    public function delete(Request $request)
    {
    	$id = $request->input('id');

    	$flight = ClassPackage::find($id);
    	$flight->status = 0;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }
}
