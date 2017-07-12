<!DOCTYPE html>
<html>
<head>
	<title>加辰教育</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="/css/sm.min.css">
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<style type="text/css">
		.item-after{
			position: relative;
		}
		.item-after a{
			position: absolute;
			top: 0px;
			right: 2px;
		}
	</style>
</head>
<body>
	<div class="page">
		<header class="bar bar-nav">
			<button class="button button-link button-nav pull-left">
    			<a id="backHome" href="">
    				<span class="icon icon-left"></span>
    				返回
    			</a>
  			</button>
            <h1 class="title">选择可上课时间</h1>
            @if(!$flight->classTimes)
            <button class="button button-link button-nav pull-right" id="setOK">
    			<a href="">
    				提交
    			</a>
  			</button>
  			@else
  				<button class="button button-link button-nav pull-right">
    			<a href="" style="color:red;">
    				已设置
    			</a>
  			</button>
  			@endif
        </header>
		<div class="content">
		    <p style="color: red;padding-left: 12px;">注意：上课时间设置只有一次机会。</p>
			<div class="list-block top" hide="false" style="margin:8px 0;">
			    <ul>
			    	<li class="item-content">
				        <div class="item-inner">
				          	<div class="item-title">请选择每周上课次数</div>
				          	<div class="item-after" style="width: 20%;">
				          		<div class="item-input">
				          			<select id="classTimes">
				          				@php $classTimes = $flight->classTimes; @endphp
						                <option value="1" @if($classTimes == 1) selected="selected" @else @endif>1</option>
						                <option value="2" @if($classTimes == 2) selected="selected" @else @endif>2</option>
						                <option @if($classTimes == 3 || !$classTimes) selected="selected" @else @endif value="3">3</option>
						                <option @if($classTimes == 4) selected="selected" @else @endif value="4">4</option>
						                <option @if($classTimes == 5) selected="selected" @else @endif value="5">5</option>
						                <option @if($classTimes == 6) selected="selected" @else @endif value="6">6</option>
						                <option @if($classTimes == 7) selected="selected" @else @endif value="7">7</option>
						                <option @if($classTimes == 8) selected="selected" @else @endif value="8">8</option>
						                <option @if($classTimes == 9) selected="selected" @else @endif value="9">9</option>
						                <option @if($classTimes == 10) selected="selected" @else @endif value="10">10</option>
						                <option @if($classTimes == 11) selected="selected" @else @endif value="11">11</option>
						                <option @if($classTimes == 12) selected="selected" @else @endif value="12">12</option>
						                <option @if($classTimes == 13) selected="selected" @else @endif value="13">13</option>
						                <option @if($classTimes == 14) selected="selected" @else @endif value="14">14</option>
						                <option @if($classTimes == 15) selected="selected" @else @endif value="15">15</option>
						                <option @if($classTimes == 16) selected="selected" @else @endif value="16">16</option>
						                <option @if($classTimes == 17) selected="selected" @else @endif value="17">17</option>
						                <option @if($classTimes == 18) selected="selected" @else @endif value="18">18</option>
						                <option @if($classTimes == 19) selected="selected" @else @endif value="19">19</option>
						                <option @if($classTimes == 20) selected="selected" @else @endif value="20">20</option>
              						</select>
					            </div>
				          	</div>
				        </div>
				    </li>
			      	<li class="item-content">
				        <div class="item-inner">
				          	<div class="item-title">是否由加辰安排</div>
				          	<div class="item-after">
				          		<div class="item-input">
				          			<span class="operateShow">@if($flight->prefer_type == 1) 是 @else 否 @endif</span>
					              	<label class="label-switch">
					                	<input type="checkbox" id="checkbox" @if($flight->prefer_type == 1) checked="checked" @else @endif>
					                	<div class="checkbox" id="selectCheckbox"></div>
					              	</label>
					            </div>
				          	</div>
				        </div>
				    </li>
				</ul>
		  	</div>
		  	<div class="content-block-title" hide="true">下午放学后（寒暑假代表全天可用）</div>
	  		<div class="list-block" hide="true">
			    <ul>
			      	<li class="item-content li-select" choose="1">
				        <div class="item-inner">
				          	<div class="item-title">周一</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('1', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="2">
				        <div class="item-inner">
				          	<div class="item-title">周二</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('2', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="3">
				        <div class="item-inner">
				          	<div class="item-title">周三</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('3', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="4">
				        <div class="item-inner">
				          	<div class="item-title">周四</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('4', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="5">
				        <div class="item-inner">
				          	<div class="item-title">周五</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('5', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				</ul>
		  	</div>
		  	<div class="content-block-title" hide="true">周末/节假日</div>
	  		<div class="list-block" hide="true">
			    <ul>
			      	<li class="item-content li-select" choose="6">
				        <div class="item-inner">
				          	<div class="item-title">周六上午</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('6', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="7">
				        <div class="item-inner">
				          	<div class="item-title">周六下午</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('7', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="8">
				        <div class="item-inner">
				          	<div class="item-title">周日上午</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('8', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				    <li class="item-content li-select" choose="9">
				        <div class="item-inner">
				          	<div class="item-title">周日下午</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array('9', $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				</ul>
		  	</div>
		  	<!-- <div class="content-block-title" hide="true">周一到周五</div>
	  		<div class="list-block" hide="true">
			    <ul>
			    @foreach($classType[0] as $value)
			      	<li class="item-content" cid="{{$value->id}}">
				        <div class="item-inner">
				          	<div class="item-title">{{$value->low}}-{{$value->high}}</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array($value->id, $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
				          	</div>
				        </div>
				    </li>
				@endforeach
				</ul>
		  	</div>
		  	<div class="content-block-title" hide="true">周末-节假日</div>
		  	<div class="list-block" hide="true">
		    	<ul>
		    	@foreach($classType[1] as $value)
		      		<li class="item-content" cid="{{$value->id}}">
		        		<div class="item-inner">
		          			<div class="item-title">{{$value->low}}-{{$value->high}}</div>
		          			<div class="item-after">
		          				<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		@if(in_array($value->id, $userClass))
				          			<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>
				          		@else
				          			<a href="#" class="button button-fill selectBtn">选择</a>
				          		@endif
		          			</div>
		        		</div>
		      		</li>
		      	@endforeach
		    	</ul>
		  	</div> -->
		</div>
	</div>

	<div id="toast" style="opacity: 1; display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content">已完成</p>
        </div>
    </div>

    <div id="loadingToast" style="opacity: 1; display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">正在选择中</p>
        </div>
    </div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/js/zepto.min.js"></script>
	<script type="text/javascript" src="/js/sm.min.js"></script>
	<script type="text/javascript" src="/js/layui/layer_only/mobile/layer.js"></script>
	<script type="text/javascript">
		$(function(){
			/*初始化ajax*/
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

			var url = new Array();
            url = window.location.href.split('#');
    		if(url.length == 1){
    			var back = '/front/home#my';
    		}else{
    			var back = '/front/home#'+url[1];
    		}
    		$('#backHome').attr('href', back);

            @if($flight->prefer_type == 1)
            	$('div[hide="true"]').hide();
            @else 
            @endif

			$(document).on('click', '#selectCheckbox', function(){
				var val = $(this).parents('label').find('input:checked').length;
				if (val == 0) {
					/*表示之前是0，现在已打开*/
					$('.operateShow').html('是');
					$('div[hide="true"]').hide();
					$('#toast').find('.weui-toast__content').html('由加辰安排');
					/*ajax进行更改*/
					var status = '1';//''表示

				} else {
					$('.operateShow').html('否');
					$('div[hide="true"]').show();

					var status = '0';
				}

				// $.ajax({
				// 	url: '/front/setClassTime/selectType',
				// 	dataType: 'json',
				// 	type: 'post',
				// 	data: {
				// 		status: status
				// 	},
				// 	success: function(data){
				// 		if (data.errcode == 0) {
				// 			if (status == 1) {
								$('#toast').show();
								setTimeout(function(){
									$('#toast').hide();
								}, 850);
				// 			}
				// 		}
				// 	},
				// 	error: function(){
						
				// 	}
				// })
			})

			/*选择课程按钮*/
			// $(document).on('click', '.selectBtn', function(){
			// 	$('#loadingToast').show();
			// 	var cdom = $(this);
			// 	var id = $(this).parents('li').attr('choose');
			// 	$('#toast').find('.weui-toast__content').html('已设置可上课');
			// 	$.ajax({
			// 		url: '/front/setClassTime/selectTime',
			// 		dataType: 'json',
			// 		type: 'post',
			// 		data: {
			// 			id: id
			// 		},
			// 		success: function(data) {
			// 			if (data.errcode == 0) {
			// 				$('#loadingToast').hide();
			// 				$('#toast').show();
			// 				cdom.replaceWith('<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>');
			// 				setTimeout(function(){
			// 					$('#toast').hide();
			// 				}, 700);
			// 			}
			// 		},
			// 		error: function() {
			// 			$('#loadingToast').hide();
			// 			alert('选择失败,请重试');
			// 		}
			// 	})
			// });

			$(document).on('click', '.selectBtn', function(){
				// $('#loadingToast').show();
				var cdom = $(this);
				// var id = $(this).parents('li').attr('choose');
				$('#toast').find('.weui-toast__content').html('已设置可上课');
				// $.ajax({
				// 	url: '/front/setClassTime/selectTime',
				// 	dataType: 'json',
				// 	type: 'post',
				// 	data: {
				// 		id: id
				// 	},
				// 	success: function(data) {
				// 		if (data.errcode == 0) {
							// $('#loadingToast').hide();
							$('#toast').show();
							cdom.replaceWith('<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>');
							setTimeout(function(){
								$('#toast').hide();
							}, 700);
				// 		}
				// 	},
				// 	error: function() {
				// 		$('#loadingToast').hide();
				// 		alert('选择失败,请重试');
				// 	}
				// })
			});

			// $(document).on('click', '.cancleBtn', function(){
			// 	$('#loadingToast').show();
			// 	var cdom = $(this);
			// 	var id = $(this).parents('li').attr('cid');
			// 	$('#toast').find('.weui-toast__content').html('已取消选择');
			// 	$.ajax({
			// 		url: '/front/setClassTime/cancleTime',
			// 		dataType: 'json',
			// 		type: 'post',
			// 		data: {
			// 			id: id
			// 		},
			// 		success: function(data) {
			// 			if (data.errcode == 0) {
			// 				$('#loadingToast').hide();
			// 				$('#toast').show();
			// 				cdom.replaceWith('<a href="#" class="button button-fill selectBtn">选择</a>');
			// 				setTimeout(function(){
			// 					$('#toast').hide();
			// 				}, 700);
			// 			}
			// 		},
			// 		error: function() {
			// 			$('#loadingToast').hide();
			// 			alert('取消选择失败,请重试');
			// 		}
			// 	})
			// });

			$(document).on('click', '.cancleBtn', function(){
				// $('#loadingToast').show();
				var cdom = $(this);
				// var id = $(this).parents('li').attr('cid');
				$('#toast').find('.weui-toast__content').html('已取消选择');
				// $.ajax({
				// 	url: '/front/setClassTime/cancleTime',
				// 	dataType: 'json',
				// 	type: 'post',
				// 	data: {
				// 		id: id
				// 	},
				// 	success: function(data) {
				// 		if (data.errcode == 0) {
				// 			$('#loadingToast').hide();
							$('#toast').show();
							cdom.replaceWith('<a href="#" class="button button-fill selectBtn">选择</a>');
							setTimeout(function(){
								$('#toast').hide();
							}, 700);
				// 		}
				// 	},
				// 	error: function() {
				// 		$('#loadingToast').hide();
				// 		alert('取消选择失败,请重试');
				// 	}
				// })
			});

			$('#setOK').click(function(){
				var classTimes = $('#classTimes option:selected').val();
				var min = Math.ceil(classTimes/2);

				var select = new Array();
				var len = 0;
				$('.li-select').each(function(){
					var choose = $(this).attr('choose');
					if($(this).find('.button-danger').length > 0)
						select[len++] = choose;
				})

				if ($('.content-block-title').css('display') == 'none') {
					var is_order = 1;
				}
				else{
					var is_order = 0;
					if (len < min) {
						layer.open({
						    content: '每周上'+classTimes+'节课所选时间不能低于'+min+'个'
						    ,skin: 'msg'
						    ,time: 2 //2秒后自动关闭
						 });
		        		return false;
					}
				}
				$('#loadingToast').show();
				$('#toast').find('.weui-toast__content').html('提交成功');
				$.ajax({
					url: '/front/setClassTime/setAll',
					dataType: 'json',
					type: 'post',
					data: {
						classTimes: classTimes,
						is_order: is_order,
						select: select
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#loadingToast').hide();
							$('#toast').show();
							setTimeout(function(){
								$('#toast').hide();
							}, 700);
							window.location.href = $('#backHome').attr('href');
						}
					},
					error: function() {
						$('#loadingToast').hide();
						alert('设置失败,请重试');
					}
				})

			})
		})
	</script>
</body>
</html>