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
	    	<!-- <a class="button button-link button-nav pull-left" href="/front/home" data-transition='slide-out'>
	      		<span class="icon icon-left"></span>
	      		返回
	    	</a> -->
	    	<h1 class="title">请点击授课中订单</h1>
	  	</header>
	  	<div class="content">
	  		<div class="content-block">
	       	@foreach($teachingObj as $value)
			  	<div class="content-block-title">订单编号：<span>{{$value['order_no']}}</span></div>
				<div class="list-block media-list">
			    	<ul>
			      		<li>
				        	<a @if($value['schedule']) onclick="window.location.href='/front/parent/mySchedule/schedule';" @else onclick="noSchedule();" @endif class="item-link item-content" style="font-size: 15px;">
				          		<div class="item-inner">
					            	<div class="item-title-row">
					              		<div class="item-title">课表：<span style="color:#3B833E;">@if($value['schedule']) 已安排 @else 未安排 @endif</span></div>
					              		<div class="item-after">{{$value['created_at']}}</div>
					            	</div>
					            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
				            		<div class="item-text">
				            			课程名称：<span style="font-size: 13px;color: #343639;">{{$value['name']}}</span>
				            		</div>
				          		</div>
				        	</a>
			      		</li>
			    	</ul>
			  	</div>
			@endforeach
	  		</div>
	  	</div>
	</div>

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
	<script type="text/javascript">
		function noSchedule() {
			$.alert('管理员暂未分配该订单,请稍后再试');
		}
	</script>
</body>
</html>