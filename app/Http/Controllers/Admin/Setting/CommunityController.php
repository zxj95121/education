<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\CommunityCommunity;

class CommunityController extends Controller
{
    public function communityManage()
    {
    	/*找出所有的一级分类*/
    	$cityInfo = CommunityCity::where('status', '1')
    		->get();
    	return view('admin.os.communityManage',['cityInfo'=>$cityInfo]);
    }

    /*请求所有的数据*/
    public function getAll(Request $request)
    {
    	
    }

    public function cityAdd(Request $request)
    {
    	$name = $request->input('val');
    	$flight = new CommunityCity();
    	$flight->name = $name;
    	$flight->save();
    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }
}
