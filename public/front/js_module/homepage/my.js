$(function(){
	var width = $('.my_function_type:eq(0)').css('width');
	$('.my_function_type').each(function(){
		$(this).css('height', width);
	})

	/*间隔高度*/
	$('.jiange').css('width', parseInt($('.jiange:eq(0)').width())+parseInt($('#my').css('paddingLeft'))*2+'px');
	$('.jiange').css({'position':'relative', 'right': $('#my').css('paddingLeft')});
})