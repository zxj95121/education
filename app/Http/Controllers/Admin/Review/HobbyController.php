<?php

namespace App\Http\Controllers\Admin\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SchoolApply;
use App\Models\SchoolOne;
use App\Models\SchoolTwo;
use App\Models\Hobby;
use App\Models\HobbyApply;
use App\Models\ParentInfo;
use App\Models\ParentDetail;
use App\Models\TeacherInfo;
use App\Models\TeacherDetail;

class HobbyController extends Controller
{
    public function applyHobby()
    {
    	$hobbyApplyInfo = HobbyApply::leftJoin('user_type as ut', 'ut.openid', 'hobby_apply.openid')
    		->select('hobby_apply.id as id', 'hobby_apply.name as hobbyName', 'hobby_apply.status', 'hobby_apply.created_at as time', 'ut.type as type', 'ut.uid as uid')
    		->orderBy('hobby_apply.status')
    		->get();
    	$hobbyInfo = array();
    	foreach ($hobbyApplyInfo as $key => $value) {
    		$hobbyInfo[$key]['id'] = $value->id;
    		$hobbyInfo[$key]['hobbyName'] = $value->hobbyName;
    		$hobbyInfo[$key]['status'] = $value->status;
    		$hobbyInfo[$key]['time'] = $value->time;

    		/*查该名称是否已经存在*/
    		$count = Hobby::where('name', $value->hobbyName)
    			->where('status', '1')
    			->count();
    		$hobbyInfo[$key]['explain'] = $count;

	    	switch ($value->type) {
	    		case '2':
	    			$flightInfo = ParentInfo::find($value->uid);   
	    			$flightDetail = ParentDetail::find($value->uid);   
	    			break;
	    		case '3':
	    			$flightInfo = TeacherInfo::find($value->uid);   
	    			$flightDetail = TeacherDetail::find($value->uid);
	    			break;
	    		default:
	    			break;
	    	}

	    	$hobbyInfo[$key]['name'] = $flightDetail->name;
	    	$hobbyInfo[$key]['nickname'] = $flightInfo->name;
	    	$hobbyInfo[$key]['phone'] = $flightInfo->phone;
	    }

    	return view('admin.review.applyHobby', ['hobbyInfo'=>$hobbyInfo]);
    }

    public function failed(Request $request)
    {
    	$id = $request->input('id');

    	/*驳回申请，状态改为2*/
    	$flight = HobbyApply::find($id);
    	$flight->status = 2;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*通过申请*/
    public function success(Request $request)
    {
    	$id = $request->input('id');
    	$type = $request->input('type');
    	$name = $request->input('name');

    	$flight = new Hobby();
    	$flight->name = $name;
    	$flight->type = $type;
    	$flight->save();

    	/*通过申请，状态改为1*/
    	$flight = HobbyApply::find($id);
    	$flight->status = 1;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }
}
