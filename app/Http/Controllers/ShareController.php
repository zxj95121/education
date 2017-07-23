<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewUser;
use App\Http\Controllers\Wechat\OauthController;

class ShareController extends Controller
{
    public function index(Request $request)
    {
    	$openid = Session::get('openid');
    	$newuser = NewUser::where('openid',$openid)->select('id,type')->get();
    	$news = array("Title" =>"加辰教育", "Description"=>"加辰教育123", "PicUrl" =>'http://'.$_SERVER['SERVER_NAME'].'/admin/img/index.png', "Url" =>"http://".$_SERVER['SERVER_NAME']."/front/home?type=".$newuser[0]->type."&&id=".$newuser[0]->id);
    	return view('share',['news'=>$news]);
    }
    /*oauth*/
    public function oauth()
    {
    	return redirect(OauthController::getUrl(7, 0));
    }
}
