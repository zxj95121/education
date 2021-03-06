<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Http\Controllers\Wechat\MsgCrypt;
use App\Http\Controllers\Wechat\Deal\SubscribeController;

class wechatIndexCatchonController extends Controller
{
    /*接受公众平台消息主PHP文件*/
    
    public function index()
    {
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
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = 'hehedada';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }
    
    private function responseMsg()
    {
        // $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents('php://input');
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
                    $result = $this->receiveImage1($postObj);
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
                $openid = $object->FromUserName;
                $subscribe = new SubscribeController();
                $subscribe->subscribe($openid);
                //             $content[] = array("Title"=>"【1】分组  笑话  信步校园  天气查询  星座
                // 【2】答题  宿管投票  微访谈  游戏
                // 【3】备注  天气查询  历史上的今天
                
                //  快快邀请身边同学关注，一起走进微师大吧！
                //  回复对应数字查看使用方法
                //  发送 0 返回本菜单",
                //                                "Description"=>"",
                //                                "PicUrl"=>"",
                //                                "Url" =>""
                //                               );
                //                 $result = $this->transmitText($object, '外教一对一，合适吗？双师Class，喜欢吗？不用担心哦/:rose孩子体验过了，就会知道啦/:v加辰教育中小学生外教一对一双师Class免费试听课，诚邀您的孩子和外教一起快乐学习，体验英语交流的乐趣/:share：
                
                // 1.【中小学外教一对一，双师Class】回复“我要试听”，即可领取免费试听课体验一次。
                
                // 2.【注册有礼】点击（“个人中心”绿色按钮），注册即送188元；外教一对一双师Class，定制由你哦/:rose
                
                // 3.【双师Class学年版】全年100次外教一对一双师Class课程，点击（“双师Class"绿色按钮），即可畅学全年啦/::)
                
                // 4.【家长亲子学英语】想陪伴孩子一起学习英语吗？请点击（“家长亲子”绿色按钮）/:handclap加辰教育鼓励家长亲子学英语，支持家长陪伴孩子一起学习，共同进步/:v
                
                // 另外，我还有自己的想法，怎么办？可以呀，更多服务，请检阅【加辰教育定制】菜单栏/:handclap');
                //                 $result = $this->transmitText($object, '外教一对一，合适吗？双师Class，喜欢吗？不用担心哦/:rose孩子体验过了，就会知道啦～加辰教育中小学生外教一对一双师Class免费试听课，诚邀您的孩子和外教一起快乐学习，体验英语交流的乐趣/:v：
                
                // 1.【中小学生外教一对一，双师Class】回复“我要试听”，即可领取免费试听课。
                
                // 2.【注册有礼】回复“注册”，就可以注册成为加辰教育学习会员啦～，注册即送188元哦/:rose
                
                // 3.【双师Class学年版】全年100次外教一对一双师Class课程，回复“双师Class"，即可定制课程，开启畅学模式～
                
                // 4.【家长亲子学英语】您愿意陪伴孩子一起学习英语吗？加辰教育鼓励家长亲子学英语，支持家长与孩子一起学习，共同进步。回复“家长亲子”，即可开启您的亲子学习之旅啦～
                
                // 合适的才是最好的，适应需求才是更有效的。更多课程与教学服务，请您展开页面下方菜单栏～您的需求，就是我们努力的方向。加油/:@@');
                $result = $this->transmitText($object, '记住四个单词：try，class，start ，learn，发出您的号令，加辰教育携手51Talk专业英语外教，乖乖陪您溜英语～

———————————
【免费51Talk】回复“try”，免费领取51Talk专业英语外教试听课；

【双师课堂】回复“class”，51Talk双师课程任您学；

【注册】回复“start”，注册即送188元；

【亲子共学】回复“learn”，陪孩子一起学习。
———————————

Try the class & start to learn.
Come on, let\'s study with CATCHON & 51Talk.');
                break;
            case "unsubscribe":
                break;
            case "click":
                switch($object->EventKey)
                {
                    case '1':
                        $a = 1;
                        break;
                }
                break;
            default:break;
        }
        return $result;
    }
    
    private function receiveText($object)
    {
        $keyword = $object->Content;
        if($keyword == 'SB')
        {
            $content = $object->FromUserName;
            $result = $this->transmitText($object, $content);
        }
        else if ($keyword == '半价购课网址') {
            $content = 'http://wechat.catchon-edu.cn/front/share/oauth';
            $result = $this->transmitText($object, $content);
        } else if ($keyword == 'try') {
            $contentArr[] = array(
                'Title' => '外教适不适合，孩子体验了才知道！',
                'Description' => '加辰教育中小学外教一对一双师Class免费试听课，诚邀您的孩子和外教一起快乐学习、体验英语交流的乐趣！',
                'PicUrl' => 'http://wechat.catchon-edu.cn/admin/images/wechat/free_reply4.png',
                'Url' => 'http://wechat.catchon-edu.cn/front/classFree/oauth'
            );
            $result = $this->transmitNews($object, $contentArr);
        } else if ($keyword == 'start') {
            $contentArr[] = array(
                'Title' => '给自己一次学习英语的机会，世界就在你的眼前',
                'Description' => '你还为学习英语而苦恼吗？你还在为没有良好的学习环境而着急吗？~不用担心，这些我们都能帮你，即日起，注册加辰教育即送188元！外教一对一双师Class,定制由你！',
                'PicUrl' => 'http://wechat.catchon-edu.cn/admin/images/wechat/register_reply.png',
                'Url' => 'http://wechat.catchon-edu.cn/front/home/oauth'
            );
            $result = $this->transmitNews($object, $contentArr);
        } else if (strcasecmp($keyword, 'class') == 0) {
            $contentArr[] = array(
                'Title' => '购买即可畅学全年啦!!!',
                'Description' => '外教一对一教学，英语课程顾问一对六辅导学习和英语活动班课程，这样的双师Class还不来快快抢购？',
                'PicUrl' => 'http://wechat.catchon-edu.cn/admin/images/wechat/class_reply.png',
                'Url' => 'http://wechat.catchon-edu.cn/front/classPackage?id=3'
            );
            $result = $this->transmitNews($object, $contentArr);
        } else if ($keyword == 'learn') {
            $contentArr[] = array(
                'Title' => '给你一个亲子乐园，快乐学习吧!',
                'Description' => '家长不仅能成为孩子的良好学习榜样，还能通过学习英语陪伴孩子一起成长，增进与孩子之间的感情。',
                'PicUrl' => 'http://wechat.catchon-edu.cn/admin/images/wechat/parent_reply.png',
                'Url' => 'http://wechat.catchon-edu.cn/front/classPackage?id=9'
            );
            $result = $this->transmitNews($object, $contentArr);
        }
        else
            return '';
            // $result = $this->transmitText($object, $keyword);
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
        $result = $this->transmitVoice($object, $content);;
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
        $face = array('/::)','/::~','/::B','/::|','/:8-)','/::<','/::$','/::X','/::Z','/::\'(','/::-|','/::@','/::P','/::D','/::O','/::(','/::+','/:Cb','/::Q','/::T','/:,@P','/:,@-D','/::d','/:,@o','/::g','/:|-)','/::!','/::L','/::>','/::,@','/:,@f','/::-S','/:?','/:,@x','/:,@@','/::8','/:,@!','/:!!!','/:xx','/:bye','/:wipe','/:dig','/:handclap','/:&-(','/:B-)','/:<@','/:@>','/::-O','/:>-|','/:P-(','/::\'|','/:X-)','/::*','/:@x','/:8*','/:pd','/:<W>','/:beer','/:basketb','/:oo','/:coffee','/:eat','/:pig','/:rose','/:fade','/:showlove','/:heart','/:break','/:cake','/:li','/:bome','/:kn','/:footb','/:ladybug','/:shit','/:moon','/:sun','/:gift','/:hug','/:strong','/:weak','/:share','/:v','/:@)','/:jj','/:@@','/:bad','/:lvu','/:no','/:ok','/:love','/:<L>','/:jump','/:shake','/:<O>','/:circle','/:kotow','/:turn','/:skip','/[]','/:#-0','/[]','/:kiss','/:<&','/:&>','/:v');
        $word = array('微笑','伤心','美女','发呆','墨镜','哭','羞','哑','睡','哭','囧','怒','调皮','笑','惊讶','难过','酷','汗','抓狂','吐','笑','快乐','奇','傲','饿','累','吓','汗','高兴','闲','努力','骂','疑问','秘密','乱','疯','哀','鬼','打击','bye','汗','抠','鼓掌','糟糕','恶搞','什么','什么','累','看','难过','难过','坏','亲','吓','可怜','刀','水果','酒','篮球','乒乓','咖啡','美食','动物','鲜花','枯','唇','爱','分手','生日','电','炸弹','刀','足球','虫','臭','月亮','太阳','礼物','伙伴','赞','差','握手','优','恭','勾','顶','坏','爱','不','好的','爱','吻','跳','怕','尖叫','圈','拜','回头','跳','天使','激动','舞','吻','瑜伽','太极','胜利');
        $content = str_replace($face, $word, $message);
        return $content;
    }
    
}
