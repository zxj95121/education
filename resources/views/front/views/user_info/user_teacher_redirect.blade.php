<!DOCTYPE html>
<html>
<head>
	<title>请选择您的身份</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/js/weui/weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css" />
	<style type="text/css">
		#confirm:hover{
			text-decoration: none;
			color: #FFF;
		}
	</style>
</head>
<body>
	<div class="container" style="width:95%;max-width: 500px;margin:0 auto;padding: 0px;position: relative;text-align: center;">
		<article class="weui-article">
            <h1 style="text-align: left;">请选择您的身份</h1>
        </article>
		<a href="javascript:;" class="ha weui-btn weui-btn-mini weui-btn_default" type="1">大学生教师</a>
		<a type="2" href="javascript:;" class="ha weui-btn weui-btn-mini weui-btn_default">职业教师</a>
		
		<br>
		<a href="javascript:;" id="confirm" class="weui-btn weui-btn_primary" style="background-color: #22AAE8;">确认身份</a>
	</div>

	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.weui-btn-mini').click(function(){
				var index = $(this).index();
				if(index == 2){
					$(this).prev().removeClass('weui-btn_primary').addClass('weui-btn_default');
					// $(this).prev().css({'background-color':'#f8f8f8','color':'#000'});
					// $(this).prev().removeClass('ttt');
					$(this).prev().css({'background-color':'#f8f8f8','color':'#000'});
				} else {
					$(this).next().removeClass('weui-btn_primary').addClass('weui-btn_default');
					// $(this).next().css({'background-color':'#f8f8f8','color':'#000'});;
					// $(this).next().removeClass('ttt');
					$(this).next().css({'background-color':'#f8f8f8','color':'#000'});
				}

				$(this).removeClass('weui-btn_default').addClass('weui-btn_primary');
				// $(this).addClass('ttt');
				$(this).css({'text-decoration':'none','color':'#FFF','background-color':'#1aad19'});
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