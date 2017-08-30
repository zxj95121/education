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
    <link rel="stylesheet" type="text/css" href="/js/mui/dist/css/mui.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="/front/css_module/homepage/my.css">
    <link rel="stylesheet" type="text/css" href="/js/mui/plugin/picker/dist/css/mui.picker.min.css"">

    <style type="text/css">
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
        .weui-tabbar__icon {
		    width: 18px;
		    height: 18px;
		}
    </style>
</head>
<body>

	<div class="container-fluid mui-control-content" id="teacher">
    	<div class="weui-loadmore weui-loadmore_line">
        	<span class="weui-loadmore__tips">功能正在开发中</span>
    	</div>
	</div>
<!-- 	<div class="container-fluid mui-control-content" id="studyplace">
    	 <div class="weui-loadmore weui-loadmore_line">
        	<span class="weui-loadmore__tips">功能正在开发中</span>
    	</div>
	</div>
	<div class="container-fluid mui-control-content" id="salary" style="padding:0">
    	 <div class="weui-loadmore weui-loadmore_line">
        	<span class="weui-loadmore__tips">功能正在开发中</span>
    	</div>
	</div> -->

    <div class="container-fluid mui-control-content" id="my">
        <!-- header start -->
        <div class="row" id="my_header" style="position: relative;">
            <div class="col-xs-2" id="my_header_img">
                <img src="{{$res->headimg}}">
            </div>
            <div class="col-xs-5" id="my_header_basic">
                <div class="col-xs-10">

                	<span style="font-size: 22px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;display: inline-block;width: 100%;">{{$res->name}}</span><br>

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

            <a href="/front/user_info_teacher">
                <div class="col-xs-5" id="my_header_add_content" style="position: absolute;bottom: 0px;right: 0px;">
                    <p style="font-size: 18px;height: 35px;line-height: 35px;">个人信息<i class="glyphicon glyphicon-chevron-right"></i></p>
                </div>
            </a>

        </div>

	    <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div>

	    <div id="my_functions">
	        <div class="row" class="my_function function_child">

	       		<div id="my_functions">
		            <div class="row" class="my_function function_child">
		            	<div class="col-xs-3 my_function_type" id="addChild">
		                    <div class="my_function_top">
		                        <img src="/images/home/function_add.png" />
		                    </div>
		                    <div class="my_function_bottom" style="padding-top:11px">
		                     	 添加孩子
		                    </div>
		                </div>
		                
		            </div>
		            <!-- <div class="row" class="my_function">
		            </div> -->
		        </div>
		        <!-- <div class="jiange" style="width:100%;height:12px;background:#F2F5EA;"></div> -->
	        

	        	<div class="weui-cells" id="my_option">
		            <a class="weui-cell weui-cell_access" href="#">
		                <div class="weui-cell__hd"><img src="/images/home/option_notice.png" alt="" style="width:20px;margin-right:5px;display:block"></div>
		                <div class="weui-cell__bd">
		                    <p>暂无功能使用</p>
		                </div>
		                <div class="weui-cell__ft"></div>
		            </a>
		        </div>

	    	</div>
	    </div>
	</div>

		<nav class="mui-bar mui-bar-tab" id="all_bottom" style="position: fixed;z-index: 9999;">
			<a class="mui-tab-item" for="teacher" href="#teacher" id="teacher1" style="cursor: pointer;">
				<span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_teach.png" alt="" class="weui-tabbar__icon">
	            </span><br>
				<span class="mui-tab-label">家教定制</span>
			</a>
<!-- 			<a class="mui-tab-item" for="classroom" href="#classroom" id="classroom1" style="cursor: pointer;">
				<span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_classroom.png" alt="" class="weui-tabbar__icon">
	            </span><br>
				<span class="mui-tab-label">教室定制</span>
			</a>
			<a class="mui-tab-item" for="eclass" href="#eclass" id="eclass1" style="cursor: pointer;">
				<span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_class.png" alt="" class="weui-tabbar__icon">
	            </span><br>
				<span class="mui-tab-label">双师class</span>
			</a> -->
			<a class="mui-tab-item" for="my" href="#my" id="my1" style="cursor: pointer;">
				<span style="display: inline-block;position: relative;">
	                <img src="/images/home/menu_my.png" alt="" class="weui-tabbar__icon">
	            </span><br>
				<span class="mui-tab-label">我的加辰</span>
			</a>
		</nav>

    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
    <!-- <script type="text/javascript" src="/front/js_module/homepage/homepage.js"></script> -->
    <script type="text/javascript" src="/front/js_module/homepage/my.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>
    <script type="text/javascript" src="/js/mui/dist/js/mui.min.js"></script>
    <script type="text/javascript" src="/js/mui/plugin/picker/dist/js/mui.picker.min.js"></script>
    <script type="text/javascript" src="/front/js_module/homepage/homepageT.js"></script>
    <script type="text/javascript">
  //   	mui.init({
		// 	// swipeBack:true //启用右滑关闭功能
		// });
		mui.init({
			swipeBack: true
		});
    </script>

    <script type="text/javascript">
    	$(function(){
    		newUserId = '{{$newUserId}}';

    		cartArr = new Array();
    		cartTotal = 0;
    		cartOrder = new Object();

    		var url = [];	
    		url = window.location.href.split('#');
    		if(url.length == 1){
    			// $('#my1').trigger('click');
    			tabFunc('my');
    		}else{
    			var obj = document.getElementById(url[1]);
    			if(obj){
        			// $('#'+url[1]+'1').trigger('click');
        			tabFunc(url[1]);
        			if (url[1] == 'teacher' || url[1] == 'teachers') {
        				includeLink('/admin/css/style.min.css', 'css');
        				includeLink('/js/swiper/dist/css/swiper.min.css', 'css');
        				
        				includeLink('/js/swiper/dist/js/swiper.jquery.min.js', 'js', 'doSwiper');

        				if (url[1] == 'teachers') {
        					tabFunc('teacher');
        					$('.madeT_Div').css('display', 'none');
        					$('#madeT_history').show();
        				}
            		}
    			}else{
    				// $('#my1').trigger('click');
    				tabFunc('my');
    			}
    		}
        })

        function tabFunc(tab){
        	$('.mui-tab-item').each(function(){
        		$(this).removeClass('mui-active');
        	})
        	$('.mui-control-content').each(function(){
        		$(this).removeClass('mui-active');
        	})

        	$('#'+tab+'1').addClass('mui-active');
        	$('#'+tab).addClass('mui-active');
        	$('#'+tab+'1').find('img').attr('src', $('#'+tab+'1').find('img').attr('src').replace('.png', '_fill.png'));
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
	    var urlStyle = [];
	    var urlScript = [];
	    /* 加载js css*/
		function includeLink(url,urlType, func='') {
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
    				if (func) {
    					var ffff = eval(func);
    					new ffff();
    				}
    			});
    		}
    
    	}
    	
    	function doSwiper() {
    		var mySwiper = new Swiper ('.swiper-container', {
            	direction: 'horizontal',
            	
                loop: false,
    		});
    		$(document).on('click', '.madeShowDiv', function(){
    	  		mySwiper.slideTo(2, 500, false);//切换到第二个slide，速度为0.5秒
    	  		$('.swiper-slide').eq(0).fadeOut(300);
    	  		$('.swiper-slide').eq(1).fadeIn(600);

    	  		window.showMade($(this));
    	    })

    	    window.showMade = function(cdom){
      			var name = cdom.attr('stname');
      			var sex = cdom.attr('msex');
      			var education = cdom.attr('meducation');
      			var hobby = cdom.attr('mhobby');
      			var exp = cdom.attr('mexp');
      			var price = cdom.attr('mprice');
      			var time = cdom.attr('mtime');
      			var type = cdom.attr('mtype');
      			
      			$('.csubject').html(name);
      			$('.cprice').html(price+'元/时');
      			
      			var sexArr = ['未定制', '男女均可', '男', '女'];
      			$('.csex').html(sexArr[sex]);
      			
      			var educationArr = ['未定制', '研究生', '本科生', '专科生'];
      			$('.ceducation').html(educationArr[education]);
      			if (hobby) {
      				var hb = hobby.split('-');
    	  			var str = '';
    	  			for (var i in hb) {
    	  				var dt = $('#hobbyPopover button[hid="'+hb[i]+'"]').html();
    	  				str = str + '、' + dt;
    	  			}
    	  			$('.chobby').html(str.substr(1));
      			} else {
      				$('.chobby').html('未定制');
      			}
      			
      			var expArr = ['未定制', '高中生', '初中生', '小学生'];
      			$('.cexp').html(expArr[exp]);
      			
      			var timeArr = ['周一至周五晚上', '周末', '节假日', '暑假', '寒假'];
      			$('.ctime').html(timeArr[time]);
      			
      			var typeArr = ['未定制', '温和型', '严厉型', '幽默型'];
      			$('.ctype').html(typeArr[type]);
      		}
    	}
    </script>

    <script type="text/javascript">

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
