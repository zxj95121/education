<!DOCTYPE html>
<html>
<head>
	<title>请选择您的身份</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/js/weui/weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css" />
	<style type="text/css">
		a:hover{
			text-decoration: none;
			color: #FFF;
		}
	</style>
</head>
<body>
	<div class="container" style="width:95%;max-width: 500px;margin:0 auto;padding: 0px;position: relative;text-align: center;">
		<a href="javascript:;" class="weui-btn weui-btn-mini weui-btn_default" type="1">大学生教师</a>
		<a type="2" href="javascript:;" class="weui-btn weui-btn-mini weui-btn_default">职业教师</a>
		
		<br>
		<a href="javascript:;" id="confirm" class="weui-btn weui-btn_primary">确认身份</a>
	</div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.weui-btn-mini').click(function(){
				var index = $(this).index();
				if(index == 1){
					$(this).prev().removeClass('weui-btn_primary').addClass('weui-btn_default');
				} else {
					$(this).next().removeClass('weui-btn_primary').addClass('weui-btn_default');
				}

				$(this).removeClass('weui-btn_default').addClass('weui-btn_primary');
			});

			$('#confirm').click(function(){
				if ($('.weui-btn_default').length == 1) {
					var type = $('.container .weui-btn_primary:eq(0)').attr('type');
					window.location.href = '/front/selectTeacherType?type='+type;
				}
			})
		})
	</script>
</body>
</html>