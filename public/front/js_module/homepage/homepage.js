$(function(){
	$('#all_bottom .weui-tabbar__item').click(function(){
		var forDiv = $(this).attr('for');
		console.log(forDiv);
		$('#all_bottom .weui-tabbar__item').each(function(){
			var sforDiv = $(this).attr('for');
			$('#'+sforDiv).css('display', 'none');
			var src = $(this).find('img').attr('src');
			src = src.replace('_fill','');
			$(this).find('img').attr('src', src);
		})
		$('#'+forDiv).css('display', 'block');
		$(this).find('img').attr('src', $(this).find('img').attr('src').replace('.png', '_fill.png'));
	})
})