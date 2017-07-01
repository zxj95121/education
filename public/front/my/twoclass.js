$(document).on("click",".class1",function(){
	console.log(123);
	//var pid = $(this).attr('pid');
	//$('#eclass').load('/front/twoClass?pid='.pid);
});
$(document).on('click','.class2',function(){
	var pid = $(this).attr('pid');
	$('#eclass').load('/front/twoClasstwo?pid='.pid);
})
$(document).on('click','.class3',function(){
	var pid = $(this).attr('pid');
	$('#eclass').load('/front/twoClassthree?pid='.pid);
})
$(document).on('click','.class4',function(){
	var pid = $(this).attr('pid');
	$('#eclass').load('/front/twoClassfour?pid='.pid);
})