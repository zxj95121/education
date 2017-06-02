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
	<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.mobile.css">
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
		.codeType{
			color:#E7E7E7;
		}
	</style>
</head>
<body>
	<div id="big">
		<header class="bar bar-nav">
	  		<h1 class='title'>加辰教育定制 管理员申请</h1>
		</header>
		<div class="content">
		  	<div class="list-block" style="margin-top: 10px;">
		    	<ul>
			      	<!-- Text inputs -->
			      	<li>
			        	<div class="item-content">
				          	<div class="item-media"><i class="icon"></i></div>
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
			          		<div class="item-media"><i class="icon"></i></div>
			          		<div class="item-inner" style="border-top: 1px solid #E7E7E7;">
			            		<div class="item-title label">验证码</div>
			            		<div class="item-input">
			              			<input type="text" id="phoneCode" placeholder="请输入4位数字验证码">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			      	<li>
			        	<div class="item-content">
			          		<div class="item-media"><i class="icon"></i></div>
			          		<div class="item-inner">
			            		<div class="item-title label">管理密码</div>
			            		<div class="item-input">
			              			<input type="password" id="password1" placeholder="6-18位数字字母">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
			      	<li>
			        	<div class="item-content">
			          		<div class="item-media"><i class="icon"></i></div>
			          		<div class="item-inner">
			            		<div class="item-title label">确认密码</div>
			            		<div class="item-input">
			              			<input type="password" id="password2" placeholder="6-18位数字字母">
			            		</div>
			          		</div>
			        	</div>
			      	</li>
					<li id="li_error" style="display: none;">
						<div class="item-content">
							<div class="item-media">
								<i class="icon"></i>
							</div>
							<div class="item-inner" style="color:red;" id="input_error">
			          		</div>
						</div>
					</li>
			    </ul>

			</div>
		  	<div class="content-block">
		    	<div class="row">
		      		<div id="btn_apply" class="col-50" style="width: 100%;text-align: center;"><a href="#" class="button button-big button-fill button-success">提交申请</a></div>
		    	</div>
	  		</div>

	  		<div id="toast" style="opacity: 0; display: none;">
		        <div class="weui-mask_transparent"></div>
		        <div class="weui-toast">
		            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
		            <p class="weui-toast__content">注册成功</p>
		        </div>
		    </div>
		</div>
	</div>

	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript" src="/js/zepto.min.js"></script>
	<script type="text/javascript" src="/js/sm.min.js"></script>
	<script type="text/javascript" src="/js/layui/layui.js"></script>
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
			/*无误进行发送ajax*/
			$('#btn_apply').click(function(){
				if (check()) {
					/*进行验证码校验*/
					var phoneCode = $('#phoneCode').val();
					if (phoneCode != window.phoneCode) {
						$('#input_error').html('验证码不正确');
						$('#li_error').css('display','block');
						return; 
					}

					/*将所有数据传后台进行存储咯*/
					$.ajax({
						url: '/admin/apply/submit',
						type: 'post',
						dataType: 'json',
						data: {
							name: $('#name').val(),
							phone: $('#phone').val(),
							phoneCode: $('#phoneCode').val(),
							password: $('#password1').val(),
							openid: '{{$openid}}',
							nickname: '{{$nickname}}',
							headimgurl: '{{$headimgurl}}'
						},
						success: function(data){
							if (data.errcode == 1) {
								window.layer.msg('注册失败，请重试');
							} else {
								$('#toast').css({'display': 'block', 'opacity': '1'});
								setTimeout(function(){
									$('#toast').hide('800');
									setTimeout(function(){
										wx.closeWindow();
									}, 800);
								}, 2000);
							}
						}
					})
				}
			})
		});
	</script>
	<script type="text/javascript">
		$(function(){
			$.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            layui.use('layer', function(){
			  	window.layer = layui.layer;
			});   

            window.phoneCode = 0;

			$('input').each(function(){

				$(this).blur(function(){
					check();
				});

				$(this).focus(function(){
					$('#input_error').html('');
					$('#li_error').css('display','none');
				});
			})

			/*请求发送手机验证码*/
			$('#getPhoneCode').click(function(){
				var phone = $('#phone').val();
				if (/^1\d{10}$/.test(phone)) {
					var loadIndex = window.layer.load(1);
					$.ajax({
						url: '/admin/apply/phoneCode',
						type: 'post',
						dataType: 'json',
						data: {
							phone: phone
						},
						success: function(data){
							window.layer.close(loadIndex);
							if(data.errcode == 0) {
								window.layer.msg('发送成功');
								$('#getPhoneCode').addClass('codeType').prop('disabled', 'disabled');
								window.phoneCode = data.phoneCode;
								setTime();
							} else if (data.errcode == 2) {
								window.layer.msg('该手机已注册');
							}
						}

					})
				} else {
					$('#input_error').html('手机号码不正确');
					$('#li_error').css('display','block');
				}
			})
		})

		function check(){
			var input = new Array(/^[\u4e00-\u9fa5]{2,8}$/,/^1\d{10}$/,/^[0-9]{4}$/,/^[0-9a-zA-Z_]{6,18}$/,/^[0-9a-zA-Z_]{6,18}$/);
			var word = new Array('姓名格式','手机号码','验证码格式','密码格式','确认密码格式');
			var flag = 1;
			$('input').each(function(){
				if(flag == 0)
					return;
				var index = $(this).index('input');

				var content = $(this).val();

				if (!input[index].test(content)) {
					$('#input_error').html(word[index]+'不正确');
					$('#li_error').css('display','block');
					flag = 0;
				}
			});

			if(flag == 0)
				return false;
			else {
				var password1 = $('#password1').val();
				var password2 = $('#password2').val();
				if (password1 != password2) {
					$('#input_error').html('两次密码不一致');
					$('#li_error').css('display','block');
					return false;
				}
				return true;
			}
		}

		function setTime(){
			var time = 60;
			window.interval = setInterval(function(){
				time--;
				if (time > 9) {
					$('#getPhoneCode').html('　 '+time+'秒 　');
				} else if (time >= 0) {
					$('#getPhoneCode').html('　  '+time+'秒 　');
				} else {
					$('#getPhoneCode').removeClass('codeType').removeProp('disabled', 'disabled').html('获取验证码');
					clearInterval(window.interval);
				}
			}, 1000);
		}
	</script>
</body>
</html>