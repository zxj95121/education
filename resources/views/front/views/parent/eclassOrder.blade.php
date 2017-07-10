<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Api.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/jsapi/WxPay.JsApiPay.php';
//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();
//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("test");//商品描述
$input->SetOut_trade_no($flight->order_no);//商户订单号
$input->SetTotal_fee("1");//标价金额
$input->SetTime_start(date("YmdHis"));//交易起始时间
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
<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="/css/sm.min.css">
</head>
<body>
	<div class="page">
	  	<header class="bar bar-nav">
	    	<a class="button button-link button-nav pull-left" href="/demos/card" data-transition='slide-out'>
	      		<span class="icon icon-left"></span>
	      		返回
	    	</a>
	    	<h1 class="title">订单详情</h1>
	  	</header>
	  	<nav class="bar bar-tab">
	    	
	  	</nav>
	  	<div class="content">
  			<div class="content-block-title">双师class订单</div>
  				<div class="list-block">
    				<ul>
    					<li class="item-content">
        					<div class="item-media"><i class="icon icon-f7"></i></div>
        					<div class="item-inner">
          						<div class="item-title">订单编号</div>
          						<div class="item-after">{{$flight->order_no}}</div>
        					</div>
      					</li>
      					<li class="item-content">
        					<div class="item-media"><i class="icon icon-f7"></i></div>
        					<div class="item-inner">
          						<div class="item-title">课程名称</div>
          						<div class="item-after">一年级第一阶段</div>
        					</div>
      					</li>
      					<li class="item-content">
        					<div class="item-media"><i class="icon icon-f7"></i></div>
        					<div class="item-inner">
          						<div class="item-title">课时数量</div>
          						<div class="item-after">63</div>
        					</div>
      					</li>
      					<li class="item-content">
        					<div class="item-media"><i class="icon icon-f7"></i></div>
        					<div class="item-inner">
          						<div class="item-title">订单价格</div>
          						<div class="item-after" style="font-weight: bold;">¥2400</div>
        					</div>
      					</li>
      					<li class="item-content">
        					<div class="item-media"><i class="icon icon-f7"></i></div>
        					<div class="item-inner">
          						<div class="item-title">状态</div>
          						<div class="item-after">待支付</div>
        					</div>
      					</li>
				    </ul>
				    <div class="row" style="margin-top:30px;">
						<div class="col-100"><a href="#" class="button button-big button-fill button-success" id="order_pay" onclick="callpay()">立即支付</a></div>
					</div>
				</div>
			</div>
			
	  	</div>
	</div>

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
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
</body>
</html>