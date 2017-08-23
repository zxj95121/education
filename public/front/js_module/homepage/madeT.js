$('#madeT_ul li').click(function(){
	var href = $(this).attr('hr');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})

$(document).on('touchstart', '#segmentedControl .mui-control-item', function(){
	// $('#segmentedControl .mui-control-item').each(function(){
	// 	$(this).removeClass('mui-active');
	// })

	// $(this).addClass('mui-active');
	var href = $(this).attr('for');
	$('.madeSteps').hide();
	$(href).show();
})

/*定制部分*/
$('#subjectMade').click(function(){
	mui('.mui-popover-subject').popover('toggle',document.getElementById("openPopover"));
})