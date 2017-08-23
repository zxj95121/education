$('#madeT_ul li').click(function(){
	var href = $(this).find('a').attr('href');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})