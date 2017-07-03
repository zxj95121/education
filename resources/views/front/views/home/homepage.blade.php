<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>加辰教育</title>
    <!-- 引入 WeUI -->
    
    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" href="/css/weui.css"/>
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
    </style>
</head>
<body>

    <div class="container-fluid" id="teacher" style="display: none;">
        teacher
    </div>

    <div class="container-fluid" id="parent" style="display: none;">
        parent
    </div>

    <div class="container-fluid" id="classroom" style="display: none;">
        classrome
    </div>

    <div class="container-fluid" id="eclass" style="display: none; padding:0">
        
    </div>
    <div class="container-fluid" id="my">
        <!-- header start -->
        <div class="row" id="my_header">
            <div class="col-xs-2" id="my_header_img">
                <img src="http://wx.qlogo.cn/mmopen/twzEicfDU8lTKRO4jibmPvp1ibxRaGvcKgEkGiaWfUVCZavod3RtVIKh3NiaGBhUjia2dzmzBWSQ8I0KzLooYZ2JlchqIJyZx58WiaR/0">
            </div>
            <div class="col-xs-5" id="my_header_basic">
                <div class="col-xs-10">
                    <span>张贤健</span><br>
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

        <!-- count start -->
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
        <!-- count end -->
        <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        <!--function start -->
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
            <div class="row" class="my_function">
            </div>
        </div>
        <!--function end -->
        <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>
        <!-- option start -->
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
        <!-- option end -->
    </div>
    <div class="weui-tabbar" id="all_bottom" style="position: fixed;z-index: 9999;">
        <a href="javascript:void(0);" class="weui-tabbar__item" for="teacher">
            <span style="display: inline-block;position: relative;">
                <img src="/images/home/menu_teach.png" alt="" class="weui-tabbar__icon">
                <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">8</span>
            </span>
            <p class="weui-tabbar__label">名师定制</p>
        </a>
        <a href="javascript:void(0);" class="weui-tabbar__item" for="classroom">
            <img src="/images/home/menu_classroom.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">教室定制</p>
        </a>
        <a id="twoclass" href="javascript:void(0);" class="weui-tabbar__item" for="eclass">
            <span style="display: inline-block;position: relative;">
                <img src="/images/home/menu_class.png" alt="" class="weui-tabbar__icon">
                <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>
            </span>
            <p class="weui-tabbar__label">双师class</p>
        </a>
        <a href="javascript:void(0);" class="weui-tabbar__item" for="my">
            <img src="/images/home/menu_my_fill.png" alt="" class="weui-tabbar__icon">
            <p class="weui-tabbar__label">我的</p>
        </a>
    </div>

    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/homepage.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/my.js"></script>

	<!-- <script type="text/javascript" src="/js/layui/layui.js"></script> -->
    
    <script type="text/javascript">
		// $(function(){
	 //        layui.use('layer', function(){
	 //            window.layer = layui.layer;
	 //        });
		// })
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
