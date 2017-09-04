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
    <link rel="stylesheet" type="text/css" href="/front/css_module/homepage/madeTT.css?v={{rand(1,1000)}}">
    <link rel="stylesheet" type="text/css" href="/admin/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/helper.css">

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
    	<div class="mui-col-xs-12 mui-col-sm-12">
            <button type="button" class="mui-btn mui-btn-primary" style="width: 100%;border-radius: 0px;line-height: 32px;font-size: 1.8rem;">设置定制详情</button>   
        </div>

        <div class="mui-col-xs-12 mui-col-sm-12 madeT_Div" id="madeT_apply" style="margin-bottom: 50px;">
            <div class="mui-content" style="position: relative;">
                <div class="mui-col-xs-12 mui-col-sm-12 madeSteps" id="directionMade">
                    <div style="padding: 10px 10px;">
                        <form class="mui-input-group">

                            <div class="mui-input-row">
                                <label>时间定制 <span style="color:red;">*</span></label>

                                <input type="text" placeholder="点我设置辅导时间" id="timeMade" readonly="readonly">
                            </div>

                            <div class="mui-input-row">
                                <label>风格定制 <span style="color:red;">*</span></label>

                                <input type="text" placeholder="请选择辅导风格" readonly="readonly">
                                <select class="selectMade" id="typeM" name="typeM" style="opacity: 0;">
                                    <option value="1">温和型</option>
                                    <option value="2">严厉型</option>
                                    <option value="3">幽默型</option>
                                </select>
                            </div>

                            <div class="mui-input-row">
                                <label>学科定制 <span style="color:red;">*</span></label>

                                <input type="text" placeholder="请选择自己擅长学科" id="subjectMade" readonly="readonly">
                            </div>

                            <div class="mui-input-row">
                                <label>特长定制</label>

                                <input type="text" placeholder="请选择自己的特长" id="hobbyMade" readonly="readonly">
                            </div>

                            <div class="mui-input-row">
                                <label>经验定制 <span style="color:red;">*</span></label>

                                <input type="text" placeholder="请选择辅导经验" readonly="readonly" id="expMade">
                            </div>

                            <div class="mui-input-row">
                                <label>薪资定制</label>

                                <input type="text" placeholder="请选择辅导期望薪资" id="priceMade" readonly="readonly">
                            </div>

                            <div class="mui-input-row">
                                <label>地点定制</label>

                                <input type="text" placeholder="请选择期望辅导地点" id="placeMade" readonly="readonly">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="page__bd page_set" id="hobbyPopover">
            <div class="weui-cells" style="margin-top:0px" >
                <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
                    <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
                    <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">特长定制</div></div>
                    <div><div class="placeholder glyphicon glyphicon-ok" id="done_ok2""></div></div>
                </div>
            </div>
            <div style="width: 100%;margin: 0 auto;" class="div_detail">
                <div class="mui-content" style="padding: 6px;">
                    @foreach($hobby as $value)
                    <div class="mui-col-xs-12 mui-col-sm-12 subject_type">
                        <h5 style="margin-bottom: 0px;">{{$value['type']}}</h5>
                        @foreach($value['two'] as $v)
                        <button type="button" class="mui-btn" hid="{{$v['id']}}" active="0" style="margin-top: 8px;">{{$v['name']}}</button>
                        @endforeach
                    </div>
                    @endforeach
                </div>

                <br>
                <p style="text-decoration: underline;" id="noHobby">没有找到特长，点我联系管理员。</p>
            </div>
        </div>

        <div class="page__bd page_set" id="subjectPopover">
                <div class="weui-cells" style="margin-top:0px" >
                    <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
                        <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
                        <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">学科定制</div></div>
                        <div><div class="placeholder glyphicon glyphicon-ok" id="done_ok1"></div></div>
                    </div>
                </div>
                <div style="width: 100%;margin: 0 auto;" class="div_detail">
                    <div class="mui-content" style="padding: 6px;">
                        @foreach($subject as $value)
                        <div class="mui-col-xs-12 mui-col-sm-12 subject_type" sid="{{$value['id']}}">
                            <h5>{{$value['name']}}</h5>
                            @foreach($value['two'] as $v)
                            <button type="button" class="mui-btn" stid="{{$v['id']}}" active="0">{{$v['name']}}</button>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        <div class="page__bd page_set" id="expPopover">
            <div class="weui-cells" style="margin-top:0px" >
                <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
                    <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
                    <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">经验定制</div></div>
                    <div><div class="placeholder glyphicon glyphicon-ok" id="done_ok_exp"></div></div>
                </div>
            </div>

            <div style="width: 100%;margin: 0 auto;" class="div_detail">
                <div class="mui-content" style="padding: 6px;">
                    <div class="col-md-9">

                        <div class="checkbox-inline" style="margin: 10px 0px 10px;">
                            <label class="cr-styled">
                                <input type="checkbox" name="expCheckbox" class="expCheckbox" value="1">
                                <i class="fa"></i> 
                                <font>高中生</font>
                            </label>
                        </div>

                        <div class="checkbox-inline" style="margin: 10px 0px 10px;">
                            <label class="cr-styled">
                                <input type="checkbox" name="expCheckbox" class="expCheckbox" value="2">
                                <i class="fa"></i> 
                                <font>初中生</font>
                            </label>
                        </div>

                        <div class="checkbox-inline" style="margin: 10px 0px 10px;">
                            <label class="cr-styled">
                                <input type="checkbox" name="expCheckbox" class="expCheckbox" value="3">
                                <i class="fa"></i> 
                                <font>小学生</font>
                            </label>
                        </div>

                        <div class="checkbox-inline" style="margin: 10px 0px 10px;">
                            <label class="cr-styled">
                                <input type="checkbox" name="expCheckbox" value="4" id="noexpCheckbox">
                                <i class="fa"></i> 
                                <font>无经验</font>
                            </label>
                        </div>

                    </div>
                </div>
            </div>

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
	        <div class="row" class="my_function function_child" style="margin: 0px;">

	       		<!-- <div id="my_functions">
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
		        </div> -->
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
    <script type="text/javascript" src="/front/js_module/homepage/homepageT.js?v={{rand(1,1000)}}"></script>
    <script type="text/javascript" src="/front/js_module/homepage/madeTT.js?v={{rand(1,1000)}}"></script>
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

    <script type="text/javascript">

            /*特长添加新内容*/
            $('#noHobby').click(function(){
                window.openIndex = layer.open({
                    type: 1
                    ,content: '<div class="weui-cells__title">特长申请</div><div class="weui-cells weui-cells_form"> <div class="weui-cell"> <div class="weui-cell__hd"><label class="weui-label">特长名称</label></div> <div class="weui-cell__bd"> <input class="weui-input" id="input_newHobby" type="text" placeholder="请输入您的特长"> </div> </div> <div class="weui-btn-area"> <a class="weui-btn weui-btn_primary" href="javascript:" id="addHobby" onclick="addHobbyFunc();">提交</a> </div>'
                    ,anim: 'up'
                    ,style: 'position:fixed; top:26%; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
                });
            })


        function addHobbyFunc(){
            var name = $('#input_newHobby').val();
            $.ajax({
                url: '/front/addNewHobby',
                type: 'post',
                dataType: 'json',
                data: {
                    name: name
                },
                success: function(data){
                    layer.close(window.openIndex);
                    layer.open({
                        content: '提交申请成功，请耐心等待管理员审核。'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                }
            })
        }

    </script>
</body>
</html>
