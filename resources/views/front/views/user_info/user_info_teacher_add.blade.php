<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
	<title>个人信息</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="/js/cutimage/css/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/js/weui/weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css" />
	<!-- <link rel="stylesheet" type="text/css" href="/js/weui/example.css"> -->
	<style type="text/css">
		.page_set{
			width: 100%;
			position: absolute;
			z-index: 20;
			background-color: #E8E8E3;
		}
		#school_btns button{
			margin:5px;
		}

		.row_community{
			text-align: center;
			height: 60px;
			line-height: 60px;
			/*color: #22AAE8;*/
			font-size: 18px;
			overflow: hidden;
			padding: 0px;
		}
		.col{
			height: 100%;
			overflow-y: scroll;
			overflow-x: hidden;
			padding: 0px;
		}
		.col:nth-of-type(1){
			background-color: #FFF;
		}
		.col:nth-of-type(2){
			background-color: #F0F0EA;
		}
	</style>
</head>
<body>
	<div class="container" style="max-width: 500px;margin:0 auto;padding: 0px;position: relative;">
		<div class="page__bd" id="page_main">
			<div class="weui-cells" style="margin-top:0px" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
		            <div><div class="placeholder">&lt;</div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">个人信息</div></div>
		            <div><div class="placeholder">提交</div></div>
		        </div>
	            <div class="weui-cell weui-cell_access row_info" target="headimg">
	                <div class="weui-cell__bd">头像</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px; display:inline-block;"><img id="headimgPhone" style="width:70px;border-radius:50%;" src="{{$userInfo->headimg}}"></span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access row_info input_info" target="nickname">
	                <div class="weui-cell__bd">昵称</div>
	                <div class="weui-cell__ft" style="font-size: 0" >
	                    <span style="vertical-align:middle; font-size: 17px;">{{$userInfo->name}}</span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access row_info input_info" target="name">
	                <div class="weui-cell__bd">姓名</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">{{$userDetail->name}}</span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="cell_sex">
	                <div class="weui-cell__bd">性别</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">
	                    	@if($userDetail->sex == 0) 女
	                    	@elseif ($userDetail->sex == 1) 男
	                    	@endif
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="showDatePicker">
	                <div class="weui-cell__bd">出生日期</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;" class="qu-birth">
	                    	@php
	                    		if (!$userDetail->birth) {
	                    			echo '';
	                    		} else {
	                    			$birthArr = explode('-', $userDetail);
	                    			echo $birthArr[0].'年'.$birthArr[1].'月';
	                    		}
	                    	@endphp
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info" target="school">
	                <div class="weui-cell__bd">所在学校</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info input_info" target="project">
	                <div class="weui-cell__bd">所学专业</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">{{$userDetail->project}}</span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="moneyPicker">
	                <div class="weui-cell__bd">期望薪资</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info" target="community">
	                <div class="weui-cell__bd">期望教学社区</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">中央城等</span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access">
	                <div class="weui-cell__bd">我的优势</div>
	                <div class="weui-cell__ft" style="color:#22AAE8;">
	                    <span style="vertical-align:middle; font-size: 17px;" class="glyphicon glyphicon-ok"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access">
	                <div class="weui-cell__bd">个人图片展示</div>
	                <div class="weui-cell__ft" style="color:#22AAE8;">
	                    <span style="vertical-align:middle; font-size: 17px;" class="glyphicon glyphicon-ok"></span>
	                </div>
	            </div>
       		</div>
		</div>

		<div class="row" id="page_row" style="width: 100%;overflow: hidden;margin: 0 auto;position: absolute;top: 0px;">
        	<div class="page__bd page_set" id="headimg">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">头像</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok" id="btnCrop"> 使用</div></div>
			        </div>

			        <!-- <div id="cutShow" class="row" style="display: none;width: 100%;margin: 0px;">
			        	<img src="" style="width: 100%;">
			        </div> -->

			        <!-- 头像展示 -->
			        <div class="row" id="cut">
			        	<div class="col-xs-12" style="max-width: 500px;margin: 0 auto;">
			        		<div class="container" id="cutImage" style="width: 100%;margin: 0px;padding: 0px;">
							  	<div class="imageBox">
							    	<div class="thumbBox"></div>
							    	<div class="spinner" style="display: none">Loading...</div>
							  	</div>
							  	<div class="action"> 
							    	<!-- <input type="file" id="file" style=" width: 200px">-->
							    	<div class="new-contentarea tc"> 
							    		<a href="javascript:void(0)" class="upload-img">
							      			<label for="upload-file">更换照片</label>
							      		</a>
							      	<input type="file" class="" name="upload-file" id="upload-file" />
							    	</div>
							    	<!-- <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切"> -->
							    	<input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
							    	<input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
							  </div>
							  <div class="cropped" style="display: none;"></div>
							</div>

			        	</div>
			        </div>
			    </div>
			    <div style="width: 80%;margin: 0 auto;background-image:url('http://wx.qlogo.cn/mmopen/w6MofXPc5Nj9oWjZKbm3svI0grH1AMuYg6OaoQoc5TNjuic9iazY1YZKD9yQ4p8WP0Ovo6QVG6kxyrHvWJPJ39V9vM0zS033OS/0');background-size: 100%;">
			    </div>
			</div>
			<!-- 昵称 -->
			<div class="page__bd page_set" id="nickname">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">昵称</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok1"></div></div>
			        </div>
			    </div>
			    <div style="width: 97%;margin: 0 auto;" class="div_detail">
			    	<div class="weui-cells__title"><span>3</span>/8</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input input_set" name="nickname" type="text" placeholder="请输入昵称">
			                </div>
			            </div>
       				</div>
			    </div>
			</div>

			<!-- 姓名 -->
			<div class="page__bd page_set" id="name">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">姓名</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok1"></div></div>
			        </div>
			    </div>
			    <div style="width: 97%;margin: 0 auto;" class="div_detail">
			    	<div class="weui-cells__title"><span>3</span>/4</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input input_set" name="name" type="text" placeholder="请输入姓名">
			                </div>
			            </div>
       				</div>
			    </div>
			</div>

			<!-- 性别 -->
			<div id="sex" style="display: none;">
		        <div class="weui-mask" id="iosMask" style="opacity: 1;"></div>
		        <div class="weui-actionsheet weui-actionsheet_toggle" id="iosActionsheet">
		            <div class="weui-actionsheet__title">
		                <p class="weui-actionsheet__title-text">选择性别</p>
		            </div>
		            <div class="weui-actionsheet__menu">
		                <div class="weui-actionsheet__cell sex_actionsheet" val="1">男</div>
		                <div class="weui-actionsheet__cell sex_actionsheet" val="0">女</div>
		            </div>
		            <div class="weui-actionsheet__action">
		                <div class="weui-actionsheet__cell" id="iosActionsheetCancel">取消</div>
		            </div>
		        </div>
		    </div>

		    <!-- 学校 -->
		    <div class="page__bd page_set" id="school">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">学校</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok"></div></div>
			        </div>
			    </div>
			    <div style="width: 97%;margin: 0 auto;padding:20px 4px;" id="school_btns">
			    	<button type="button" class="btn btn-info">安徽师范大学</button>
			    	<button type="button" class="btn btn-info">安徽工程大学</button>
			    	<button type="button" class="btn btn-info">皖南医学院</button>	
			    	<button type="button" class="btn btn-info">芜湖职业技术学院</button>	
			    	<button type="button" class="btn btn-info">安徽中医药高等专科学校</button>	
			    	<button type="button" class="btn btn-info">安徽机电职业技术学院</button>	
			    	<button type="button" class="btn btn-info">其他高校</button>	
			    </div>
			</div>

			<!-- 所学专业 -->
			<div class="page__bd page_set" id="project">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">专业</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok1"></div></div>
			        </div>
			    </div>
			    <div style="width: 97%;margin: 0 auto;" class="div_detail">
			    	<div class="weui-cells__title"><span>3</span>/10</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input input_set" name="project" type="text" placeholder="所学专业">
			                </div>
			            </div>
       				</div>
			    </div>
			</div>

			<!-- 期望教学社区 -->
		    <div class="page__bd page_set" id="community">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">期望教学社区</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok"></div></div>
			        </div>
			    </div>
			    <div class="row" style="width: 100%;height: 100%;margin: 0 auto;" id="community">
			    	<div class="col-xs-3 col">
			    		<div class="row row_community">
			    			芜湖市fdfdafdf大饭店
			    		</div>
			    		<div class="row row_community">
			    			安庆市
			    		</div>
			    	</div>	
			    	<div class="col-xs-4 col">
			    		<div class="row row_community">
			    			鸠江区
			    		</div>
			    		<div class="row row_community">
			    			镜湖区
			    		</div>
			    		<div class="row row_community">
			    			弋江区
			    		</div>
			    	</div>
			    	<div class="col-xs-5 col">
			    		<div class="row row_community">
			    			中央城
			    		</div>
			    		<div class="row row_community">
			    			柏庄春暖花开
			    		</div>
			    		<div class="row row_community">
			    			鲁港新镇
			    		</div>
			    	</div>
			    </div>
			</div>


        </div>
        <!-- <div style="width: 100%;height:50px;"></div> -->
	</div>

	<div id="loadingToast" style="opacity: 0; display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">正在保存</p>
        </div>
    </div>

    <div id="toast" style="opacity: 0; display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content">已完成</p>
        </div>
    </div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/js/cutimage/js/cropbox.js"></script>
	<script type="text/javascript" src="/js/weui/zepto.min.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
	<script type="text/javascript" src="/js/weui/example.js"></script>
	<script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
	<script type="text/javascript">
		$(function(){
			var height = document.documentElement.clientHeight;
			$('#page_row').css({'display': 'none','height': height+'px'});
			$('.page_set').css({'height': height+'px','top': height+'px'});

			/*点击修改*/
			$('.row_info').click(function(){
				var target = $(this).attr('target');
				$('#page_row').css('display', 'block');
				$('#'+target).animate({'top': '0px'},250);
				setTimeout(function(){
					$('#page_main').css('display', 'none');
				}, 250);

				if ($(this).hasClass('input_info')) {
					var value = $(this).find('span').html();
					if (value == '' || value == '选填') {
						value = '';
					}
					$('#'+target+' input[name="'+target+'"]').val(value);
					$('#'+target+' .div_detail span').html(value.length);
				}
				if (target == "headimg") {
					options =
					{
						thumbBox: '.thumbBox',
						spinner: '.spinner',
						imgSrc: $('#headimgPhone').attr('src')
					};
					cropper = $('.imageBox').cropbox(options);

					$('.thumbBox').css('height', $('.thumbBox')[0].offsetWidth);
					$('#cut').css('display', 'block');
					$('#cutShow').css('display', 'none');
				}
			})

			/*取消修改*/
			$('.done_romove').click(function(){
				$('#page_main').css('display', 'block');
				$(this).parents('.page_set').animate({'top': height+'px'}, 250);
				setTimeout(function(){
					$('#page_row').css('display', 'none');
				}, 250);
			})

			/*性别*/
			$('#cell_sex').click(function(){
				$('#page_row').css('display', 'block');
				$('#sex').css('display', 'block');
			})
			$('#iosActionsheetCancel').click(function(){
				$('#page_row').css('display', 'none');
				$('#sex').css('display', 'none');
			})
			$('.sex_actionsheet').click(function(){
				var sex = $(this).html();
				var val = $(this).attr('val');
				$('#loadingToast').css({'display':'block', 'opacity':'1'});
				$('#loadingToast p').html('数据保存中');
				$.ajax({
					url: '/front/tsave_sex',
					type: 'post',
					dataType: 'json',
					data: {
						sex: val
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#cell_sex').find('span').html(sex);
							$('#page_row').css('display', 'none');
							$('#sex').css('display', 'none');

							$('#loadingToast').css({'display':'none', 'opacity':'0'});
		    				$('#toast p').html('修改成功');
							$('#toast').css({'display':'block', 'opacity':'1'});
							setTimeout(function(){
								$('#toast').css({'display':'none', 'opacity':'0'});
							},1000);
						}
					}

				})
				

			})

			/*出生年月*/
		    /*所在学校*/
		    $('#school_btns button').click(function(){
		    	$('#school_btns button[class="btn btn-success"]').removeClass('btn-success').addClass('btn-info');
		    	// var index = $(this).index('#school_btns button');
		    	$(this).removeClass('btn-info').addClass('btn-success');
		    })

		    $('#school .done_ok').click(function(){
		    	var value = $('#school_btns button[class="btn btn-success"]').html();
		    	if (!value) {
		    		return false;
		    	} else {
		    		$('div[target="school"]').find('span').html(value);
		    		$('#page_main').css('display', 'block');
					$(this).parents('.page_set').animate({'top': height+'px'}, 250);
					setTimeout(function(){
						$('#page_row').css('display', 'none');
					}, 250);
		    	}
		    })

		    /*文本框点击确认*/
		    $('.done_ok1').click(function(){
		    	var index = $(this).index('.done_ok1');
		    	var value = $(this).parents('.page_set').find('input').val();

		    	var arr = new Array(/^.{1,8}$/,/^[\u4e00-\u9fa5]{1,4}$/,/[\u4e00-\u9fa5]{1,10}/);
		    	if (!arr[index].test(value) && !(index == 1 && value == '')) {
		    		layer.open({
					    content: '长度或格式不正确'
					    ,skin: 'msg'
					    ,time: 2 //2秒后自动关闭
					 });
		    	} else {
			    	var tid = $(this).parents('.page_set').attr('id');
			    	$('.row_info[target="'+tid+'"]').find('span').html(value);

			    	if (index == 1 && value == '') {
						$('.row_info[target="'+tid+'"]').find('span').html('选填');
			    	}

			    	if (index == 0) {
			    		var url = '/front/tsave_nickname';
			    	} else if (index == 1) {
			    		var url = '/front/tsave_name';
			    	} else if (index == 2) {
			    		var url = '/front/tsave_project';
			    	}
			    	/*发送ajax请求更换数据*/

			    	$('#loadingToast').css({'display':'block', 'opacity':'1'});
					$('#loadingToast p').html('数据保存中');

			    	var thisdom = $(this);
			    	$.ajax({
			    		url: url,
			    		type: 'post',
			    		dataType: 'json',
			    		data: {
			    			value: value,
			    			openid: '{{$openid}}'
			    		},
			    		success: function(data) {
			    			if (data.errcode == 0) {
			    				$('#loadingToast').css({'display':'none', 'opacity':'0'});
			    				$('#toast p').html('修改成功');
								$('#toast').css({'display':'block', 'opacity':'1'});
								setTimeout(function(){
									$('#toast').css({'display':'none', 'opacity':'0'});
									$('#page_main').css('display', 'block');
									thisdom.parents('.page_set').animate({'top': height+'px'}, 250);
									setTimeout(function(){
										$('#page_row').css('display', 'none');
									}, 250);
								},1000);
			    			}
			    		}
			    	})

			    	
				}
		    })


		    /*keyup事件，限制用户长度*/
		    $('.input_set').keyup(function(){
		    	var index = $(this).index('.input_set');
		    	var value = $(this).val();
		    	var arr = new Array(5,4,10);
		    	if (value.length <= arr[index]) {
		    		$(this).parents('.div_detail').find('span').html(value.length);
		    	} else {
		    		$(this).parents('.div_detail').find('span').html('<font color="#F0F">'+value.length+'</font>');
		    	}
		    })

		})
	</script>
	<script type="text/javascript">
		$(function(){
			/*价格*/
			$(document).on('click', '#moneyPicker', function(){
				weui.picker([{
		            label: '50元',
		            value: 50
		        }, {
		            label: '60元',
		            value: 60,
		            checked: true
		        },{
		            label: '70元',
		            value: 70
		        },{
		            label: '80元',
		            value: 80
		        },{
		            label: '90元',
		            value: 90
		        },{
		            label: '100元',
		            value: 100
		        },{
		            label: '110元',
		            value: 110
		        },{
		            label: '120元',
		            value: 120
		        },{
		            label: '130元',
		            value: 130
		        },{
		            label: '140元',
		            value: 140
		        },{
		            label: '150元',
		            value: 150
		        },{
		            label: '160元',
		            value: 160
		        },{
		            label: '170元',
		            value: 170
		        },{
		            label: '180元',
		            value: 180
		        },{
		            label: '190元',
		            value: 190
		        },{
		            label: '200元',
		            value: 200
		        },{
		            label: '210元',
		            value: 210
		        },{
		            label: '220元',
		            value: 220
		        },{
		            label: '230元',
		            value: 230
		        },{
		            label: '240元',
		            value: 240
		        },{
		            label: '250元',
		            value: 250
		        },{
		            label: '260元',
		            value: 260
		        },{
		            label: '270元',
		            value: 270
		        },{
		            label: '280元',
		            value: 280
		        },{
		            label: '290元',
		            value: 290
		        },{
		            label: '300元',
		            value: 300
		        }],	 [{
		            label: '60分钟',
		            value: 60
		        }, {
		            label: '90分钟',
		            value: 90
		        }], {
		            onChange: function (result) {
		                // console.log(result);
		            },
		            onConfirm: function (result) {
		                $('#moneyPicker span').html(result[0] + '元 / ' + result[1] +'分钟');
		            }
		        });
			})

			/*出生年月*/
			$(document).on('click', '#showDatePicker', function () {
				var end = new Date().getFullYear();
				var start = parseInt(end)-60;
				var yearArr = new Array();
				for(var i = start;i < end; i++) {
					yearArr[yearArr.length] = i;
				}
				var monthArr = [1,2,3,4,5,6,7,8,9,10,11,12];
				$.scrEvent2({
			        data: yearArr,
			        data2: monthArr,
			        evEle: '.qu-birth',
			        title: '出生日期',
			        defValue: start+30,
			        defValue2: 1,
			        linkType: '.',
			        afterAction: function (data1, data2) {

			          $('.qu-birth').html(data1 + '.' + data2);
			        }
			    });
	        });

		});
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
		});
	</script>

	<script type="text/javascript">
		$(function(){
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
		})
		$(window).load(function() {

			$(document).on('change', '#upload-file', function(){
				var reader = new FileReader();
				reader.onload = function(e) {
					options.imgSrc = e.target.result;
					cropper = $('.imageBox').cropbox(options);
				}
				reader.readAsDataURL(this.files[0]);
				// this.files = [];
			})
			$(document).on('click', '#btnCrop', function(){
				var img = cropper.getDataURL();
				console.log(typeof(img));
				console.log(img);
				$('#loadingToast').css({'display':'block', 'opacity':'1'});
				$('#loadingToast p').html('图片保存中');

				$.ajax({
					url: '/front/tsave_headimg',
					type: 'post',
					dataType: 'json',
					data: {
						img: img,
						openid: '{{$openid}}'
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#loadingToast').css({'display':'none', 'opacity':'0'});
							$('#toast').css({'display':'block', 'opacity':'1'});
							setTimeout(function(){
								$('#toast').css({'display':'none', 'opacity':'0'});
								$('#headimg .done_romove')[0].click();
							},1000);

							$('#headimgPhone').attr('src', data.imgurl);
						}
					},
					error: function(data) {
						alert(data);
						alert('dafd');
					}
				});
				// $('#cut').css('display', 'none');
				// $('#cutShow').css('display', 'block');
				// $('#cutShow img').attr('src', img);
				// $('.cropped').html('');
				// $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
				// $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
				// $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
			})
			$(document).on('click', '#btnZoomIn', function(){
				cropper.zoomIn();
			})
			$(document).on('click', '#btnZoomOut', function(){
				cropper.zoomOut();
			})
		});
	</script>
</body>
</html>