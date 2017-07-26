<?php

namespace App\Http\Controllers\Admin\OtherClass;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\ClassPackage;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
    	$discountObj = Discount::where('discount.status',1)
    					->leftJoin('class_package','discount.pid','class_package.id')
    					->select('discount.id','discount_price','start_time','probability','class_package.name','class_package.price')
    					->paginate(10);
    	return view('admin.otherClass.discount',['res'=>$discountObj]);
    }
    public function add(Request $request)
    {
    	$classpackageObj = ClassPackage::where('status',1)
    						->select('id','name','price')
    						->get();
    	return view('admin.otherClass.discountAdd',['classpackage'=>$classpackageObj]);
    }
    public function add_post(Request $request)
    {
    	$discountObj = new Discount();
    	$discountObj->pid = $request->input('pid');
    	$discountObj->discount_price = $request->input('discount_price');
    	$discountObj->probability = $request->input('probability');
    	$discountObj->start_time = $request->input('start_time');
    	$discountObj->save();
    	return response()->json(['code'=>200]);
    }
    public function edit(Request $request)
    {
     	$id = $request->input('id');
    	$discountObj =  Discount::where('discount.id',$id)
    					->leftJoin('class_package','discount.pid','class_package.id')
    					->select('discount.id','discount_price','start_time','probability','class_package.name','class_package.price')
    					->get()[0];
    	$classpackageObj = ClassPackage::where('status',1)
    					->select('id','name','price')
    					->get(); 
    	return view('admin.otherClass.discountEdit',['res'=>$discountObj, 'classpackage'=>$classpackageObj]);
    }
    public function edit_post(Request $request)
    {
    	$id = $request->input('id');
    	$discountObj = Discount::find($id);
    	$discountObj->pid = $request->input('pid');
    	$discountObj->discount_price = $request->input('discount_price');
    	$discountObj->probability = $request->input('probability');
    	$discountObj->start_time = $request->input('start_time');
    	$discountObj->save();
    	return response()->json(['code'=>200]);
    }
    public function delete(Request $request)
    {
    	$id = $request->input('id');
    	$discountObj = Discount::find($id);
    	$discountObj->status = 0;
    	$discountObj->save();
    	return redirect('admin/otherClass/discount');
    }
}
