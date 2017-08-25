<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherOne;
use App\Models\TeacherTwo;
use App\Models\TeacherThree;
use App\Models\TeacherFour;
use App\Models\ClassPrice;
use App\Models\BigOrder;
use App\Models\EclassOrder;

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
        else if ($type == 3)
            $name = $twoObj->name;
        return $name;
    }


    public static function getUnitPriceByCount($tid, $count)
    {

        $priceObj = ClassPrice::where('status', 1)
            ->where('tid', $tid)
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

        return $unitPrice;
    }

    public static function getUnitPriceByStandard($tid)
    {

        $priceObj = ClassPrice::where('status', 1)
            ->where('tid', $tid)
            ->select('area', 'price')
            ->get()[0];

        $unitPrice = $priceObj->price;

        return $unitPrice;
    }

    public static function getStandardPrice($id)
    {
        /*传入大订单的ID*/
        $eclassObj = EclassOrder::where('bid', $id)
            ->where('status', 1)
            ->select('id', 'tid', 'count')
            ->get();

        $price = 0;
        foreach ($eclassObj as $value) {
            $oneId = TeacherThree::where('teacher_three.id', $value->tid)
                ->leftJoin('teacher_two as tt', 'tt.id', 'teacher_three.pid')
                ->leftJoin('teacher_one as to', 'to.id', 'tt.pid')
                ->select('to.id')
                ->first()
                ->id;

            $priceObj = ClassPrice::where('status', 1)
                ->where('tid', $oneId)
                ->select('area', 'price')
                ->get()[0];

            $unitPrice = $priceObj->price;

            $price += $value->count*$unitPrice;

            return number_format($price, 2);
        }
    }
}
