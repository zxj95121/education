$(function(){
	$('#all_bottom .weui-tabbar__item').click(function(){
		var forDiv = $(this).attr('for');
		console.log(forDiv);
		$('#all_bottom .weui-tabbar__item').each(function(){
			var sforDiv = $(this).attr('for');
			$('#'+sforDiv).css('display', 'none');
		})
		$('#'+forDiv).css('display', 'block');
	})
})