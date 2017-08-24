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
	$(this).parents('.page_set').hide().animate({'top': height+'px'}, 250);
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

var isPriceMPicker = 0;
$('#priceM').click(function(){
	if (!isPriceMPicker) {
		pricePicker = new mui.PopPicker();


		/*80*/

		var priceArr = new Array();
		for(var i = 0,j=10;j <= 300; i++){
			priceArr[i] = new Object();
			priceArr[i]['value'] = j;
			priceArr[i]['text'] = j+'元';
			j += 10;
		}

		pricePicker.setData(priceArr);
		// pricePicker.setData([{
		//     value: "first",
		//     text: "第一项"
		// }, {
		//     value: "second",
		//     text: "第一项"
		// }, {
		//     value: "third",
		//     text: "第三项"
		// }, {
		//     value: "fourth",
		//     text: "第四项"
		// }, {
		//     value: "fifth",
		//     text: "第五项"
		// }])
		//picker.pickers[0].setSelectedIndex(4, 2000);
		pricePicker.show(function(SelectedItem) {
			console.log(SelectedItem);
		})

		isPriceMPicker = 1;
	}

	pricePicker.pickers[0].setSelectedValue('150', 200);
})