<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>加辰教育</title>
    <!-- 引入 WeUI -->
    
    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="/front/css_module/homepage/my.css">
    <style type="text/css">
        #my a:link{
            text-decoration: none;
        }
        #my a:visited{
            text-decoration: none;
        }
        #my a:hover{
            text-decoration: none;
        }
        #my a:active{
            text-decoration: none;
        }
        #all_bottom p:link{
            text-decoration: none;
        }
        #all_bottom p:visited{
            text-decoration: none;
        }
        #all_bottom p:hover{
            text-decoration: none;
        }
        #all_bottom p:active{
            text-decoration: none;
        }
    </style>
</head>
<body>
	@if($userType->type == 2)
		<div class="container-fluid" id="teacher" style="display: none;">
        	teacher
    	</div>
    	<div class="container-fluid" id="classroom" style="display: none;">
        	classrome
    	</div>
    	<div class="container-fluid" id="eclass" style="display: none; padding:0">
        
    	</div>
	@elseif($userType->type == 3)
		<div class="container-fluid" id="studytime" style="display: none;">
        	教学时间
    	</div>
    	<div class="container-fluid" id="studyplace" style="display: none;">
        	教学地点
    	</div>
    	<div class="container-fluid" id="salary" style="display: none; padding:0">
        	薪资待遇
    	</div>
	@endif
    <div class="container-fluid" id="parent" style="display: none;">
        parent
    </div>
    <div class="container-fluid" id="my" style="display:none">
        <!-- header start -->
        <div class="row" id="my_header">
            <div class="col-xs-2" id="my_header_img">
                <img src="{{$res->headimg}}">
            </div>
            <div class="col-xs-5" id="my_header_basic">
                <div class="col-xs-10">
                	@if($userType->type == 1)
                		<span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;width: 100%;">{{$res->nickname}}</span><br>
                	@else
                		<span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;width: 100%;">{{$res->name}}</span><br>
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
                <div class="col-xs-5" id="my_header_add_content">
                    <p>个人信息<i class="glyphicon glyphicon-chevron-right"></i></p>
                </div>
            </a>
            @elseif($userType->type == 3)
            <a href="/front/user_info_teacher">
                <div class="col-xs-5" id="my_header_add_content">
                    <p>个人信息<i class="glyphicon glyphicon-chevron-right"></i></p>
                </div>
            </a>
            @else
            @endif
        </div>
        <!-- header end -->

    <div class="row" id="my_count">
		@if($userType->type == 1)
        

        @elseif($userType->type == 2)
	       	<div class="row" id="my_count">
	            <div class="row" id="my_count_top">
	                <div class="col-xs-4">3</div>
	                <div class="col-xs-4">2</div>
	                <div class="col-xs-4">1</div>
	            </div>
	            <div class="row" id="my_count_bottom">
	                <div class="col-xs-4">class订单</div>
	                <div class="col-xs-4">已确认</div>
	                <div class="col-xs-4">已完成</div>
	            </div>
	        </div>
	       	<div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        @elseif($userType->type == 3)
	        <div class="row" id="my_count">
	            <div class="row" id="my_count_top">
	                <div class="col-xs-4">3</div>
	                <div class="col-xs-4">2</div>
	                <div class="col-xs-4">1</div>
	            </div>
	            <div class="row" id="my_count_bottom">
	                <div class="col-xs-4">class订单</div>
	                <div class="col-xs-4">已确认</div>
	                <div class="col-xs-4">已完成</div>
	            </div>
	        </div>
	       	<div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        @endif
        @if($userType->type == 1)
        @elseif($userType->type == 2)
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
	                <div class="col-xs-3 my_function_type" id="addChild">
	                    <div class="my_function_top">
	                        <img src="/images/home/function_add.png" />
	                    </div>
	                    <div class="my_function_bottom">
	                        添加孩子
	                    </div>
	                </div>
	            </div>
	            <!-- <div class="row" class="my_function">
	            </div> -->
	        </div>
	        <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        @elseif($userType->type == 3)
        @endif
        
        @if($userType->type == 1)
        	
        @elseif($userType->type == 2)
       		<div class="weui-cells" id="my_option">
	            <a class="weui-cell weui-cell_access" href="/front/setClassTime">
	                <div class="weui-cell__hd"><img src="/images/home/option_time.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>上课时间倾向</p>
	                </div>
	                <div class="weui-cell__ft">必填</div>
	            </a>
	        </div>
        @elseif($userType->type == 3)
        	<div class="weui-cells" id="my_option">
	            <a class="weui-cell weui-cell_access" href="/front/user_info_teacher">
	                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>消息通知</p>
	                </div>
	                <div class="weui-cell__ft">说明文字</div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="javascript:;">
	                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>cell standard</p>
	                </div>
	                <div class="weui-cell__ft">说明文字</div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="javascript:;">
	                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>cell standard</p>
	                </div>
	                <div class="weui-cell__ft">说明文字</div>
	            </a>
	            <a class="weui-cell weui-cell_access" href="javascript:;">
	                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
	                <div class="weui-cell__bd">
	                    <p>cell standard</p>
	                </div>
	                <div class="weui-cell__ft">说明文字</div>
	            </a>
	        </div>
        @endif
        </div>
    </div>
    @if($userType->type == 1)
   		<div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的</p>
	        </a>
	    </div>
   	@elseif($userType->type == 2)
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
	        <a id="twoclass" href="javascript:void(0);" class="weui-tabbar__item" for="eclass" id="eclass1">
	            <span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_class.png" alt="" class="weui-tabbar__icon">
	            </span>
	            <p class="weui-tabbar__label">双师class</p>
	        </a>
	        <a href="javascript:void(0);" class="weui-tabbar__item" for="my" id="my1">
	            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
	            <p class="weui-tabbar__label">我的</p>
	        </a>
	    </div>
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
	        <a id="twoclass" href="javascript:void(0);" class="weui-tabbar__item" for="salary" id="salary1">
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
    <script type="text/javascript">
    	// $(function(){
    	// 	var url = [];	
    	// 	url = window.location.href.split('#');
    	// 	if(url.length == 1){
    	// 		$('#my1').trigger('click');
    	// 	}else{
    	// 		var obj = document.getElementById(url[1]);
    	// 		if(obj){
     //    			$('#'+url[1]+'1').trigger('click');
    	// 		}else{
    	// 			$('#my1').trigger('click');
    	// 		}
    	// 	}
     //    })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
	    var urlStyle = [];
	    var urlScript = [];
	    /* 加载js css */
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
        $('#twoclass').click(function(){
            $('#eclass').load('/front/twoClass');
        	includeLink("/front/my/twoclass.js","js");
        })
    </script>
</body>
</html>
