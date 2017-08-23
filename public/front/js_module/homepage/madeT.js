$('#madeT_ul li').click(function(){
	var href = $(this).attr('hr');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})

$('#slider .mui-control-item').click(function(){
	$('#slider .mui-control-item').each(function(){
		$(this).removeClass('mui-active');
	})
	$(this).addClass('mui-active');
})