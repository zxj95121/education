<!DOCTYPE html>
<html>
<head>
	<title>个人信息</title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/weui.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css">
	<style>
		.yincang{
			display: none;
			z-index: 2;
			position: absolute;
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
	    <!-- 生日 -->
	    <div style="display:none">
		    <div class="weui-mask weui-animate-fade-in"></div>
			<div class="weui-picker weui-animate-slide-up"> 
				<div class="weui-picker__hd"> 
					<a href="javascript:;" data-action="cancel" class="weui-picker__action">取消</a> 
					<a href="javascript:;" data-action="select" class="weui-picker__action" id="weui-picker-confirm">确定</a> 
				</div> 
				<div class="weui-picker__bd">
					<div class="weui-picker__group"> 
						<div class="weui-picker__mask"></div> 
						<div class="weui-picker__indicator"></div> 
						<div class="weui-picker__content" style="transform: translate3d(0px, -374px, 0px);">
							<div class="weui-picker__item">
							1990年
							</div>
							<div class="weui-picker__item">
							1991年
							</div>
							<div class="weui-picker__item">
							1992年
							</div>
							<div class="weui-picker__item">
							1993年
							</div>
							<div class="weui-picker__item">
							1994年
							</div>
							<div class="weui-picker__item">
							1995年
							</div>
							<div class="weui-picker__item">
							1996年
							</div>
							<div class="weui-picker__item">
							1997年
							</div>
							<div class="weui-picker__item">
							1998年
							</div>
							<div class="weui-picker__item">
							1999年
							</div>
							<div class="weui-picker__item">
							2000年
							</div>
							<div class="weui-picker__item">
							2001年
							</div>
							<div class="weui-picker__item">
							2002年
							</div>
							<div class="weui-picker__item">
							2003年
							</div>
							<div class="weui-picker__item">
							2004年
							</div>
							<div class="weui-picker__item">
							2005年
							</div>
							<div class="weui-picker__item">
							2006年
							</div>
							<div class="weui-picker__item">
							2007年
							</div>
							<div class="weui-picker__item">
							2008年
							</div>
							<div class="weui-picker__item">
							2009年
							</div>
							<div class="weui-picker__item">
							2010年
							</div>
							<div class="weui-picker__item">
							2011年
							</div>
							<div class="weui-picker__item">
							2012年
							</div>
							<div class="weui-picker__item">
							2013年
							</div>
							<div class="weui-picker__item">
							2014年
							</div>
							<div class="weui-picker__item">
							2015年
							</div>
							<div class="weui-picker__item">
							2016年
							</div>
							<div class="weui-picker__item">
							2017年
							</div>
						</div> 
					</div>
					<div class="weui-picker__group" style="display: block;"> 
						<div class="weui-picker__mask"></div> 
						<div class="weui-picker__indicator"></div> 
						<div class="weui-picker__content" style="transform: translate3d(0px, -102px, 0px);">
							<div class="weui-picker__item">
							1月
							</div>
							<div class="weui-picker__item">
							2月
							</div>
							<div class="weui-picker__item">
							3月
							</div>
							<div class="weui-picker__item">
							4月
							</div>
							<div class="weui-picker__item">
							5月
							</div>
							<div class="weui-picker__item">
							6月
							</div>
							<div class="weui-picker__item">
							7月
							</div>
							<div class="weui-picker__item">
							8月
							</div>
							<div class="weui-picker__item">
							9月
							</div>
							<div class="weui-picker__item">
							10月
							</div>
							<div class="weui-picker__item">
							11月
							</div>
							<div class="weui-picker__item">
							12月
							</div>
						</div> 
					</div>
					<div class="weui-picker__group" style="display: block;"> 
						<div class="weui-picker__mask"></div> 
						<div class="weui-picker__indicator"></div> 
						<div class="weui-picker__content" style="transform: translate3d(0px, -408px, 0px);">
							<div class="weui-picker__item">
							1日
							</div>
							<div class="weui-picker__item">
							2日
							</div>
							<div class="weui-picker__item">
							3日
							</div>
							<div class="weui-picker__item">
							4日
							</div>
							<div class="weui-picker__item">
							5日
							</div>
							<div class="weui-picker__item">
							6日
							</div>
							<div class="weui-picker__item">
							7日
							</div>
							<div class="weui-picker__item">
							8日
							</div>
							<div class="weui-picker__item">
							9日
							</div>
							<div class="weui-picker__item">
							10日
							</div>
							<div class="weui-picker__item">
							11日
							</div>
							<div class="weui-picker__item">
							12日
							</div>
							<div class="weui-picker__item">
							13日
							</div>
							<div class="weui-picker__item">
							14日
							</div>
							<div class="weui-picker__item">
							15日
							</div>
							<div class="weui-picker__item">
							16日
							</div>
							<div class="weui-picker__item">
							17日
							</div>
							<div class="weui-picker__item">
							18日
							</div>
							<div class="weui-picker__item">
							19日
							</div>
							<div class="weui-picker__item">
							20日
							</div>
							<div class="weui-picker__item">
							21日
							</div>
							<div class="weui-picker__item">
							22日
							</div>
							<div class="weui-picker__item">
							23日
							</div>
							<div class="weui-picker__item">
							24日
							</div>
							<div class="weui-picker__item">
							25日
							</div>
							<div class="weui-picker__item">
							26日
							</div>
							<div class="weui-picker__item">
							27日
							</div>
							<div class="weui-picker__item">
							28日
							</div>
							<div class="weui-picker__item">
							29日
							</div>
							<div class="weui-picker__item">
							30日
							</div>
							<div class="weui-picker__item">
							31日
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
			$('#shengri').on('click', function () {
		        weui.datePicker({
		            start: 1990,
		            end: new Date().getFullYear(),
		            onChange: function (result) {
		                console.log(result);
		            },
		            onConfirm: function (result) {
		                console.log(result);
		            }
		        });
		    });
		})

	</script>
</body>
</html>
