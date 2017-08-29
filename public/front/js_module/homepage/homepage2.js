$(function(){
	// var height = document.documentElement.clientHeight;
	/*底部点击效果*/
	$(document).on('touchstart', '#all_bottom .mui-tab-item', function(){
		var forDiv = $(this).attr('for');
		history.pushState('', '', '/front/home#'+forDiv);
		// console.log(forDiv);
		if (forDiv != 'teacher') {
			if (pricePicker) {
				pricePicker.hide();
			}
		}
		if (forDiv == 'teacher') {
			includeLink('/admin/css/style.min.css', 'css');
			includeLink('/js/swiper/dist/css/swiper.min.css', 'css');
			
			includeLink('/js/swiper/dist/js/swiper.jquery.min.js', 'js', 'doSwiper');	      	
		}
		$('#all_bottom .mui-tab-item').each(function(){
			// var sforDiv = $(this).attr('for');
			// $('#'+sforDiv).css('display', 'none');
			var src = $(this).find('img').attr('src');
			src = src.replace('_fill','');
			$(this).find('img').attr('src', src);
		})
		// $('#'+forDiv).css('display', 'block');
		$(this).find('img').attr('src', $(this).find('img').attr('src').replace('.png', '_fill.png'));
	})
	$('#all_bottom .mui-tab-item').click(function(e){
		var forDiv = $(this).attr('for');
		history.pushState('', '', '/front/home#'+forDiv);
		// console.log(forDiv);
		$('#all_bottom .mui-tab-item').each(function(){
			// var sforDiv = $(this).attr('for');
			// $('#'+sforDiv).css('display', 'none');
			var src = $(this).find('img').attr('src');
			src = src.replace('_fill','');
			$(this).find('img').attr('src', src);
		})
		// $('#'+forDiv).css('display', 'block');
		console.log($(this).html());
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

	var urlStyle = [];
    var urlScript = [];
    /* 加载js css*/
	function includeLink(url,urlType, func='') {
		if(urlType == "css"){
			for(var i = 0; i < urlStyle.length;i++){
				if(urlStyle[i] == url){
					var status = 2333;
					return false;
				}
			}
			if(status == 2333){
				return false;
			}
			urlStyle.push(url);
			var link = document.createElement("link");
			link.rel = "stylesheet";
			link.type = "text/css";
			link.href = url;
			document.getElementsByTagName("head")[0].appendChild(link);
		}else{
			for(var i = 0; i < urlScript.length;i++){
				if(urlScript[i] == url){
					var status = 2333;
					return false;
				}
			}
			if(status == 2333){
				return false;
			}
			urlScript.push(url);
			$.ajaxSetup({
				cache: true
			});
			$.getScript(url, function(){
				if (func) {
					var ffff = eval(func);
					new ffff();
				}
			});
		}

	}
	function doSwiper() {
		var mySwiper = new Swiper ('.swiper-container', {
        	direction: 'horizontal',
        	
            loop: false,

      	
      	$(document).on('click', '.madeShowDiv', function(){
//       		mySwiper.slideNext(function(){}, 500);
			console.log(213);
      		mySwiper.slideTo(2, 500, false);//切换到第二个slide，速度为0.5秒
      		$('.swiper-slide').eq(0).fadeOut(300);
      		$('.swiper-slide').eq(1).fadeIn(600);
//       		setTimeout(function(){mySwiper.lockSwipes();}, 600);
        })
	}
})