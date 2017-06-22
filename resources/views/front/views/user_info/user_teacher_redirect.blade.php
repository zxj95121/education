<!DOCTYPE html>
<html>
<head>
	<title>请选择您的身份</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/js/weui/weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css" />
</head>
<body>
	<div class="container" style="max-width: 500px;margin:0 auto;padding: 0px;position: relative;">
		<a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">大学生教师</a>
		<a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">职业教师</a>
	</div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('weui-btn_mini').click(function(){
				$('weui-btn-mini').removeClass('weui-btn-primary');
				$(this).addClass('weui-btn-primary');
			})
		})
	</script>
</body>
</html>