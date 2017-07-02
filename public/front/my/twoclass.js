$(document).on('click','.class1',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClasstwo?pid='+pid);
})
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#houtui').prop('pid1',pid);
	$('#twoclass').load('/front/twoClassthree?pid='+pid);
})
$(document).on('click','.class3',function(){
	var pid = $(this).attr('pid');
	$('#houtui').prop('pid2',pid);
	$('#twoclass').load('/front/twoClassfour?pid='+pid);
})
$(document).on('click','#houtui',function(){
	var twoclass = $(this).attr('fenlei');
	switch(twoclass){
		case'class2':
			var pid = 0;
			break;
		case 'class3':
			var pid = $(this).attr('pid1');
			break;
		case 'class4':
			var pid = $(this).attr('pid2');
			break;
	}
	$('#twoclass').load('/front/twoClassback?feneli='+twoclass+'&pid='+pid);
})