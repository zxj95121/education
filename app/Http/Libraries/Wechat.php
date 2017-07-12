<?php
namespace App\Http\Libraries;

use Illuminate\Support\ServiceProvider;
use Session;
use App\Models\AccessToken;

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
        $flight = AccessToken::find(1);
        $temp = 0;
        if (!$flight) {
            $temp = 1;
        } else {
            $time = time();
            $oldTime = strtotime($flight->updated_at);
            if ($time-$oldTime >= 3600) {
                $temp = 2;
            }
        }

        if ($temp == 0) {
            $result['access_token'] = $flight->access_token;
            return $result;
        }

        if($type == 'service')
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.getenv('APPID').'&secret='.getenv('APPSECRET');
        else
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.getenv('SUBID').'&secret='.getenv('SUBSECRET');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        if ($temp == 1) {
            $flight = new AccessToken();
            $result = json_decode($output,true);
            $flight->access_token = $result['access_token'];
            $flight->save();
        } elseif ($temp == 2) {
            $flight = AccessToken::find(1);
            $result = json_decode($output,true);
            $flight->access_token = $result['access_token'];
            $flight->save();
        }
        return json_decode($output,true);
    }
}

?>