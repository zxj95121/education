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
	    	<a class="button button-link button-nav pull-left" href="/front/home" data-transition='slide-out'>
	      		<span class="icon icon-left"></span>
	      		返回
	    	</a>
	    	<a class="icon icon-refresh pull-right" onclick="window.location.reload();"></a>
	    	<h1 class="title">历史订单</h1>
	  	</header>
	  	<div class="content">
		  	<div class="buttons-tab">
			    <a href="#tab1" class="tab-link active button">待付款</a>
			    <a href="#tab2" class="tab-link button">待审核</a>
			    <a href="#tab3" class="tab-link button">授课中</a>
			    <!-- <a href="#tab4" class="tab-link button">已完成</a> -->
			 </div>
	  		<div class="content-block">
	    		<div class="tabs">
	      			<div id="tab1" class="tab active">
	      			@foreach($noPayObj as $value)
					  	<div class="content-block-title" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list">
					    	<ul>
					      		<li>
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#343639;">待付款</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			优惠金额：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-text" style="text-align: right;">
						            			<button class="button button-block" onclick="window.location.href='/front/parent/showPayEclassOrder?id={{$value['id']}}';" style="color:#FFF;background: #0894ec;">去付款</button>
						            		</div>
						          		</div>
						        	</a>
					      		</li>
					    	</ul>
					  	</div>
					@endforeach
					  	<!-- 加载提示符 -->
			          	<div class="infinite-scroll-preloader" style="display: none;">
			              	<div class="preloader"></div>
			          	</div>
	      			</div>
			      	<div id="tab2" class="tab">
			       	@foreach($noConfirmObj as $value)
					  	<div class="content-block-title" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list">
					    	<ul>
					      		<li>
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#3B833E;">待审核</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			优惠金额：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						          		</div>
						        	</a>
					      		</li>
					    	</ul>
					  	</div>
					@endforeach
					  	<!-- 加载提示符 -->
			          	<div class="infinite-scroll-preloader" style="display: none;">
			              	<div class="preloader"></div>
			          	</div>
			      	</div>
			      	<div id="tab3" class="tab">
			       	@foreach($teachingObj as $value)
					  	<div class="content-block-title" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list">
					    	<ul>
					      		<li  onclick="window.location.href='/front/parent/myClassOrder/details?id={{$value['id']}}';">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#3B833E;">待授课</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			优惠金额：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						          		</div>
						        	</a>
					      		</li>
					    	</ul>
					  	</div>
					@endforeach
					  	<!-- 加载提示符 -->
			          	<div class="infinite-scroll-preloader" style="display: none;">
			              	<div class="preloader"></div>
			          	</div>
			     	</div>
			     	
	    		</div>
	  		</div>
	  	</div>
	</div>

	
	<!-- <script type="text/javascript" src="/js/zepto.min.js"></script> -->
	<!-- <script type="text/javascript" src="/js/sm.min.js"></script> -->
	<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
	<script>
		function GetQueryString(name)
		{
		     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		     var r = window.location.search.substr(1).match(reg);
		     if(r!=null)return  unescape(r[2]); return null;
		}
		var ids = GetQueryString('action');
		if(ids){
			$('.buttons-tab').find('a').eq(parseInt(ids)-1).trigger('click');
		}else{
			$('.buttons-tab').find('a').eq(0).trigger('click');
		}
		$('.buttons-tab a').click(function(){
			var num = $(this).attr('href').substr($(this).attr('href').length-1,$(this).attr('href').length);
			var stateObject = {};
			var newUrl = "/front/parent/myClassOrder?action="+num;
			history.pushState(stateObject,'',newUrl);
		})
	</script>
</body>
</html>