<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BanJi;

class ProgressController extends Controller
{
    public function index()
    {
    	$banji = BanJi::where('status', '1')
    		->get();
    	return view('admin.teacher.progress',['banji'=>$banji]);
    }
}
