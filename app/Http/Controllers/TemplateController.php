<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wechat;

class TemplateController extends Controller
{
    public static function send($openid,$title,$name,$type,$price,$time,$nickname,$remark)
    {
    	$access_token = Wechat::get_access_token();
    	$res = '{
				"touser":"'.$openid.'",
				"template_id":"Aes29u_WuVTbyxSZPHqB5g3gzjEsx7Pj_9CSqJXLB70",
				"url": "'.$_SERVER["SERVER_NAME"].'/parent/myClassOrder/oauth",
				"topcolor":"#FF0000",
    			"data":{
    				"first":{"value": "'.$title.'"},
    				"keyword1":{"value": "'.$name.'"},
    				"keyword2":{"value": "'.$type.'"},
    				"keyword3":{"value": "'.$price.'"},
    				"keyword4":{"value": "'.$time.'"},
    				"keyword5":{"value": "'.$nickname.'"},
    				"remark":{"value": "'.$remark.'"}
    				}
    			}';
    	Wechat::curl('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token['access_token'],$res);
    }
}