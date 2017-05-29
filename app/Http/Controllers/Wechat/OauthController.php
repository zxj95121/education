<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OauthUrlRedirect;

use Wechat;
use Session;

class OauthController extends Controller
{
    public static function getUrl($url_id,$scope=1){
    	/**
    	* @author 张贤健
    	* 生成要跳转的网站授权地址
    	*/
    	$url = 'http://'.getenv('SITE_ADMIN').'/oauth/getCode';
    	if ($scope == 1) {
    		$scope = 'snsapi_userinfo';
    	} else {
    		$scope = 'snsapi_base';
    	}
    	$state = 'u-'.$url_id;

    	$oauth_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.
    		getenv('APPID').'&redirect_uri='.
    		urlencode($url).'&response_type=code&scope='
    		.$scope.'&state='
    		.$state.'#wechat_redirect';
    	return $oauth_url;
    }

    public function getCode(Request $request){
    	$code = $request->input('code');
    	$state = $request->input('state');
    	$id = explode('-', $state)[1];

    	$flight = OauthUrlRedirect::find($id);

    	if ($flight->status == 1) {
    		$redirect_url = 'http://'.getenv('SITE_FRONT').$flight->url;
    	} else {
    		$redirect_url = 'http://'.getenv('SITE_ADMIN').$flight->url;
    	}

    	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.
    		getenv('APPID').'&secret='.
    		getenv('APPSECRET').'&code='.
    		$code.'&grant_type=authorization_code';

    	echo $ur;
    	$data = Wechat::curl($url);
    	var_dump($data);
    	exit;
    	if (isset($data['access_token'])){
    		/*通过code获取到信息了*/
    		$access_token = $data['access_token'];
    		$openid = $data['openid'];
    		session::put('openid', $openid);
    		return redirect($redirect_url);
    	} else if(isset($data['openid'])) {
    		//静默授权进来的
    		$openid = $data['openid'];
    		Session::put('openid', $openid);
    		return redirect($redirect_url);
    	} else {
    		return redirect('/front/error_403');
    	}
    }
}
