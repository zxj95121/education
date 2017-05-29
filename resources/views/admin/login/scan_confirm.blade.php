<!DOCTYPE html>
<html>
<head>
	<title>扫码确认登录</title>
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<style type="text/css">
		#icon_box{
			padding: 28px;
			width: 95%;
			text-align: center;
		}
		#box_ctn{
			font-size: 18px;
			padding: 12px;
		}
		#div_btn{
			width: 95%;
			margin: 5px auto;
		}
	</style>
</head>
<body>
    <div class="icon-box" id="icon_box">
        <i class="weui-icon-waiting weui-icon_msg" id="icon_i"></i>
        <div class="icon-box__ctn" id="box_ctn">
            <p class="icon-box__desc">你确认要登录管理后台</p>
            <p class="icon-box__desc">{{$site_name}}吗？</p>
        </div>
    </div>

    <div class="page__bd page__bd_spacing" id="div_btn">

        <a href="javascript:;" class="weui-btn weui-btn_primary">确认</a>

        <a href="javascript:;" class="weui-btn weui-btn_default">取消</a>

    </div>

    <div class="weui-footer">
	    <p class="weui-footer__text weui-footer_fixed-bottom">{{$phone_footer}}</p>
       </div>
	<script type="text/javascript" src="/admin/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript">
		$(function(){
			var boxW = parseFloat($('#icon_box').width());
			$('#icon_i').css('fontSize', 0.21*boxW+'px');
		})
	</script>
</body>
</html>