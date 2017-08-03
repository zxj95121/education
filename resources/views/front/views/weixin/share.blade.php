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
		<div style="width: 96%;margin: 0 auto;">
		<!-- <section data-role="outer" label="Powered by 135editor.com" style="font-family:微软雅黑;font-size:16px;">
		    <section data-role="outer" label="Powered by 135editor.com" style="font-family:微软雅黑;font-size:16px;">
		        <section data-role="outer" label="Powered by 135editor.com" style="font-family:微软雅黑;font-size:16px;">
		            <section class="article135" style="padding: 10px; box-sizing: border-box; background-image: -webkit-linear-gradient(left, rgb(184, 204, 228), rgb(204, 217, 233), rgb(184, 204, 228)); background-color: rgb(184, 204, 228); background-size: auto; background-position: 0% 0%; background-repeat: repeat;">
		                <section data-role="outer" label="Powered by 135editor.com" style="font-family:微软雅黑;font-size:16px;">
		                    <section class="_135editor" style="border: 0px none; padding: 0px; box-sizing: border-box; position: relative;">
		                        <section class="_135editor" data-tools="135编辑器" data-id="89934" style="border: 0px none; padding: 0px; box-sizing: border-box;">
		                            <section data-id="us522272" class="_135editor" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                <section style="width:100%; text-align:center;" data-width="100%"></section>
		                                <section style="clear:both; width:100%;" data-width="100%"></section>
		                            </section>
		                        </section><img data-id="89260" data-role="guide-img" style="" title="风车分割线" src="http://rdn.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9naWYvZmdua3hmR25ua1RObDVWdndQUFUxUEtrRWN3NE84STI1MFRvNzlJMnFacUR5bDFDVTM3WGdlZlppY0RGd1JOUllURTllc1M0S3RFeHFGWm91eHZTTDlnLzA/d3hfZm10PWdpZg==" style="display: inline;"/>
		                    </section>
		                    <section class="_135editor" data-id="t36" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                        <section class="layout" style="margin-right: auto; margin-left: auto; width: 60%;">
		                            <section style="margin-top: 2em; padding-top: 0.5em; padding-bottom: 0.5em; font-size: 1em; line-height: 22.4px; border-style: solid none none; border-top-width: 1px; border-color: rgb(204, 204, 204) rgb(117, 117, 118) rgb(117, 117, 118); text-decoration: inherit; color: rgb(117, 117, 118); box-sizing: border-box;">
		                                <section style="margin-top: -2.6em; text-align: center; line-height: 1.4;">
		                                    <section style="display: inline-block; border: 1px solid rgb(117, 117, 118); color: inherit; margin-top: 10px; margin-bottom: 10px; padding: 8px 12px; font-size: 16px; box-sizing: border-box; background-color: rgb(254, 254, 254);">
		                                        <span style="font-family: 微软雅黑;">加辰教育活动季</span>
		                                    </section>
		                                </section>
		                            </section>
		                        </section>
		                    </section>
		                    <p>
		                        <br/>
		                    </p>
		                    <p style="color: rgb(62,62,62); margin-bottom: 15px; margin-top: 15px; text-align: justify;font-size: 14px;font-family: 微软雅黑; ">
		                        中小学外教一对一，双师Class,定制由你！！！
		                    </p>
		                    <p style="color: rgb(62,62,62); margin-bottom: 15px; margin-top: 15px; text-align: justify;font-size: 14px;font-family: 微软雅黑; ">
		                        即日起，加辰教育开展活动啦！！！喜欢英语的小朋友们，赶快来这里一起学习吧！用美丽的语言，编织梦想的翅膀，环游世界的梦想从加辰起步！
		                    </p>
		                    <section style="border-width: 0px; border-style: none; padding: 0px; box-sizing: border-box;" data-ele="imb">
		                        <section style="margin: 0px; padding: 0px; box-sizing: border-box; font-family: 微软雅黑;">
		                            <section style="margin: 0px 30px; padding: 0px; box-sizing: border-box;transform: rotate(0deg);-webkit-transform: rotate(0deg);-moz-transform: rotate(0deg);-ms-transform: rotate(0deg);-o-transform: rotate(0deg);">
		                                <section style="margin-bottom: -38px; padding: 0px; display: inline-block; width: 100%; box-sizing: border-box;" data-width="100%">
		                                    <section style="margin: 0px; padding: 0px; border-right-width: 20px; border-right-style: solid; border-right-color: rgb(238, 87, 94); border-top-width: 10px; border-top-style: solid; border-top-color: transparent; border-bottom-width: 10px; border-bottom-style: solid; border-bottom-color: transparent; height: 0px; width: 0px; float: left; box-sizing: border-box;">
		                                        <section class="_135editor" data-tools="135编辑器" data-id="90207" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                            <section style="width:100%;" data-width="100%">
		                                                <section style="width:200px; height:230px; margin:10px auto; background-image:url(http://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvZmdua3hmR25ua1IxdWs4Q1JvZmViWUs4d291R29HWmlhdktybE85aWJpYkhTa1FoNklGN1dnVmxVcnlmcFFiOXNpYno4YU42Y2hHVGU1MFd6VFRTOTdxbmF3LzA/d3hfZm10PXBuZw==); background-repeat:no-repeat; background-size:100% auto; overflow:hidden;">
		                                                    <section style="width: 165px; height: 159px; border-radius: 100%; margin-left: 8px; margin-top: 59px; box-sizing: border-box;">
		                                                        <section data-role="circle" style="border-radius: 100%; overflow: hidden; margin: 0px auto; width: 100%; padding-bottom: 100%; height: 0px; background-image: url(http://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvZmdua3hmR25ua1IxdWs4Q1JvZmViWUs4d291R29HWmlhNGlhcmhNYXhpYks0Tm5Pa2ljSmF1TWxSTFYzN3kwajY0cnFmYTRnS0N2emxVUDQyaWJLcmdMdzJnQS8wP3d4X2ZtdD1wbmc=); background-position: 50% 50%; background-size: cover; box-sizing: border-box;" data-width="100%">
		                                                            <img src="http://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvZmdua3hmR25ua1IxdWs4Q1JvZmViWUs4d291R29HWmlhNGlhcmhNYXhpYks0Tm5Pa2ljSmF1TWxSTFYzN3kwajY0cnFmYTRnS0N2emxVUDQyaWJLcmdMdzJnQS8wP3d4X2ZtdD1wbmc=" style="opacity:0;"/>
		                                                        </section>
		                                                    </section>
		                                                </section>
		                                            </section>
		                                        </section>
		                                    </section>
		                                    <section style="margin: 0px; padding: 0px; border-left-width: 20px; border-left-style: solid; border-left-color: rgb(238, 87, 94); border-top-width: 10px; border-top-style: solid; border-top-color: transparent; border-bottom-width: 10px; border-bottom-style: solid; border-bottom-color: transparent; height: 0px; width: 0px; float: right; clear: none; box-sizing: border-box;"></section>
		                                </section>
		                                <section style="margin: 0px 20px; padding: 0px 10px; height: 50px; box-sizing: border-box; border-radius: 6px; background-color: rgb(238, 87, 94); font-size: 18px; color: rgb(254, 254, 254); text-align: center; word-wrap: break-word;">
		                                    <section style="margin: 0px; padding: 0px; display: inline-block; box-sizing: border-box;">
		                                        <section style="margin: 0px; padding: 0px; height: 50px; display: table-cell; vertical-align: middle; text-align: center; box-sizing: border-box;">
		                                            <strong><span style="color: inherit;">活动详情介绍</span></strong>
		                                        </section>
		                                    </section>
		                                </section>
		                            </section>
		                            <section style="margin-top: -30px; padding: 50px 10px 20px; border: 4px solid rgb(200, 200, 200); border-radius: 10px; box-sizing: border-box;">
		                                <section style="border-width: 0px; border-style: none; padding: 0px; box-sizing: border-box;">
		                                    <section class="_135editor" data-tools="135编辑器" data-id="89436" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                        <section style="text-align:center;">
		                                            <section style="width:7em;height:3em;color:#fff;font-size:1em;line-height:3em;display:inline-block;text-align:center;background-image:url(http://rdn.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9naWYvZmdua3hmR25ua1RNTnRHeTdLV2ZDcmRKaWJBWVk2SHRJV1R6QmxKeDdWaGR5cXhKVUtZSXF4am1WTkRBTTFQcXNWaWNDSjRhM3NoRUxpYWRNOERzZUVzdEEvMD93eF9mbXQ9Z2lm);background-repeat:no-repeat;background-size:100%;background-position:0">
		                                                <p class="autonum" style="margin:0" data-original-title="" title="">
		                                                    1
		                                                </p>
		                                            </section>
		                                        </section>
		                                    </section>
		                                    <section data-id="us538932" class="_135editor" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                                        <section style="padding: 10px; box-sizing: border-box;">
		                                            <section style="width:100%;">
		                                                <section style="float: left; border: 2px solid rgb(147, 205, 91); width: 45%; box-sizing: border-box;">
		                                                    <section data-role="square" style="overflow: hidden; margin: 0px auto; width: 100%; padding-bottom: 100%; height: 0px; box-sizing: border-box; background-image: url(&quot;http://image.135editor.com/files/users/262/2625290/201707/4EfYIQ4C_BIvx.jpg&quot;); background-size: cover; background-position: 50% 50%;">
		                                                        <img src="http://image.135editor.com/files/users/262/2625290/201707/4EfYIQ4C_BIvx.jpg" style="opacity:0;width:100%;"/>
		                                                    </section>
		                                                </section>
		                                                <section style="float:right; width:50%; font-size:14px;" class="135brush">
		                                                    <p>
		                                                        <span style="font-size: 17px;">每推荐3位好友关注“加辰教育定制”，即可获赠一次价值88元的精品英文绘本课程。</span>
		                                                    </p>
		                                                </section>
		                                            </section>
		                                        </section>
		                                        <section style="width:100%; clear:both;"></section>
		                                    </section>
		                                    <section class="_135editor" data-tools="135编辑器" data-id="89436" style="border: 0px none; padding: 0px; box-sizing: border-box; position: relative;">
		                                        <section style="text-align:center;">
		                                            <section style="width:7em;height:3em;color:#fff;font-size:1em;line-height:3em;display:inline-block;text-align:center;background-image:url(http://rdn.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9naWYvZmdua3hmR25ua1RNTnRHeTdLV2ZDcmRKaWJBWVk2SHRJV1R6QmxKeDdWaGR5cXhKVUtZSXF4am1WTkRBTTFQcXNWaWNDSjRhM3NoRUxpYWRNOERzZUVzdEEvMD93eF9mbXQ9Z2lm);background-repeat:no-repeat;background-size:100%;background-position:0">
		                                                <p class="autonum" style="margin:0" data-original-title="" title="">
		                                                    2
		                                                </p>
		                                            </section>
		                                        </section>
		                                    </section>
		                                    <section style="padding: 10px; box-sizing: border-box;">
		                                        <section style="width:100%;">
		                                            <section style="float: right; border: 2px groove rgb(147, 205, 91); width: 45%; box-sizing: border-box;">
		                                                <section data-role="square" style="overflow: hidden; margin: 0px auto; width: 100%; padding-bottom: 100%; height: 0px; box-sizing: border-box; background-image: url(&quot;http://image.135editor.com/files/users/262/2625290/201707/2JJBdNTN_SKqp.jpg&quot;); background-size: cover; background-position: 50% 50%;">
		                                                    <img src="http://image.135editor.com/files/users/262/2625290/201707/2JJBdNTN_SKqp.jpg" style="opacity:0;width:100%;"/>
		                                                </section>
		                                            </section>
		                                            <section style="float:left; width:50%; font-size:14px;" class="135brush">
		                                                <span style="font-size: 17px;">每推荐10位好友关注“加辰教育定制“，即有机会获赠一本精品英文绘本&nbsp;。</span>
		                                            </section>
		                                        </section>
		                                    </section>
		                                    <section style="width:100%; clear:both;"></section><br/>
		                                    <p>
		                                        <br/>
		                                    </p>
		                                </section>
		                                <section style="border-width: 0px; border-style: none; padding: 0px; box-sizing: border-box;"></section>
		                            </section>
		                        </section>
		                    </section><br/>
		                    <p>
		                        <br/>
		                    </p>
		                    <section class="_135editor" data-tools="135编辑器" data-id="90010" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                        <section style="width:100%; text-align:center;" data-width="100%">
		                            <img style="width:80%;" src="http://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9naWYvZmdua3hmR25ua1N6bmdXeUh2MkpmVEZpYklmbUhxR2ZVN1NPSFB5aWNPcGdmT3k2Y0JXck15WkloVkQ1NjVCNVlLTW1nQjdpY0NmakhzQmtLUHhTampBbUEvMD93eF9mbXQ9Z2lm" data-width="80%"/>
		                        </section>
		                    </section>
		                    <section class="_135editor" style="border: 0px none; padding: 0px; box-sizing: border-box;">
		                        <section style="text-align:center;">
		                            <iframe class="video_iframe" style="position: relative;z-index:1;height:240px;width:320px;" scrolling="no" src="https://v.qq.com/iframe/preview.html?vid=n0514qeuraf&auto=0" allowfullscreen="" frameborder="0"></iframe>
		                        </section>
		                        <p class="135brush" data-brushtype="text" style="text-align:center;">
		                            <br/>
		                        </p>
		                    </section>
		                    <section class="_135editor" data-tools="135编辑器" data-id="90207" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;"></section>
		                    <section class="_135editor" data-tools="135编辑器" data-id="89537" style="border: 0px none; padding: 0px; box-sizing: border-box; position: relative;">
		                        <section style="border: 0px; padding: 0px; margin: 0px auto; text-align: left; white-space: normal; display: inline-block; box-sizing: border-box;">
		                            <section style="display:inline-block;float:left;vertical-align:top">
		                                <section style="width: 60px; text-align: center; border-radius: 100%; display: inline-block; color: rgb(255, 255, 255); vertical-align: top; box-sizing: border-box;">
		                                    <img style="width: 100%;" src="http://image.135editor.com/files/users/262/2625290/201707/2C5uGA6N_WG5f.jpg" style="border: 1px solid rgb(51, 68, 85); margin: 0px; padding: 0px; border-radius: 100%;" title="微信图片_20170725222511.jpg" data-width="100%" alt="微信图片_20170725222511.jpg"/>
		                                </section>
		                            </section>
		                            <section style="padding: 0px; margin-left: 70px; text-align: left; line-height: 25px; box-sizing: border-box;">
		                                <p style="padding: 0px; margin: 0px 0px 0px 5px; clear: none; display: inline-block; font-size: 14px;">
		                                    <span style=";color:#51b8d2;color: #0C0C0C;">加辰教育定制</span>
		                                </p>
		                                <p style="color: rgb(153, 153, 153); font-size: 12px; padding: 0px; margin: 0px 0px 0px 5px; clear: none; display: inline-block;">
		                                    ：
		                                </p>
		                                <section class="135brush" data-style="clear:none;" style="color: rgb(120, 120, 120); font-size: 14px; padding: 0px; margin: 0px 0px 0px 10px; box-sizing: border-box;">
		                                    <p style="clear:none;">
		                                        <span style="font-family: 微软雅黑; color: #0C0C0C;">我们的成长，期待与你同行!</span><br/>
		                                    </p>
		                                </section>
		                            </section>
		                            <section style="clear:both;"></section>
		                        </section>
		                    </section>
		                    <section class="_135editor" data-tools="135编辑器" data-id="90070" style="border: 0px none; padding: 0px; position: relative; box-sizing: border-box;">
		                        <section style="padding: 10px; box-sizing: border-box;">
		                            <section style="width:100%;" data-width="100%">
		                                <img style="display: block;width: 100%;" src="http://image.135editor.com/files/users/262/2625290/201707/xTdEcRpO_SJEj.jpg" data-width="100%" title="微信图片_20170725222542.jpg" alt="微信图片_20170725222542.jpg"/>
		                            </section>
		                            <section style="width:100%; text-align:center;" data-width="100%">
		                                <section style="text-align:center;">
		                                    <span style="width:10px; height:10px; background-color:#85accd; border-radius:100%; display:inline-block; margin:0px 5px;"></span><span style="width:10px; height:10px; background-color:#85accd; border-radius:100%; display:inline-block; margin:0px 5px;"></span><span style="width:10px; height:10px; background-color:#85accd; border-radius:100%; display:inline-block; margin:0px 5px;"></span>
		                                </section>
		                            </section>
		                        </section>
		                    </section>
		                    <p>
		                        <br/>
		                    </p>
		                </section>
		            </section>
		        </section>
		    </section>
		</section> -->

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
		                                                                        <span style="color: #7F7F7F; line-height: 22.4px; font-size: 20px;">之半价购课</span><span style="color: #595959; font-size: 15px; line-height: inherit;">&nbsp;</span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                        </section>
		                                                        <p style="font-size: 16px;">
		                                                            <br/>
		                                                        </p>
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
		                                                                        <span style="color: rgb(12, 12, 12); font-size: 18px;"><span style="color: rgb(12, 12, 12); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif;">初中一至三年级英语</span></span>
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
		                                                                        <span style="font-size: 18px;">您当前拥有半价券 0 张</span>
		                                                                    </p>
		                                                                </section>
		                                                            </section>
		                                                            <section style="font-size: 16px; text-align: center; color: rgb(87, 110, 181); margin-left: 3.5em;">
		                                                                <button type="button" class="btn btn-success btn-lg">分享得券</button>
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
		                                                            <section style="margin-top: -4.5em; margin-left: 8em;">
		                                                                <section>
		                                                                    <p>
		                                                                        <span style="font-size: 18px;">您的分享指数为 0 人</span>
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
		                                                                        您已购买此课程次数 0 次
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
		                                                                    <section style="width: 100%; text-align: left;">
		                                                                        <br/>
		                                                                    </section>
		                                                                </section>
		                                                            </section>
		                                                        </section>
		                                                        <section class="_135editor" data-tools="135编辑器" data-id="89927" style="font-size: 16px; border: 0px none; padding: 0px; box-sizing: border-box;"></section>
		                                                        <p style="font-size: 16px;">
		                                                            <span style="font-size: 17px;"><strong><span style="color: #FF0000;">推荐有奖活动详情规则</span></strong></span><span style="font-size: 15px; color: #3F3F3F;">：<span style="color: #3F3F3F; font-size: 16px;">用户每成功推荐<span style="color: #3F3F3F; font-size: 18px;">一位</span>好友关注“加辰教育定制”，即可获得一张<span style="color: #3F3F3F; font-size: 19px;">半价购课券</span>，凭此券，用户可半价购买一次指定的加辰教育双师Class课程。半价购课券有效期90天，可叠加使用。</span></span>
		                                                        </p>
		                                                        <p style="font-size: 16px; text-align: center;">
		                                                            <img src="http://7xo6kd.com1.z0.glb.clouddn.com/upload-ueditor-image-20170803-1501761169745046230.jpg" alt="微信图片_20170731204053_meitu_3.jpg"/>
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
	</body>
