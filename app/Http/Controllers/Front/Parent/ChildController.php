<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParentChild;
use App\Models\ParentInfo;
use Session;
class ChildController extends Controller
{
    public function addChild()
    {
    	return view('front.views.parent.addChild');
    }
    public function addPost(Request $request)
    {
    	$obj = new ParentChild();
    	$obj->name = $request->input('name');
    	$obj->sex = $request->input('sex');
    	$parentinfo = ParentInfo::where('openid',Session::get('openid'))->select('id')->first();
    	$obj->pid = $parentinfo->id;
    	$obj->save();
    	return response()->json(['code'=>200]);
    }
   	public function savePost(Request $request)
   	{
   		$id = $request->input('id');
   		$obj = ParentChild::find($id);
   		if(!empty($request->input('name'))){
   			$obj->name = $request->input('name');
   		}
   		if(!empty($request->input('sex'))){
   			$obj->name = $request->input('sex');
   		}
   		$obj->save();
   		return response()->json(['code'=>200]);
   	}
   	public function editChild(Request $request)
   	{
   		$id = $request->input('id');
   		$obj = ParentChild::find($id);
   		return  view('front.views.parent.editChild',['res'=>$obj]);
   	}
   	public function editPost(Request $request)
   	{
   		$id = $request->input('id');
   		$obj = ParentChild::find($id);
   		$obj->name = $request->input('name');
   		$obj->sex = $request->input('sex');
   		$obj->save();
   		return response()->json(['code'=>200]);
   	}
   	public function deleteChild(Request $request)
   	{
   		$id = $request->input('id');
   		$obj = ParentChild::find($id);
   		$obj->status = 0;
   		$obj->save();
   		return response()->json(['code'=>200]);
   	}
}
