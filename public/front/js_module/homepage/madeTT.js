$('#madeT_ul li').click(function(){
	var href = $(this).attr('hr');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})

$(document).on('click', '.selectMade', function(){
	$(this).prev().hide();
	$(this).css({'top': '0px', 'opacity': '1'});
	// ajaxSession();
})