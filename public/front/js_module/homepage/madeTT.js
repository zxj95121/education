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


/*定制部分*/
var height = document.documentElement.clientHeight;
$('.page_set').css({'height': height+'px','top': height+'px'});

$('.done_romove').click(function(){
	$(this).parents('.page_set').hide().animate({'top': height+'px'}, 250);
})

/*经验定制*/
$(document).on('click', '#expMade', function(){
	$('#expPopover').show().animate({'top': '0px'},250);
})

$('#noexpCheckbox').click(function(){
	$('input[class="expCheckbox"]:checked').each(function(){
		$(this).attr('checked', false);
	})
})

$('.expCheckbox').click(function(){
	$('#noexpCheckbox').attr('checked', false);
})

$(document).on('touchstart', '#done_ok_exp', function(){
	var expArr = new Array();
	var str = '';
	$('input[class="expCheckbox"]:checked').each(function(){
		expArr[expArr.length] = $(this).val();
		str += $(this).parents('.cr-styled').text() + '、';
	})

	$('#expMade').val(str.substr(0, -1));
	$('#expMade').attr('val', expArr.join('-'));

	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#subjectPopover').hide();
	}, 250);
})