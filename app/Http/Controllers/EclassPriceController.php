<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherOne;
use App\Models\TeacherTwo;
use App\Models\TeacherThree;
use App\Models\TeacherFour;
use App\Models\ClassPrice;

class EclassPriceController extends Controller
{
    public static function getUnitPrice($id){
    	$threeObj = TeacherThree::find($id);
    	$pid = $threeObj->id;

    	$count = TeacherFour::where('pid', $pid)
    		->where('status', 1)
    		->count();

    	$priceObj = ClassPrice::where('status', 1)
    		->select('area', 'price')
    		->get();

    	foreach ($priceObj as $key => $value) {
    		$area = $value->area;
    		$arr = explode('-', $area);
    		if (count($arr) == 1 && $key == 0) {
    			if ($count <= $arr[0]) {
    				$unitPrice = $value->price;
    				break;
    			}
    		} else if (count($arr) == 1 && $key != 0) {
    			if ($count >= $arr[0]) {
    				$unitPrice = $value->price;
    				break;
    			}
    		} else {
    			if ($count >= $arr[0] && $count <= $arr[1]) {
    				$unitPrice = $value->price;
    				break;
    			}
    		}
    	}

    	return array('count'=>$count,'unitPrice'=>$unitPrice);
    }

    public static function getName($id, $type=1, $sign='')
    {
        $threeObj = TeacherThree::find($id);

        $twoid = $threeObj->pid;
        $twoObj = TeacherTwo::find($twoid);

        $oneid = $twoObj->pid;
        $oneObj = TeacherOne::find($oneid);

        if ($type == 1)
            $name = $oneObj->name.$sign.$twoObj->name.$sign.$threeObj->name;
        else if ($type == 2)
            $name = $twoObj->name.$sign.$threeObj->name;
        else if ($type == 0)
            $name = $oneObj->name;
        return $name;
    }
}
