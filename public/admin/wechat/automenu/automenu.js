$(function(){
	$('.js_addL1Btn').click(function(){
		var len = $('.bigMenu').length;
		if (len < 3) {
			$(this).parent().before('<li class="jsMenu pre_menu_item grid_item jslevel1 ui-sortable ui-sortable-disabled size1of3 '
				+'current selected bigMenu" id="menu_0"> <a href="javascript:void(0);" class="pre_menu_link" draggable="false"> <i class='+
				'"icon_menu_dot js_icon_menu_dot dn" style=""></i> <i class="icon20_common sort_gray"></i> <span class='
				+'"js_l1Title">菜单名称</span> </a> <div class="sub_pre_menu_box js_l2TitleBox" style=""> <ul class="sub_pre_menu_list">'+
				'<li class="js_addMenuBox"><a href="javascript:void(0);" class="jsSubView js_addL2Btn" title="最多添加5个子菜单"'
				+' draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon14_menu_add"></i></span></a></li>'+
				' </ul> <i class="arrow arrow_out"></i> <i class="arrow arrow_in"></i> </div> </li>');

			menuActive($(this).parent().prev());
		}
	})


	$(document).on('click', '.bigMenu', function(){
		menuActive($(this));
	})
})


function menuActive(cdom) {
	$('.bigMenu').each(function(){
			$(this).removeClass('current');
			$(this).removeClass('selected');
			$(this).find('.js_l2TitleBox').css('display', 'none');
		})
		cdom.addClass('current');
		cdom.addClass('selected');
		cdom.find('.js_l2TitleBox').css('display', 'block');
}