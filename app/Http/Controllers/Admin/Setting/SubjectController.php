<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SubjectOne;
use App\models\SubjectTwo;

class SubjectController extends Controller
{
    public function subjectManage()
    {
    	$data['subjectone'] = SubjectOne::where('status',1)->select('id','name')->get();
		$data['subjecttwo'] = SubjectTwo::where('subject_two.status',1)
								->leftJoin('subject_one','subject_two.pid','=','subject_one.id')
								->select('subject_two.id','subject_two.name','pid','subject_one.name as pname')->get();
		$arr = array();
		foreach ($data['subjectone'] as $value) {
			$arr[$value->id] = true;
		}
		return view('admin.os.subjectManage',['data'=>$data,'arr'=>$arr]);
    }
    public function subjectoneAdd(Request $request)
    {
    	$subjectone = new SubjectOne(); 
    	$subjectone->name = $request->input('text');
    	$subjectone->save();
    	$id = $subjectone->id;
    	return response()->json(['id'=>$id]);
    }
    public function subjectoneEdit(Request $request)
    {
    	 $id = $request->input('fenleiid');
    	 $subjectone = SubjectOne::find($id);
    	 $subjectone->name = $request->input('text');
    	 $subjectone->save();
    	 return response()->json(['code'=>200]);
    }
    public function subjectoneDelete(Request $request)
    {
    	$id = $request->input('fenleiid');
    	$subjectone = SubjectOne::find($id);
    	$subjectone->status = -1;
    	$subjectone->save();
    	return response()->json(['code'=>200]);
    }
    public function subjecttwoAdd(Request $request)
    {
    	$subjecttwo = new SubjectTwo();
    	$subjecttwo->pid = $request->input('fenleiid');
    	$subjecttwo->name = $request->input('text');
    	$subjecttwo->save();
    	return response()->json(['id'=>$subjecttwo->id]);
    }
    public function subjecttwoEdit(Request $request)
    {
    	$id = $request->input('xkid');
    	$subjecttwo = SubjectTwo::find($id);
    	$subjecttwo->name = $request->input('text');
    	$subjecttwo->save();
    	return response()->json(['code'=>200]);
    }
    public function subjecttwoDelete(Request $request)
    {
    	$id = $request->input('xkid');
    	$subjecttwo = SubjectTwo::find($id);
    	$subjecttwo->status = -1;
    	$subjecttwo->save();
    	return response()->json(['code'=>200]);
    }
}
