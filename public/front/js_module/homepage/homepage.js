$(function(){
	// var height = document.documentElement.clientHeight;
	/*底部点击效果*/
	$('#all_bottom .weui-tabbar__item').click(function(e){
		var forDiv = $(this).attr('for');
		history.pushState('', '', '/front/home#'+forDiv);
		// console.log(forDiv);
		$('#all_bottom .weui-tabbar__item').each(function(){
			var sforDiv = $(this).attr('for');
			$('#'+sforDiv).css('display', 'none');
			var src = $(this).find('img').attr('src');
			src = src.replace('_fill','');
			$(this).find('img').attr('src', src);
		})
		$('#'+forDiv).css('display', 'block');
		$(this).find('img').attr('src', $(this).find('img').attr('src').replace('.png', '_fill.png'));
	})

	var imgUrl = new Array(
		'/images/home/menu_teach.png',
		'/images/home/menu_teach_fill.png',
		'/images/home/menu_parent.png',
		'/images/home/menu_parent_fill.png',
		'/images/home/menu_classroom.png',
		'/images/home/menu_classroom_fill.png',
		'/images/home/menu_class.png',
		'/images/home/menu_class_fill.png',
		'/images/home/menu_my.png',
		'/images/home/menu_my_fill.png',

		'/images/home/cart.png',
		'/images/home/cart_dark.png',
		'/images/home/cart_red.png',
		'/images/home/cart_delete.png',

		'/images/home/option_chat.png',
		'/images/home/option_voucher.png',
		'/images/home/option_coin.png',
		'/images/home/option_order.png'
		);
	var loadImg = new Array();
	// 预加载图片
	for (var i in imgUrl) {
		loadImg[i] = new Image(); 
		loadImg[i].src = imgUrl[i];
	}

	$('#user_info').click(function(){
		  window.location.href = "/front/user_info_parent";
	})


	/*调整高度*/
	var funcTypeHeight = $('.my_function_type')[0].clientHeight;
	$('.my_function_type').each(function(){
		$(this).css('height', funcTypeHeight+'px');
	})
})