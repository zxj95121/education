<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgressController extends Controller
{
    public function index()
    {
    	return view('admin.teacher.progress');
    }
}
