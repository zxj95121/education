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
    public function index(Request $request){
    	$sess = Session::get('sess');
    	if(Session::has('sess')){
    		if($sess['class'] == 'class2'){
    			$this->twotwo();
    		}else if($sess['class'] == 'class3'){
    			$this->threethree();
    		}else if($sess['class'] == 'class4'){
    			$this->fourfour();
    		}
    		return;
    	}else{
    		$teacherone = TeacherOne::where('status','1')->select('id','name')->get();
    		$front_id = $this->getUid(Session::get('openid'));
    		$flight = ParentDetail::find($front_id);
    		return view('front.views.home.twoclass',['res'=>$teacherone,'class'=>'class1','parentDetail'=>$flight]);
    	}
    	
    }
    public function two(Request $request){
    	$pid = $request->input('pid');
    	if(empty($pid)){
			$sess = Session::get('sess');
			$pid = $sess['pid'];
    	}else{
    		$sess['pid'] = $pid;
    		$sess['class'] = 'class2';
    		Session::put('sess', $sess);
    	}
    	$teachertwo = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
        $front_id = $this->getUid(Session::get('openid'));
        $flight = ParentDetail::find($front_id);
    	return view('front.views.home.twoclass',['res'=>$teachertwo,'class'=>'class2','pid'=>$pid,'parentDetail'=>$flight]);
    }

    public function twotwo(){
        $sess = Session::get('sess');
        $pid = $sess['pid'];
        $teachertwo = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
        $front_id = $this->getUid(Session::get('openid'));
        $flight = ParentDetail::find($front_id);
        return view('front.views.home.twoclass',['res'=>$teachertwo,'class'=>'class2','pid'=>$pid,'parentDetail'=>$flight]);
    }

    public function three(Request $request){
    	$pid = $request->input('pid');
    	if(empty($pid)){
    		$sess = Session::get('sess');
    		$pid = $sess['pid'];
    	}else{
    		$sess['pid'] = $pid;
    		$sess['class'] = 'class3';
    		Session::put('sess', $sess);
    	}
        dd($pid);
    	$teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherthree,'class'=>'class3','pid'=>$pid]);
    }

    public function threethree(){
        $sess = Session::get('sess');
        $pid = $sess['pid'];
        $teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
        return view('front.views.home.twoclass',['res'=>$teacherthree,'class'=>'class3','pid'=>$pid]);
    }

    public function four(Request $request){
    	$pid = $request->input('pid');
    	if(empty($pid)){
    		$sess = Session::get('sess');
    		$pid = $sess['pid'];
    	}else{
    		$sess['pid'] = $pid;
    		$sess['class'] = 'class4';
    		Session::put('sess', $sess);
    	}
    	$teacherfour = TeacherFour::where('status','1')->where('pid',$pid)->select('id','name')->get();
    	return view('front.views.home.twoclass',['res'=>$teacherfour,'class'=>'class4','pid'=>$pid]);
    }

    public function fourfour(){
        $sess = Session::get('sess');
        $pid = $sess['pid'];
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
