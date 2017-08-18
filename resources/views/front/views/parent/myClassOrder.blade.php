<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="/css/weui.css"/>
	<link rel="stylesheet" type="text/css" href="/css/sm.min.css">
	<style type="text/css">
	</style>
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
			    <a href="#tab2" class="tab-link button">排课中</a>
			    <a href="#tab3" class="tab-link button">授课中</a>
			    <!-- <a href="#tab4" class="tab-link button">已完成</a> -->
			 </div>
	  		<div class="content-block">
	  			<div class="popup popup-services">
				  	<div class="content-block">
					    <div id="orderdetail" style="position: absolute;top: 0px;left: 0px;width: 100%;overflow: scroll;font-family: arial, helvetica, sans-serif;background: #FFF;">
	            			<div class="cartTop" style="position: relative;text-align: center;line-height: 39px;height:39px;background: #EA7E1F;color:#FFF;z-index: 100;cursor: pointer;">
	            		订单详情
	            				<div class="cartTopRight" id="orderdetailClose" style="height: 39px;cursor: pointer;line-height: 39px;position: absolute;right: 10px;top: 0px;"><a href="#" class="close-popup" style="color:#FFF;" onclick="OpenContent();">关闭</a></div>
	            			</div>
	            			<div class="weui-loadmore weui-loadmore_line" style="position: absolute;top:39px;left:0px;z-index: -1;width: 100%;">
		            			<span class="weui-loadmore__tips">订单为空</span>
		        			</div>
		        		</div>
				  	</div>
				</div>
				<div class="popup-overlay"></div>
	    		<div class="tabs">
	      			<div id="tab1" class="tab active">
	      			@foreach($noPayObj as $value)
					  	<div class="content-block-title payT" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list payC">
					    	<ul>
					      		<li class="urlPay urlPay0" vid="{{$value['id']}}">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#343639;">待付款</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			已优惠：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-text" style="text-align: right;">
						            			<button class="button button-block showOrderDetail" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #0894ec;cursor:pointer;width: 48%;display: inline-block;">订单详情</button>
						            			<button class="button button-block deleteOrderDetail" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #ED2424;cursor:pointer;border-color:#ED2424;width: 48%;display: inline-block;">删除订单</button>
						            		</div>	
						          		</div>
						        	</a>
					      		</li>
					    	</ul>
					  	</div>
					@endforeach
					@foreach($noPayObj2 as $value)
					  	<div class="content-block-title payT" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list payC">
					    	<ul>
					      		<li class="urlPay urlPay1" vid="{{$value['id']}}">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#343639;">待付款</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">课程名称：<span style="color:#343639;">{{$value['name']}}</span></div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			已优惠：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-text" style="text-align: right;">
						            			<button class="button button-block" onclick="window.location.href='/front/classPackage/payShow?id={{$value['id']}}';" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #31B22C;border-color: #31B22C;cursor:pointer;width: 48%;display: inline-block;">立即支付</button>
						            			<button class="button button-block deleteOrderDetail2" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #ED2424;cursor:pointer;border-color:#ED2424;width: 48%;display: inline-block;">删除订单</button>
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
					  	<div class="content-block-title payT" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list payC">
					    	<ul>
					      		<li class="urlPay" vid="{{$value['id']}}">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#3B833E;">排课中</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			已优惠：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-text" style="text-align: right;">
						            			<button class="button button-block showOrderDetail" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #0894ec;cursor:pointer;">订单详情</button>
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
					  	<div class="content-block-title payT" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list payC">
					    	<ul>
					      		<li class="urlPay" vid="{{$value['id']}}">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#3B833E;">授课中</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			已优惠：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-text" style="text-align: right;">
						            			<button class="button button-block showOrderDetail" style="color:#FFF;height: 1.6rem;line-height:1.6rem;background: #0894ec;cursor:pointer;">订单详情</button>
						            		</div>
						          		</div>
						        	</a>
					      		</li>
					    	</ul>
					  	</div>
					@endforeach

					@foreach($teachingObj2 as $value)
					  	<div class="content-block-title payT" style="height: 16px;line-height: 15px;">订单编号：<span>{{$value['order_no']}}</span></div>
						<div class="list-block media-list payC">
					    	<ul>
					      		<li class="urlPay" vid="{{$value['id']}}">
						        	<a href="javascript:void(0);" class="item-link item-content" style="font-size: 15px;">
						          		<div class="item-inner">
							            	<div class="item-title-row">
							              		<div class="item-title">状态：<span style="color:#3B833E;">授课中</span></div>
							              		<div class="item-after">{{$value['created_at']}}</div>
							            	</div>
							            	<div class="item-subtitle">价格：<span style="color:#DE5145;">{{$value['price']}}元</span></div>
							            	<div class="item-subtitle">课时：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
						            		<div class="item-text">
						            			已优惠：<span style="font-size: 15px;color: #343639;">{{$value['voucher_num']*88}}元</span>
						            		</div>
						            		<div class="item-subtitle">英语主题party：<span style="color:#2e7900;">{{$value['count']}}次</span></div>
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

		
		$(document).on('click','.showOrderDetail', function (e) {
			var vid = $(this).parents('.urlPay').attr('vid');
			setTimeout(function(){
				$('.payT').hide();
		  		$('.payC').hide();
			}, 250)
			
			$.ajax({
				headers:{
					'X-CSRF-TOKEN': '{{csrf_token()}}'
				},	
				url:'/front/parent/getOrderDetail',
				data:{
					id: vid
				},
				type:'post',
				datatype:'json',
				success:function(data){
					if(data.errcode == 0){
						$('.cartblock').each(function(){
							$(this).remove();
						})
						var obj = data.obj;

                        for (var i in obj) {
                            var id2 = obj[i]['id'];
                            var name2 = obj[i]['name'];
                            var name1 = obj[i]['name1'];



                            $('#orderdetail').append('<div class="cartblock" pid="'+i+'"> <div class="cartheader" style="width:100%;background: #60b4e6;'
			+'color: #FFF;padding:6px 10px;"> <p style="font-size:1.1em;margin: 0px 0px;">'+name2+'</p> </div> </div>');

							var liObj = obj[i]['detail'];
                            for (var j in liObj) {
								$('.cartblock').last().append('<div class="cartcontent" style="width: 96%;margin:0 auto;background: #FFF;" pid="'+j+'">'
								 +'<div  class="weui-cells" style="margin:0;"> <a class="weui-cell weui-cell_title"> <div class="weui-cell__bd"'
								  +'style="position: relative;color:#333;"> <p style="font-size:15px;">'+liObj[j]['name3']+'</p> <iframe id="tmp_downloadhelper_iframe"'
								   +'style="display: none;"></iframe> </div> <div class="weui-cell__ft"> <span>'+liObj[j]['count']+'课时</span> <span class="btn btn-danger deleteCartBtn"'
								    +'style="background-color:#FFF;border-color:#FFF;background-image:url(\'/images/home/cart_delete.png\');'
								    +'background-size:100% 100%;width:28px;height:28px;"> </span> </div> </a> </div> </div>');
							}


                            // appendDiv.append('<div class="col-md-12 detailList" twoid="'+id2+'"> <div class="panel panel-default"> <div class="panel-heading"> <h3 class="panel-title">'+name1+' 》 '+name2+'</h3> </div> <div class="panel-body"> <ol> </ol> </div> </div> </div>');
                            // var liObj = obj[i]['detail'];
                            // for (var j in liObj) {
                            //     var cdom = $('.detailList[twoid="'+id2+'"]').find('ol');
                            //     cdom.append('<li>'+liObj[j]['name3']+'<span style="display: inline-block;margin-left:8px;">'+liObj[j]['count']+'</span>'+'</li>');
                            // }
                        }
                        $('#orderdetail').append('<div class="cartblock"> <div class="cartheader" style="width:100%;background: #60b4e6;'
			+'color: #FFF;padding:6px 10px;"> <p style="font-size:1.1em;margin: 0px 0px;">英语主题party</p> </div> </div>');
							$('.cartblock').last().append('<div class="cartcontent" style="width: 96%;margin:0 auto;background: #FFF;" pid="'+j+'">'
								 +'<div  class="weui-cells" style="margin:0;"> <a class="weui-cell weui-cell_title"> <div class="weui-cell__bd"'
								  +'style="position: relative;color:#333;"> <p style="font-size:15px;">英语主题party</p> <iframe id="tmp_downloadhelper_iframe"'
								   +'style="display: none;"></iframe> </div> <div class="weui-cell__ft"> <span>'+data.count+'次</span> <span class="btn btn-danger deleteCartBtn"'
								    +'style="background-color:#FFF;border-color:#FFF;background-image:url(\'/images/home/cart_delete.png\');'
								    +'background-size:100% 100%;width:28px;height:28px;"> </span> </div> </a> </div> </div>');
					} else {
						$('.payT').hide();
		  				$('.payC').hide();
					}
				},
				error: function(){
					$('.payT').hide();
		  			$('.payC').hide();
				}
			})
		  	$.popup('.popup-services');
		  	
		});


		$(document).on('click', '.urlPay0', function(e){
			var vid = $(this).attr('vid');
			// console.log(e.target.tagName);
			if (e.target.tagName == 'DIV')
				window.location.href='/front/parent/showPayEclassOrder?id='+vid;
		})

		$(document).on('click', '.urlPay1', function(e){
			var vid = $(this).attr('vid');
			// console.log(e.target.tagName);
			if (e.target.tagName == 'DIV')
				window.location.href='/front/classPackage/payShow?id='+vid;
		})

		$(document).on('click', '.deleteOrderDetail', function(e){
			var vid = $(this).parents('li').attr('vid');
			var cdom = $(this).parents('.payC');

			$.confirm('确定?', '删除该订单', function () {
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					url:'/front/parent/deleteOrderDetail',
					data:{
						id: vid
					},
					type:'post',
					datatype:'json',
					success:function(data){
						if (data.errcode == 0) {
							$.alert('删除成功');
							cdom.prev().remove();
							cdom.remove();
						}
					}
				})
			});
		}) 

		$(document).on('click', '.deleteOrderDetail2', function(e){
			var vid = $(this).parents('li').attr('vid');
			var cdom = $(this).parents('.payC');

			$.confirm('确定?', '删除该课程订单', function () {
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},	
					url:'/front/parent/deleteOrderDetail2',
					data:{
						id: vid
					},
					type:'post',
					datatype:'json',
					success:function(data){
						if (data.errcode == 0) {
							$.alert('删除成功');
							cdom.prev().remove();
							cdom.remove();
						}
					}
				})
			});
		})


		function OpenContent(){
			$('.payT').show();
		  	$('.payC').show();
		}
	</script>
</body>
</html>