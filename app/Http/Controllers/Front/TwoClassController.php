<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeacherOne;
use App\Models\TeacherTwo;
use App\Models\TeacherThree;
use App\Models\TeacherFour;

class TwoClassController extends Controller
{
    public function index(){
    	$teacherone = TeacherOne::where('status','1')->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherone,'class'=>'class1']);
    }
    public function two(Request $request){
    	$pid = $request->input('pid');
    	$teachertwo = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teachertwo,'class'=>'class2']);
    }
    public function three(Request $request){
    	$pid = $request->input('pid');
    	$teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherthree,'class'=>'class3']);
    }
    public function four(Request $request){
    	$pid = $request->input('pid');
    	$teacherfour = TeacherFour::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherfour,'class'=>'class4']);
    }
}
