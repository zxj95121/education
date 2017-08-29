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

$(document).on('click', '#subjectMade', function(){
	$('#subjectPopover').show().animate({'top': '0px'},250);
})

$(document).on('click', '#hobbyMade', function(){
	$('#hobbyPopover').show().animate({'top': '0px'},250);
})

$(document).on('click', '.selectMade', function(){
	$(this).prev().hide();
	$(this).css({'top': '0px', 'opacity': '1'});
	ajaxSession();
})

pricePicker = 0;
$(document).on('click', '#priceM', function(){
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
	ajaxSession();
})

//提交定制后的事情
$(document).on('click', '#submitBtn', function(){
	var subject = $('#subjectMade').attr('stid');
	var price = $('#priceM').attr('price');
	var time = $('#timeM').val();
	var timeVad = $('#timeM').css('opacity');
	
	if (subject && price && timeVad) {
//		获取每一个值
		var education = $('#educationM').css('opacity') == '1' ? $('#educationM option:selected').val() : 0;
		var sex = $('#sexM').css('opacity') == '1' ? $('#sexM option:selected').val() : 0;
		var type = $('#typeM').css('opacity') == '1' ? $('#typeM option:selected').val() : 0;//风格
		var hobby = $('#hobbyMade').attr('hid');
		var teachObj = $('#teachObjM').css('opacity') == '1' ? $('#teachObjM option:selected').val() : 0;//经验定制
		
		if (!education || !sex || !type || !hobby || !teachObj || (education && sex && type && hobby && teachObj)) {
			if (education && sex && type && hobby && teachObj) {
				var sttt = '确认提交吗？';
			} else {
				var sttt = '您的定制不太完善，确认提交吗？';
			}
			mui.confirm(sttt, '提示', ['取消', '确认'], function(e){
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
								initForm();
								$('.madeT_Div').css('display', 'none');
								$('#madeT_history').show();
								window.location.href = '/front/home#teachers';
								window.location.reload();
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

//读取sesisons
window.onload = function() {
	setSessionValue();
}

function setSessionValue() {
	var eduB = $('#subjectMade').attr('stid');
	if (eduB) {
		var eduBdom = $('#subjectPopover button[stid="'+eduB+'"]');
		eduBdom.attr('active', 1);
		eduBdom.addClass('mui-btn-primary');
		$('#subjectMade').val(eduBdom.html());
	}
	
	var eduH = $('#hobbyMade').attr('hid');
	if (eduH) {
		var arr = eduH.split('-');
		var str = new Array();
		for (var i in arr) {
			var eduHdom = $('#hobbyPopover button[hid="'+arr[i]+'"]');
			eduHdom.attr('active', 1);
			eduHdom.addClass('mui-btn-primary');
			str[i] = eduHdom.html();
		}
		if (str.length == 1) {
			$('#hobbyMade').val(str[0]);
		} else if (str.length == 2) {
			$('#hobbyMade').val(str[0]+'、'+str[1]);
		} else {
			$('#hobbyMade').val(str[0]+'、'+str[1]+'等');
		}
	}
}

function initForm() {
	pricePicker = 0;
	$('#directionMade').html('<div style="padding: 10px 10px;"> <form class="mui-input-group"> <div class="mui-input-row"> <label>学科定制 <span style="color:red;">*</span></label> <input type="text" placeholder="选择学科" id="subjectMade" stid="" readonly="readonly"> </div> <div class="mui-input-row"> <label>学历定制</label> <input type="text" placeholder="选择学历" readonly="readonly"> <select class="selectMade" id="educationM" name="educationM" style="opacity: 0;z-index:2;position: relative;top: -39px;"> <option value="1">研究生</option> <option value="2">本科生</option> <option value="3">专科生</option> </select> </div> <div class="mui-input-row"> <label>性别定制</label> <input type="text" placeholder="性别要求" readonly="readonly"> <select class="selectMade" name="sexM" id="sexM" style="opacity: 0;z-index:2;position: relative;top: -39px;"> <option value="1">男女均可</option> <option value="2">男</option> <option value="3">女</option> </select> </div> <div class="mui-input-row"> <label>风格定制</label> <input type="text" placeholder="选择辅导老师风格" readonly="readonly"> <select class="selectMade" id="typeM" name="typeM" style="opacity: 0;z-index:2;position: relative;top: -39px;"> <option value="1">温和型</option> <option value="2">严厉型</option> <option value="3">幽默型</option> </select> </div> <div class="mui-input-row"> <label>特长定制</label> <input type="text" placeholder="选择特长" id="hobbyMade" readonly="readonly"> </div> <div class="mui-input-row"> <label>经验定制</label> <input type="text" placeholder="要求教师曾经授课对象" readonly="readonly"> <select class="selectMade" name="teachObjM" id="teachObjM" style="opacity: 0;z-index:2;position: relative;top: -39px;"> <option value="1">高中生</option> <option value="2">初中生</option> <option value="3">小学生</option> <option value="4">无</option> </select> </div> <div class="mui-input-row"> <label>学费定制 <span style="color:red;">*</span></label> <input type="text" placeholder="选择辅导价格" id="priceM" readonly="readonly"> </div> <div class="mui-input-row"> <label>时间定制 <span style="color:red;">*</span></label> <input type="text" placeholder="选择辅导时间" readonly="readonly"> <select class="selectMade" name="timeM" id="timeM" style="opacity: 0;z-index:2;position: relative;top: -39px;"> <option value="1">周一至周五晚上</option> <option value="2">周末</option> <option value="3">节假日</option> <option value="4">暑假</option> <option value="5">寒假</option> </select> </div> </form> </div> <div style="padding: 10px 10px;"> <button type="button" id="submitBtn" class="mui-btn mui-btn-success" style="width: 100%;height: 40px;font-size: 1.5em;line-height: 26px;">提交定制</button> </div>');
	ajaxSession();
	var selectArr = new Array('#educationM', '#sexM', '#typeM', '#teachObjM', '#timeM');
	for (var q in selectArr) {
		$(selectArr[q]).change(function(){
			ajaxSession();
		})
	}
	
	$('#hobbyPopover button').attr('active', 0);
	$('#subjectPopover button').attr('active', 0);
}

$('.swpSlide2').click(function(){
	$('.swiper-slide').eq(1).fadeOut(300);
	$('.swiper-slide').eq(0).fadeIn(600);
})





















