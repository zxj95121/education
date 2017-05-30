<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhpqrcodeController;

use App\Http\Controllers\Wechat\OauthController;

use App\Models\AdminInfo;
use App\Models\AdminScanLogin;
use Session;
use Config;
use Hash;
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

                QrCode::format('png')->size(200)->generate(url('/admin/scanConfirm/oauth?id='.$qrcodeInfo['id']), public_path($path));

    		} else {
				$qrcodeInfo['id'] = $timeOver[0]->id;
    			$qrcodeInfo['qrcode'] = url('/admin/images/login_qrcode/'.$timeOver[0]->scan_url);

    			$flight = AdminScanLogin::find($qrcodeInfo['id']);
    			$flight->created_at = date('Y-m-d H:i:s');
    			$flight->status = 1;
                $flight->admin_id = '0';
    			$flight->save();
    		}
    	} else {
    		$qrcodeInfo['id'] = $processEnd[0]->id;
    		$qrcodeInfo['qrcode'] = url('/admin/images/login_qrcode/'.$processEnd[0]->scan_url);

    		$flight = AdminScanLogin::find($qrcodeInfo['id']);
			$flight->created_at = date('Y-m-d H:i:s');
			$flight->status = 1;
            $flight->admin_id = '0';
			$flight->save();
    	}
    	return  view('admin.login', ['qrcodeInfo'=>$qrcodeInfo]);
    }

    /*请求扫码二维码是否成功*/
    public function scanok(Request $request) {
    	// dd($request->all());
        $id = $request->input('id');
        $flight = AdminScanLogin::find($id);
        if ($flight->status == 2 && $flight->admin_id != 0)
    	   return response()->json(['errcode'=>0]);
        else 
            return response()->json(['errcode'=>1]);
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

        $site_name = Config::get('constants.site_name');
        $phone_footer = Config::get('constants.phone_footer');

        $adminInfo = AdminInfo::where('openid', $openid)
            ->where('status', 1)
            ->select('id', 'scan_id')
            ->get();
        if ($adminInfo->count() <= 0) {
            return view('admin.login.scan_error',[
                'error_data' => '不是管理员',
                'phone_footer' => $phone_footer
            ]);
        } else {
            $admin_id = $adminInfo[0]['id'];
        }

        return view('admin.login.scan_confirm',[
            'site_name' => $site_name,
            'phone_footer' => $phone_footer,
            'scan_id' => $id,
            'admin_id' => $admin_id
        ]);
    }

    /*确认登录ajax*/
    public function scan_OK(Request $request)
    {
        $admin_id = $request->input('admin_id');
        $scan_id = $request->input('scan_id');

        $flight = AdminInfo::find($admin_id);
        $flight->scan_id = $scan_id;
        $flight->save();

        $flight = AdminScanLogin::find($scan_id);
        $flight->admin_id = $admin_id;
        $flight->status = '2';
        $flight->save();

        return response()->json(['errcode'=>0]);
    }

    /*检验密码是否正确*/
    public function passwordConfirm(Request $request)
    {
        $password = $request->input('password');
        $id = $request->input('id');

        $admin_id = AdminScanLogin::find($id)->admin_id;
        $real_password = AdminInfo::find($admin_id)->password;

        if ($real_password == Hash::make($password)){
            return response()->json(['errcode'=>0]);
        } else {
            return response()->json(['errcode'=>1]);
        }
    }
}
