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
    <div class="page-group">
        <div class="page page-current">
			<header class="bar bar-nav">
				<a class="button button-link button-nav pull-left" href="/front/parent/myClassOrder?action=3" data-transition='slide-out'>
	      			<span class="icon icon-left"></span>
	      			返回
	    		</a>
				<h1 class="title">授课详情</h1>
			</header>
			<div class="content">
				<div class="content-block-title" style=" margin-bottom: 0px;margin-top: 0px;"><p>{{$classname}}<p><p>授课学生:{{$childname}}</p></div>
				<div class="list-block" style="margin-top: 0px">
					<ul>
						@foreach($res as $key => $value)
							<li class="item-content">
								<div class="item-inner">
									<div class="item-title">{{$value->name}}</div>
									@if($value->zhuangtai == 0)
										<div class="item-after">已完成</div>
									@else
										<div class="item-after">未完成</div>
									@endif
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