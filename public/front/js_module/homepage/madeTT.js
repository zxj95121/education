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

$(document).on('change', '#expM', function(){
	var val = $(this).val();
	alert(val);
})

$(document).on('blur', '#expM', function(){
	$(this).css({'opacity': '0'});
})

/*经验定制*/
$(document).on('click', '#expMade', function(){
	$('#expPopover').show().animate({'top': '0px'},250);
})