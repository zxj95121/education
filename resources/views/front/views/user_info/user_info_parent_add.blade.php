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
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="nickname1"></div></span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access danji" target="xingming">
	                <div class="weui-cell__bd">姓名</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="xingming1">选填</div></span>
	                </div>
	            </div>
	           	<div class="weui-cell weui-cell_access danji" target="xingshi">
	                <div class="weui-cell__bd">学生姓氏</div>
	                <div class="weui-cell__ft" style="font-size: 0" >
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="xingshi1"></div></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access" id="xingbie">
	                <div class="weui-cell__bd">性别</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="xingbie1"></div></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access " id="shengri">
	                <div class="weui-cell__bd">出生日期</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="shengri1"></div></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="zhuzhai">
	                <div class="weui-cell__bd">住宅小区</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"></span>
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_access danji" target="danyuan">
	                <div class="weui-cell__bd">栋/单元</div>
	                <div class="weui-cell__ft" style="font-size: 0">
	                    <span style="vertical-align:middle; font-size: 17px;"><div id="danyuan1">选填</div></span>
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
			    <div style="width: 97%;margin: 0 auto;">
			    	<div class="weui-cells__title"><span class="chang">0</span>/5</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input" type="text" name="nicheng" placeholder="请输入昵称">
			                </div>
			            </div>
       				</div>
			    </div>
	       </div>
		</div>
		<div class="page__bd yincang" id="xingming">
			<div class="weui-cells" style="margin-top:0px;height:100%;" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">姓名</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
			    <div style="width: 97%;margin: 0 auto;">
			    	<div class="weui-cells__title"><span class="chang">0</span>/4</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input" type="text" name="xingming" placeholder="请输入姓名">
			                </div>
			            </div>
       				</div>
			    </div>
	       </div>
		</div>
		<div class="page__bd yincang" id="xingshi">
			<div class="weui-cells" style="margin-top:0px;height:100%;" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">学生姓氏</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
			    <div style="width: 97%;margin: 0 auto;">
			    	<div class="weui-cells__title"><span class="chang">0</span>/4</div>
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input" type="text" name="xingshi" placeholder="请输入姓氏">
			                </div>
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
	                <div class="weui-actionsheet__cell sex_actionsheet">男</div>
	                <div class="weui-actionsheet__cell sex_actionsheet">女</div>
	            </div>
	            <div class="weui-actionsheet__action">
	                <div class="weui-actionsheet__cell" id="iosActionsheetCancel">取消</div>
	            </div>
	        </div>
	    </div>
	    <div class="page__bd yincang" id="danyuan">
			<div class="weui-cells" style="margin-top:0px;height:100%;" >
	            <div class="weui-cell weui-cell_access" style="height:40px;background:#22AAE8;color:#FFF;">
		            <div><div class="placeholder glyphicon glyphicon-remove"></div></div>
		            <div class="weui-flex__item"><div class="placeholder" style="text-align:center;">栋/单元</div></div>
		            <div><div class="placeholder glyphicon glyphicon-ok"></div></div>
		        </div>
			    <div style="width: 97%;margin: 0 auto;">
			    	
			    	<div class="weui-cells">
			            <div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input class="weui-input" type="text" name="danyuan" placeholder="请输入栋/单元">
			                </div>
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
	<script type="text/javascript" src="/js/layui/layui.js"></script>
	<script type="text/javascript" src="/js/weui/zepto.min.js"></script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
	<script type="text/javascript" src="/js/weui/example.js"></script>
	<script type="text/javascript">
		$(function(){
			var height1 = document.documentElement.clientHeight;			
			$('.container').find('.page__bd').css({height:height1});
			$('.page_bd').css('top', height1);
			$('.danji').each(function(){
				$(this).click(function(){
					var ids = $(this).attr('target');
					var text = $(this).find('.weui-cell__ft div').text();
					if(text == "选填"){
						text = '';
					}
					$('#'+ids).css('display', 'block');
					$('#'+ids).find('.chang').text(text.length);
					$('#'+ids).find('input').val(text);
					$('#'+ids).animate({top:"0px"},300);
					
				})
			})
			/*关闭 */
			$('.yincang .glyphicon-remove').click(function(){
				$('.page__bd').eq(0).show();
				$(this).parents('.page__bd').animate({top:height1+'px'},300);
				var obj = $(this);
				setTimeout(function(){
					obj.parents('.page__bd').css('display', 'none');
				},300);
			})
			/* 昵称提交  */
 			$('#nickname .glyphicon-ok').click(function(){
				var nicheng = $('input[name=nicheng]').val();
				var obj = $(this);
				if(nicheng.length > 5){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('超过字数限制');
					});
					return false;
				}else if(nicheng.length == 0){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('昵称不能为空');
					});
					return false;
				}
				$('#nickname1').text(nicheng);
				$('.page__bd').eq(0).show();
	
				obj.parents('.page__bd').animate({top:height1+'px'},300);
				setTimeout(function(){
					obj.parents('.page__bd').css({display:'none'});
				},300)
		 	})
	 	 	 /* 昵称input验证 */
			$('input[name=nicheng]').on('input',function(){
				var changdu = $(this).val().length;
				$(this).parents('.weui-cells').prev().find('span').text(changdu);
				if(changdu > 5){
					$(this).parents('.weui-cells').prev().css({color:'red'});
				}else{
					$(this).parents('.weui-cells').prev().css({color:'#999999'});
				}
			})
			/* 姓名提交  */
 			$('#xingming .glyphicon-ok').click(function(){
				var text = $('input[name=xingming]').val();
				var obj = $(this);
				var yanzheng = /^[\u4e00-\u9fa5]{2,8}$/;
				if(text.length > 4){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('超过字数限制');
					});
					return false;
				}else if(text.length == 0){
					text = '选填';
				}else if(!yanzheng.test(text)){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('请输入中文');
					});
					return false;
				}
				
				$('#xingming1').text(text);
				$('.page__bd').eq(0).show();
				obj.parents('.page__bd').animate({top:height1+'px'},300);
				setTimeout(function(){
					obj.parents('.page__bd').css({display:'none'});
				},300)
		 	 })
	 	 	 /* 姓名input验证 */
			$('input[name=xingming]').on('input',function(){
				var changdu = $(this).val().length;
				$(this).parents('.weui-cells').prev().find('span').text(changdu);
				if(changdu > 4){
					$(this).parents('.weui-cells').prev().css({color:'red'});
				}else{
					$(this).parents('.weui-cells').prev().css({color:'#999999'});
				}
			})
			/* 姓氏提交  */
 			$('#xingshi .glyphicon-ok').click(function(){
				var text = $('input[name=xingshi]').val();
				var yanzheng = /^[\u4e00-\u9fa5]{2,8}$/;
				var obj = $(this);
				if(text.length > 4){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('超过字数限制');
					});
					return false;
				}else if(text.length == 0){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('姓氏不能为空');
					});
					return false;
				}
				if(!yanzheng.test(text)){
					layui.use('layer', function(){
						  var layer = layui.layer;
						  layer.msg('请输入中文');
					});
					return false;
				}
				$('#xingshi1').text(text);
				$('.page__bd').eq(0).show();
				obj.parents('.page__bd').animate({top:height1+'px'},300);
				setTimeout(function(){
					obj.parents('.page__bd').css({display:'none'});
				},300)
	 	 	 })
	 	 	 /* 姓氏input验证 */
			$('input[name=xingshi]').on('input',function(){
				var changdu = $(this).val().length;
				$(this).parents('.weui-cells').prev().find('span').text(changdu);
				if(changdu > 4){
					$(this).parents('.weui-cells').prev().css({color:'red'});
				}else{
					$(this).parents('.weui-cells').prev().css({color:'#999999'});
				} 
			})
			/*性别  */
			$('#xingbie').click(function(){
				$('#sex').css('display', 'block');
			})
			$('#iosActionsheetCancel').click(function(){
				$('#sex').css('display', 'none');
			})
			$('.sex_actionsheet').click(function(){
				var sex = $(this).html();
				$('#xingbie1').text(sex);
				$('#sex').css('display', 'none');
			})
			/* 生日 */
		    $(document).on('click','#shengri',function(){
	    	 	weui.datePicker({
		            start: 1960,
		            end: new Date().getFullYear(),
		            onChange: function (result) {
		                /* console.log(result); */
		            },
		            onConfirm: function (result) {
		            	$('#shengri1').html(result[0] + '年' + (result[1]) + '月');
		            }
		        });
	    	 	$('.weui-picker__group').eq(2).remove();
			})
			/* 单元提交  */
 			$('#danyuan .glyphicon-ok').click(function(){
				var text = $('input[name=danyuan]').val();
				var obj = $(this);
				if(text.length == 0){
					text = '选填';
				}
				$('#danyuan1').text(text);
				$('.page__bd').eq(0).show();
				obj.parents('.page__bd').animate({top:height1+'px'},300);
				setTimeout(function(){
					obj.parents('.page__bd').css({display:'none'});
				},300)
		 	 })
		})

	</script>
</body>
</html>
