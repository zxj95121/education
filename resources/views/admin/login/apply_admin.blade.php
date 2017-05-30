<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
	<title>申请管理员</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<link rel="stylesheet" type="text/css" href="/css/sm.min.css">
	<style type="text/css">
		body{
			width: 100%;
			max-width: 500px;
			margin: 0 auto;
			font-size: 14px;
		}
		#big{
			width: 95%;
			margin: 0 auto;
		}
	</style>
</head>
<body>
	<div id="big">
		<header class="bar bar-nav">
	  		<h1 class='title'>加辰教育定制申请管理员</h1>
		</header>
		<div class="content">
		  	<div class="list-block" style="margin-top: 10px;">
		    	<ul>
			      	<!-- Text inputs -->
			      	<li>
			        	<div class="item-content">
				          	<div class="item-media"><i class="icon icon-form-name"></i></div>
				          	<div class="item-inner">
			            		<div class="item-title label">姓名</div>
			            		<div class="item-input">
			              			<input type="text" id="name" placeholder="真实姓名">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			      	<li>
				      	<div class="item-content">
				      		<div class="weui-cell weui-cell_vcode">
				                <div class="weui-cell__hd">
				                    <label class="weui-label">手机号</label>
				                </div>
				                <div class="weui-cell__bd">
				                    <input class="weui-input" type="tel" id="phone" placeholder="请输入手机号">
				                </div>
				                <div class="weui-cell__ft">
				                    <button class="weui-vcode-btn" id="getPhoneCode">获取验证码</button>
				                </div>
				            </div>
			            </div>
			      	</li>
			      	<li>
			        	<div class="item-content">
			          		<div class="item-media"><i class="icon icon-form-email"></i></div>
			          		<div class="item-inner" style="border-top: 1px solid #E7E7E7;">
			            		<div class="item-title label">验证码</div>
			            		<div class="item-input">
			              			<input type="password" id="password1" placeholder="请输入4位数字验证码">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			      	<li>
			        	<div class="item-content">
			          		<div class="item-media"><i class="icon icon-form-email"></i></div>
			          		<div class="item-inner">
			            		<div class="item-title label">密码</div>
			            		<div class="item-input">
			              			<input type="password" id="password1" placeholder="6-18位数字字母">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			      	<li>
			        	<div class="item-content">
			          		<div class="item-media"><i class="icon icon-form-email"></i></div>
			          		<div class="item-inner">
			            		<div class="item-title label">确认密码</div>
			            		<div class="item-input">
			              			<input type="password" id="password2" placeholder="6-18位数字字母">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			    </ul>
			</div>
		  	<div class="content-block">
		    	<div class="row">
		      		<div class="col-50" style="width: 100%;text-align: center;"><a href="#" class="button button-big button-fill button-success">提交申请</a></div>
		    	</div>
	  		</div>
		</div>
	</div>

	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/js/zepto.min.js"></script>
	<script type="text/javascript" src="/js/sm.min.js"></script>
	<script type="text/javascript" src="/admin/js/jquery-1.8.3.min.js"></script>
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
		      	'closeWindow'
		    ]
		});
		wx.ready(function () {
			// 在这里调用 API
			wx.hideAllNonBaseMenuItem();
		});
	</script>
	<script type="text/javascript">
		$(function(){
			var boxW = parseFloat($('#icon_box').width());
			$('#icon_i').css('fontSize', 0.25*boxW+'px');
		})
	</script>
</body>
</html>