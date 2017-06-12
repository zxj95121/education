<!DOCTYPE html>
<html>
<head>
	<title>个人信息</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css">
	<style>
		.yincang{
			display:none;
			z-index: 2;
			position:absolute;
			width: 100%;
		}
	</style>
</head>
<body>
	<div class="container" style="max-width:500px;margin:0 auto;overflow:hidden;padding:0;">
		<div class="page__bd">
			<div class="weui-cells" style="margin-top:0px" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">个人信息</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
	            <div class="weui-cell weui-cell_access danji" target="touxiang">
	                <div class="weui-cell__bd">头像</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px; display:inline-block;"><img style="width:70px;border-radius:50%;" src="http://wx.qlogo.cn/mmopen/w6MofXPc5Nj9oWjZKbm3svI0grH1AMuYg6OaoQoc5TNjuic9iazY1YZKD9yQ4p8WP0Ovo6QVG6kxyrHvWJPJ39V9vM0zS033OS/0"></span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access danji" target="nickname">
	                <div class="weui-cell__bd">昵称</div>
	                <div class="weui-cell__ft" style="font-size: 0" >
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access danji" target="name">
	                <div class="weui-cell__bd">姓名</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;">选填</span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access danji" target="xingshi">
	                <div class="weui-cell__bd">学生姓氏</div>
	                <div class="weui-cell__ft" style="font-size: 0" >
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="sex">
	                <div class="weui-cell__bd">性别</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="shengri">
	                <div class="weui-cell__bd">出生日期</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="zhuzhai">
	                <div class="weui-cell__bd">住宅小区</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="xiangxi">
	                <div class="weui-cell__bd">详细地址</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
       		</div>
		</div>
		<div class="page__bd yincang" id="touxiang">
			<div class="weui-cells" style="margin-top:0px;height:100%;" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">头像</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
	            <div class="weui-cell weui-cell_access">
	                <div class="weui-cell__bd">头像</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px; display:inline-block;"><img style="width:70px;border-radius:50%;" src="http://wx.qlogo.cn/mmopen/w6MofXPc5Nj9oWjZKbm3svI0grH1AMuYg6OaoQoc5TNjuic9iazY1YZKD9yQ4p8WP0Ovo6QVG6kxyrHvWJPJ39V9vM0zS033OS/0"></span>
	                </div>
	            </div>
	       </div>
		</div>
		<div class="page__bd yincang" id="nickname">
			<div class="weui-cells" style="margin-top:0px;height:100%;" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">昵称</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
		        <div >
					<div class="weui-cell">
		                <div class="weui-cell__bd">
		                    <input class="weui-input" type="text" placeholder="请输入文本">
		                </div>
	            	</div>
            	</div>
	       </div>
		</div>
		 <div class="weui-footer">
		    <p class="weui-footer__text weui-footer_fixed-bottom">12312312</p>
	    </div>	
	</div>
	<script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			var height1 = document.documentElement.clientHeight;
			$('.container').find('.page__bd').css({height:height1});
			$('.page_bd').css('top', height1);
			$('.danji').each(function(){
				$(this).click(function(){
					var ids = ($(this).attr('target'));
					$('#'+ids).css('display', 'block');
					$('#'+ids).animate({top:"0px"},300);
				})
			})
			$('.yincang .glyphicon-remove').click(function(){
				$('.yincang').hide();
				$('.page__bd').eq(0).show();
				$('.page__bd').css('top', height1);
			})
 
		})

	</script>
</body>
</html>
