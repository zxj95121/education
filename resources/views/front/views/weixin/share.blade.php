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
		</style>
	</head>
	<body>
	<div class="container-fluid" style="padding: 0px;">
		<div id="phoneDiv" style="display:none;z-index: 9999;width: 100%;height: 100%;opacity: 1;position: fixed;top: 0px;left: 0px;background: #FFF;">
		    <header style="height: 40px;text-align: center;position: relative;font-size: 19px;line-height: 40px;color: #FFF;background: #22AAE8;">
		    	添加手机号
			 	<div class="closeclose" style="position: absolute;right: 10px;line-height: 40px;height: 40px;font-size:16px;top: 0px;color: #fff;" onclick="document.getElementById('phoneDiv').style.display ='none';">关闭</div>
			</header>
			<div class="content" style="width: 96%;margin: 0 auto;">
				<div class="row" style="margin-top: 15px;">
					<div class="form-group">
						<div class="col-xs-3" style="text-align: right;">
							<label for="phoneInput">手机号</label>
						</div>
						<div class="col-xs-9" style="position: relative;">
			                <div class="input-groupf">
			                    <input type="number" id="phoneInput" name="phone" class="form-control" placeholder="手机号">
			                    <span class="" style="position: absolute;right: 15px;height: 100%;top: 0px;">
			                    	<button type="button" class="btn btn-effect-ripple btn-info" id="getPhoneCode">发送验证码</button>
			                    </span>
			                </div>
			            </div>
			        </div>

				</div>

				<div class="row" style="margin-top: 12px;">
					<div class="form-group">
						<div class="col-xs-3" style="text-align: right;">
							<label>验证码</label>
						</div>
						<div class="col-xs-9">
			                <div class="input-groupf m-t-10">
			                    <input type="number" id="phoneCode" name="phoneCode" class="form-control" placeholder="请输入验证码">
			                </div>
			            </div>
			        </div>
				</div>

				<div class="row" style="margin-top: 15px">
					<div class="form-group">
						<div class="col-xs-8 col-xs-offset-2">
							<button id="send" class="btn btn-success" style="width: 100%;">提交</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div id="shareDiv" style="display:none;z-index: 9999;width: 100%;height: 100%;opacity: 1;position: fixed;top: 0px;left: 0px;">
			<img src="/images/share2.png" style="width: 100%;"> 
		</div>
		<div style="width: 96%;margin: 0 auto;">

		<section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		    <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		        <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		            <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                    <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                        <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                            <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                    <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                        <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                            <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                                <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                                    <section data-role="outer" label="Powered by 135editor.com" style="font-family: 微软雅黑;">
		                                                        <section class="_135editor" data-tools="135编辑器" data-id="85679" style="font-size: 16px; border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                                            <section style="text-align:center;margin:10px auto;">
		                                                                <section data-bcless="spin" data-bclessp="90" style="width: 0px; height: 0px; color: rgb(254, 254, 254); text-align: center; border-top-width: 200px; border-top-style: solid; border-color: rgb(225, 235, 229) transparent; border-left-width: 120px; border-left-style: solid; border-right-width: 120px; border-right-style: solid; display: inline-block; box-sizing: border-box;"></section>
		                                                                <section style="margin-top: -160px;margin-bottom: 80px;">
		                                                                    <section style="opacity: 0.75; border-width: 1px 0px; border-style: solid; border-color: rgb(198, 198, 198); padding: 5px; display: inline-block; box-sizing: border-box;">
		                                                                        <p style="color: inherit; text-align: center;line-height: 3em;">
		                                                                            <span style="color: #7B7752; vertical-align: middle; font-size: 36px;">加辰教育定制</span>
		                                                                        </p>
		                                                                    </section>
		                                                                    <p style="text-align: center; letter-spacing: 1px;">
		                                                                        <span style="color: #7F7F7F; line-height: 22.4px; font-size: 20px;">之半价购课</span><!-- <span style="color: #595959; font-size: 15px; line-height: inherit;">&nbsp;</span> -->
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                        </section>
<!-- 		                                                        <p style="font-size: 16px;">
		                                                            <br/>
		                                                        </p> -->
		                                                        <section label="Copyright © 2015 playhudong All Rights Reserved." style="font-size: 16px; border: none; overflow: hidden; margin: 1em auto; width: 268px; text-align: center;" id="shifu_tea_005" donone="shifuMouseDownTeacher(&#39;shifu_tea_005&#39;)">
		                                                            <section style="
		    width: 268px;
		    font-size: 21px;
		    font-weight: 700;
		    color: #ffffff;
		    border: solid 4px #fbc16c;
		    background:#254932;
		    text-align: left;
		    line-height: 47px;
		    padding-left: 24px;
		    ">
		                                                                <p style="text-align: justify; margin: 0em;">
		                                                                    关于半价购课
		                                                                </p>
		                                                            </section>
		                                                        </section>
		                                                        <section style="padding-top: 2em; padding-bottom: 1em;">
		                                                            <section style="font-size: 16px; border-bottom: 2px dotted rgb(87, 110, 181); margin-top: 0em;"></section>
		                                                            <section style="font-size: 16px; padding-top: 1em; padding-left: 1em;">
		                                                                <section style="width:5em;
		height:5em;
		padding:0.5em 0;
		background:#576eb5;
		text-align:center;
		color:#fff;
		overflow:hidden;
		border-radius:50%;
		box-sizing:border-box;">
		                                                                    <section style="width:1.2em;
		font-size:1em;
		line-height:1.4em;
		display:inline-block;
		overflow:hidden;">
		                                                                        <p style="margin:0">
		                                                                            课程名
		                                                                        </p>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; margin-top: -4.5em; margin-left: 8em;">
		                                                                <section style="
		padding-top: -2em;
		font-size: 16px;
		">
		                                                                    <p>
		                                                                        <span style="color: rgb(12, 12, 12); font-size: 18px;"><span style="color: rgb(12, 12, 12); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif;">{{$halfClassObj->name}}</span></span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; text-align: center; color: rgb(87, 110, 181); margin-left: 3.5em;">
		                                                                <p>
		                                                                    （半价课程不定期更新）
		                                                                </p>
		                                                            </section>

		                                                            <section style="font-size: 16px; padding-top: 1em; padding-left: 1em;">
		                                                                <section style="width:5em;
		height:5em;
		padding:0.5em 0;
		background:#576eb5;
		text-align:center;
		color:#fff;
		overflow:hidden;
		border-radius:50%;
		box-sizing:border-box;">
		                                                                    <section style="width:1.2em;
		font-size:1em;
		line-height:1.4em;
		display:inline-block;
		overflow:hidden;">
		                                                                        <p style="margin:0">
		                                                                            分享数
		                                                                        </p>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; margin-top: -4.5em; margin-left: 8em;">
		                                                                <section style="
		padding-top: -2em;
		font-size: 16px;
		">
		                                                                    <p>
		                                                                        <span style="color: rgb(12, 12, 12); font-size: 18px;"><span style="color: rgb(12, 12, 12); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif;">您的分享指数为 {{$shareCount}} 人</span></span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; text-align: center; color: rgb(87, 110, 181); margin-left: 3.5em;">
		                                                                <p style="opacity: 0;">
		                                                                    d
		                                                                </p>
		                                                            </section>
		                                                            
		                                                            <section style="font-size: 16px; padding-top: 1em; padding-left: 1em;">
		                                                                <section style="width:5em;
		height:5em;
		padding:0.5em 0;
		background:#576eb5;
		text-align:center;
		color:#fff;
		overflow:hidden;
		border-radius:50%;
		box-sizing:border-box;">
		                                                                    <section style="width:1.2em;
		font-size:1em;
		line-height:1.4em;
		display:inline-block;
		overflow:hidden;">
		                                                                        <p style="margin:0">
		                                                                            半价券
		                                                                        </p>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; margin-top: -4.5em; margin-left: 8em;">
		                                                                <section style="
		padding-top: -2em;
		font-size: 16px;
		">
		                                                                    <p>
		                                                                        <span style="color: rgb(12, 12, 12); font-size: 18px;"><span style="color: rgb(12, 12, 12); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif;">您当前拥有半价券 {{$halfObj->ticket_num}} 张</span></span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; text-align: center; color: rgb(87, 110, 181); margin-left: 3.5em;">
		                                                                <button id="shareBtn" type="button" class="btn btn-success btn-lg">分享得券</button>
		                                                            </section>
		                                                            
		                                                            <section style="font-size: 16px; padding-top: 1em; padding-left: 1em;">
		                                                                <section style="width:5em;
		height:5em;
		padding:0.5em 0;
		background:#576eb5;
		text-align:center;
		color:#fff;
		overflow:hidden;
		border-radius:50%;
		box-sizing:border-box;">
		                                                                    <section style="width:1.2em;
		font-size:1em;
		line-height:1.4em;
		display:inline-block;
		overflow:hidden;">
		                                                                        <p style="margin:0">
		                                                                            已购买
		                                                                        </p>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; margin-top: -4.5em; margin-left: 8em;">
		                                                                <section style="
		padding-top: -2em;
		font-size: 16px;
		">
		                                                                    <p>
		                                                                        <span style="color: rgb(12, 12, 12); font-size: 18px;"><span style="color: rgb(12, 12, 12); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif;">您已购买此课程数 {{$buyCount}} 次</span></span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; text-align: center; color: rgb(87, 110, 181); margin-left: 3.5em;">
		                                                                <p style="opacity: 0;">
		                                                                    aaaaaaa
		                                                                </p>
		                                                            </section>
		                                                        </section>
		                                                        <section class="_135editor" data-tools="135编辑器" data-id="90174" style="font-size: 16px; border: 0px none; padding: 0px; box-sizing: border-box; position: relative;">
		                                                            <section data-id="us524665" class="_135editor" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                                                <section style="padding: 10px; box-sizing: border-box;">
		                                                                    <section style="width: 100%; text-align: center;">
		                                                                        <br/>
		                                                                        <button id="buyBtn" type="button" class="btn btn-success btn-lg">立即购买</button>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                        </section>
		                                                        <section class="_135editor" data-tools="135编辑器" data-id="89927" style="font-size: 16px; border: 0px none; padding: 0px; box-sizing: border-box;"></section>
		                                                        <p style="font-size: 16px;">
		                                                            <span style="font-size: 17px;"><strong><span style="color: #FF0000;">半价购课推荐有奖活动详情规则</span></strong></span><span style="font-size: 15px; color: #3F3F3F;">：<span style="color: #3F3F3F; font-size: 16px;">用户每成功推荐<span style="color: #3F3F3F; font-size: 18px;">一位</span>好友关注“加辰教育定制”，即可获得一张<span style="color: #3F3F3F; font-size: 19px;">半价购课券</span>，凭此券，用户可半价购买一次指定的加辰教育双师Class课程。半价购课券有效期90天，可叠加使用。</span></span>
		                                                        </p>
		                                                        <p style="font-size: 16px; text-align: center;">
		                                                            <img src="/images/getqrcode.jpg"/>
		                                                        </p>
		                                                        <section class="_135editor" data-tools="135编辑器" data-id="105" style="font-size: 16px; border: 0px none; padding: 0px; box-sizing: border-box;">
		                                                            <p style="text-align:center;">
		                                                                <img data-id="105" data-role="guide-img" title="猫抓毛线球引导分享" src="http://7xo6kd.com1.z0.glb.clouddn.com/upload-ueditor-image-20170803-1501761170280051590.jpg" style="display: inline;"/>
		                                                            </p>
		                                                        </section>
		                                                        <p style="font-size: 16px;">
		                                                            <br/>
		                                                        </p>
		                                                    </section>
		                                                </section>
		                                            </section>
		                                        </section>
		                                    </section>
		                                </section>
		                            </section>
		                        </section>
		                    </section>
		                </section>
		            </section>
		        </section>
		    </section>
		</section>

		</div>
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
/*  		        wx.checkJsApi({
		            jsApiList: [
		                'onMenuShareTimeline',
		                'onMenuShareAppMessage',
		                'hideAllNonBaseMenuItem',
		                'showMenuItems'
		            ],
		            success: function (res) {
		                console.log(JSON.stringify(res));
		            }
		        });  */
		    	wx.hideAllNonBaseMenuItem();//隐藏所有非基础类
		    	wx.showMenuItems({
		    	    menuList: [
		    	    	//要显示的菜单项
		    	    	'menuItem:share:appMessage',
		    	    	'menuItem:share:timeline'
				    ],
				    success: function (res){
				    	//alert("隐藏");
					}
		    	});
		        wx.onMenuShareAppMessage({
		            title: '<?php echo $news['Title'];?>',
		            desc: '<?php echo $news['Description'];?>',
		            link: '<?php echo $news['Url'];?>',
		            imgUrl: '<?php echo $news['PicUrl'];?>',
		            trigger: function (res) {
		              // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
		              // alert('用户点击发送给朋友');
		            },
		            success: function (res) {
		            //	$.alert('已分享');
		            },
		            cancel: function (res) {
		              // alert('已取消');
		            },
		            fail: function (res) {
		              // alert(JSON.stringify(res));
		            }
		        });
		        wx.onMenuShareTimeline({
		            title: '<?php echo $news['Title'];?>',
		            link: '<?php echo $news['Url'];?>',
		            imgUrl: '<?php echo $news['PicUrl'];?>',
		            trigger: function (res) {
		              // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
		              // alert('用户点击分享到朋友圈');
		            },
		            success: function (res) {
		             // $.alert('已分享');
		            },
		            cancel: function (res) {
		              // alert('已取消');
		            },
		            fail: function (res) {
		              // alert(JSON.stringify(res));
		            }
		          });
			});
		</script>


		<script type="text/javascript">
			/*半价购课js*/
			$(function(){
				$('#shareBtn').click(function(){
					var height = $('.container-fluid').height();
					$('#shareDiv').css('height', height).show();
				})


				$('#shareDiv').click(function(){
					$(this).hide();
				})

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					}
				});


				$('#buyBtn').click(function(){
					var ticket = parseInt('{{$halfObj->ticket_num}}');

					$.ajax({
						url: '/front/phoneCheck',
						dataType: 'json',
						type: 'post',
						data:{
						},
						datatype: 'json',
						success: function(data){
							if(data.errcode == 0){
								if (ticket <= 0) {
									layer.open({
										content:'您剩余的半价券为0...',
										skin:'msg',
										time:2
									});
								} else {
									window.location.href = '/front/share/halfBuyOrder';
								}
							} else {
								$('#phoneDiv').css('display', 'block');
								return false;
							}						
						}
					})


					
				})


				$(document).on('click','#getPhoneCode',function(){
					if($('#getPhoneCode').attr('disabled') == 'true'){
						return false;
					}
					var phone = $('input[name="phone"]').val();
					var reg = /^1\d{10}$/;
					if(!reg.test(phone)){
						layer.open({
							content:'手机号输入不正确',
							skin:'msg',
							time:2
						});
						return false;
					}else{

						$.ajax({
							url:'/front/phoneCode',
							data:{
								phone:phone
							},
							type:'post',
							datatype:'json',
							success:function(data){
								if(data.errcode == 0){
									layer.open({
										content:'发送成功',
										skin:'msg',
										time:2
									});
									var time = 60;
									$('#getPhoneCode').html(time);
									$('#getPhoneCode').addClass('button-light button-fill');
									$('#getPhoneCode').attr('disabled','true');
									var timer = setInterval(function(){
										if(time == 1){
											clearInterval(timer);
											$('#getPhoneCode').attr('disabled','false');
											$('#getPhoneCode').removeClass('button-light button-fill');
											$('#getPhoneCode').html('发送验证码');
											return false;
										}
										time--;
										$('#getPhoneCode').html(time);
									},1000);
								}else{
									layer.open({
										content: data.reason,
										skin:'msg',
										time:2
									});
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
						layer.open({
							content:'手机号输入不正确',
							skin:'msg',
							time:2
						});
						return false;
					}
					if(phoneCode == ''){
						layer.open({
							content:'验证码未填写',
							skin:'msg',
							time:2
						});
						return false;
					}
					$.ajax({
						url:'/front/savePhone',
						data:{
							phone:phone,
							phoneCode:phoneCode
						},
						type:'post',
						datatype:'json',
						success:function(data){
							if(data.errcode != 1){
								layer.open({
									content: data.reason,
									skin:'msg',
									time:2
								});
							}else{
								$('#phoneDiv').css('display', 'none');
								layer.open({
									content:'添加成功',
									skin:'msg',
									time:2
								});
							}
						},
					})
				})
			})
		</script>
	</body>
