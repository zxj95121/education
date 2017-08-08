<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>加辰教育</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!--     <link rel="shortcut icon" href="/favicon.ico"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">

    <style type="text/css">
    	.bigBtn{
    		margin-top: 18px;
    		border-radius: 3px;
    	}
    </style>

  </head>
  <body>
    <div class="page-group" style="background:#fff">
        <div class="page page-current">
		    <header class="bar bar-nav">
		    	<a class="button button-link button-nav pull-left" onclick="window.location.href='/front/home/oauth';" data-transition="slide-out" style="color:#fff">
	      			<span class="icon icon-left"></span>返回
	    		</a>
			 	<h1 class='title' style="background: #22AAE8;color: #fff;">我的优惠券</h1>
			</header>
			<div class="content" style="background: #eaeaea;">
				<div class="container-fluid" style="padding: 0px;">
					<div class="row" style="margin: 0 auto;width: 96%;">

						<!-- <div class="col-xs-5 bigBtn" id="bigBtn1" style="height:70px;background: #22AAE8;text-align: center;line-height: 70px;color: #FFF;">
							推荐有奖
						</div>
						<div class="col-xs-5 col-xs-offset-2 bigBtn" id="bigBtn2" style="height:70px;background: #22AAE8;text-align: center;line-height: 70px;color: #FFF;">
							地方开发
						</div> -->
						<div class="card-container" style="width: 100;margin-top: 18px;">
					        <div class="card" style="margin: 0px;">
					            <div class="card-header">{{$userinfo->nickname}}，你好</div>
					            <div class="card-content">
					                <div class="card-content-inner">
					                    你可用优惠总金额为：<span style="color:#22AAE8;">{{$userinfo->voucher}}</span> 元。 <br>
					                    最多可使用满1000减88代金券： <span style="color:#22AAE8;">{{floor($userinfo->voucher/88)}}</span> 张
					                </div>
					            </div>
					        </div>
					    </div>

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
									<label class="label label-success" style="position: relative;height: 100%;font-size:18px;right: 8px;cursor: pointer;" onclick="window.location.href='/front/use_right_away';">立即使用</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>


    <script type="text/javascript">
    	Zepto(function($){
			var width = $('.bigBtn').width();
			var a = parseInt(0.7*(width/5));
			$('#bigBtn1').css({'position':'relative','left':a+'px'});
			$('#bigBtn2').css({'position':'relative','right':a+'px'});
		})
    </script>
  </body>
</html>