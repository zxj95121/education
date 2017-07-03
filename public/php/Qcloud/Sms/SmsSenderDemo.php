<?php
function postPhoneCodeSms($phone,$code)
{
    require_once "SmsSender.php";
    try {
        // 请根据实际 appid 和 appkey 进行开发，以下只作为演示 sdk 使用
        $appid = 1400033207;
        $appkey = "731c695823783fb9fb78a77f0be26efd";
        $phoneNumber1 = $phone;
        $templId = 23619;

        $singleSender = new SmsSingleSender($appid, $appkey);

        // // 普通单发
        // $result = $singleSender->send(0, "86", $phoneNumber2, "测试短信，普通单发，深圳，小明，上学。", "", "");
        // $rsp = json_decode($result);
        // echo $result;
        // echo "<br>";


        // 指定模板单发
        // 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
        $params = array($code);
        $result = $singleSender->sendWithParam("86", $phoneNumber1, $templId, $params, "", "", "");
        $rsp = json_decode($result, true);
        return $rsp;
        // echo $result;

        // $multiSender = new SmsMultiSender($appid, $appkey);

        // // 普通群发
        // $phoneNumbers = array($phoneNumber1, $phoneNumber2, $phoneNumber3);
        // $result = $multiSender->send(0, "86", $phoneNumbers, "测试短信，普通群发，深圳，小明，上学。", "", "");
        // $rsp = json_decode($result);
        // echo $result;
        // echo "<br>";

        // // 指定模板群发，模板参数沿用上文的模板 id 和 $params
        // $params = array("指定模板群发", "深圳", "小明");
        // $result = $multiSender->sendWithParam("86", $phoneNumbers, $templId, $params, "", "", "");
        // $rsp = json_decode($result);
        // echo $result;
        // echo "<br>";
    } catch (\Exception $e) {
        echo var_dump($e);
    }
}