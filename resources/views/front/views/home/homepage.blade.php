<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>加辰教育</title>
    <!-- 引入 WeUI -->
    @if($parentDetail->id == 21)
    <link rel="stylesheet" type="text/css" href="/js/mui/dist/css/mui.css">
    @else
    @endif
    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="/front/css_module/homepage/my.css">
    @if($parentDetail->id == 21)
    <link rel="stylesheet" type="text/css" href="/front/css_module/homepage/madeT.css">
    @else
    @endif

    <style type="text/css">
	    #twoclass{
	    	position: relative;
	    }
        a:link{
            text-decoration: none;
        }
         a:visited{
            text-decoration: none;
        }
         a:hover{
            text-decoration: none;
        }
         a:active{
            text-decoration: none;
        }
       	#all_bottom .weui-tabbar__label{
       		font-size: 13px;
       		line-height: 1.3;
       		margin: 0px 0px 5px;
       	}
       	.weui-tabbar__icon{
       		width: 18px;
       		height: 18px;
		}
       	/*#all_bottom{
       		transform: scale(1, 0.7);
       	}
       	.weui-tabbar__item{
       		transform: scale(0.7, 0.7);
       	}*/
    </style>
</head>
<body>
	@if($userType->type == 2)
		@if($parentDetail->type == 1)
		<div class="container-fluid" id="teacher" style="display: none;">
			@if($parentDetail->id == 21)
			<ul class="mui-table-view mui-grid-view mui-grid-9" id="madeT_ul">
	            <li class="mui-table-view-cell mui-media mui-col-xs-6 mui-col-sm-6" hr="#madeT_made"><a href="#">
	                    <span class="mui-icon mui-icon-compose"></span>
	                    <div class="mui-media-body">教师定制</div></a></li>
	            <li class="mui-table-view-cell mui-media mui-col-xs-6 mui-col-sm-6" hr="#madeT_made"><a href="#">
	                    <span class="mui-icon mui-icon-paperclip"><span class="mui-badge">5</span></span>
	                    <div class="mui-media-body">历史定制</div></a></li>
	        </ul>
	        <div class="mui-col-xs-12 mui-col-sm-12 madeT_Div" id="madeT_made">
	        	<nav class="mui-bar mui-bar-tab">
					<a class="mui-tab-item" href="#teacher1">
						<span class="mui-icon mui-icon-home"></span>
						<span class="mui-tab-label">首页</span>
					</a>
					<a class="mui-tab-item" href="#classroom1">
						<span class="mui-icon mui-icon-email"><span class="mui-badge">9</span></span>
						<span class="mui-tab-label">消息</span>
					</a>
					<a class="mui-tab-item" href="#eclass1">
						<span class="mui-icon mui-icon-contact"></span>
						<span class="mui-tab-label">通讯录</span>
					</a>
					<a class="mui-tab-item mui-active" href="#my1">
						<span class="mui-icon mui-icon-gear"></span>
						<span class="mui-tab-label">设置</span>
					</a>
				</nav>
	        </div>
	        <div class="mui-col-xs-12 mui-col-sm-12 madeT_Div" id="madeT_history">
	        	
	        </div>
			@else
        	<div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">名师定制功能正在开发中</span>
        	</div>
        	@endif
    	</div>
    	<div class="container-fluid" id="classroom" style="display: none;">
        	 <div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">教室定制功能正在开发中</span>
        	</div>
    	</div>
    	<div class="container-fluid" id="eclass" style="display: none; padding:0">
        	<div id="twoclass">
        	</div>
    	</div>
    	@elseif($parentDetail->type == 2)
    	<div class="container-fluid" id="teacher" style="display: none;">
        	<div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">名师定制功能正在开发中</span>
        	</div>
    	</div>
    	@else
    	<div class="container-fluid" id="teacher" style="display: none;">
        	<div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">名师定制功能正在开发中</span>
        	</div>
    	</div>
    	@endif
	@elseif($userType->type == 3)
		<div class="container-fluid" id="studytime" style="display: none;">
        	<div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">功能正在开发中</span>
        	</div>
    	</div>
    	<div class="container-fluid" id="studyplace" style="display: none;">
        	 <div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">功能正在开发中</span>
        	</div>
    	</div>
    	<div class="container-fluid" id="salary" style="display: none; padding:0">
        	 <div class="weui-loadmore weui-loadmore_line">
            	<span class="weui-loadmore__tips">功能正在开发中</span>
        	</div>
    	</div>
	@endif
    <div class="container-fluid" id="my" style="display:none">
        <!-- header start -->
        <div class="row" id="my_header" style="position: relative;">
            <div class="col-xs-2" id="my_header_img">
                <img src="{{$res->headimg}}">
            </div>
            <div class="col-xs-5" id="my_header_basic">
                <div class="col-xs-10">
                	@if($userType->type == 1)
                		<span style="font-size: 22px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;width: 100%;">{{$res->nickname}}</span><br>
                	@else
                		<span style="font-size: 22px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;width: 100%;">{{$res->name}}</span><br>
                	@endif
                    <span>
                        @if($userType->type == 1)
                            我是管理员
                        @elseif($userType->type == 2)
                            我是家长
                        @elseif($userType->type == 3)
                            我是名师
                        @endif
                    </span>
                </div>
            </div>
            @if($userType->type == 2)
            <a href="/front/user_info_parent">
                <div class="col-xs-5" id="my_header_add_content" style="position: absolute;bottom: 0px;right: 0px;">
                    <p style="font-size: 18px;height: 35px;line-height: 35px;">个人信息<i class="glyphicon glyphicon-chevron-right"></i></p>
                </div>
            </a>
            @elseif($userType->type == 3)
            <a href="/front/user_info_teacher">
                <div class="col-xs-5" id="my_header_add_content" style="position: absolute;bottom: 0px;right: 0px;">
                    <p style="font-size: 18px;height: 35px;line-height: 35px;">个人信息<i class="glyphicon glyphicon-chevron-right"></i></p>
                </div>
            </a>
            @else
            @endif
        </div>
        <!-- header end -->
		@if($userType->type == 1)
        

        @elseif($userType->type == 2)
        	@if($parentDetail->type == 1)
	       	<!-- <div class="row" id="my_count">
	            <a href="/front/parent/myClassOrder">
	            	<div class="row_count col-xs-4" id="my_count_left">
	                	<div class="colXS">{$orderstatus[1]}</div>
	                	<div class="colXS">课程总次数</div>
	            	</div>
	            </a>
	            <a href="/front/parent/myClassOrder?action=3">
		            <div class="row_count col-xs-4" id="my_count_center">
		                <div class="colXS">{$orderstatus[2]}</div>
		                <div class="colXS">待学习</div>
		            </div>
	            </a>
	            <a href="/front/parent/myClassOrder?action=4">
		            <div class="row_count col-xs-4" id="my_count_right">
		                <div class="colXS">{$orderstatus[3]}</div>
		                <div class="colXS">已完成</div>
		            </div>
	        	</a>
	        </div> -->
	       	<!-- <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div> -->
	       	@else
	       	@endif
        @elseif($userType->type == 3)
	        <!-- <div class="row" id="my_count">
	            <div class="row_count col-xs-4" id="my_count_left">
	                <div class="colXS">1</div>
	                <div class="colXS">1</div>
	            </div>
	            <div class="row_count col-xs-4" id="my_count_center">
	                <div class="colXS">1</div>
	                <div class="colXS">1</div>
	            </div>
	            <div class="row_count col-xs-4" id="my_count_right">
	                <div class="colXS">1</div>
	                <div class="colXS">1</div>
	            </div>
	        </div> -->
	       	<div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        @endif
        @if($userType->type == 1)
        @elseif($userType->type == 2)
        	@if($parentDetail->type == 1)
       		<div id="my_functions">
	            <div class="row" class="my_function function_child">
	                <!-- <div class="col-xs-3 my_function_type" id="user_info">
	                    <div class="my_function_top">
	                        <img src="/images/home/function_info.png" />
	                    </div>
	                    <div class="my_function_bottom">
	                        个人信息
	                    </div>
	                    <div class="my_function_float">
	                        <img src="/images/home/function_cicle.png" />
	                    </div>
	                </div> -->
	                @foreach($child as $key => $value)
	                	<div class="col-xs-3 my_function_type listChild" childid="{{$value->id}}" style="cursor: pointer;">
		                    <div class="my_function_top">
		                    	@if($value->sex == 0)
		                        	<img src="/images/home/function_child_girl.png" />
		                    	@else
		                    		<img src="/images/home/function_child_boy.png" />
		                    	@endif
		                    </div>
		                    <div class="my_function_bottom" style="padding-top:11px">
		                    	{{$value->name}}
		                    </div>
		                </div>
	                @endforeach
	                @if(empty($key) || $key < 3)
	                	<div class="col-xs-3 my_function_type" id="addChild">
		                    <div class="my_function_top">
		                        <img src="/images/home/function_add.png" />
		                    </div>
		                    <div class="my_function_bottom" style="padding-top:11px">
		                     	 添加孩子
		                    </div>
		                </div>
	                @endif

	            </div>
	            <!-- <div class="row" class="my_function">
	            </div> -->
	        </div>
	        <!-- <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div> -->
	        @else
	        @endif
        @elseif($userType->type == 3)
        @endif
        
        @if($userType->type == 1)
        	
        @elseif($userType->type == 2)
        	@if($parentDetail->type == '1')
       		<div class="weui-cells" id="my_option">
	            <a class="weui-cell weui-cell_access" href="/front/setClassTime">
	                <div class="weui-cell__hd"><img src="/images/home/option_time.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>上课时间倾向</p>
	                </div>
	                <div class="weui-cell__ft">必填</div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="/front/parent/myClassOrder">
	                <div class="weui-cell__hd"><img src="/images/home/option_order.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>我的订单</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="/front/parent/mySchedule" style="display: none;">
	                <div class="weui-cell__hd"><img src="/images/home/option_schedule.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>我的课程表</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="/front/parent/myVoucher">
	                <div class="weui-cell__hd"><img src="/images/home/option_voucher.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>我的优惠券</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="/front/coin">
	                <div class="weui-cell__hd"><img src="/images/home/option_coin.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>我的加辰币</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="/front/parent/parentChat">
	                <div class="weui-cell__hd"><img src="/images/home/option_chat.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>客服沟通</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	        </div>
	        @elseif(!$parentDetail->type)
	        <div class="weui-cells" id="my_option">
	            <a class="weui-cell weui-cell_access" href="/front/user_info_parent">
	                <div class="weui-cell__hd"><img src="/images/home/option_information.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>请尽快完善个人信息</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	        </div>
	        @else
	        @endif
        @elseif($userType->type == 3)
        	<div class="weui-cells" id="my_option">
	            <a class="weui-cell weui-cell_access" href="#">
	                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>暂无功能使用</p>
	                </div>
	                <div class="weui-cell__ft"></div>
	            </a>
	        </div>
        @endif
    </div>

    @if($userType->type == 1)
   		<div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的加辰</p>
	        </a>
	    </div>
   	@elseif($userType->type == 2)
   		@if($parentDetail->type == 1)
   		<div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="teacher" id="teacher1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_teach.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">名师定制</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="classroom" id="classroom1">
	            <img src="/images/home/menu_classroom.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">教室定制</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="eclass" id="eclass1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_class.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">双师class</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my" id="my1">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的加辰</p>
	        </a>
	    </div>
	    @else
	    <div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="teacher" id="teacher1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_teach.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">名师定制</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my" id="my1">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的加辰</p>
	        </a>
	    </div>
	    @endif

   	@elseif($userType->type == 3)
   		<div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="studytime" id="studytime1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_teach.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">教学时间</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="studyplace" id="studyplace1">
	            <img src="/images/home/menu_classroom.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">教学地点</p>
	        </a>
	        <a  href="javascript:void(0);" class="weui-tabbar__item" for="salary" id="salary1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_class.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">薪资待遇</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my" id="my1">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的</p>
	        </a>
	    </div>
   	@endif
    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/homepage.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/my.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>
    <script type="text/javascript" src="/js/jquery.fly.js"></script>
    @if($parentDetail->id == 21)
    <script type="text/javascript" src="/js/mui/dist/js/mui.min.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/madeT.js?v={{rand(1,1000)}}"></script>
    @else
    @endif
    <script type="text/javascript" class="tabbar js_show">
    $(function(){
        $('.weui-tabbar__item').on('click', function () {
            $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
        });
    });</script>
    <script type="text/javascript">
    	$(function(){
    		newUserId = '{{$newUserId}}';

    		cartArr = new Array();
    		cartTotal = 0;
    		cartOrder = new Object();

    		var url = [];	
    		url = window.location.href.split('#');
    		if(url.length == 1){
    			$('#my1').trigger('click');
    		}else{
    			var obj = document.getElementById(url[1]);
    			if(obj){
        			$('#'+url[1]+'1').trigger('click');
    			}else{
    				$('#my1').trigger('click');
    			}
    		}
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
	    var urlStyle = [];
	    var urlScript = [];
	    /* 加载js css*/
		function includeLink(url,urlType) {
			if(urlType == "css"){
				for(var i = 0; i < urlStyle.length;i++){
					if(urlStyle[i] == url){
						var status = 2333;
						return false;
					}
				}
				if(status == 2333){
					return false;
				}
				urlStyle.push(url);
				var link = document.createElement("link");
				link.rel = "stylesheet";
				link.type = "text/css";
				link.href = url;
				document.getElementsByTagName("head")[0].appendChild(link);
			}else{
				for(var i = 0; i < urlScript.length;i++){
					if(urlScript[i] == url){
						var status = 2333;
						return false;
					}
				}
				if(status == 2333){
					return false;
				}
				urlScript.push(url);
				$.ajaxSetup({
					cache: true
				});
				$.getScript(url, function(){
				});
			}

		}
        $('#eclass1').click(function(){
            $('#eclass').load('/front/twoClass', function(){
            	setCartPosition();
            	$.ajax({
		        		url: '/front/twoClass/getpid',
		        		dataType: 'json',
		        		type: 'post',
		        		data: {

		        		},
		        		success: function(data) {
		        			if(data.errcode == 0) {
		        				$('#eclass').attr('pid1',data.pid1);
		        				$('#eclass').attr('pid2',data.pid2);
		        				// setCartPosition();
		        				// cartInit();

			            	$.ajax({
			            		url: '/front/getCartStorage',
								dataType: 'json',
								type: 'post',
								data: {
									id: newUserId
								},
								success: function(data) {
									if (data.errcode == 0) {
										cartOrder = eval('('+data.order+')');
										cartArr = eval('('+data.arr+')');
										cartTotal = parseInt(data.total);

										setCartPosition();
			            				cartInit();
									} else {
										console.log(0);
									}
								}
			            	})
			            }
		        	}
			    })
            });
        	includeLink("/front/my/twoclass.js","js");

        	
        })

        function setCartPosition(){
			var bottomHeight = $('#all_bottom').height();
			$('#myCart').css({'position':'fixed','bottom':bottomHeight+'px'});
			if ($('#myCart').length == 0) {
				$('#zhicheng').css({'height':bottomHeight+'px','opacity':0});
			} else {
				$('#zhicheng').css({'height':bottomHeight+40+'px','opacity':0});
			}
			var height = document.documentElement.clientHeight;

			$('#orderdetail').css('height', height-bottomHeight-40+'px');
			console.log(height);
			$('#orderdetail').css({'bottom':bottomHeight+40+'px'});
			
			$('#cartNum').html(cartTotal);/*购物车个数显示*/
			/*对购物车已有的三级变灰色*/
			for (var i = 0;i < cartArr.length;i++) {
				$('.buyCell a[pid="'+cartArr[i]+'"]').find('span').css({'background-color':'#FFF','border-color':'#FFF','background-image':"url('/images/home/cart_dark.png')"});
			}
		}

		$(document).on('click', '#myCartLeft', function(){
			if ($('#orderdetail').css('display') == 'none') {
				$('#orderdetail').slideDown();
			} else {
				$('#orderdetail').slideUp();
			}
		})

		/*deleteCartBtn*/
		$(document).on('click', '.deleteCartBtn', function(){
			var blockCount = $(this).parents('.cartblock').find('.cartcontent').length;

			var id = $(this).parents('.cartblock').attr('pid');
			var pid = $(this).parents('.cartcontent').attr('pid');
			var count = cartOrder[id]['val'][pid].count;
			cartTotal = cartTotal-count;

			var len = cartArr.length;
			for (var i = 0;i < len;i++) {
				if( cartArr[i] == pid) {
					delete(cartArr[i]);
					break;
				}
			}

			$('#cartNum').html(cartTotal);

			if (blockCount != 1) {
				delete(cartOrder[id]['val'][pid]);
				$(this).parents('.cartcontent').remove();
			} else {
				delete(cartOrder[id]);
				$(this).parents('.cartblock').remove();
			}

			$('.buyCell a').find('span').each(function(){
				$(this).css({'background-color':'#5cb85c','border-color':'#4cae4c','background-image':"url('/images/home/cart.png')"});
			})
			for (var i = 0;i < cartArr.length;i++) {
				$('.buyCell a[pid="'+cartArr[i]+'"]').find('span').css({'background-color':'#FFF','border-color':'#FFF','background-image':"url('/images/home/cart_dark.png')"});
			}

			ajaxStorage();
		})

		/*直接将购物车详情内容根据cartOrder对象重置*/
function cartInit(){
	$('#orderdetail .cartblock').each(function(){
		$(this).remove();
	})
	for (var i in cartOrder) {
		$('#orderdetail').append('<div class="cartblock" pid="'+i+'"> <div class="cartheader" style="width:100%;background: #EA6969;'
			+'color: #FFF;padding:6px 10px;"> <p style="font-size:1.1em;margin: 0px 0px;">'+cartOrder[i].name+'</p> </div> </div>');
		var val = cartOrder[i]['val'];
		for (var j in val) {
			$('#orderdetail .cartblock:last').append('<div class="cartcontent" style="width: 100%;background: #FFF;" pid="'+j+'">'
			 +'<div  class="weui-cells" style="margin:0;"> <a class="weui-cell weui-cell_title"> <div class="weui-cell__bd"'
			  +'style="position: relative;color:#333;"> <p style="font-size:15px;">'+val[j].name+'</p> <iframe id="tmp_downloadhelper_iframe"'
			   +'style="display: none;"></iframe> </div> <div class="weui-cell__ft"> <span>'+val[j].count+'课时</span> <span class="btn btn-danger deleteCartBtn"'
			    +'style="background-color:#FFF;border-color:#FFF;cursor:pointer;background-image:url(\'/images/home/cart_delete.png\');'
			    +'background-size:100% 100%;width:28px;height:28px;"> </span> </div> </a> </div> </div>');
		}
	}
}
    </script>

    @if($parentDetail->id == 21)
    <script type="text/javascript">
  //   	mui.init({
		// 	// swipeBack:true //启用右滑关闭功能
		// });
		mui.init({
			swipeBack: true
		});
    </script>
    @else
    @endif
    <script type="text/javascript">
  //   	closeStatus =0;
  //   	window.onpopstate = function(event) {
  //   		if(closeStatus == 1)
		//       	wx.closeWindow();
		//     else {
		//     	setTimeout(function(){wx.closeWindow();},100);
		//     	setTimeout(function(){wx.closeWindow();},200);
		//     	setTimeout(function(){wx.closeWindow();},400);
		//     	setTimeout(function(){wx.closeWindow();},600);
		//     	setTimeout(function(){wx.closeWindow();},800);
		//     	setTimeout(function(){wx.closeWindow();},1000);
		//     }
		// }

		wx.config({
		    debug: false,
		    appId: '<?php echo $signPackage["appId"];?>',
		    timestamp: <?php echo $signPackage["timestamp"];?>,
		    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		    signature: '<?php echo $signPackage["signature"];?>',
		    jsApiList: [
		      	// 所有要调用的 API 都要加到这个列表中
		      	'hideAllNonBaseMenuItem',
		      	'closeWindow'
		    ]
		});
		wx.ready(function () {
			// closeStatus = 1;
			// 在这里调用 API
			wx.hideAllNonBaseMenuItem();
			/*无误进行发送ajax*/

		});
	</script>
</body>
</html>
