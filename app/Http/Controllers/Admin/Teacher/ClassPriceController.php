<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPrice;
use App\Models\TeacherOne;

class ClassPriceController extends Controller
{
    public function classPrice()
    {
        $teacherOneObj = TeacherOne::where('status', 1)
            ->select('id', 'name')
            ->get();

        if(count($teacherOneObj) > 0) {
            $oneTid = $teacherOneObj[0]->id;

            $priceObj = ClassPrice::where('status', '1')
            ->select('id', 'area', 'price')
            ->where('tid', $oneTid)
            ->orderBy('id')
            ->get();
        } else {
            $priceObj = array();
        }

        
    	return view('admin.teacher.classPrice', ['priceObj'=>$priceObj,'teacherOne'=>$teacherOneObj]);
    }

    public function newPrice(Request $request)
    {
   		$data = $request->input('data');
        $id = $request->input('id');

   		ClassPrice::where('tid', $id)
            ->where('status', '1')
   			->update(['status'=>0]);
    	
    	foreach ($data as $value) {
    		$flight = new ClassPrice();
            $flight->tid = $id;
    		$flight->price = $value['price'];
    		$flight->area = $value['area'];
    		$flight->save();
    	}

    	return response()->json(['errcode'=>0]);
    }


    public function getTeacherPrice(Request $request)
    {
        $tid = $request->input('id');

        $priceObj = ClassPrice::where('status', '1')
            ->select('id', 'area', 'price')
            ->where('tid', $tid)
            ->orderBy('id')
            ->get();
        $priceObjLength = count($priceObj);
        // @php $priceObjLength = count($priceObj); @endphp
        $str = '';
        foreach($priceObj as $key => $value) {
            $str .= '<tr><td>'.($key+1).'</td><td>';
            if($key == 0)
                $str .= '<='.$value->area;
            elseif($key == $priceObjLength-1)
                $str .= '>='.$value->area;
            else
                $str .= $value->area;
            $str .= '</td><td>'.number_format((float)$value->price, 2).'</td></tr>';
        }

        return response()->json(['errcode'=>0,'str'=>$str]);
    }
}
