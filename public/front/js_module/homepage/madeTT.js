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
	$('input[name="expCheckbox"]:checked').each(function(){
		expArr[expArr.length] = $(this).val();
		str += '、' +$(this).parents('.cr-styled').find('font').html();
	})
	$('#expMade').val(str.substr(1));
	console.log(str.substr(1));
	$('#expMade').attr('val', expArr.join('-'));

	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#expPopover').hide();
	}, 250);
})

/*特长*/
$(document).on('click', '#hobbyMade', function(){
	$('#hobbyPopover').show().animate({'top': '0px'},250);
})
$(document).on('click', '#subjectMade', function(){
	$('#subjectPopover').show().animate({'top': '0px'},250);
})

/*特长方面的js*/
$('#hobbyPopover button').click(function(){
	if ($(this).hasClass('mui-btn-primary')) {
		$(this).removeClass('mui-btn-primary');
		$(this).attr('active', '0');
	} else {
		if($('#hobbyPopover button[active="1"]').length == 3) {
			mui.alert('最多填写三个特长项','提示', '确认');
			return;
		}
		$(this).addClass('mui-btn-primary');
		$(this).attr('active', '1');
	}
})

$('#done_ok2').click(function(){
	var cdom = $('#hobbyPopover button[active="1"]');
	var html = '';
	var ids = new Array();
	cdom.each(function(){
		if (ids.length == 0)
			html += $(this).html();
		else if (ids.length == 1)
			html = html + '、' + $(this).html();
		else
			html += '等';
		ids[ids.length] = $(this).attr('hid');
	})
	if (ids.length > 3) {
		mui.alert('最多填写三个特长项','提示', '确认');
		return false;
	}
	if (html) {
		$('#hobbyMade').val(html);
		$('#hobbyMade').attr('hid', ids.join('-'));
	} else {
		$('#hobbyMade').val('');
		$('#hobbyMade').attr('hid', '');
	}
	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#hobbyPopover').hide();
	}, 250);
	// ajaxSession();
})

/*学科选课方面的js*/

$('#subjectPopover button').click(function(){
	
	if ($(this).hasClass('mui-btn-primary')) {
		$(this).removeClass('mui-btn-primary');
		$(this).attr('active', '0');
	} else {
		if($('#subjectPopover button[active="1"]').length == 10) {
			mui.alert('最多填写十个擅长学科','提示', '确认');
			return;
		}

		$(this).addClass('mui-btn-primary');
		$(this).attr('active', '1');
	}
})

$('#done_ok1').click(function(){
	var cdom = $('#subjectPopover button[active="1"]');
	var html = '';
	var ids = new Array();
	cdom.each(function(){
		if (ids.length == 0)
			html += $(this).html();
		else if (ids.length == 1)
			html = html + '、' + $(this).html();
		else if (ids.length == 2)
			html = html + '、' + $(this).html();
		else
			html += '等';
		ids[ids.length] = $(this).attr('stid');
	})
	if (ids.length > 10) {
		mui.alert('最多填写十个擅长学科','提示', '确认');
		return false;
	}
	if (html) {
		$('#subjectMade').val(html);
		$('#subjectMade').attr('stid', ids.join('-'));
	} else {
		$('#subjectMade').val('');
		$('#subjectMade').attr('stid', '');
	}
	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#subjectPopover').hide();
	}, 250);
	// ajaxSession();
})

/*薪水定制*/
pricePicker = 0;
$(document).on('click', '#priceMade', function(){
	pricePicker = new mui.PopPicker({
	    layer: 2
	});

	var priceArr = new Array();
	priceArr[0] = new Object();
	priceArr[0]['value'] = '1';
	priceArr[0]['text'] = '按时结算';
	priceArr[0]['children'] = new Array();
	for(var i = 0,j=30;j <= 120; i++){
		priceArr[0]['children'][i] = new Object();
		priceArr[0]['children'][i]['value'] = j;
		priceArr[0]['children'][i]['text'] = j+'元/时';
		j += 5;
	}
	priceArr[1] = new Object();
	priceArr[1]['value'] = '2';
	priceArr[1]['text'] = '按月结算';
	priceArr[1]['children'] = new Array();
	for(var i = 0,j=1000;j <= 5000; i++){
		priceArr[1]['children'][i] = new Object();
		priceArr[1]['children'][i]['value'] = j;
		priceArr[1]['children'][i]['text'] = j+'元/月';
		j += 100;
	}

	
	pricePicker.setData(priceArr);


	pricePicker.show(function(SelectedItem) {
		$('#priceMade').val(SelectedItem[1].text);
		$('#priceMade').attr('price', SelectedItem[0].value + '-' + SelectedItem[1].value);
		// ajaxSession();
	})

	var price = $('#priceMade').attr('price');

	if (price) {
		var v = price.split("-");
		pricePicker.pickers[0].setSelectedValue(v[0], v[1]);
	} else {
		pricePicker.pickers[0].setSelectedValue(1, 50);
	}
})