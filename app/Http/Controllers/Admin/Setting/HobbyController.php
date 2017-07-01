<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Hobby;

class HobbyController extends Controller
{
    public function hobbyManage()
    {
    	$hobbyObj = Hobby::where('status', '1')
    		->select('id', 'name', 'type', 'created_at')
    		->groupBy('type', 'id', 'name', 'created_at')
    		->get();
    	// dd($hobbyObj->toArray());
    	return view('admin.os.hobbyManage', ['hobbyObj'=>$hobbyObj]);
    }

    public function newHobby(Request $request)
    {
    	$name = $request->input('name');
    	$type = $request->input('type');

    	$flight = new Hobby();
    	$flight->name = $name;
    	$flight->type = $type;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*隐藏hobby*/
    public function hideHobby(Request $request)
    {
    	$id = $request->input('id');
    	$flight = Hobby::find($id);
    	$flight->status = 0;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }
}
