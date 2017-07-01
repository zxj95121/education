<?php

namespace App\Http\Controllers\Admin\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SchoolApply;
use App\Models\SchoolOne;
use App\Models\SchoolTwo;
use App\Models\ParentInfo;
use App\Models\ParentDetail;
use App\Models\TeacherInfo;
use App\Models\TeacherDetail;

class SchoolController extends Controller
{
    public function applySchool()
    {
    	$schoolApplyInfo = SchoolApply::leftJoin('user_type as ut', 'ut.openid', 'school_apply.openid')
    		->select('school_apply.id as id', 'school_apply.name as schoolName', 'school_apply.status', 'school_apply.created_at as time', 'ut.type as type', 'ut.uid as uid')
    		->orderBy('school_apply.status')
    		->get();
    	$schoolInfo = array();
    	foreach ($schoolApplyInfo as $key => $value) {
    		$schoolInfo[$key]['id'] = $value->id;
    		$schoolInfo[$key]['schoolName'] = $value->schoolName;
    		$schoolInfo[$key]['status'] = $value->status;
    		$schoolInfo[$key]['time'] = $value->time;

    		/*查该名称是否已经存在*/
    		$count = SchoolTwo::where('name', $value->schoolName)
    			->where('status', '1')
    			->count();
    		$schoolInfo[$key]['explain'] = $count;

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

	    	$schoolInfo[$key]['name'] = $flightDetail->name;
	    	$schoolInfo[$key]['nickname'] = $flightInfo->name;
	    	$schoolInfo[$key]['phone'] = $flightInfo->phone;
	    }

	    /*读取一级分类*/
	    $schoolOneInfo = SchoolOne::where('status', '1')
	    	->select('id', 'name')
	    	->get();

    	return view('admin.review.applySchool', ['schoolInfo'=>$schoolInfo,'schoolOneInfo'=>$schoolOneInfo]);
    }

    public function failed(Request $request)
    {
    	$id = $request->input('id');

    	/*驳回申请，状态改为2*/
    	$flight = SchoolApply::find($id);
    	$flight->status = 2;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }

    /*通过申请*/
    public function success(Request $request)
    {
    	$id = $request->input('id');
    	$cid = $request->input('cid');
    	$name = $request->input('name');

    	$flight = new SchoolTwo();
    	$flight->name = $name;
    	$flight->pid = $id;
    	$flight->save();

    	/*通过申请，状态改为1*/
    	$flight = SchoolApply::find($cid);
    	$flight->status = 1;
    	$flight->save();

    	return response()->json(['errcode'=>0]);
    }
}
