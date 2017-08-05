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
				width: 50%;
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
            			        <li>兑换券</li>
            			        <li>说明</li>
            			    </ul>
            			    <ul class="ui-tab-content" style="width:300%">
            			        <li>
            			        	<section class="ui-panel">
									    <!-- <h2 class="ui-arrowlink">加辰币使用说明<span class="ui-panel-subtitle"></span></h2> -->
									    <h2 style="opacity: 0;">呵呵</h2>
									    <ul class="ui-grid-trisect">
									        <li>
									            <div class="ui-border">
									                <div class="ui-tips ui-tips-success">
													    <i></i><span>可用币额</span>
													</div>
									                <div style="text-align: center;width: 100%;font-size: 3em;color: #22AAE8;">
									                    888
									                </div>
									            </div>
									        </li>
									        <li>
									            <div class="ui-border">
									                <div class="ui-tips ui-tips-default">
													    <i></i><span>暂不可用币额</span>
													</div>
									                <div style="text-align: center;width: 100%;font-size: 3em;color: #797979;">
									                    55
									                </div>
									            </div>
									        </li>
									    </ul>
									</section>
            			        </li>
            			        <li>内容2</li>
            			        <li>内容3</li>
            			    </ul>
            			</div>
            		</div>
            		<script class="demo-script">
            		
                    </script>
            	</div>
            </section>
        </section>


        
        
	</div>

		<!-- <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script> -->
		<!-- <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script> -->
		<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
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
        </script>
	</body>
