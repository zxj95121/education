<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TemplateController;
class HtmlController extends Controller
{
    // public function index(Request $request)
    // {
    // 	// $res = explode('/', $_SERVER['REQUEST_URI'])[2];
    // 	// echo $res;
    // 	$res = $request->input('res');
    // 	$views = $this->$res();
    // 	return view($views);
    // }
    public function index(){
        $access_token = 'kIHWDyEjSBDeGhOnGk_vKGWoAoqlh0CW7E4j0qdmX0vdcyTy6b6j6IKcsD7M_pSv9YqvOk_k5nEecaHvFmxRMaLgqnH7mL8jxh2a4LDVYbMgWPQGB3BinVp9KU9M8GhbWWRiAGAZZU';
        $openid = 'oild4wHv3pTetKtuaI28ylHO3fIM';
        // $bill = new Bill();
        // $bill->oid = $order->id;
        // $bill->save();
        // $parentObj = ParentInfo::find($uid);
        // $name = EclassPriceController::getName($order->tid, 2);
        // $firstName = EclassPriceController::getName($order->tid, 0);
        $name = '张安安';
        $firstName = 'zxj';
        Template::send($openid,'关于双师Class订单支付成功的通知',$firstName,$name,'15','201515202','订单支付成功，请耐心等待管理员审核');
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
}
