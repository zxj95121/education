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
var picker = new mui.PopPicker({
    layer: 2
});
    picker.setData([{
        value: '110000',
        text: '北京市',
        children: [{
                value: "110101",
                text: "东城区"
        }]
    }, {
        value: '120000',
        text: '天津市',
        children: [{
	        value: "120101",
            text: "和平区"
        }, {
            value: "120102",
            text: "河东区"
        }, {
            value: "120104",
            text: "南开区"
        }
        ]
    }])
picker.pickers[0].setSelectedIndex(1);
picker.pickers[1].setSelectedIndex(1);
picker.show(function(SelectedItem) {
	console.log(SelectedItem);
})
})