<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BanJi;
use App\Models\DateType;
use App\Models\EclassOrder;
use App\Models\OrderClassTime;
use App\Models\EclassProgress;
use App\Models\TeacherFour;

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
    		->where('eo.complete', '0')
    		->leftJoin('parent_child as pc', function ($join) {
	            $join->on('pc.pid', '=', 'eo.uid')
	            	->on('pc.id', '=', 'eo.child');
	        })
	        ->leftJoin('class_time as ct', 'ct.id', 'order_class_time.ct_id')
	        ->leftJoin('teacher_three as tt', 'tt.id', 'eo.tid')
	        ->leftJoin('teacher_two as ttwo', 'ttwo.id', 'tt.pid')
	        ->leftJoin('teacher_one as tone', 'tone.id', 'ttwo.pid')
    		->select('order_class_time.order_id as oid', 'order_class_time.id as oct_id', 'eo.order_no as order_no', 'pc.name as name', 'ct.low as low', 'ct.high as high', 'tt.name as className', 'ttwo.name as twoClassName', 'tone.name as oneClassName', 'order_class_time.ct_id as ct_id')
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
    				->where('eclass_progress.status', 1)
    				->leftJoin('teacher_four as tf', 'tf.id', 'eclass_progress.fid')
    				->orderBy('eclass_progress.fid', 'desc')
    				->select('eclass_progress.id as progress_id', 'tf.name as progress_name', 'eclass_progress.day as date')
    				->get()[0];
    			if (EclassProgress::where('oid', $oid)->where('day', $date)->where('ct_id', $value['ct_id'])->count() > 0) {
    				$orderObj[$key]['is_set'] = 1;
    			} else {
    				$orderObj[$key]['is_set'] = 0;
    			}
    			$orderObj[$key]['progress_id'] = $result->progress_id;
    			$orderObj[$key]['progress_name'] = $result->progress_name;
    		}
    	}
    	return response()->json(['errcode'=>0,'data'=>$orderObj]);
    }

    /*getClass*/
    public function getClass(Request $request)
    {
    	$oid = $request->input('oid');

    	$count = EclassProgress::where('oid', $oid)
    			->count();
		if ($count <= 0) {
			$data['progress_id'] = 0;
			$data['progress_name'] = '没有进度';
		} else {
	    	$result = EclassProgress::where('eclass_progress.oid', $oid)
				->where('eclass_progress.status', 1)
				->leftJoin('teacher_four as tf', 'tf.id', 'eclass_progress.fid')
				->where('tf.status', 1)
				->orderBy('eclass_progress.fid', 'desc')
				->select('eclass_progress.fid as progress_id', 'tf.name as progress_name')
				->get()[0];
			$data['progress_id'] = $result->progress_id;
			$data['progress_name'] = $result->progress_name;
		}

		$all = EclassOrder::where('eclass_order.id', $oid)
			->leftJoin('teacher_four as tf', 'tf.pid', 'eclass_order.tid')
			->where('tf.status', '1')
			->select('tf.id', 'tf.name')
			->get();

		return response()->json(['errcode'=>0,'data'=>$data,'all'=>$all]);
    }

    /*设置新的课程进度*/
    public function setDetailProgerss(Request $request)
    {
    	$oid = $request->input('oid');
    	$fid = $request->input('fid');
    	$date = $request->input('date');
    	$ct_id = $request->input('ct_id');

    	$flight = new EclassProgress();
    	$flight->oid = $oid;
    	$flight->fid = $fid;
		$flight->ct_id = $ct_id;
		$flight->day = $date;
		$flight->save();

		/*查询这个fid是否是最后一个ID，是的话就将这个订单变成已完成状态*/

		$fourFlight = TeacherFour::find($fid);
		$pid = $fourFlight->pid;
		$last = TeacherFour::where('pid', $pid)
			->select('id')
			->orderBy('id', 'desc')
			->get()[0]->id;

		if ($last == $fid) {
			/*这已经是最后一个课程*/
			$eclass = EclassOrder::find($oid);
			$eclass->complete = '1';
			$eclass->save();
		}

		return response()->json(['errcode'=>0]);
    }
}
