<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhpqrcodeController;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\AdminInfo;
use App\Models\AdminScanLogin;
use Session;
use QrCode;

class HomeController extends Controller
{
    public function index()
    {
    	return view('admin.dashboard');
    }

    public function login()
    {
    	/*访问，是否要生成二维码*/
    	$processEnd = AdminScanLogin::where('status', '3')
    		->select('id', 'scan_url')
    		->get();
    	if ($processEnd->count() <= 0) {
    		/*已完成的二维码没有了*/
    		$date = date('Y-m-d H:i:s', time()-1800);//半小时有效
    		$timeOver = AdminScanLogin::where('created_at', '<', $date)
    			->select('id', 'scan_url')
    			->get();
    		if ($timeOver->count() <= 0) {
    			/*也没有过期的*/
    			$rand = date('YmdHis').'_'.rand(1000,9999).'.png';
    			$path = 'admin/images/login_qrcode/'.$rand;
    			
    			/*插入数据库*/
    			$flight = new AdminScanLogin();
    			$flight->scan_url = $rand;
    			$flight->save();

    			$qrcodeInfo['id'] = $flight->id;
    			$qrcodeInfo['qrcode'] = url('/admin/images/login_qrcode/'.$flight->scan_url);

                QrCode::format('png')->size(200)->generate(url('/admin/scanConfirmOauth?id='.$qrcodeInfo['id']), public_path($path));

    		} else {
				$qrcodeInfo['id'] = $timeOver[0]->id;
    			$qrcodeInfo['qrcode'] = url('/admin/images/login_qrcode/'.$timeOver[0]->scan_url);

    			$flight = AdminScanLogin::find($qrcodeInfo['id']);
    			$flight->created_at = date('Y-m-d H:i:s');
    			$flight->status = 1;
    			$flight->save();
    		}
    	} else {
    		$qrcodeInfo['id'] = $processEnd[0]->id;
    		$qrcodeInfo['qrcode'] = url('/admin/images/login_qrcode/'.$processEnd[0]->scan_url);

    		$flight = AdminScanLogin::find($qrcodeInfo['id']);
			$flight->created_at = date('Y-m-d H:i:s');
			$flight->status = 1;
			$flight->save();
    	}
    	return  view('admin.login', ['qrcodeInfo'=>$qrcodeInfo]);
    }

    /*请求扫码二维码是否成功*/
    public function scanok(Request $request) {
    	// dd($request->all());
    	return response()->json(['errcode'=>0]);
    }

    /*用户扫码进行登录确认的页面(网页授权)*/
    public function scanConfirmOauth(Request $request)
    {
        Session::put('scan_id', $request->input('id'));
        return redirect(OauthController::getUrl(2, 2));
    }

    public function scanConfirm(Request $request)
    {
        $id = Session::get('scan_id');
        Session::forget('scan_id');
        $openid = Session::get('openid');
        return view('admin.login.scan_confirm');
    }
}
