$(document).on('click','.class1',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClasstwo?pid='+pid);
})
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClassthree?pid='+pid);
})
$(document).on('click','.class3',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClassfour?pid='+pid);
})
$(document).on('click','#houtui',function(){
	var pid = $(this).attr('pid');
	var twoclass = $(this).attr('fenlei');
	$('#twoclass').load('/front/twoClassback?pid='+pid+'&fenlei'+twoclass);
})