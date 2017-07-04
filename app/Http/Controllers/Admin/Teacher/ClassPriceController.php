<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPrice;

class ClassPriceController extends Controller
{
    public function classPrice()
    {
    	$priceObj = ClassPrice::where('status', '1')
    		->select('id', 'area', 'price')
    		->orderBy('id')
    		->get();
    	return view('admin.teacher.classPrice', ['priceObj'=>$priceObj]);
    }

    public function newPrice(Request $request)
    {
   		$data = $request->input('data');

   		ClassPrice::where('status', '1')
   			->update(['status'=>0]);
    	
    	foreach ($data as $value) {
    		$flight = new ClassPrice();
    		$flight->price = $value['price'];
    		$flight->area = $value['area'];
    		$flight->save();
    	}

    	return response()->json(['errcode'=>0]);
    }
}
