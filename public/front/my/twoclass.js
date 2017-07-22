$(document).on('click','.class1',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid1',pid);
	$('#eclass').load('/front/twoClasstwo?pid='+pid);
})
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid2',pid);
	$('#eclass').load('/front/twoClassthree?pid='+pid, function(){
		setCartPosition();
	});
})
$(document).on('click','.class3',function(){
	e = window.event;
	var pid = $(this).attr('pid');
	if (e.target.tagName == 'P')
		$('#eclass').load('/front/twoClassfour?pid='+pid);
	else if (e.target.tagName == 'SPAN') {
		$('#childsheet').remove();

		var offset = $("#cartNum").offset();
        var img = '/images/home/cart_red.png'; //获取当前点击图片链接   
        var flyer = $('<img class="flyer-img" style="width:20px;height:20px;z-index:2000;" src="' + img + '">'); //抛物体对象   
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
            }   
        });
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
			break;
	}
	$('#twoclass').load('/front/twoClassback?fenlei='+twoclass+'&pid='+pid);
})

function setCartPosition(){
	var bottomHeight = $('#all_bottom').height();
	$('#myCart').css({'position':'fixed','bottom':bottomHeight+'px'});
	$('#myCart').before('<div id="zhicheng0"></div>');
	$('#zhicheng0').css({'height':bottomHeight+40+'px','opacity':0});
}