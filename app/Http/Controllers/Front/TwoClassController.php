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

use App\Http\Controllers\Front\EclassPriceController;
use Session;

class TwoClassController extends Controller
{
    public function index(Request $request){
    	$sess = Session::get('sess');
    	if(Session::has('sess')){
    		if($sess['class'] == 'class2'){
    			$array = $this->twotwo();
    		}else if($sess['class'] == 'class3'){
    			$array = $this->threethree();
    		}else if($sess['class'] == 'class4'){
    			$array = $this->fourfour();
    		}
    		return view('front.views.home.twoclass',$array);
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
        $array = ['res'=>$teachertwo,'class'=>'class2','pid'=>$pid,'parentDetail'=>$flight];
        return $array;
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
    	$teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
        $nameObj = TeacherTwo::where('id', $pid)->select('name')->get()[0];
    	return view('front.views.home.twoclass',['res'=>$teacherthree,'class'=>'class3','pid'=>$pid,'name'=>$nameObj->name]);
    }

    public function threethree(){
        $sess = Session::get('sess');
        $pid = $sess['pid'];
        $teacherthree = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
        $nameObj = TeacherTwo::where('id', $pid)->select('name')->get()[0];
        $array = ['res'=>$teacherthree,'class'=>'class3','pid'=>$pid,'name'=>$nameObj->name];
        return $array;
    }

    public function getpid(){
        if (Session::has('sess')) {
            $sess = Session::get('sess');
            $class = $sess['class'];
            if ($class == 'class4') {
                $pid = $sess['pid'];
                $pid2 = TeacherThree::where('status', '1')
                    ->where('id', $pid)
                    ->select('pid')
                    ->get()[0]->pid;
                $pid1 = TeacherTwo::where('status', '1')
                    ->where('id', $pid2)
                    ->select('pid')
                    ->get()[0]->pid;
                echo json_encode(['errcode'=>0,'pid1'=>$pid1,'pid2'=>$pid2]);
                exit;
            } elseif ($class == 'class3') {
                $pid = $sess['pid'];
                $pid1 = TeacherTwo::where('status', '1')
                    ->where('id', $pid)
                    ->select('pid')
                    ->get()[0]->pid;
                $pid2 = $pid;
                echo json_encode(['errcode'=>0,'pid1'=>$pid1,'pid2'=>$pid2]);
                exit;
            }
        } else {
            echo json_encode(['errcode'=>1]);
            exit;
        }
        
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
        $array = ['res'=>$teacherfour,'class'=>'class4','pid'=>$pid];
        return $array;
    }

    public function back(Request $request){
    	$pid = $request->input('pid');
        // dd($pid);
    	$fenlei = $request->input('fenlei');
    	switch ($fenlei){
    		case 'class2':
    			$res = TeacherOne::where('status','1')->select('id','name')->get();
    			$fenlei = 'class1';
                Session::forget('sess');
    			break;
    		case 'class3';
    			$res = TeacherTwo::where('status','1')->where('pid',$pid)->select('id','name')->get();
    			$fenlei = 'class2';
                Session::put('sess', array('class'=>'class2','pid'=>$pid));
    			break;
    		case 'class4';
    			$res = TeacherThree::where('status','1')->where('pid',$pid)->select('id','name')->get();
    			$fenlei = 'class3';
                Session::put('sess', array('class'=>'class3','pid'=>$pid));
                return view('front.views.home.twoclass',['res'=>$res,'class'=>$fenlei,'pid'=>$pid]);
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
