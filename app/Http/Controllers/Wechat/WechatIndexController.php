<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Wechat\MsgCrypt;

class WechatIndexController extends Controller
{
	/*接受公众平台消息主PHP文件*/
	public function __construct(){
        parent::__construct();
    }
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
    private function receiveEvent($object)
    {
        switch(strtolower($object->Event))
        {
            case "subscribe":
            $content="欢迎关注！";
            $result = $this->transmitText($object, $content);
            break;
            case "unsubscribe":
            break;
            case "SCAN":
            $content = "扫描";
            $result = $this->transmitText($object, $content);
            break;
            case 'location':
            $data['FromUserName'] = $object->FromUserName;
            $data['ToUserName'] = $object->ToUserName;
            $data['CreateTime'] = $object->CreateTime;
            $data['Latitude'] = $object->Latitude;
            $data['Longitude'] = $object->Longitude;
            $data['Precision'] = $object->Precision;
            $this->db->insert('wechat_location',$data);
            $file=$_SERVER['DOCUMENT_ROOT'].'weixin/public/1.txt';
            file_put_contents($file, $content);
            return 'success';
            break;
            case "click":
                switch($object->EventKey)
                {  
                    case "新游戏":
                        include('./game/main.php');
                        $shop=new Shop('开始游戏');
                        $result = $this->transmitText($object,$shop->deal($object->FromUserName));
                    break;
                    case "下一周":
                        include('./game/main.php');
                        $shop=new Shop('下一周');
                        $result = $this->transmitText($object,$shop->deal($object->FromUserName));
                    break;
                    case "代金券":
                        include('./game/main.php');
                        $shop=new Shop('');
                        $result = $this->transmitText($object,$shop->cx_djq($object->FromUserName));
                    break;
                    case "最高分":
                        include('./game/main.php');
                        $shop=new Shop('');
                        $result = $this->transmitText($object,$shop->cx_money($object->FromUserName));
                    break;
                    case "times":
                        include('./game/main.php');
                        $shop=new Shop('');
                        $result = $this->transmitText($object,$shop->cx_times($object->FromUserName));
                    break;
                    case "":
                        $contentStr[] = array(
                            "Title" => "",
                            "Description" => "",
                            "PicUrl" =>"",
                            "Url" =>""                  
                        );
                            $result=$this->transmitNews($object,$contentStr);
                        break;
                    default:
                    break;
                }
                break;
            default:break;
        }
        return $result;
    }
    
    private function receiveText($object)
    {
        $keyword=$object->Content;
        $openid=$object->FromUserName;
        if($keyword=='SB')
            $content=date('Y-m-d H:i:s',time());
        else
            $content=$keyword;
        $content = $object->FromUserName;
        $result = $this->transmitText($object,$content);
        return $result;
    }
    
    private function receiveImage($object)
    {
        //回复图片消息 
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);;
        return $result;
    }

    private function receiveVoice($object)
    {
        //回复语音消息 
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitVoice($object, $content);
        return $result;
    }

    private function receiveVideo($object)
    {
        //回复视频消息 
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = $this->transmitVideo($object, $content);;
        return $result;
    }  
    
    /*
     * 回复文本消息
     */
    private function transmitKefu($object)
    {
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[transfer_customer_service]]></MsgType>
        </xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
    
    //回复链接消息
    
    /*
     * 回复图片消息
     */
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
    <MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
    /*
     * 回复语音消息
     */
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
    <MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
    /*
     * 回复视频消息
     */
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
    <MediaId><![CDATA[%s]]></MediaId>
    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    
    /*
     * 回复图文消息
     */
    private function transmitNews($object, $arr_item)
    {
        if(!is_array($arr_item))
            return;

        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $result;
    }
    
    /*
     * 回复音乐消息
     */
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    //QQ表情文档
    private function getqqemoij($content)
    {
        $face = array('/::)','/::~','/::B','/::|','/:8-)','/::<','/::$','/::X','/::Z','/::\'(','/::-|','/::@','/::P','/::D','/::O','/::(','/::+','/:Cb','/::Q','/::T','/:,@P','/:,@-D','/::d','/:,@o','/::g','/:|-)','/::!','/::L','/::>','/::,@','/:,@f','/::-S','/:?','/:,@x','/:,@@','/::8','/:,@!','/:!!!','/:xx','/:bye','/:wipe','/:dig','/:handclap','/:&-(','/:B-)','/:<@','/:@>','/::-O','/:>-|','/:P-(','/::\'|','/:X-)','/::*','/:@x','/:8*','/:pd','/:<W>','/:beer','/:basketb','/:oo','/:coffee','/:eat','/:pig','/:rose','/:fade','/:showlove','/:heart','/:break','/:cake','/:li','/:bome','/:kn','/:footb','/:ladybug','/:shit','/:moon','/:sun','/:gift','/:hug','/:strong','/:weak','/:share','/:v','/:@)','/:jj','/:@@','/:bad','/:lvu','/:no','/:ok','/:love','/:<L>','/:jump','/:shake','/:<O>','/:circle','/:kotow','/:turn','/:skip','/[]','/:#-0','/[]','/:kiss','/:<&','/:&>');
        $word = array('微笑','伤心','美女','发呆','墨镜','哭','羞','哑','睡','哭','囧','怒','调皮','笑','惊讶','难过','酷','汗','抓狂','吐','笑','快乐','奇','傲','饿','累','吓','汗','高兴','闲','努力','骂','疑问','秘密','乱','疯','哀','鬼','打击','bye','汗','抠','鼓掌','糟糕','恶搞','什么','什么','累','看','难过','难过','坏','亲','吓','可怜','刀','水果','酒','篮球','乒乓','咖啡','美食','动物','鲜花','枯','唇','爱','分手','生日','电','炸弹','刀','足球','虫','臭','月亮','太阳','礼物','伙伴','赞','差','握手','优','恭','勾','顶','坏','爱','不','好的','爱','吻','跳','怕','尖叫','圈','拜','回头','跳','天使','激动','舞','吻','瑜伽','太极');
        $content = str_replace($face, $word, $message);
        return $content;
    }
    private function https_request($url, $data = null){
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
        return $output;
    }

}
