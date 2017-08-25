<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/lib/WxPay.Api.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/php/WxPayAPI/jsapi/WxPay.JsApiPay.php';
	//①、获取用户openid
	$tools = new JsApiPay();
	$openId = $tools->GetOpenid();
	//②、统一下单
	$input = new WxPayUnifiedOrder();
	$input->SetBody($package->name);//商品描述
	$input->SetOut_trade_no($order_no);//商户订单号
	$input->SetTotal_fee((int)((float)$price*100));//标价金额
	$input->SetTime_start(date("YmdHis"));//交易起始时间
	$input->SetNotify_url("http://".$_SERVER['SERVER_NAME']."/wxpay/notifyOtherClass");//通知地址
	$input->SetTrade_type("JSAPI");//交易类型
	$input->SetOpenid($openId);//用户标识
	$order = WxPayApi::unifiedOrder($input);
	// var_dump($order);
	$jsApiParameters = $tools->GetJsApiParameters($order); 
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
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
	    	<a class="button button-link button-nav pull-left" style="cursor: pointer;" onclick="window.location.href='/front/classPackage?id={{$package->id}}';" data-transition='slide-out'>
	      		<span class="icon icon-left"></span>
	      		返回
	    	</a>
	    	<h1 class="title">订单详情</h1>
	  	</header>
	  	<div class="content">
  			<!-- <div class="content-block-title">双师class订单</div> -->
			<div class="list-block">
				<ul>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">套餐名称</div>
      						<div class="item-after">{{$package->name}}</div>
    					</div>
  					</li>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">课时数量</div>
      						<div class="item-after">{{$package->number}} 次课</div>
    					</div>
  					</li>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">标准价格</div>
      						<div class="item-after" style="text-decoration: line-through;">¥ {{number_format((string)$package->standard_price, 2)}}</div>
    					</div>
  					</li>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">优惠价格</div>
      						<div class="item-after" style="text-decoration: line-through;">¥ {{number_format((string)$prePrice, 2)}}</div>
    					</div>
  					</li>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">代金券</div>
      						<div class="item-after">@if($vouNum != 0) 88元*{{$vouNum}}张 @else 无可用 @endif</div>
    					</div>
  					</li>
  					<li class="item-content">
    					<div class="item-media"><i class="icon icon-f7"></i></div>
    					<div class="item-inner">
      						<div class="item-title">结算金额</div>
      						<div class="item-after" style="font-weight: bold;">¥ {{number_format((string)$price, 2)}}</div>
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

	  				<!-- About Popup -->
				<div class="popup popup-about">
					<div class="content-block">
					    <header class="bar bar-nav">
						 	<h1 class='title' style="background: #22AAE8;color: #fff;">请输入手机号</h1>
						</header>
						<div class="content">
							<div class="list-block" style="margin-top:0px">
								<div class="item-content">
									<div class="item-inner" style="padding-right:0px">
										<div class="item-title label" style="width:63px">手机号:</div>
										<div class="item-input">
											<input type="text" placeholder="手机号" name="phone">
										</div>
										<a href="#" disabled="false" class="button button-round" id="getPhoneCode">发送验证码</a>
									</div>
									
								</div>
						 		<div class="item-content">
									<div class="item-inner" style="padding-right:0px">
										<div class="item-title label" style="width:63px">验证码:</div>
										<div class="item-input">
											<input type="text" placeholder="验证码" name="phoneCode">
										</div>
									</div>
								</div>
								<div class="content-block" style="margin-top:20px">
									<div class="row">
										<div class="col-50"><a href="#" class="button  button-big button-fill button-danger close-popup" >取消</a></div>
			      						<div class="col-50"><a href="#" class="button  button-big button-fill  button-success" id="send">提交</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			 <div class="popup-overlay"></div>
	</div>

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script type="text/javascript">

		window.onpopstate = function(event) {
    		// window.location.href='/front/classPackage?id={{$package->id}}';
    		history.back(-1);
		}

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
			$('#order_pay').click(function(){
				WeixinJSBridge.invoke(
					'getBrandWCPayRequest',
					<?php echo $jsApiParameters; ?>,
					function(res){
						WeixinJSBridge.log(res.err_msg);
						// alert(res.err_code+res.err_desc+res.err_msg);
						if(res.err_msg == "get_brand_wcpay_request:ok"){

							$('#order_pay').replaceWith('<a href="#" class="button button-big button-fill button-danger">已完成</a>');

							$.modal({
						      	title:  '支付成功',
						      	text: '',
						      	buttons: [
						        	{
						          		text: '确认',
						         		onClick: function() {
						            		$.closeModal();
						            		wx.closeWindow();
						          		}
						        	},
						      	]
						    });

							/*弹出框框*/

						}else{
							$.alert('支付失败');
						}  
					}
				);
			})
		});
	</script>
    <script type="text/javascript">

	// //调用微信JS api 支付
	// function callpay()
	// {
		
	// }
	</script>


	    <script>
		@if(!$phone)
			$.popup('.popup-about');
		@else
		@endif
		
		$(document).on('click','#getPhoneCode',function(){
			if($('#getPhoneCode').attr('disabled') == 'true'){
				return false;
			}
			var phone = $('input[name="phone"]').val();
			var reg = /^1\d{10}$/;
			if(!reg.test(phone)){
				$.toast("手机号输入不正确");
				return false;
			}else{
				$.ajax({
					headers:{
					'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					url:'/front/phoneCode',
					data:{
						phone:phone
					},
					type:'post',
					datatype:'json',
					success:function(data){
						if(data.errcode == 0){
							$.toast("发送成功");
							var time = 60;
							$('#getPhoneCode').html(time);
							$('#getPhoneCode').addClass('button-light button-fill');
							$('#getPhoneCode').attr('disabled','true');
							var timer = setInterval(function(){
								if(time == 1){
									clearInterval(timer);
									$('#getPhoneCode').attr('disabled','false');
									$('#getPhoneCode').removeClass('button-light button-fill');
									$('#getPhoneCode').html('重新发送验证码');
									return false;
								}
								time--;
								$('#getPhoneCode').html(time);
							},1000);
						}else{
							$.toast(data.reason);
						}
					},
				})
			}	
		})
		$(document).on('click','#send',function(){
			var phone = $('input[name="phone"]').val();
			var phoneCode = $('input[name="phoneCode"]').val();
			var reg = /^1\d{10}$/;
			if(!reg.test(phone)){
				$.toast("手机号输入不正确");
				return false;
			}
			if(phoneCode == ''){
				$.toast('验证码未填写');
				return false;
			}
			$.ajax({
					headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					url:'/front/savePhone',
					data:{
						phone:phone,
						phoneCode:phoneCode
					},
					type:'post',
					datatype:'json',
					success:function(data){
						if(data.errcode != 1){
							$.toast(data.reason);
						}else{
							$(".close-popup").trigger("click");
							$.closeModal('.popup-about');
							$.toast("添加成功");
						}
					},
				})
		})
    </script>
</body>
</html>