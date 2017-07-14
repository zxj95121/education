<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BanJi;
use App\Models\DateType;
use App\Models\EclassOrder;
use App\Models\OrderClassTime;
use App\Models\EclassProgress;

class ProgressController extends Controller
{
    public function index()
    {
    	$banji = BanJi::where('status', '1')
    		->get();
    	return view('admin.teacher.progress',['banji'=>$banji]);
    }

    public function search(Request $request)
    {
    	$banji = $request->input('banji');
    	$date = $request->input('date');

    	/*1、根据date查今天是节假日还是上课日*/
    	$dateType = DateType::where('day', $date)
    		->where('status', '1')
    		->select('type')
    		->get();
    	if ($dateType->count() <= 0) {
    		return response()->json(['errcode'=>'1']);
    	}
    	$dateType = $dateType[0]->type;/*1表示节假日，2表示上课日*/
    	/*2、算出星期*/
    	$week = date('w', strtotime($date));
    	$week = ($week == 0)?'7':$week;
    	/*3、多表联查星期和日子类型查出所有*/
    	// var_dump($week);
    	// var_dump($dateType);
    	$orderObj = OrderClassTime::where('order_class_time.class_id', $banji)
    		->where('order_class_time.week', $week)
    		->where('order_class_time.type', $dateType)
    		->where('order_class_time.status', 1)
    		->leftJoin('eclass_order as eo', 'eo.id', 'order_class_time.order_id')
    		->leftJoin('parent_child as pc', function ($join) {
	            $join->on('pc.pid', '=', 'eo.uid')
	            	->on('pc.id', '=', 'eo.child');
	        })
	        ->leftJoin('class_time as ct', 'ct.id', 'order_class_time.ct_id')
	        ->leftJoin('teacher_three as tt', 'tt.id', 'eo.tid')
    		->select('order_class_time.id as oid', 'eo.order_no as order_no', 'pc.name as name', 'ct.low as low', 'ct.high as high', 'tt.name as className')
    		->get()
    		->toArray();
    	// dd($orderObj->toArray());
    	foreach ($orderObj as $key => $value) {
    		$oid = $value['oid'];
    		$count = EclassProgress::where('oid', $oid)
    			->count();
    		if ($count <= 0) {
    			$orderObj[$key]['progress_id'] = 0;
    			$orderObj[$key]['progress_name'] = '未开课';
    		} else {
    			$result = EclassProgress::where('eclass_progress.oid', $oid)
    				->where('status', 1)
    				->leftJoin('teacher_four as tf', 'tf.id', 'eclass_progress.fid')
    				->orderBy('eclass_progress.fid', 'desc')
    				->select('eclass_progress.id as progress_id', 'tf.name as progress_name')
    				->get()[0];
    			$orderObj[$key]['progress_id'] = $result->progress_id;
    			$orderObj[$key]['progress_name'] = $result->progress_name;
    		}
    	}
    	return response()->json(['errcode'=>0,'data'=>$orderObj]);
    }
}
