$(document).on('click','.class1',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid1',pid);
	$('#twoclass').load('/front/twoClasstwo?pid='+pid);
})
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#eclass').attr('pid2',pid);
	$('#twoclass').load('/front/twoClassthree?pid='+pid);
})
$(document).on('click','.class3',function(){
	e = window.event;
	var pid = $(this).attr('pid');
	if (e.target.tagName == 'P')
		$('#twoclass').load('/front/twoClassfour?pid='+pid);
	else if (e.target.tagName == 'SPAN') {
		console.log('这是购买');
		var loadIndex = layer.open({
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

			},
			success: function(data){
				var successInter = setInterval(function(){
					if (timeLay >= 300) {
						clearInterval(layInter);
						clearInterval(successInter);
						/*展示data*/
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
							$(body).append(data);
						}
					}
				}, 50);
			}
		})
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
			break;
	}
	$('#twoclass').load('/front/twoClassback?fenlei='+twoclass+'&pid='+pid);
})