<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SchoolOne;
use App\Models\SchoolTwo;
class SchoolController extends Controller
{
    public function schoolManage(Request $request)
    {
    	$data['schoolone'] = SchoolOne::where('status',1)->select('id','name','is_student')->get();
    	$data['schooltwo'] = SchoolTwo::where('school_two.status',1)
    	->leftJoin('school_one','school_two.pid','=','school_one.id')
    	->select('school_two.id','school_two.name','pid','school_one.name as pname')->get();
    	$arr = array();
    	foreach ($data['schoolone'] as $value) {
    		$arr[$value->id] = true;
    	}
    	return view('admin.os.schoolManage',['data'=>$data,'arr'=>$arr]);
    }
    public function schooloneAdd(Request $request)
    {
    	$schoolone = new SchoolOne();
    	$schoolone->name = $request->input('text');
    	$schoolone->is_student = $request->input('student');
    	$schoolone->save();
    	$id = $schoolone->id;
    	return response()->json(['id'=>$id]);
    }
    public function schooloneEdit(Request $request)
    {
    	$id = $request->input('fenleiid');
    	$schoolone = SchoolOne::find($id);
    	$schoolone->name = $request->input('text');
    	$schoolone->is_student = $request->input('student');
    	$schoolone->save();
    	return response()->json(['code'=>200]);
    }
    public function schooloneDelete(Request $request)
    {
    	$id = $request->input('fenleiid');
    	$schoolone = SchoolOne::find($id);
    	$schoolone->status = -1;
    	$schoolone->save();
    	$schooltwo = SchoolTwo::where('pid',$id)->update(['status'=>-1]);
    	return response()->json(['code'=>200]);
    }
    public function schooltwoAdd(Request $request)
    {
    	$schooltwo = new SchoolTwo();
    	$schooltwo->pid = $request->input('fenleiid');
    	$schooltwo->name = $request->input('text');
    	$schooltwo->save();
    	return response()->json(['id'=>$schooltwo->id]);
    }
    public function schooltwoEdit(Request $request)
    {
    	$id = $request->input('xkid');
    	$schooltwo = SchoolTwo::find($id);
    	$schooltwo->name = $request->input('text');
    	$schooltwo->save();
    	return response()->json(['code'=>200]);
    }
    public function schooltwodelete(Request $request)
    {
    	$id = $request->input('xkid');
    	$schooltwo = SchoolTwo::find($id);
    	$schooltwo->status = -1;
    	$schooltwo->save();
    	return response()->json(['code'=>200]);
    }
}
