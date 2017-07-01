$(document).on("click",".class1",function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClass?pid='+pid);
});
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClasstwo?pid='+pid);
})
$(document).on('click','.class3',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClassthree?pid='+pid);
})
$(document).on('click','.class4',function(){
	var pid = $(this).attr('pid');
	$('#twoclass').load('/front/twoClassfour?pid='+pid);
})