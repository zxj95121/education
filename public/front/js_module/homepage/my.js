$(function(){
	var width = $('.my_function_type:eq(0)').css('width');
	$('.my_function_type').each(function(){
		$(this).css('height', width);
	})

	/*间隔高度*/
	$('.jiange').css('width', parseInt($('.jiange:eq(0)').width())+parseInt($('#my').css('paddingLeft'))*2+'px');
	$('.jiange').css({'position':'relative', 'right': $('#my').css('paddingLeft')});

	/*bottom*/
	$('#my_option').css('marginBottom', $('#all_bottom').css('height'));

	/*添加孩子点击*/
	$('#addChild').click(function(){
		layer.open({
		    content: '该功能正在开发中...'
		    ,skin: 'msg'
		    ,time: 2 //2秒后自动关闭
		});
		// window.location.href = "/front/parent/addChild";
	})
})