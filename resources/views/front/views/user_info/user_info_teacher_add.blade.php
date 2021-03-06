<?php
require_once $_SERVER['DOCUMENT_ROOT']."/php/jssdk/jssdk.php";
$jssdk = new JSSDK(getenv('APPID'), getenv('APPSECRET'));
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" href="/js/cutimage/css/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/js/weui/weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/front/css_module/picker.css">
	<!-- <link rel="stylesheet" type="text/css" href="/js/weui/example.css"> -->
	<style type="text/css">
		.page_set{
			width: 100%;
			position: absolute;
			z-index: 2;
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

		.communityActive{
			background: #64C9F7;
			color: #FFF;
		}
		#page_main a:link{
			text-decoration: none;
		}
		#page_main a:visited{
			text-decoration: none;
		}
		#page_main a:hover{
			text-decoration: none;
		}
		#page_main a:active{
			text-decoration: none;
		}
		.cTwo,.cOne,.cThree{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="container" style="max-width: 500px;margin:0 auto;padding: 0px;position: relative;">
		<div class="page__bd" id="page_main">
			<div class="weui-cells" style="margin-top:0px" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
		            <div onclick="window.location.href='/front/home/oauth'"><div class="glyphicon glyphicon-menu-left"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">个人信息</div></div>
		            <!-- <div><div class="placeholder">提交</div></div> -->
		        </div>
	            <div class="weui-cell weui-cell_access" target="headimg" onclick="sorry();">
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
	                <div class="weui-cell__bd">出生年月</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;" class="qu-birth">
	                    	@php
	                    		if (!$userDetail->birth) {
	                    			echo '';
	                    		} else {
	                    			$birthArr = explode('-', $userDetail->birth);
	                    			echo $birthArr[0].'年 '.$birthArr[1].'月';
	                    		}
	                    	@endphp
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="teachYearPicker">
	                <div class="weui-cell__bd">@if($userDetail->type == 1) 入学年份 @else 教书年份 @endif</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;" class="qu-teachYear">
	                    	@if($userDetail->teachYear)
	                    		{{$userDetail->teachYear}} 年
	                    	@else
	                    	@endif
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info" target="school">
	                <div class="weui-cell__bd">所在学校</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">@if($schoolObj) {{$schoolObj->name}} @else @endif</span>
	                </div>
	            </div>
	            @if($userDetail->type == 1)
	            <div class="weui-cell weui-cell_access row_info input_info" target="project">
	                <div class="weui-cell__bd">所学专业</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">{{$userDetail->project}}</span>
	                </div>
	            </div>
	            @else
	            @endif
	            <div class="weui-cell weui-cell_access" id="cell_status">
	                <div class="weui-cell__bd">求职状态</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">
							@if($userDetail->find_status == 0) 暂不考虑
	                    	@elseif ($userDetail->find_status == 1) 兼职
	                    	@elseif ($userDetail->find_status == 2) 全职
	                    	@endif
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="moneyPicker">
	                <div class="weui-cell__bd">期望薪资</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">
	                    	@if($userDetail->find_status == 0) 
	                    	@elseif ($userDetail->find_status == 1) 
	                    		@php
		                    		$qwxz = str_replace('-', ' 元 /', $userDetail->money).'分钟';
		                    		echo $qwxz;
		                    	@endphp
	                    	@elseif ($userDetail->find_status == 2)
	                    		@php
	                    			$qwxz = explode('-', $userDetail->money)[0].'元 / 月';
	                    			echo $qwxz;
	                    		@endphp
	                    	@endif
	                    </span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info" target="community">
	                <div class="weui-cell__bd">期望教学社区</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">{{$addressStr}}</span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access row_info" target="hobby">
	                <div class="weui-cell__bd">我的爱好特长</div>
	                <div class="weui-cell__ft" style="font-size: 0;">
	                    <span style="vertical-align:middle; font-size: 17px;">{{$hobbyData}}</span>
	                </div>
	            </div>
	            <!-- <div class="weui-cell weui-cell_access">
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
	            </div> -->
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

		    <!-- 性别 -->
			<div id="status" style="display: none;">
		        <div class="weui-mask" id="iosMask" style="opacity: 1;"></div>
		        <div class="weui-actionsheet weui-actionsheet_toggle" id="iosActionsheet">
		            <div class="weui-actionsheet__title">
		                <p class="weui-actionsheet__title-text">选择求职状态</p>
		            </div>
		            <div class="weui-actionsheet__menu">
		                <div class="weui-actionsheet__cell status_actionsheet" val="1">兼职</div>
		                <div class="weui-actionsheet__cell status_actionsheet" val="2">全职</div>
		                <div class="weui-actionsheet__cell status_actionsheet" val="0">暂不考虑</div>
		            </div>
		            <div class="weui-actionsheet__action">
		                <div class="weui-actionsheet__cell" id="iosActionsheetCancel2">取消</div>
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
			    <div style="width: 97%;margin: 0 auto;padding:0px 4px;" id="school_btns">
			    	@foreach($schoolInfo as $value)
			    	<div class="row">
			    		<div class="col-xs-12" style="margin-top: 5px;">
                            <div class="heading" id1="{{$value['id1']}}"> 
                                <h4 style="margin-bottom: 0px;">{{$value['name1']}}</h4> 
                            </div>
                            <div class="pbody">
                            	@foreach($value['two'] as $v)
                                <button type="button" @if($userDetail->school == $v['id2']) class="btn btn-success" @else class="btn btn-info" @endif id2="{{$v['id2']}}">{{$v['name2']}}</button>
                                @endforeach
                            </div> 
                        </div>
			    	</div>
			    	@endforeach
			    	<br>
			    	<p style="text-decoration: underline;" id="noSchool">没有找到学校，点我联系管理员。</p>
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
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">期望教学社区(多选)</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok"></div></div>
			        </div>
			    </div>
			    <div class="row" style="width: 100%;height: 100%;margin: 0 auto;">
			    	<div class="col-xs-3 col">
			    	</div>	
			    	<div class="col-xs-4 col">
			    	</div>
			    	<div class="col-xs-5 col">
			    	</div>
			    </div>
			</div>

			<!-- 特长爱好 -->
		    <div class="page__bd page_set" id="hobby">
				<div class="weui-cells" style="margin-top:0px" >
		            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#fff;">
			            <div><div class="placeholder glyphicon glyphicon-remove done_romove"></div></div>
			            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">爱好特长</div></div>
			            <div><div class="placeholder glyphicon glyphicon-ok done_ok"></div></div>
			        </div>
			    </div>
			    <div style="width: 97%;margin: 0 auto;padding:0px 4px;" id="hobby_btns">
			    	@foreach($typeArr as $key => $value)
			    	<div class="row">
			    		<div class="col-xs-12" style="margin-top: 5px;">
                            <div class="heading"> 
                                <h4 style="margin-bottom: 0px;">{{$key}}</h4> 
                            </div>
                            <div class="pbody">
                            	@foreach($value as $v)
                            		@php if(strpos($userDetail->hobby, $v['id'].'') !== false) 
                                		echo '<button type="button" class="btn btn-success" cid="'.$v['id'].'">'.$v['name'].'</button>';
                                		else
                                		echo '<button type="button" class="btn btn-info" cid="'.$v['id'].'">'.$v['name'].'</button>';
                                	@endphp
                                @endforeach
                            </div> 
                        </div>
			    	</div>
			    	@endforeach
			    	<br>
			    	<p style="text-decoration: underline;" id="noHobby">没有找到特长，点我联系管理员。</p>
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

    <!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      		</div>
		      	<div class="modal-body">
		        	...
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-primary">Save changes</button>
		      	</div>
		    </div>
	  	</div>
	</div>

    <div id="birthPicker" class="zxjPicker">
    	<div class="operatePicker">
    		<div class="canclePicker">取消</div>
    		<div class="okPicker">确认</div>
    	</div>
    	<div class="contentPicker">
    		<div class="linePicker"></div>
    		<div class="linePicker"></div>
    	</div>
    </div>

    <div id="myMoneyPicker" class="zxjPicker">
    	<div class="operatePicker">
    		<div class="canclePicker">取消</div>
    		<div class="okPicker">确认</div>
    	</div>
    	<div class="contentPicker">
    		<div class="linePicker"></div>
    		<div class="linePicker"></div>
    	</div>
    </div>

    <div id="teachPicker" class="zxjPicker">
    	<div class="operatePicker">
    		<div class="canclePicker">取消</div>
    		<div class="okPicker">确认</div>
    	</div>
    	<div class="contentPicker">
    		<div class="linePicker"></div>
    		<div class="linePicker"></div>
    	</div>
    </div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/js/cutimage/js/cropbox.js"></script>
	<script type="text/javascript" src="/js/weui/zepto.min.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
	<script type="text/javascript" src="/js/weui/example.js"></script>
	<script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
	<script type="text/javascript" src="/front/js_module/picker.js"></script>
	<script type="text/javascript">
		$(function(){
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
		})

		function removeActive(cdom){
			cdom.parent().find('div').each(function(){
				$(this).removeClass('communityActive');
			})
		}
		$(function(){
			/*期望社区部分*/
			communityInfo = new Array();
	        $.ajax({
	        	url: '/front/getCommunity',
	        	type: 'post',
	        	dataType: 'json',
	        	data: {

	        	},
	        	success: function(data) {
	        		communityInfo = data['communityInfo'];
	        		addressCommunity = data['address'];
	        		if(!addressCommunity)
	        			addressCommunity = new Array();
	        		console.log(communityInfo);
	        		console.log(addressCommunity);

	        		for (var i in communityInfo) {
	        			$('#community .col:eq(0)').append('<div class="row row_community cOne" number="'+i+'" cid = "'+communityInfo[i].id+'">'+communityInfo[i].name+'</div>');
	        		}
	        	}
	        })

	        $(document).on('click', '.cOne', function(){
	        	var number = $(this).attr('number');
	        	removeActive($(this));
	        	$(this).addClass('communityActive');
	        	$('#community .col:eq(0)').attr('num', number);

	        	$('#community .col:eq(1)').html('');
	        	$('#community .col:eq(2)').html('');

	        	for (var i in communityInfo[number]['next']) {
	        		$('#community .col:eq(1)').append('<div class="row row_community cTwo" number="'+i+'" cid = "'+communityInfo[number]['next'][i].id+'">'+communityInfo[number]['next'][i].name+'</div>');
	        	}
	        })

	        $(document).on('click', '.cTwo', function(){
	        	var num = $('#community .col:eq(0)').attr('num');
	        	var number = $(this).attr('number');
	        	removeActive($(this));
	        	$(this).addClass('communityActive');
	        	$('#community .col:eq(1)').attr('num', number);

	        	$('#community .col:eq(2)').html('');

	        	for (var i in communityInfo[num]['next'][number]['next']){
	        		$('#community .col:eq(2)').append('<div class="row row_community cThree" number="'+i+'" cid = "'+communityInfo[num]['next'][number]['next'][i].id+'">'+communityInfo[num]['next'][number]['next'][i].name+'</div>');
	        		
	        		if (addressCommunity[communityInfo[num]['next'][number]['next'][i].id]) {
	        			$('#community .col:eq(2)').find('.cThree:last').addClass('communityActive');
	        		}
	        	}
	        })

	        $(document).on('click', '.cThree', function(){
	        	var cdom = $(this);

        		if ($(this).hasClass('communityActive')) {
        			// addressCommunity[cdom.attr('cid')] = false;
        			delete(addressCommunity[cdom.attr('cid')]);
        			cdom.removeClass('communityActive');
        		} else {
        			addressCommunity[cdom.attr('cid')] = cdom.attr('cid');
        			cdom.addClass('communityActive');
        		}
	        })

		})

		$(function(){
			find_status = {{$userDetail->find_status}};
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
			/*求职状态*/
			$('#cell_status').click(function(){
				$('#page_row').css('display', 'block');
				$('#status').css('display', 'block');
			})

			$('#iosActionsheetCancel').click(function(){
				$('#page_row').css('display', 'none');
				$('#sex').css('display', 'none');
			})
			$('#iosActionsheetCancel2').click(function(){
				$('#page_row').css('display', 'none');
				$('#status').css('display', 'none');
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

			/*求职状态*/
			$('.status_actionsheet').click(function(){
				var status = $(this).html();
				var val = $(this).attr('val');
				$('#loadingToast').css({'display':'block', 'opacity':'1'});
				$('#loadingToast p').html('数据保存中');
				$.ajax({
					url: '/front/tsave_status',
					type: 'post',
					dataType: 'json',
					data: {
						status: val
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#cell_status').find('span').html(status);
							$('#page_row').css('display', 'none');
							$('#status').css('display', 'none');

							$('#loadingToast').css({'display':'none', 'opacity':'0'});
		    				$('#toast p').html('修改成功');
							$('#toast').css({'display':'block', 'opacity':'1'});
							setTimeout(function(){
								$('#toast').css({'display':'none', 'opacity':'0'});
							},1000);
							$('#moneyPicker span').html('');/*清空*/

							if (val == 0) {
								$('#moneyPicker').css('display', 'none');
							} else if(val == 1) {
								$('#moneyPicker').css('display', 'flex');
								$('#moneyPicker').find('div:eq(0)').html('期望薪资');

								var monthArr = new Array();
								for(var i = 50,j = 0;i <= 300;j++) {
									monthArr[j] = new Object();
									monthArr[j].name = i+'元',
									monthArr[j].value = i;
									i += 10;
								}
							    selfPicker.start({
							    	id: 'myMoneyPicker', 
							    	action: 'moneyPicker',
							    	content: [
										monthArr,	 [{
								            name: '60分钟',
								            value: 60
								        }, {
								            name: '90分钟',
								            value: 90
								        }]
							    	],
							    	len: 1,
							    	select: function(result){
							    		$('#loadingToast').css({'display':'block', 'opacity':'1'});
										$('#loadingToast p').html('数据保存中');

							    		var message = result[0]+'-'+result[1];
							    		$.ajax({
							    			url: '/front/tsave_money',
							    			type: 'post',
							    			dataType: 'json',
							    			data: {
							    				value: message
							    			},
							    			success: function(data) {
							    				if (data.errcode == 0) {
								    				$('#loadingToast').css({'display':'none', 'opacity':'0'});
								    				$('#toast p').html('修改成功');
													$('#toast').css({'display':'block', 'opacity':'1'});
													$('#moneyPicker span').html(result[0] + '元 / ' + result[1] +'分钟');
													setTimeout(function(){
														$('#toast').css({'display':'none', 'opacity':'0'});
													},250);
								    			}
							    			}
							    		})
							    	}
							    });
							} else {
								$('#moneyPicker').css('display', 'flex');
								$('#moneyPicker').find('div:eq(0)').html('期望月薪');

								var monthArr = new Array();
								for(var i = 1500,j = 0;i <= 5000;j++) {
									monthArr[j] = new Object();
									monthArr[j].name = i+'元',
									monthArr[j].value = i;
									i += 100;
								}
							    selfPicker.start({
							    	id: 'myMoneyPicker', 
							    	action: 'moneyPicker',
							    	content: [
										monthArr
							    	],
							    	len: 1,
							    	select: function(result){
							    		$('#loadingToast').css({'display':'block', 'opacity':'1'});
										$('#loadingToast p').html('数据保存中');

										var message = result[0]+'-'+'1';
							    		$.ajax({
							    			url: '/front/tsave_money',
							    			type: 'post',
							    			dataType: 'json',
							    			data: {
							    				value: message
							    			},
							    			success: function(data) {
							    				if (data.errcode == 0) {
								    				$('#loadingToast').css({'display':'none', 'opacity':'0'});
								    				$('#toast p').html('修改成功');
													$('#toast').css({'display':'block', 'opacity':'1'});
													$('#moneyPicker span').html(result[0] + '元 / ' +'月');
													setTimeout(function(){
														$('#toast').css({'display':'none', 'opacity':'0'});
													},250);
								    			}
							    			}
							    		});
							    	}
							    });
							}

						}
					}

				})
			})


			/*初始化picker薪资*/
			@if($userDetail->type == 1)
			var monthArr = new Array(); for(var i = 50,j = 0;i <= 300;j++) {monthArr[j] = new Object(); monthArr[j].name = i+'元', monthArr[j].value = i; i += 10; } selfPicker.start({id: 'myMoneyPicker', action: 'moneyPicker', content: [monthArr,	 [{name: '60分钟', value: 60 }, {name: '90分钟', value: 90 }] ], default: [@if($money) {{$money[0]}} @endif,@if($money) {{$money[1]}} @endif ], select: function(result){ $('#loadingToast').css({'display':'block', 'opacity':'1'}); $('#loadingToast p').html('数据保存中'); var message = result[0]+'-'+result[1]; $.ajax({url: '/front/tsave_money', type: 'post', dataType: 'json', data: {value: message }, success: function(data) {if (data.errcode == 0) {$('#loadingToast').css({'display':'none', 'opacity':'0'}); $('#toast p').html('修改成功'); $('#toast').css({'display':'block', 'opacity':'1'}); $('#moneyPicker span').html(result[0] + '元 / ' + result[1] +'分钟'); setTimeout(function(){$('#toast').css({'display':'none', 'opacity':'0'}); },250); } } }) } });
			@elseif($userDetail->type == 2)
				$('#moneyPicker').css('display', 'flex');$('#moneyPicker').find('div:eq(0)').html('期望月薪'); var monthArr = new Array(); for(var i = 1500,j = 0;i <= 5000;j++) {monthArr[j] = new Object(); monthArr[j].name = i+'元', monthArr[j].value = i; i += 100; } selfPicker.start({id: 'myMoneyPicker', action: 'moneyPicker', content: [monthArr ], default: [@if($money) {{$money[0]}} @endif ], select: function(result){ $('#loadingToast').css({'display':'block', 'opacity':'1'}); $('#loadingToast p').html('数据保存中'); var message = result[0]+'-'+'1'; $.ajax({url: '/front/tsave_money', type: 'post', dataType: 'json', data: {value: message }, success: function(data) {if (data.errcode == 0) {$('#loadingToast').css({'display':'none', 'opacity':'0'}); $('#toast p').html('修改成功'); $('#toast').css({'display':'block', 'opacity':'1'}); $('#moneyPicker span').html(result[0] + '元 / ' +'月'); setTimeout(function(){$('#toast').css({'display':'none', 'opacity':'0'}); },250); } } }); } });
			@else
			@endif

			/*出生年月*/
		    /*所在学校*/
		    $('#school_btns button').click(function(){
		    	$('#school_btns button[class="btn btn-success"]').removeClass('btn-success').addClass('btn-info');
		    	// var index = $(this).index('#school_btns button');
		    	$(this).removeClass('btn-info').addClass('btn-success');
		    })

		    /*爱好特长*/
		    $('#hobby_btns button').click(function(){
		    	if ($(this).hasClass('btn-success')) {
		    		$(this).removeClass('btn-success').addClass('btn-info');
		    	} else {
		    		$(this).removeClass('btn-info').addClass('btn-success');
		    	}
		    })

		    $('#school .done_ok').click(function(){
		    	var schoolDom = $('#school_btns button[class="btn btn-success"]');
		    	var value = schoolDom.html();
		    	var id2 = schoolDom.attr('id2');
		    	var id1 = schoolDom.parents('.pbody').prev().attr('id1');
		    	var cdom = $(this);
		    	if (!value) {
		    		return false;
		    	} else {
		    		$.ajax({
		    			url: '/front/tsave_school',
		    			dataType: 'json',
		    			type: 'post',
		    			data: {
		    				id2: id2
		    			},
		    			success: function(data) {
		    				if (data.errcode == 0) {
		    					$('div[target="school"]').find('span').html(value);
					    		$('#page_main').css('display', 'block');
								cdom.parents('.page_set').animate({'top': height+'px'}, 250);
								setTimeout(function(){
									$('#page_row').css('display', 'none');
								}, 250);
		    				}
		    			}
		    		})
		    	}
		    })

		    /*爱好特长点OK*/
		    $('#hobby .done_ok').click(function(){
		    	var hobby = '';
		    	$('#hobby button').filter('.btn-success').each(function(){
		    		hobby += $(this).attr('cid')+'-';
		    	})

		    	if (hobby != '') {
		    		hobby = hobby.substring(0,hobby.length-1);
		    	}

		    	var cdom = $(this);

		    	$.ajax({
	    			url: '/front/tsave_hobby',
	    			dataType: 'json',
	    			type: 'post',
	    			data: {
	    				hobby: hobby
	    			},
	    			success: function(data) {
	    				if (data.errcode == 0) {
	    					$('div[target="hobby"]').find('span').html(data.html);
				    		$('#page_main').css('display', 'block');
							cdom.parents('.page_set').animate({'top': height+'px'}, 250);
							setTimeout(function(){
								$('#page_row').css('display', 'none');
							}, 250);
	    				}
	    			}
	    		})
		    })

		    /*期望社区点击OK*/
		    $('#community .done_ok').click(function(){
		    	var len = Object.keys(addressCommunity).length;
	        	if (len < 1) {
	        		layer.open({
					    content: '期望社区个数不能为0'
					    ,skin: 'msg'
					    ,time: 2 //2秒后自动关闭
					});
	        		return false;
	        	}
	        	var cdom = $(this);
				$.ajax({
	    			url: '/front/tsave_community',
	    			dataType: 'json',
	    			type: 'post',
	    			data: {
	    				address: addressCommunity
	    			},
	    			success: function(data) {
	    				if (data.errcode == 0) {
	    					if (len > 1)
	    						$('div[target="community"]').find('span').html(data.html.name+'等');
	    					else
	    						$('div[target="community"]').find('span').html(data.html.name);
				    		$('#page_main').css('display', 'block');
							cdom.parents('.page_set').animate({'top': height+'px'}, 250);
							setTimeout(function(){
								$('#page_row').css('display', 'none');
							}, 250);
	    				}
	    			}
	    		})
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
			var yearArr = new Array();
			var end = new Date().getFullYear();
			for (var i = end-60,j = 0;i <= end;i++,j++) {
				yearArr[j] = new Object();
				yearArr[j].name = i+'年',
				yearArr[j].value = i;
			}

			var monthArr = new Array();
			for(var i = 1;i <= 12;i++) {
				monthArr[i-1] = new Object();
				monthArr[i-1].name = i+'月';
				monthArr[i-1].value = i;
			}

			selfPicker.start({
		    	id: 'birthPicker', 
		    	action: 'showDatePicker',
		    	content: [
		    		yearArr,monthArr
		    	],
		    	@if($birthTime)
		    	default: [
		    		{{$birthTime[0]}},{{$birthTime[1]}}
		    	],
				@else 
				@endif
		    	select: function(result){
		    		$('#loadingToast').css({'display':'block', 'opacity':'1'});
					$('#loadingToast p').html('数据保存中');

		    		var month = result[1] > 9 ? result[1] : '0'+result[1];
		    		var message = result[0]+'-'+month;
		    		$.ajax({
		    			url: '/front/tsave_birth',
		    			type: 'post',
		    			dataType: 'json',
		    			data: {
		    				birth: message
		    			},
		    			success: function(data) {
		    				if (data.errcode == 0) {
			    				$('#loadingToast').css({'display':'none', 'opacity':'0'});
			    				$('#toast p').html('修改成功');
								$('#toast').css({'display':'block', 'opacity':'1'});
								$('#showDatePicker span').html(result[0] + '年 ' + month +'月');
								setTimeout(function(){
									$('#toast').css({'display':'none', 'opacity':'0'});
								},250);
			    			}
		    			}
		    		})
					/*select结束*/
		    	}
		    });

		    /*如果不找工作，薪资隐藏*/
		    @if($userDetail->find_status == 0)
		    $('#moneyPicker').css('display', 'none');
		    @endif


		    /*学校添加新内容*/
		    $('#noSchool').click(function(){
		    	window.openIndex = layer.open({
				    type: 1
				    ,content: '<div class="weui-cells__title">学校申请</div><div class="weui-cells weui-cells_form"> <div class="weui-cell"> <div class="weui-cell__hd"><label class="weui-label">学校名称</label></div> <div class="weui-cell__bd"> <input class="weui-input" id="input_newSchool" type="text" placeholder="请输入您的学校"> </div> </div> <div class="weui-btn-area"> <a class="weui-btn weui-btn_primary" href="javascript:" id="addSchool" onclick="addSchoolFunc();">提交</a> </div>'
				    ,anim: 'up'
				    ,style: 'position:fixed; top:26%; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
				});
		    })

		    /*特长添加新内容*/
		    $('#noHobby').click(function(){
		    	window.openIndex = layer.open({
				    type: 1
				    ,content: '<div class="weui-cells__title">特长申请</div><div class="weui-cells weui-cells_form"> <div class="weui-cell"> <div class="weui-cell__hd"><label class="weui-label">特长名称</label></div> <div class="weui-cell__bd"> <input class="weui-input" id="input_newHobby" type="text" placeholder="请输入您的特长"> </div> </div> <div class="weui-btn-area"> <a class="weui-btn weui-btn_primary" href="javascript:" id="addHobby" onclick="addHobbyFunc();">提交</a> </div>'
				    ,anim: 'up'
				    ,style: 'position:fixed; top:26%; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
				});
		    })


		    /*teachYear*/
		    @if($userDetail->type == 1)
		    	var yearCha = 3;
		    @else
		    	var yearCha = 49;
		    @endif

		    var yearArr = new Array();
			var end = new Date().getFullYear();
			for (var i = end,j = 0;i >= end-yearCha;i--,j++) {
				yearArr[j] = new Object();
				yearArr[j].name = i+'年',
				yearArr[j].value = i;
			}

			@if($userDetail->teachYear != '')
		    	end = {{$userDetail->teachYear}};
		    @else
		    @endif

			selfPicker.start({
		    	id: 'teachPicker', 
		    	action: 'teachYearPicker',
		    	content: [
		    		yearArr
		    	],
		    	default: [
		    		end
		    	],
		    	select: function(result){
		    		$('#loadingToast').css({'display':'block', 'opacity':'1'});
					$('#loadingToast p').html('数据保存中');

		    		var message = result[0];
		    		$.ajax({
		    			url: '/front/tsave_teachYear',
		    			type: 'post',
		    			dataType: 'json',
		    			data: {
		    				year: message
		    			},
		    			success: function(data) {
		    				if (data.errcode == 0) {
			    				$('#loadingToast').css({'display':'none', 'opacity':'0'});
			    				$('#toast p').html('修改成功');
								$('#toast').css({'display':'block', 'opacity':'1'});
								$('#teachYearPicker span').html(result[0] + ' 年');
								setTimeout(function(){
									$('#toast').css({'display':'none', 'opacity':'0'});
								},250);
			    			}
		    			}
		    		})
					/*select结束*/
		    	}
		    });
		});

		function addSchoolFunc(){
			var name = $('#input_newSchool').val();
			$.ajax({
				url: '/front/addNewSchool',
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

	<script type="text/javascript">
		function sorry(){
			layer.open({
			    content: '暂不支持修改头像'
			    ,skin: 'msg'
			    ,time: 2 //2秒后自动关闭
			 });
		}
	</script>
</body>
</html>