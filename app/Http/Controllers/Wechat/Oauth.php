<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OauthUrlRedirect;

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
    	dd($request->all());
    }
}
