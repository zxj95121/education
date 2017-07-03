<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassPriceController extends Controller
{
    public function classPrice()
    {
    	return view('admin.teacher.classPrice');
    }
}
