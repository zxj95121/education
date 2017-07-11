<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Api.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/jsapi/WxPay.JsApiPay.php';
//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();
//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("test");//商品描述
$input->SetAttach("test");//附加数据
$input->SetOut_trade_no('2015080612534'.time());//商户订单号
$input->SetTotal_fee("1");//标价金额
$input->SetTime_start(date("YmdHis"));//交易起始时间
$input->SetGoods_tag("test");//订单优惠标记
$input->SetNotify_url("http://api.zhangxianjian.com/wxpay/notify");//通知地址
$input->SetTrade_type("JSAPI");//交易类型
$input->SetOpenid($openId);//用户标识
$order = WxPayApi::unifiedOrder($input);
$jsApiParameters = $tools->GetJsApiParameters($order);
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付样例-支付</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function callpay()
	{
		WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg == "get_brand_wcpay_request:ok"){
						window.location.href="http://blog.sina.com.cn/u/1863605217";  
					}else{
						window.location.href="http://blog.sina.com.cn/u/1863605217";  
					}  
				}
		);
	}
	</script>
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>