<?php
namespace App\Http\Libraries;

use Illuminate\Support\ServiceProvider;
use Session;

class Wechat extends ServiceProvider
{
	/**
	* @author 张贤健
	* @function curl请求微信接口等
	* @program $url,$data=null
	*/
	public static function curl($url, $data = null)
	{
		// ------------------------------------------------------------------------
        //curl发送接口请求信息
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output,true);
    }


	// ------------------------------------------------------------------------
	/*
            默认为service，传入别的值表示为sub订阅号
    */
    public static function get_access_token($type = 'service')
    {
        if($type == 'service')
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.getenv('APPID').'&secret='.getenv('APPSECRERT');
        else
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.getenv('SUBID').'&secret='.getenv('SUBSECRET');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output,true);
    }

    // ------------------------------------------------------------------------
    /*
            默认为service，传入别的值表示为sub订阅号

    */
    public static function check()
    {
        if(Session::get('openid'))
            return true;
        else
            return false;
    }
}

?>