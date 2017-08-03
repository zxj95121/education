<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>加辰教育</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">

  </head>
	<body>
		<div class="page-group" style="background:#fff">
			<div class="page page-current">
				<div class="content native-scroll">
				    <div class="content-block">
				    	<p><a href="#" data-popup=".popup-about" class="open-popup" id="dis" style="display:none"> hehehe</a></p>			      
				    </div> 
				</div> 
				<table>
					<tr>
						<th>活动名称</th>
						<th>开始时间</th>
					</tr>
					<tr>
						<td>{{$res->name}}</td>
						<td>{{$res->start_time}}</td>
					</tr>
				</table>
				@if($lucky != '')
					<table id="t2">
						<tr><th colspan="2">中奖名单</th></tr>
						@foreach($lucky as $value)
						<tr><td >{{$value->nickname}}</td><td>{{$value->name}}</td></tr>
						@endforeach
					</table>
				@endif
				<p><a href="#" id="join" val="{{$res->id}}" class="button">参加活动</a></p>
<!-- 				<button id="join" val="{{$res->id}}">参加活动</button> -->
				<!-- About Popup -->
				<div class="popup popup-about">
					<div class="content-block">
					    <header class="bar bar-nav">
					    	<a class="button button-link button-nav pull-left" href="/front/home" data-transition="slide-out" style="color:#fff">
				      			<span class="icon icon-left"></span>返回
				    		</a>
						 	<h1 class='title' style="background: #22AAE8;color: #fff;">添加手机号</h1>
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
										<div class="col-50"><a href="#" class="button  button-fill button-danger close-popup">取消</a></div>
			      					<div class="col-50"><a href="#" class="button  button-fill  button-success">提交</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			 <div class="popup-overlay"></div>
			 <!-- End About Popup -->
			</div>
		</div>
		<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
		<script>
			$('#join').click(function(){
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					url: '/front/grab/join',
					type: 'post',
					data:{
						'id':$('#join').attr('val')
						},
					datatype: 'json',
					success: function(data){
						if(data.code != -1){
							alert(data.msg);
						}else{
							console.log('还没填写手机号');
							$('#dis').trigger("click");
							console.log(123);
							return false;
							//alert('还没填写手机号');
						}						
					}
				})
			})
			$code = {{$code}};
			if($code == 233){
				var timer = setInterval(function(){
					$.ajax({
						headers:{
							'X-CSRF-TOKEN': '{{csrf_token()}}'
						},	
						url:'/front/grab/countdown',
						data:{
							id:{{$res->id}}
						},
						type:'post',
						datatype:'json',
						success:function(data){
							var text = '';
							text += '<tr><th colspan="2">中奖名单</th></tr>';
							for(var i = 0; i < data.lucky.length; i++){
								text += "<tr><td>"+data.lucky[i].nickname+"</td><td>"+data.lucky[i].name+"</td></tr>";
							}
							$('#t2').html(text);
							if(data.code == 200){
								clearInterval(timer);
							}
						}
					})
				},1000)
			}
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
					$.ajax({
						headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
						},	
						url:'',
						data:{
							phone:phone
						},
						type:'post',
						datatype:'json',
						success:function(data){
							if(data.errcode == 0){
								$.toast("发送成功");
							}else{
								$.toast(data.reason);
							}
						},
					})
				}	
			})
			$(document).on('click','#getPhoneCode',function(){
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
						url:'',
						data:{
							phone:phone
						},
						type:'post',
						datatype:'json',
						success:function(data){
							if(data.errcode == 0){
								$.toast("发送成功");
							}else{
								$.toast(data.reason);
							}
						},
					})
			})
			
		</script>
	</body>
</html>