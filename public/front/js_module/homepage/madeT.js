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

$('#priceM').click(function(){
	/*为content提供变量，仅此而已开始*/
	var arr1 = new Array();
	for (var i = 0,j = 50;j <= 300;i++) {
		arr1[i] = new Object();
		arr1[i].name = j+'元',
		arr1[i].value = j;
		j += 10;
	}

	var arr2 = new Array();
	arr2[0] = new Object();
	arr2[0].name = '时',
	arr2[0].value = '1';

	/*为content提供变量，仅此而已结束*/

	selfPicker.start({
    	id: 'priceMPicker', /*div的ID*/
    	action: 'priceM',/*要响应的button的ID*/
    	content: [
    		arr1,arr2/*content必填项，但数组元素个数可1个，可2个，可3个等*/
    	],
    	// default: [
    	// 	150, 1
    	// ],/*default，可选项，设置打开picker时默认展示的值*/
    	select: function(result){
    		console.log(result);/*result响应用户选择的内容*/
			/*select结束*/
    	}
    });


    $('#priceM')[0].click();
})