<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeacherOne;
use App\Models\TeacherTwo;
use App\Models\TeacherThree;
use App\Models\TeacherFour;
use App\Models\UserType;
use App\Models\ParentDetail;

use Session;

class TwoClassController extends Controller
{
    public function index(){
    	$teacherone = TeacherOne::where('status','1')->select('id','name')->get();
        $front_id = $this->getUid(Session::get('openid'));
        $flight = ParentDetail::find($front_id);
    	return view('front.views.home.twoclass',['res'=>$teacherone,'class'=>'class1','parentDetail'=>$flight]);
    }
    public function two(Request $request){
    	$pid = $request->input('pid');
    	$teachertwo = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teachertwo,'class'=>'class2','pid'=>$pid]);
    }
    public function three(Request $request){
    	$pid = $request->input('pid');
    	$teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherthree,'class'=>'class3','pid'=>$pid]);
    }
    public function four(Request $request){
    	$pid = $request->input('pid');
    	$teacherfour = TeacherFour::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherfour,'class'=>'class4','pid'=>$pid]);
    }
    public function back(Request $request){
    	$pid = $request->input('pid');
    	$fenlei = $request->input('fenlei');
    	switch ($fenlei){
    		case 'class2':
    			$res = TeacherOne::where('status','1')->select('id','name')->get();
    			$fenlei = 'class1';
    			break;
    		case 'class3';
    			$res = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
    			$fenlei = 'class2';
    			break;
    		case 'class4';
    			$res = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
    			$fenlei = 'class3';
    			break;
    	}
    	return view('front.views.home.twoclass',['res'=>$res,'class'=>$fenlei]);
    }

    private function getUid($openid)
    {
        $userType = UserType::where('openid', $openid)
            ->select('uid')
            ->get()[0];
        return $userType->uid;
    }
}
