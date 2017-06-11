<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    public function parent()
    {
    	return view('front.views.user_info.user_info_parent_add');
    }

    public function teacher()
    {
    	return view('front.views.user_info.user_info_teacher_add');
    }
}
