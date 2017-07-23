
$(document).on('click','.class1',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid1',pid);
	$('#eclass').load('/front/twoClasstwo?pid='+pid, function(){
		setCartPosition();
		cartInit();
	});
})
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid2',pid);
	$('#eclass').load('/front/twoClassthree?pid='+pid, function(){
		setCartPosition();
		cartInit();
	});
})
$(document).on('click','.class3',function(){
	e = window.event;
	var pid = $(this).attr('pid');
	if (e.target.tagName == 'P')
		$('#eclass').load('/front/twoClassfour?pid='+pid, function(){
		setCartPosition();
		cartInit();
	});
	else if (e.target.tagName == 'SPAN') {
		$('#childsheet').remove();

		var offset = $("#cartNum").offset();
        var img = '/images/home/cart_red.png'; //获取当前点击图片链接   
        var flyer = $('<img class="flyer-img" style="width:20px;height:20px;z-index:2000;" src="' + img + '">'); //抛物体对象   
        var thisAdd = $(this);
        var id = thisAdd.attr('pid');
        var count = parseInt(thisAdd.attr('kcNum'));
        /*检查该购物车是否已经有*/
        var temp = 0;
        var len = cartArr.length;
       	for (var i = 0; i < len;i++) {
       		if (cartArr[i] == id) {
       			temp = 1;
       			break;
       		}
       	}
       	if( temp == 0 ) {
       		cartArr[len] = id;
       		/*将该购物车变为不可选*/
       		var lin = $(this).find('span');
       		lin.css({'background-color':'#FFF','border-color':'#FFF','background-image':"url('/images/home/cart_dark.png')"});

       		/*查找当前三级的名称*/
       		var hideThree = new Array();
       		hideThree[0] = $('#hideThree').attr('pid');
       		hideThree[1] = $('#hideThree').html();
       		/*查购物车中是否已经有这个一级*/
       		var tttt = 0;
       		for (var i in cartOrder) {
       			if (i == hideThree[0]) {
       				tttt = 1;
       				break;
       			}
       		}
       		if (tttt == 0) {
       			cartOrder[hideThree[0]] = new Object();
       			cartOrder[hideThree[0]].name = hideThree[1];
       			cartOrder[hideThree[0]].val = new Object();
       			
       			cartOrder[hideThree[0]]['val'][id] = new Object();
       			cartOrder[hideThree[0]]['val'][id].name = thisAdd.find('p').html();
       			cartOrder[hideThree[0]]['val'][id].count = count;
       		} else {
       			cartOrder[i]['val'][id] = new Object();
       			cartOrder[i]['val'][id].name = thisAdd.find('p').html();
       			cartOrder[i]['val'][id].count = count;
       		}
       		console.log(cartOrder);
       		cartInit();
	        flyer.fly({   
	            start: {   
	                left: event.pageX,//抛物体起点横坐标   
	                top: event.pageY //抛物体起点纵坐标   
	            },
	            end: {   
	                left: offset.left,//抛物体终点横坐标   
	                top: offset.top, //抛物体终点纵坐标  
	            },
	            onEnd: function() {
	                this.destory(); //销毁抛物体
	                var prevCount = parseInt($('#cartNum').html());
	                cartTotal = prevCount+count;
	                $('#cartNum').html(cartTotal);
	            }   
	        });
	    }
		// loadIndex = layer.open({
		//     type: 2
		//     ,content: ''
		// });
		// $.ajax({
		// 	url: '/front/parent/getChild',
		// 	dataType: 'json',
		// 	type: 'post',
		// 	data: {

		// 	},
		// 	success: function(data){
		// 		if (data.errcode == 0) {
		// 			layer.close(loadIndex);
		// 			var str = '<div class="weui-skin_android" id="childsheet" style="opacity: 1;"> <div class="weui-mask child-weui-mask"></div> <div class="weui-actionsheet"> <div class="weui-actionsheet__menu"> ';
		// 			if (data.child.length == 0) {
		// 				  layer.open({
		// 					    content: '请先添加自己的孩子'
		// 					    ,skin: 'msg'
		// 					    ,time: 2 //2秒后自动关闭
		// 					  });
		// 				  return false;
		// 			}
		// 			for (var i in data.child) {
		// 				str += '<div class="weui-actionsheet__cell child_Cell" cid=""><input type="radio" name="child" value="'+data.child[i].id+'" />'+data.child[i].name+'</div>';
		// 			}
		// 			str += '<div class="weui-actionsheet__cell childCellClick" style="background: #1AAD19;color:#FFF;text-align:center;">点我确认</div></div> </div> </div>';
		// 			$('#twoclass').after(str);
					
		// 			$(document).on('click', '.child_Cell', function(){
		// 				$(this).find('input')[0].click();
		// 			})

		// 			$(document).on('click', '.child-weui-mask', function(){
		// 				$('#childsheet').fadeOut(200);
		// 			})

		// 			$(document).on('click', '.childCellClick', function(){
		// 				var child = $('input[name="child"]:checked').val();
		// 				if (!child) {
		// 					return false;
		// 				}
		// 				$('#childsheet').fadeOut(200);
						


						/*var loadIndex = layer.open({
						    type: 2
						    ,content: ''
						});
						var timeLay = 0;
						var layInter = setInterval(function(){
							timeLay += 50;
						}, 50);
						$.ajax({
							url: '/front/parent/checkMessage',
							dataType: 'html',
							type: 'post',
							data: {
								pid: pid,
								// child: child
							},
							success: function(data){
								var successInter = setInterval(function(){
									if (timeLay >= 300) {
										clearInterval(layInter);
										clearInterval(successInter);
										layer.close(loadIndex);
										if (data.indexOf('weui-form-preview__bd') > 0) {
											var openIndex = layer.open({
											    type: 1
											    ,content: data
											    ,anim: 'up'
											    ,style: 'position:fixed; bottom:0; left:0; width: 100%; min-height: 150px;padding:10px 0; border:none;'
											});

											$(document).on('click', '#closeOpen0', function(){
												layer.close(openIndex);
											})
										} else {
											$('#twoclass').after(data);
										}
									}
								}, 50);
							}
						})*/



		// 				/*点击响应结束*/
		// 			});
		// 		}
		// 	}
		// })
		
	}
})
$(document).on('click','#houtui',function(){
	var twoclass = $(this).attr('fenlei');
	switch(twoclass){
		case'class2':
			var pid = 0;
			break;
		case 'class3':
			var pid = $('#eclass').attr('pid1');
			break;
		case 'class4':
			var pid = $('#eclass').attr('pid2');
			setCartPosition();
			cartInit();
			break;
	}
	$('#twoclass').load('/front/twoClassback?fenlei='+twoclass+'&pid='+pid, function(){
		setCartPosition();
		cartInit();
	});
})

$(document).on('click', '#orderdetailClose', function(){
	if ($('#orderdetail').css('display') == 'none') {
		$('#orderdetail').slideDown();
	} else {
		$('#orderdetail').slideUp();
	}
})

/*去结算*/
$(document).on('click', '#myCartRight', function(){
	if (cartTotal == 0) {
		layer.open({
		    content: '购物车不能为空'
		    ,skin: 'msg'
		    ,time: 2 //2秒后自动关闭
		 });
	} else {
		// $('#cartConfirm').show();
		var loadIndex = layer.open({
		    type: 2
		    ,content: ''
		});
		$('#cartOrderForm textarea').val(JSON.stringify(cartOrder));
		$('#cartOrderForm')[0].submit();
	}
})

function setCartPosition(){
	var bottomHeight = $('#all_bottom').height();
	$('#myCart').css({'position':'fixed','bottom':bottomHeight+'px'});
	if ($('#myCart').length == 0) {
		$('#zhicheng').css({'height':bottomHeight+'px','opacity':0});
	} else {
		$('#zhicheng').css({'height':bottomHeight+40+'px','opacity':0});
	}
	var height = document.documentElement.clientHeight;

	$('#orderdetail').css('height', height-bottomHeight-40+'px');
	$('#orderdetail').css({'bottom':bottomHeight+40+'px'});

	$('#cartNum').html(cartTotal);/*购物车个数显示*/
	/*对购物车已有的三级变灰色*/
	for (var i = 0;i < cartArr.length;i++) {
		$('.buyCell a[pid="'+cartArr[i]+'"]').find('span').css({'background-color':'#FFF','border-color':'#FFF','background-image':"url('/images/home/cart_dark.png')"});
	}
}

/*直接将购物车详情内容根据cartOrder对象重置*/
function cartInit(){
	$('#orderdetail .cartblock').each(function(){
		$(this).remove();
	})
	for (var i in cartOrder) {
		$('#orderdetail').append('<div class="cartblock" pid="'+i+'"> <div class="cartheader" style="width:100%;background: #EA6969;'
			+'color: #FFF;padding:6px 10px;"> <p style="font-size:1.1em;margin: 0px 0px;">'+cartOrder[i].name+'</p> </div> </div>');
		var val = cartOrder[i]['val'];
		for (var j in val) {
			$('#orderdetail .cartblock:last').append('<div class="cartcontent" style="width: 100%;background: #FFF;" pid="'+j+'">'
			 +'<div  class="weui-cells" style="margin:0;"> <a class="weui-cell weui-cell_title"> <div class="weui-cell__bd"'
			  +'style="position: relative;color:#333;"> <p style="font-size:15px;">'+val[j].name+'</p> <iframe id="tmp_downloadhelper_iframe"'
			   +'style="display: none;"></iframe> </div> <div class="weui-cell__ft"> <span>'+val[j].count+'课时</span> <span class="btn btn-danger deleteCartBtn"'
			    +'style="background-color:#FFF;border-color:#FFF;background-image:url(\'/images/home/cart_delete.png\');'
			    +'background-size:100% 100%;width:28px;height:28px;"> </span> </div> </a> </div> </div>');
		}
	}
}