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
    	return view('front.views.home.twoclass1',['res'=>$teacherone]);
    }
    public function two(Request $request){
    	$teachertwo = TeacherTwo::where('status','1')->select('id','name')->get();
    	return view('front.views.home.twoclass2',['res'=>$teachertwo]);
    }
    public function three(Request $request){
    	
    }
    public function four(Request $request){
    	
    }
}
