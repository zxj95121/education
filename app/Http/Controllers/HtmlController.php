<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TemplateController;
class HtmlController extends Controller
{
    public function index(Request $request)
    {
    	// $res = explode('/', $_SERVER['REQUEST_URI'])[2];
    	// echo $res;
    	$res = $request->input('res');
    	$views = $this->$res();
    	return view($views);
    }
    private function chat(){
        return 'front.views.parent.chat';
    }

    private function register(){
    	return 'front.views.index';
    }

	private function homepage(){
    	return 'front.views.home.homepage';
    }
    private function apply(){
        return 'admin.login.apply_admin';
    }

    private function home()
    {
        return 'front.views.home.homepage';
    }

    private function parent_info()
    {
        return 'front.views.user_info.user_info_parent_add';
    }

    private function teacher_info()
    {
        return 'front.views.user_info.user_info_teacher_add';
    }

    private function classTime()
    {
        return 'front.views.parent.setClassTime';
    }

    private function order()
    {
        return 'front.views.parent.eclassOrder';
    }

    private function myOrder()
    {
        return 'front.views.parent.myClassOrder';
    }

    private function coin()
    {
        return 'front.views.weixin.coin';
    }
}
