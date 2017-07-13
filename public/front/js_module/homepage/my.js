$(function(){
	var width = $('.my_function_type:eq(0)').css('width');
	$('.my_function_type').each(function(){
		$(this).css('height', width);
	})

	// console.log($('.jiange')[0].offsetWidth)
	/*间隔高度*/
	var jiangeW = document.documentElement.clientWidth;
	$('.jiange').css('width', parseInt(jiangeW)+'px');
	$('.jiange').css({'position':'relative', 'right': $('#my').css('paddingLeft')});

	/*bottom*/
	$('#my_option').css('marginBottom', $('#all_bottom').css('height'));

	/*添加孩子点击*/
	$('#addChild').click(function(){
		window.location.href = "/front/parent/addChild";
	})
	/*孩子列表点击*/
	$(document).on('click','.listChild',function(){
		layer.open({
			content:'该功能正在开发中...',
			skin:'msg',
			time:2
		});
		//alert($(this).attr('childid'));
	})
})