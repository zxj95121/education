<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;


class BillController extends Controller
{
   	public function bill(Request $request)
   	{
   		$res = Bill::where('status',1)
   		->leftJoin('eclass_order','eclass_order.id','oid')
   		->leftJoin('parent_info as pi', 'pi.id', 'eclass_order.uid')
   		->select('bill.id','bill.created_at','eclass_order.order_no','eclass_order.price','parent_info.name')
   		->get();
   	}
}
