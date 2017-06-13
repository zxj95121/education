<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function subjectManage()
    {
    	return view('admin.os.subjectManage');
    }
}
