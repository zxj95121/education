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
		$two = TeacherTwo::where('pid',$id)->get();
		if($two->count()>0){
			TeacherTwo::where('pid',$id)->update(['status'=>0]);
			foreach($two as $value){
				$twoid = $value->id;
				$three = TeacherThree::where('pid',$twoid)->select()->get();
				if($three->count() > 0){
					TeacherThree::where('pid',$twoid)->update(['status'=>0]);
					foreach($three as $vo2){
						$threeid = $vo2->id;
						$four = TeacherFour::where('pid',$threeid)->select()->get();
						if($four->count() > 0){
							TeacherFour::where('pid',$threeid)->update(['status'=>0]);
						}
					}
				}
			}
		}
		return redirect('admin/doubleTeacher');
	}
	public function oneHide(Request $request)
	{
		$id = $request->input('id');
		$teacherone = TeacherOne::find($id);
		$teacherone->status = 0 - $teacherone->status;
		$teacherone->save();
		$two = TeacherTwo::where('pid',$id)->get();
		if($two->count()>0){
			TeacherTwo::where('pid',$id)->where('status','<>',0)->update(['status'=>$teacherone->status]);
			foreach($two as $value){
				$twoid = $value->id;
				$three = TeacherThree::where('pid',$twoid)->select()->get();
				if($three->count() > 0){
					TeacherThree::where('pid',$twoid)->where('status','<>',0)->update(['status'=>$teacherone->status]);
					foreach($three as $vo2){
						$threeid = $vo2->id;
						$four = TeacherFour::where('pid',$threeid)->select()->get();
						if($four->count() > 0){
							TeacherFour::where('pid',$threeid)->where('status','<>',0)->update(['status'=>$teacherone->status]);
						}
					}
				}
			}
		}
		return redirect('admin/doubleTeacher');
	}
	public function teacherTwo(Request $request)
	{
		$id = $request->input('pid');
		$teacherone = TeacherOne::find($id);
		$teachertwo = TeacherTwo::where('status','!=','0')->where('pid',$id)->select()->get();
		return view('admin.teacher.teachertwo',['one'=>$teacherone,'res'=>$teachertwo]);
	}
	public function twoAdd(Request $request)
	{
		$pid = $request->input('pid');
		$teacherone = TeacherOne::find($pid);
		return view('admin.teacher.twoAdd',['one'=>$teacherone]);
	}
	public function twoAdd_post(Request $request)
	{
		$teachertwo = new TeacherTwo();
		$teachertwo->name = $request->input('text');
		$teachertwo->pid = $request->input('pid');
		$teachertwo->save();
		return response()->json(['code'=>200]);
	}
	public function twoEdit(Request $request)
	{
		$id = $request->input('id');
		$teachertwo = TeacherTwo::find($id);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.twoEdit',['res'=>$teachertwo,'one'=>$teacherone]);
	}
	public function twoEdit_post(Request $request)
	{
		$id = $request->input('id');
		$teachertwo = TeacherTwo::find($id);
		$teachertwo->name = $request->input('text');
		$teachertwo->save();
		return response()->json(['code'=>200,'pid'=>$teachertwo->pid]);
	}
	public function twoDelete(Request $request)
	{
		$id = $request->input('id');
		$teachertwo = TeacherTwo::find($id);
		$teachertwo->status = 0;
		$teachertwo->save();
		$three = TeacherThree::where('pid',$id)->select()->get();
		if($three->count() > 0){
			TeacherThree::where('pid',$id)->update(['status'=>0]);
			foreach($three as $vo2){
				$threeid = $vo2->id;
				$four = TeacherFour::where('pid',$threeid)->select()->get();
				if($four->count() > 0){
					TeacherFour::where('pid',$threeid)->update(['status'=>0]);
				}
			}
		}
		return redirect('admin/teachertwo?pid='.$teachertwo->pid);
	}
	public function twoHide(Request $request)
	{
		$id = $request->input('id');
		$teachertwo = TeacherTwo::find($id);
		$teachertwo->status = 0 - $teachertwo->status;
		$teachertwo->save();
		$three = TeacherThree::where('pid',$id)->select()->get();
		if($three->count() > 0){
			TeacherThree::where('pid',$id)->where('status','<>',0)->update(['status'=>$teachertwo->status]);
			foreach($three as $vo2){
				$threeid = $vo2->id;
				$four = TeacherFour::where('pid',$threeid)->select()->get();
				if($four->count() > 0){
					TeacherFour::where('pid',$threeid)->where('status','<>',0)->update(['status'=>$teachertwo->status]);
				}
			}
		}
		return redirect('admin/teachertwo?pid='.$teachertwo->pid);
	}
	public function teacherThree(Request $request)
	{
		$pid = $request->input('pid');
		$teacherthree = TeacherThree::where('status','!=','0')->where('pid',$pid)->select()->get();
		$teachertwo = TeacherTwo::find($pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.teacherthree',['one'=>$teacherone,'two'=>$teachertwo,'res'=>$teacherthree]);
	}
	public function threeAdd(Request $request)
	{
		$pid = $request->input('pid');
		$teachertwo = TeacherTwo::find($pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.threeAdd',['one'=>$teacherone,'two'=>$teachertwo]);
	}
	public function threeAdd_post(Request $request)
	{
		$teacherthree = new TeacherThree();
		$teacherthree->name = $request->input('text');
		$teacherthree->pid = $request->input('pid');
		$teacherthree->save();
		return response()->json(['code'=>200]);
	}
	public function threeEdit(Request $request)
	{
		$id = $request->input('id');
		$teacherthree = TeacherThree::find($id);
		$teachertwo = TeacherTwo::find($teacherthree->pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.threeEdit',['res'=>$teacherthree,'one'=>$teacherone,'two'=>$teachertwo]);
	}
	public function threeEdit_post(Request $request)
	{
		$id = $request->input('id');
		$teacherthree = TeacherThree::find($id);
		$teacherthree->name = $request->input('text');
		$teacherthree->save();
		return response()->json(['code'=>200,'pid'=>$teacherthree->pid]);
	}
	public function threeDelete(Request $request)
	{
		$id = $request->input('id');
		$teacherthree = TeacherThree::find($id);
		$teacherthree->status = 0;
		$teacherthree->save();
		$four = TeacherFour::where('pid',$id)->select()->get();
		if($four->count() > 0){
			TeacherFour::where('pid',$id)->update(['status'=>0]);
		}
		return redirect('admin/teacherthree?pid='.$teacherthree->pid);
	}
	public function threeHide(Request $request)
	{
		$id = $request->input('id');
		$teacherthree = TeacherThree::find($id);
		$teacherthree->status = 0 - $teacherthree->status;
		$teacherthree->save();
		$four = TeacherFour::where('pid',$id)->select()->get();
		if($four->count() > 0){
			TeacherFour::where('pid',$id)->where('status','<>',0)->update(['status'=>$teacherthree->status]);
		}
		return redirect('admin/teacherthree?pid='.$teacherthree->pid);
	}
	public function teacherFour(Request $request)
	{
		$pid = $request->input('pid');
		$teacherfour = TeacherFour::where('status','!=','0')->where('pid',$pid)->select()->get();
		$teacherthree = TeacherThree::find($pid);
		$teachertwo = TeacherTwo::find($teacherthree->pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.teacherfour',['one'=>$teacherone,'two'=>$teachertwo,'three'=>$teacherthree,'res'=>$teacherfour]);
	}
	public function fourAdd(Request $request)
	{
		$pid = $request->input('pid');
		$teacherthree = TeacherThree::find($pid);
		$teachertwo = TeacherTwo::find($teacherthree->pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.fourAdd',['one'=>$teacherone,'two'=>$teachertwo,'three'=>$teacherthree]);
	}
	public function fourAdd_post(Request $request)
	{
		$teacherfour = new TeacherFour();
		$teacherfour->name = $request->input('text');
		$teacherfour->pid = $request->input('pid');
		$teacherfour->save();
		return response()->json(['code'=>200]);
	}
	public function fourEdit(Request $request)
	{
		$id = $request->input('id');
		$teacherfour = TeacherFour::find($id);
		$teacherthree = TeacherThree::find($teacherfour->pid);
		$teachertwo = TeacherTwo::find($teacherthree->pid);
		$teacherone = TeacherOne::find($teachertwo->pid);
		return view('admin.teacher.fourEdit',['res'=>$teacherfour,'one'=>$teacherone,'two'=>$teachertwo,'three'=>$teacherthree]);
	}
	public function fourEdit_post(Request $request)
	{
		$id = $request->input('id');
		$teacherfour = TeacherFour::find($id);
		$teacherfour->name = $request->input('text');
		$teacherfour->save();
		return response()->json(['code'=>200,'pid'=>$teacherfour->pid]);
	}
	public function fourDelete(Request $request)
	{
		$id = $request->input('id');
		$teacherfour = TeacherFour::find($id);
		$teacherfour->status = 0;
		$teacherfour->save();
		return redirect('admin/teacherfour?pid='.$teacherfour->pid);
	}
	public function fourHide(Request $request)
	{
		$id = $request->input('id');
		$teacherfour = TeacherFour::find($id);
		$teacherfour->status = 0 - $teacherfour->status;
		$teacherfour->save();
		return redirect('admin/teacherfour?pid='.$teacherfour->pid);
	}
}
