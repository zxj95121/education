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
	// mui('.mui-popover-subject').popover('toggle',document.getElementById("openPopover"));
	$('#subjectPopover').show().animate({'top': '0px'},250);
})

$('.selectMade').click(function(){
	$(this).hide();
	$(this).next().show();
	open($(this).next());
})
function open(elem) {
   if (document.createEvent) {
       var e = document.createEvent("MouseEvents");
       e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
       elem[0].dispatchEvent(e);
   } else if (element.fireEvent) {
       elem[0].fireEvent("onmousedown");
   }
}