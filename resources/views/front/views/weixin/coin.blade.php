<?php
// require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
// $jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
// $signPackage = $jssdk->GetSignPackage();
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
		<link rel="stylesheet" type="text/css" href="/js/frozen/css/frozen.css">

		<!-- <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css"> -->
		<style type="text/css">
			img{
				width: 100%;
			}
			.header{
				width: 100%;
				height: 45px;
				line-height: 45px;
				font-size: 20px;
				color: #FFF;
				background: #22AAE8;
				text-align: center;
			}
			.ui-grid-trisect > li {
				width: 100%;
			}
			.ui-loading-cnt{
				margin: 0 auto;
				margin-top: 45%;
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
		<!-- <div style="width: 100%;margin: 0 auto;">
			
		</div> -->
		<section class="ui-container">
            <section id="tab">
            	<div class="demo-item">
            		<!-- <p class="demo-desc">标签栏</p> -->
            		<div class="demo-block">
            			<div class="ui-tab">
            			    <ul class="ui-tab-nav ui-border-b">
            			        <li class="current">币额</li>
            			        <li>兑换优惠券</li>
            			        <li>精品小店</li>
            			    </ul>
            			    <ul class="ui-tab-content" style="width:300%">
            			        <li class="li0">
            			        	<section class="ui-panel">
									    <!-- <h2 class="ui-arrowlink">加辰币使用说明<span class="ui-panel-subtitle"></span></h2> -->
									    <h2 style="opacity: 0;">呵呵</h2>
									    <ul class="ui-grid-trisect">
									        <li>
									            <div class="ui-border">
									                <div class="ui-tips ui-tips-success">
													    <i></i><span>加辰币余额</span>
													</div>
									                <div style="text-align: center;width: 100%;font-size: 3em;color: #22AAE8;" id="restCoin">
									                    {{$userObj->coin}}
									                </div>
									            </div>
									        </li>
									    </ul>
									</section>
									<div class="panel panel-success mt-20">
										<div class="panel-header">加辰币说明</div>
										<div class="panel-body">
											<ul>
												<li>1、加辰币是用户在加辰教育的消费积分</li>
												<li>2、每购买加辰教育课程1000元，返积分100加辰币</li>
												<li>3、加辰币可直接用于加辰精品小店购物（以加辰币标示价格）</li>
												<li>4、每100加辰币课兑换88元优惠券，购买新课程使用。</li>
											</ul>
										</div>
									</div>
            			        </li>
            			        <li class="li1">
            			        	<div style="height: 124px;margin: 0 auto 20px;width: 96%;">
            			        		<div class="col-xs-12" id="voucher" style="margin-top:24px;height:100px;padding: 0px;background: #FFF;">
											<div style="width: 36%;border-left: groove;border-color:#22AAE8;background: #22AAE8;display: inline-block;height: 100%;">
												<div style="height: 68px;line-height: 68px; text-align: center;color: #FFF;">
													¥ <span style="font-size:40px;">88</span>
												</div>
												<div style="text-align: center;color: #FFF;font-size:12px;">
													满1000减可用
												</div>
											</div>
											<div style="width: 62%;background: #FFF;height: 100%;display: inline-block;">
												<div style="height: 68px;text-align: left;color: #000;padding-top:10px;">
													<ol type="decimal">
														<li style="font-size:14px;">优惠券可叠加使用</li>
														<li style="font-size:14px;">除特价课程均可使用</li>
													</ol>
												</div>
												<div style="text-align: center;color: #FFF;text-align: right;font-size:12px;height: 32px;">
													<label class="label label-success" style="position: relative;height: 100%;font-size:14px;right: 8px;cursor: pointer;">剩余<span id="restTicket">{{floor($userObj->voucher/88)}}</span>张</label>
												</div>
											</div>
										</div>
            			        	</div>
            			        	<div class="ui-tips ui-tips-info">
            			        		@php $changeNumber = floor($userObj->coin/100); @endphp
									    <i></i><span>您的币额最多可兑换<span id="maxNotice">{{$changeNumber}}</span>张券</span>
									</div>
            			        	<div class="ui-form ui-border-t">
									    <form action="#">
										    <div class="ui-form-item ui-form-item-order ui-border-b">
									            <a href="#">兑换优惠券（满1000减88）</a>
									        </div>
									        <div class="ui-form-item ui-form-item-r ui-border-b">
									            <input type="number" id="changeInput" max="{{$changeNumber}}" placeholder="请输入数字" style="padding-left: 15px;">
									            
									            <!-- 若按钮不可点击则添加 disabled 类 -->
									            <button type="button btn-success" class="ui-border-l" id="change" style="color: #FFF;">确认兑换</button>
	<!-- 									            <a href="#" class="ui-icon-close"></a> -->
									        </div>
									        <!-- <div class="ui-form-item" style="text-align: center;background: #48C23D;color: #FFF;border-radius: 3px;margin-top: 15px;" >
									            确认兑换
									        </div> -->
									    </form>
									</div>

									<div class="ui-tips ui-tips-success" id="changeSuccess" style="display: none;">
									    <i></i><span>兑换成功！</span>
									</div>
            			        </li>
            			        <li class="li2" style="min-height: 150px;">
            			        	<div class="ui-poptips ui-poptips-warn" style="position: relative;top: 60px;" style="background: #2448D8;">
									    <div class="ui-poptips-cnt" style="color: #FFF;"><i></i>加辰精品小店正在精心“装修”和开发中</div>
									</div>
            			        </li>
            			    </ul>
            			</div>
            		</div>
            		<script class="demo-script">
            		
                    </script>
            	</div>
            </section>
        </section>


        <div class="ui-dialog ui-dialog1">
		    <div class="ui-dialog-cnt" style="margin: 0 auto;margin-top: 35%;">
		      <header class="ui-dialog-hd ui-border-b">
		                  <h3 style="line-height: 48px;">兑换提醒</h3>
		                  <i class="ui-dialog-close" data-role="button"></i>
		              </header>
		        <div class="ui-dialog-bd">
		            <!-- <h4>兑换操作无法撤回</h4> -->
		            <div>您将兑换<span id="changeNum">4</span>张优惠券，且优惠券无法兑换加辰币。</div>
		        </div>
		        <div class="ui-dialog-ft">
		            <button type="button" data-role="button" id="qxdh">取消</button>
		            <button type="button" data-role="button" id="qrdh">兑换</button>
		        </div>
		    </div>        
		</div>

        
	</div>

		<!-- <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script> -->
		<!-- <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script> -->
		<script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
		<script src="/js/frozen/js/lib/zeptojs/zepto.min.js"></script>
        <script src="/js/frozen/js/frozen.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>


		<script>
        (function (){
            var tab = new fz.Scroll('.ui-tab', {
                role: 'tab',
                autoplay: false,
                interval: 3000
            });
            /* 滑动开始前 */
            tab.on('beforeScrollStart', function(fromIndex, toIndex) {
                console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
            })
            
            
        })();


        Zepto(function($){
        	// $('.addNum').click(function(){
        	// 	var num = parseInt($(this).prev().val());
        	// 	// num ++;
        	// 	$(this).prev().val(++num);
        	// })


        	$('#change').click(function(){
				var num = parseInt($('#changeInput').val());
				var max = {{$changeNumber}};
				if (num <= 0) {
					layer.open({
						content:'数量不能为0',
						skin:'msg',
						time:2
					});
				} else if (num > max) {
					layer.open({
						content: '最大兑换数量'+max+'个',
						skin:'msg',
						time:2
					});
				} else {
        			$('#changeNum').html(num);
        			$(".ui-dialog1").dialog("show");
        		}
        	})

        	$('i.ui-dialog-close').click(function(){
        		$(".ui-dialog1").dialog("hide");
        	})

        	$('#qxdh').click(function(){
        		$(".ui-dialog1").dialog("hide");
        	})

        	$('#qrdh').click(function(){
        		$(".ui-dialog1").dialog("hide");
        		var el = $.loading({content:'兑换中...'});
        		setTimeout(function(){$('.ui-loading-block').remove();}, 8000);
        		$.ajax({
        			headers: {
	            		'X-CSRF-TOKEN': '{{csrf_token()}}'
	            	},
        			url :'/front/coin/convert',
        			dataType: 'json',
        			type: 'post',
        			data: {
        				num: $('#changeInput').val()
        			},
        			success: function(data) {
        				if (data.errcode == 0) {
        					$('.ui-loading-block').remove();
        					$('#changeSuccess').show(0);

        					console.log(data.data);
        					/*进行兑换成功后的页面改变*/
        					var voucher = data.data.voucher;
        					var vouNum = Math.floor(voucher/88);

        					var coin = data.data.coin;
        					var coinNum = Math.floor(coin/100);

        					$('#changeInput').val('');
        					$('#restCoin').html(coin);
        					$('#maxNotice').html(coinNum);
        					$('#restTicket').html(vouNum);
        					$('#changeInput').attr('max', $coinNum);


        					setTimeout(function(){
        						// $('#changeSuccess').animate({
	        					// 	top: '2000px', 
	        					// 	complete: function(){
	        					$('#changeSuccess').hide();
	        					// 	}
	        					// }, 2000);
	        				},2000);
        				// 	setTimeout(function(){$('#changeSuccess').hide();}, 2000);
        				} else {
        					alert(data.reason);
        					/*攻击预防*/
        				}
        			}
        		})
        		
        	})
        })
        </script>
	</body>
