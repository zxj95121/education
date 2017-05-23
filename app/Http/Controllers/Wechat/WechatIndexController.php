<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\MsgCrypt;

class WechatIndexController extends Controller
{
	/*接受公众平台消息主PHP文件*/
	public function index()
	{
        define("TOKEN", "wechat");
        define("AppID", 'wx54db7ab47eccc1fa');
        define("EncodingAESKey", "Pex9yqGKjNAT1qUMtnuLb3i75v4WYHOPwfYPfeWfDVt");
        if (!isset($_GET['echostr'])) {
                $this->responseMsg();
                exit;
        }else{
                $this->valid();
        }
    }

    private function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
	    // you must define TOKEN by yourself
	    if (!defined("TOKEN")) {
	        throw new Exception('TOKEN is not defined!');
	    }

	    $signature = $_GET["signature"];
	    $timestamp = $_GET["timestamp"];
	    $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
		// use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
                return true;
        }else{
                return false;
        }
    }


	public function responseMsg()
    {
        $postStr=file_get_contents("php://input");
        //$encrypt_type='aes';
        // $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            //用户发送的消息类型判断
            switch (strtolower($RX_TYPE))
            {
                case "event":
                        $result = $this->receiveEvent($postObj);
                        break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "voice":
                    $result = $this->receiveText($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                default:
                    $result = "unknow msg type: ".$RX_TYPE;
                    break;
            }
            //加密
            /*if ($encrypt_type == 'aes'){
                $encryptMsg = ''; //加密后的密文
                $errCode = $pc->encryptMsg($result, $timeStamp, $nonce, $encryptMsg);
                $result = $encryptMsg;
            }*/

            echo $result;
        }else {
            echo "";
            exit;
        }
    }


}
