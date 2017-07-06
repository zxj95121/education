<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('wx4c99c82dad498e47'), getenv('4c3b0c0a4dd30780c043d7461116020c'));
$signPackage = $jssdk->GetSignPackage();
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
          						<div class="item-after">2015102100000205</div>
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
						<div class="col-100"><a href="#" class="button button-big button-fill button-success" id="order_pay">立即支付</a></div>
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

	<script>$.init()</script>
	<script type="text/javascript">
		$(function(){
   			$.alert('fda');
		})
	</script>
	<script type="text/javascript">
		wx.config({
		    debug: false,
		    appId: '<?php echo $signPackage["appId"];?>',
		    timestamp: <?php echo $signPackage["timestamp"];?>,
		    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		    signature: '<?php echo $signPackage["signature"];?>',
		    jsApiList: [
		      	// 所有要调用的 API 都要加到这个列表中
		      	'hideAllNonBaseMenuItem',
		      	'closeWindow',
		      	'chooseWXPay'
		    ]
		});
		wx.ready(function () {
			$(document).on('click', '#order_pay', function(){
   				var version = parseInt(navigator.userAgent.split('Mozilla/')[1]);
   				if (version > 5) {
   					var time = new Date().getTime();
   					var  x="qTp0sU1Sr23tnNOPQuRl4ov5mHIJKLM6wy789xYabXckWdzeiZfhjgVABCDEFG";
   					var len = parseInt(Math.random()*10)+20;
   					var str = '';
   					for (var i = 0;i <= len;i++) {
   						str += x[parseInt(Math.random()*62)];
   					}
   					wx.chooseWXPay({
					    timestamp: time, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
					    nonceStr: str, // 支付签名随机串，不长于 32 位
					    package: '{{$order_id}}', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
					    signType: 'MD5', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
					    paySign: '', // 支付签名
					    success: function (res) {
					        // 支付成功后的回调函数
					    }
					});
   				}
   			})
		});
	</script>
</body>
</html>