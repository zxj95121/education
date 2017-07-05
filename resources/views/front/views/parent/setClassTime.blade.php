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
            <h1 class="title">选择可上课时间</h1>
        </header>
		<div class="content">
			<div class="list-block top" hide="false" style="padding:8px 0;">
			    <ul>
			      	<li class="item-content">
				        <div class="item-inner">
				          	<div class="item-title">由加辰安排</div>
				          	<div class="item-after">
				          		<div class="item-input">
				          			<span class="operateShow">关</span>
					              	<label class="label-switch">
					                	<input type="checkbox" id="checkbox">
					                	<div class="checkbox" id="selectCheckbox"></div>
					              	</label>
					            </div>
				          	</div>
				        </div>
				    </li>
				</ul>
		  	</div>
		  	<div class="content-block-title" hide="true">周一到周五</div>
	  		<div class="list-block" hide="true">
			    <ul>
			    @foreach($classType[0] as $value)
			      	<li class="item-content" cid="{{$value->id}}">
				        <div class="item-inner">
				          	<div class="item-title">{{$value->low}}-{{$value->high}}</div>
				          	<div class="item-after">
				          		<span style="user-select:none;opacity: 0;z-index: -3;">0</span>
				          		<a href="#" class="button button-fill selectBtn">选择</a>
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
				          		<a href="#" class="button button-fill selectBtn">选择</a>
		          			</div>
		        		</div>
		      		</li>
		      	@endforeach
		    	</ul>
		  	</div>
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
	<script type="text/javascript">
		$(function(){
			/*初始化ajax*/
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

			$(document).on('click', '#selectCheckbox', function(){
				var val = $(this).parents('label').find('input:checked').length;
				if (val == 0) {
					/*表示之前是0，现在已打开*/
					$('.operateShow').html('开');
					$('div[hide="true"]').hide();
					$('#toast').find('.weui-toast__content').html('由加辰安排');
					/*ajax进行更改*/
					var status = '1';//''表示

				} else {
					$('.operateShow').html('关');
					$('div[hide="true"]').show();

					var status = '0';
				}

				$.ajax({
					url: '/front/setClassTime/selectType',
					dataType: 'json',
					type: 'post',
					data: {
						status: status
					},
					success: function(data){
						if (data.errcode == 0) {
							if (status == 1) {
								$('#toast').show();
								setTimeout(function(){
									$('#toast').hide();
								}, 850);
							}
						}
					},
					error: function(){
						
					}
				})
			})

			/*选择课程按钮*/
			$(document).on('click', '.selectBtn', function(){
				$('#loadingToast').show();
				var cdom = $(this);
				var id = $(this).parents('li').attr('cid');
				$('#toast').find('.weui-toast__content').html('已设置可上课');
				$.ajax({
					url: '/front/setClassTime/selectTime',
					dataType: 'json',
					type: 'post',
					data: {
						id: id
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#loadingToast').show();
							cdom.replaceWith('<a href="#" class="button button-fill button-danger cancleBtn">取消选择</a>');
							setTimeout(function(){
								$('#toast').hide();
							}, 700);
						}
					},
					error: function() {
						$('#loadingToast').show();
						alert('选择失败,请重试');
					}
				})
			});

			$(document).on('click', '.cancleBtn', function(){
				$('#loadingToast').show();
				var cdom = $(this);
				var id = $(this).parents('li').attr('cid');
				$('#toast').find('.weui-toast__content').html('已取消选择');
				$.ajax({
					url: '/front/setClassTime/cancleTime',
					dataType: 'json',
					type: 'post',
					data: {
						id: id
					},
					success: function(data) {
						if (data.errcode == 0) {
							$('#toast').show();
							cdom.replaceWith('<a href="#" class="button button-fill selectBtn">选择</a>');
							setTimeout(function(){
								$('#toast').hide();
							}, 700);
						}
					},
					error: function() {
						$('#loadingToast').show();
						alert('取消选择失败,请重试');
					}
				})
			});
		})
	</script>
</body>
</html>