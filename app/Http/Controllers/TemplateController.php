<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wechat;

class TemplateController extends Controller
{
    public static function send($openid,$title,$name,$type,$price,$time,$nickname,$remark,$url)
    {
    	$access_token = Wechat::get_access_token();
    	$res = '{
				"touser":"'.$openid.'",
				"template_id":"Aes29u_WuVTbyxSZPHqB5g3gzjEsx7Pj_9CSqJXLB70",
				"url": "'.$url.'",
				"topcolor":"#FF0000",
    			"data":{
    				"first":{"value": "'.$title.'"},
    				"keyword1":{"value": "'.$name.'","color":"#173177"},
    				"keyword2":{"value": "'.$type.'","color":"#173177"},
    				"keyword3":{"value": "'.$price.'","color":"#173177"},
    				"keyword4":{"value": "'.$time.'","color":"#173177"},
    				"keyword5":{"value": "'.$nickname.'","color":"#173177"},
    				"remark":{"value": "'.$remark.'"}
    				}
    			}';
    	Wechat::curl('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token['access_token'],$res);
    }
}