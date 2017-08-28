$('#madeT_ul li').click(function(){
	var href = $(this).attr('hr');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})
//
//$(document).on('touchstart', '#segmentedControl .mui-control-item', function(){
//	// $('#segmentedControl .mui-control-item').each(function(){
//	// 	$(this).removeClass('mui-active');
//	// })
//
//	// $(this).addClass('mui-active');
//	var href = $(this).attr('for');
//	$('.madeSteps').hide();
//	$(href).show();
//})

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
	ajaxSession();
})

pricePicker = 0;
$('#priceM').click(function(){
	pricePicker = new mui.PopPicker();

	var priceArr = new Array();
	for(var i = 0,j=30;j <= 300; i++){
		priceArr[i] = new Object();
		priceArr[i]['value'] = j;
		priceArr[i]['text'] = j+'元/时';
		j += 10;
	}

	pricePicker.setData(priceArr);
	pricePicker.show(function(SelectedItem) {
		// console.log(SelectedItem);
		$('#priceM').val(SelectedItem[0].text);
		$('#priceM').attr('price', SelectedItem[0].value);
		ajaxSession();
	})

	var price = $('#priceM').attr('price');

	if (price) {
		var v = price;
		pricePicker.pickers[0].setSelectedValue(v);
	} else {
		pricePicker.pickers[0].setSelectedValue('100');
	}
})


/*学科选课方面的js*/

$('#subjectPopover button').click(function(){
	if ($(this).hasClass('mui-btn-primary')) {
		$(this).removeClass('mui-btn-primary');
		$(this).attr('active', '0');
	} else {
		$('#subjectPopover button[active="1"]').removeClass('mui-btn-primary');
		$(this).addClass('mui-btn-primary');
		$(this).attr('active', '1');
	}
})

$('#done_ok1').click(function(){
	var cdom = $('#subjectPopover button[active="1"]');
	if (cdom) {
		$('#subjectMade').val(cdom.html());
		$('#subjectMade').attr('stid', cdom.attr('stid'));
	}
	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#subjectPopover').hide();
	}, 250);
	ajaxSession();
})

/*特长方面的js*/
$('#hobbyPopover button').click(function(){
	if ($(this).hasClass('mui-btn-primary')) {
		$(this).removeClass('mui-btn-primary');
		$(this).attr('active', '0');
	} else {
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
	if (html) {
		$('#hobbyMade').val(html);
		$('#hobbyMade').attr('hid', ids.join('-'));
	}
	$(this).parents('.page_set').animate({'top': height+'px'}, 250);
	setTimeout(function(){
		$('#hobbyPopover').hide();
	}, 250);
	ajaxSession();
})

//提交定制后的事情
$('#submitBtn').click(function(){
	var subject = $('#subjectMade').attr('stid');
	var price = $('#priceM').attr('price');
	var time = $('#timeM').val();
	var timeVad = $('#timeM').css('opacity');
	console.log(subject);
	console.log(price);
	console.log(timeVad);
	
	if (subject && price && timeVad) {
//		获取每一个值
		var education = $('#educationM').css('opacity') == '1' ? $('#educationM option:selected').val() : 0;
		var sex = $('#sexM').css('opacity') == '1' ? $('#sexM option:selected').val() : 0;
		var type = $('#typeM').css('opacity') == '1' ? $('#typeM option:selected').val() : 0;//风格
		var hobby = $('#hobbyMade').attr('hid');
		var teachObj = $('#teachObjM').css('opacity') == '1' ? $('#teachObjM option:selected').val() : 0;//经验定制
		
		if (!education || !sex || !type || !hobby || !teachObj) {
			mui.confirm('您的定制不太完善，确认提交吗？', '提示', ['取消', '确认'], function(e){
				if (e.index == 1) {
					$.ajax({
						url: '/front/tmade/submit',
						dataType: 'json',
						type: 'post',
						data: {
							subject: subject,
							price: price,
							time: time,
							education: education,
							sex: sex,
							type: type,
							hobby: hobby,
							exp: teachObj
						},
						success: function(data) {
							if (data.errcode == 0) {
								mui.toast('定制提交成功',{ duration:'1000', type:'div' });
							}
						}
					})
				}
			});
		}
	} else {
		mui.alert('带红色<span style="color:red;">*</span>为必填项','提醒', '确认');
	}
})

//每一次失去焦点都需要进行存储内容
var selectArr = new Array('#educationM', '#sexM', '#typeM', '#teachObjM', '#timeM');
for (var q in selectArr) {
	$(selectArr[q]).change(function(){
		ajaxSession();
	})
}
function ajaxSession() {
	var subject = $('#subjectMade').attr('stid');
	var price = $('#priceM').attr('price');
	var time = $('#timeM').val();
	var education = $('#educationM').css('opacity') == '1' ? $('#educationM option:selected').val() : 0;
	var sex = $('#sexM').css('opacity') == '1' ? $('#sexM option:selected').val() : 0;
	var type = $('#typeM').css('opacity') == '1' ? $('#typeM option:selected').val() : 0;//风格
	var hobby = $('#hobbyMade').attr('hid');
	var exp = $('#teachObjM').css('opacity') == '1' ? $('#teachObjM option:selected').val() : 0;//经验定制
	
	$.ajax({
		url: '/front/tmade/session',
		dataType: 'json',
		type: 'post',
		data: {
			subject: subject,
			price: price,
			time: time,
			education: education,
			sex: sex,
			type: type,
			hobby: hobby,
			exp: exp
		},
		success: function(data) {
			if (data.errcode == 0) {
				console.log(data);
			}
		}
	})
}

function formInit() {
	$('#directionMade').html('');
}






















