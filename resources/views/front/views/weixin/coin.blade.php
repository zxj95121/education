<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
		<title>加辰教育定制</title>
		<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
<!-- 		<link rel="shortcut icon" href="/favicon.ico">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black"> -->

		<!-- <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css"> -->
		<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">

		<!-- <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css"> -->
		<style type="text/css">
			img{
				width: 100%;
			}
			.header{
				width: 100%;
				height: 40px;
				line-height: 40px;
				font-size: 20px;
				color: #FFF;
				background: #22AAE8;
				text-align: center;
			}
		</style>
	</head>
	<body>
	<div class="container-fluid" style="padding: 0px;">
		<!-- <div id="shareDiv" style="display:none;z-index: 9999;width: 100%;height: 100%;opacity: 1;position: fixed;top: 0px;left: 0px;">
			<img src="/images/share2.png" style="width: 100%;"> 
		</div> -->
		<header class="header">
			我的加辰币
		</header>
		<!-- <div style="width: 96%;margin: 0 auto;"> -->
			
			<section style="border: 0px none; padding: 0px;">
				<section style="margin: 5px 2px -40px; text-align: center;">
					<section class="ImbWord ImbBgColor" data-bglessp="-90" style="display: inline-block; width: 50%; padding: 10px; border: 1px solid rgb(214, 214, 214); border-radius: 2px; font-size: 15px; margin-top: 3px; color: rgb(255, 255, 255); line-height: 1.5em; background-color: rgb(192, 168, 60);" data-width="50%">
						<span style="font-size:14px">可用</span>
					</section>
					<section class="ImbWord ImbBgColor" style="display: inline-block; width: 50%; padding: 10px; border: 1px solid rgb(214, 214, 214); border-radius: 2px; margin-top: 3px; color: rgb(255, 255, 255); line-height: 1.5em; background-color: rgb(14, 206, 255); font-size: 14px;" data-width="50%">
						<strong><span style="">不可用</span></strong>
					</section>
				</section>
				<section style="margin: -15px 2px 2px; text-align: center; font-weight:bold;">
					<span style=";;color:#FF0000;background-color:#FEFEFE; border-bottom-left-radius:50%; border-bottom-right-radius:50%; border-top-left-radius:50%; border-top-right-radius:50%; display:inline-block; height:35px !important; line-height:35px; width:35px">
						-
					</span>
				</section>
			</section>
		<!-- </div> -->
	</div>

		<!-- <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script> -->
		<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<script>
		    wx.config({
		        debug: false,
		        appId: '<?php echo $signPackage["appId"];?>',
		        timestamp: <?php echo $signPackage["timestamp"];?>,
		        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		        signature: '<?php echo $signPackage["signature"];?>',
		        jsApiList: [
		            // 所有要调用的 API 都要加到这个列表中
		            'checkJsApi',
		            'onMenuShareTimeline',
		            'onMenuShareAppMessage',
		            'hideAllNonBaseMenuItem',
	                'showMenuItems'
		          ]
		    });
		    wx.ready(function () {
			});
		</script>

	</body>
