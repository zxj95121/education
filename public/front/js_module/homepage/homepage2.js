$(function(){
	// var height = document.documentElement.clientHeight;
	/*底部点击效果*/
	$(document).on('touchstart', '#all_bottom .mui-tab-item', function(){
		var forDiv = $(this).attr('for');
		history.pushState('', '', '/front/home#'+forDiv);
		// console.log(forDiv);
		if (forDiv == 'teacher') {
			includeLink('/front/css_module/picker.css', 'css');
			includeLink('/front/js_module/picker.js', 'js');
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
		    	default: [
		    		150, 1
		    	],/*default，可选项，设置打开picker时默认展示的值*/
		    	select: function(result){
		    		console.log(result);/*result响应用户选择的内容*/
					/*select结束*/
		    	}
		    });
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
	function includeLink(url,urlType) {
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
			});
		}

	}
})