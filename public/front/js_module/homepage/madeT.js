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

var height = document.documentElement.clientHeight;
$('.page_set').css({'height': height+'px','top': height+'px'});

$('.done_romove').click(function(){
	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
})

$('#subjectMade').click(function(){
	$('#subjectPopover').show().animate({'top': '0px'},250);
})

$('#hobbyMade').click(function(){
	$('#hobbyPopover').show().animate({'top': '0px'},250);
})

$('.selectMade').click(function(){
	$(this).prev().hide();
	$(this).css({'top': '0px', 'opacity': '1'});
})