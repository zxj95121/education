$(function(){
	/*menu2Type*/
	$('.menu2Type').click(function(){
		var Otemp = 0;
		if ($(this).hasClass('layui-btn-primary')) {
			Otemp = 1;
		}
		console.log(Otemp);
		$('.menu2Type').each(function(){
			$(this).removeClass('layui-btn-normal');
			$(this).addClass('layui-btn-primary');
		})
		if (Otemp) {
			$(this).removeClass('layui-btn-primary');
			$(this).addClass('layui-btn-normal');
		}
	})


	$('#desc').change(function(){
		var str = $("#desc").val();
        $("#show").html(replace_em(str));
	})
})
