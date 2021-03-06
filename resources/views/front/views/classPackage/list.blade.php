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
		    
			<div class="content" style='background: #FFF;font-family: -apple-system-font,"Helvetica Neue","PingFang SC","Hiragino Sans GB","Microsoft YaHei",sans-serif;'>
				<div class="content-block" style="margin-top: 1rem;font-weight: bold;font-size: 1.2em;margin-bottom: 0.4rem;">请选择class课程</div>
				<div class="content-block" style='margin: 4px 0px 0.38rem;/*color: #557ECB;*/color: #000;font-size: 1.6em;' onclick="window.location.href='https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIxNzg4MDY4Ng==&scene=124#wechat_redirect';">加辰教育定制</div>
			  	<!-- <div style="width: 96%;margin: 0 auto;">
                  
                </div> -->
                <div class="list-block">
                    <ul>
                        @foreach($obj as $value)
                        <li class="item-content" onclick="window.location.href='/front/classPackage?id={{$value->id}}';">
                            <div class="item-inner">
                                <div class="item-title">{{$value->name}}</div>
                                <div class="item-after">¥ {{number_format($value->price, 2)}}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

			</div>
        </div>
    </div>
    <script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
  </body>
</html>