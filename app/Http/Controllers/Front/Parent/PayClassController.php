<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentDetail;
use App\Models\TeacherFour;
use App\Models\TeacherThree;
use App\Models\TeacherTwo;
use App\Models\TeacherOne;
use App\Models\UserType;
use App\Models\EclassOrder;
use App\Models\ParentChild;
use App\Models\NewUser;
use App\Models\BigOrder;


use App\Http\Controllers\EclassPriceController;

use Session;
use DB;

class PayClassController extends Controller
{
	/*新订单*/
	public function newEclassOrder(Request $request) {
		// var_dump($request->all());
		/*
		array(1) {
		  [4]=>
		  array(2) {
		    ["name"]=>
		    string(18) "英语自然拼读"
		    ["val"]=>
		    array(1) {
		      [58]=>
		      array(2) {
		        ["name"]=>
		        string(41) "Phonics Unit 8 . 自然拼读第八单元"
		        ["count"]=>
		        int(6)
		      }
		    }
		  }
		}
		*/
		$openid = Session::get('openid');
		$userObj = NewUser::where('openid', $openid)->first();
		$voucher = $userObj->voucher;//代金券可用金额

		$cartTotal = $request->input('cartTotal');
		$cartOrder = json_decode($request->input('cartOrder'), true);
		// dd(1);

		$order_no = 'EC'.date('YmdHis').rand(10000,99999);
		$price = 0;
		foreach ($cartOrder as $key => $value) {
			$count = 0;
			foreach ($value['val'] as $v) {
				$count += (int)$v['count'];
			}

			$twoPid = TeacherTwo::find($key)->pid;
			$price += $count*EclassPriceController::getUnitPriceByCount($twoPid, $count);
		}

		$bigPrice = $price;
		$vnum = floor($bigPrice/1000);
        $vouNum = 0;
        for ($i = 0; $i < $vnum; $i++) {
            if (($voucher-88)>=0) {
                $voucher -= 88;
                $vouNum++;
            }
        }
        $bigPrice = $bigPrice-(88*$vouNum);

		/*开始大订单插入*/
		DB::beginTransaction();
		$flight = new BigOrder();
		$flight->order_no = $order_no;
		$flight->openid = $openid;
		$flight->count = $cartTotal;
		$flight->voucher_num = $vouNum;
		$flight->price = $bigPrice;
		$flight->save();
		/*大订单插入结束*/
		$bid = $flight->id;

		$num = 0;
		$twoCount = count($cartOrder);
		foreach ($cartOrder as $key => $value) {
			// $twoObj = TeacherTwo::find($key);
			if ($twoCount == 1) 
				$orderName = $value['name'];
			else 
				$orderName = $value['name'].'等';
			foreach ($value['val'] as $k => $v) {
				$num++;
				$no = $order_no.'-'.$num;/*大订单下的小订单号*/
				$threeObj = TeacherThree::find($k);
				$ksNum = TeacherFour::where('status', '1')
					->where('pid', $k)
					->count();
				$count = $v['count'];
				/*小订单*/
				$flight = new EclassOrder();
				$flight->order_no = $no;
				$flight->uid = $userObj->id;
				$flight->tid = $k;
				$flight->count = $ksNum;
				$flight->price = 0;
				$flight->bid = $bid;
				$flight->save();
			}
		}
		DB::commit();

		Session::put('bigOrder_id', $bid);
		Session::put('orderName', $orderName);
		// return view('front.views.parent.bigOrder');
		return redirect('/front/parent/newEclassOrder2');
		// exit;
	}

	public function newEclassOrder2(Request $request)
	{

		// $childName = Session::get('child');
		$openid = Session::get('openid');
		$bid = Session::get('bigOrder_id');
		$orderName = Session::get('orderName');
		$bigOrderObj = BigOrder::find($bid);
		return view('front.views.parent.bigOrder', ['bigOrderObj'=>$bigOrderObj,'orderName'=>$orderName]);
	}

	public function newEclassOrder00(Request $request)
	{
		$openid = Session::get('openid');
		$uid = $this->getUid($openid);
		/*新订单*/
		$tid = $request->input('id');
		// $child = $request->input('child');
		/*查取价格*/
		$res = EclassPriceController::getUnitPrice($tid);
		$count = $res['count'];
		$unitPrice = $res['unitPrice'];
		$price = number_format($count*$unitPrice, 2);
		$order_no = date('YmdHis', time()).rand(1000,9999);
		$flight = new EclassOrder();
		$flight->uid = $uid;
		$flight->tid = $tid;
		$flight->order_no = $order_no;
		$flight->count = $count;
		$flight->price = $price;
		// $flight->child = $child;
		$flight->save();
		$order_id = $flight->id;
		$name = EclassPriceController::getName($tid, 2);
		$firstName = EclassPriceController::getName($tid, 0);
		$classname = $firstName.$name;

		// $childName = ParentChild::find($flight->child)->name;
		Session::put('jname',$name);
		Session::put('jorder_id',$order_id);
		Session::put('jclassname',$classname);
		Session::put('jflight',$flight);
		// Session::put('child', $childName);
		return redirect('/front/parent/newEclassOrder2');
	}

	public function newEclassOrder200(Request $request)
	{
		$name = Session::get('jname');
		$order_id = Session::get('jorder_id');
		$classname = Session::get('jclassname');
		$flight = Session::get('jflight');
		// $childName = Session::get('child');
		return view('front.views.parent.eclassOrder', ['name'=>$name,'order_id'=>$order_id,'flight'=>$flight,'classname'=>$classname]);
	}

	public function showPayEclassOrder(Request $request)
	{
		$openid = Session::get('openid');
		$uid = $this->getUid($openid);
		/*新订单*/
		$order_id = $request->input('id');

		$flight = EclassOrder::find($order_id);

		// $childName = ParentChild::find($flight->child)->name;/*学生名称*/

		$name = EclassPriceController::getName($flight->tid, 2);
		$classname = EclassPriceController::getName($flight->tid);
		return view('front.views.parent.eclassOrder', ['name'=>$name,'order_id'=>$order_id,'flight'=>$flight,'classname'=>$classname,'back'=>'/front/parent/myClassOrder']);
	}

    public function checkMessage(Request $request)
    {
    	$openid = Session::get('openid');

		$id = $this->getUid($openid);

		// $flight = ParentDetail::find($id);

		$result = array();
		// $k = 0;
		// if ($flight->address == '') {
		// 	$result[$k]['word'] = '所在社区';
		// 	$result[$k++]['reason'] = '未填写';
		// }
		// if ($flight->place == '') {
		// 	$result[$k]['word'] = '栋单元楼层';
		// 	$result[$k++]['reason'] = '未填写';
		// }

		
		// if(isset($flight->classTimes)) 
		// 	$noTime = false;
		// else
		// 	$noTime = true;

		$noTime = false;/*新增关于去掉限制*/

		if(!$result && !$noTime) {
			/*读取课程数量*/
			$pid = $request->input('pid');
			// $child = $request->input('child');
			$threeObj = TeacherThree::find($pid);

			$twoid = $threeObj->pid;
			$twoObj = TeacherTwo::find($twoid);

			$oneid = $twoObj->pid;
			$oneObj = TeacherOne::find($oneid);

			// $count = TeacherFour::where('pid', $threeObj->id)
			// 	->where('status', 1)
			// 	->count();
			$name = $oneObj->name.$twoObj->name.$threeObj->name;

			/*查取单价*/
			$res = EclassPriceController::getUnitPrice($pid);
			$count = $res['count'];
			$unitPrice = $res['unitPrice'];
			$price = number_format($count*$unitPrice, 2);
			return view('front.views.home.checkMessageResult', ['result'=>$result,'noTime'=>$noTime,'name'=>$name,'count'=>$count,'price'=>$price,'id'=>$pid]);
		}
    	return view('front.views.home.checkMessageResult', ['result'=>$result,'noTime'=>$noTime]);
    }

    /*查孩子信息*/
    public function getChild(Request $request)
    {
    	/*getChild*/
    	$openid = Session::get('openid');

		$id = $this->getUid($openid);

		$childObj = ParentChild::where('status', '1')
			->where('pid', $id)
			->select('name','id')
			->get()
			->toArray();

		return response()->json(['errcode'=>0,'child'=>$childObj]);
    }

    private function getUid($openid)
    {
    	$userType = UserType::where('openid', $openid)
    		->select('uid')
    		->get()[0];
    	return $userType->uid;
    }
}
