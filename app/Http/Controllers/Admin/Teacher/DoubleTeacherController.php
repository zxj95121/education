<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeacherOne;
use App\Models\TeacherTwo;
use App\Models\TeacherThree;
use App\Models\TeacherFour;

class DoubleTeacherController extends Controller
{
	public function doubleTeacher(Request $request)
	{
		$teacherone = TeacherOne::where('status','!=','0')->select('id','status','name')->get();
		return view('admin.teacher.doubleTeacher',['res'=>$teacherone]);
	}
    public function oneAdd(Request $request)
    {
		return view('admin.teacher.oneAdd');
    }
	public function oneAdd_post(Request $request)
	{
		 $teacherone = new TeacherOne();
		 $teacherone->name = $request->input('text');
		 $teacherone->save();
		 return response()->json(['code'=>200]);
	}
	public function oneEdit(Request $request)
	{	
		$id = $request->input('id');
		$teacherone = TeacherOne::find($id);
		return view('admin.teacher.oneEdit',['res'=>$teacherone]);
	}
	public function oneEdit_post(Request $request)
	{
		$id = $request->input('id');
		$teacherone = TeacherOne::find($id);
		$teacherone->name = $request->input('text');
		$teacherone->save();
		return response()->json(['code'=>200]);
	}
	public function oneDelete(Request $request)
	{
		$id = $request->input('id');
		$teacherone = TeacherOne::find($id);
		$teacherone->status = 0;
		$teacherone->save();
		return redirect('admin/doubleTeacher');
	}
	public function oneHide(Request $request)
	{
		$id = $request->input('id');
		$teacherone = TeacherOne::find($id);
		$teacherone->status = 0 - $teacherone->status;
		$teacherone->save();
		return redirect('admin/doubleTeacher');
	}
}
