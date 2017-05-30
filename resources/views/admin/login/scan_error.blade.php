<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
	<title>扫码错误提示</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<style type="text/css">
		body{
			width: 100%;
			max-width: 500px;
			margin: 0 auto;
		}
		#big{
			width: 95%;
			margin: 0 auto;
		}
		#icon_box{
			padding: 28px;
			text-align: center;
		}
		#box_ctn{
			font-size: 18px;
			padding: 12px;
		}
	</style>
</head>
<body>
	<div id="big">
	    <div class="icon-box" id="icon_box">
	        <i class="weui-icon-warn weui-icon_msg" id="icon_i"></i>
	        <div class="icon-box__ctn" id="box_ctn">
	            <p class="icon-box__desc">{{$error_data}}</p>
	        </div>
	    </div>

	    <div class="weui-footer">
		    <p class="weui-footer__text weui-footer_fixed-bottom">{{$phone_footer}}</p>
	    </div>
	</div>

	<script type="text/javascript" src="/admin/js/jquery-1.8.3.min.js"></script>

	<script type="text/javascript">
		$(function(){
			var boxW = parseFloat($('#big').width());
			$('#icon_i').css('fontSize', 0.3*boxW+'px');
		})
	</script>
</body>
</html>