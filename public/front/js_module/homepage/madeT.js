$('#madeT_ul li').click(function(){
	var href = $(this).attr('hr');	
	$('.madeT_Div').css('display', 'none');
	$(href).show();
})

$(document).on('touchstart', '#segmentedControl .mui-control-item', function(){
	// $('#segmentedControl .mui-control-item').each(function(){
	// 	$(this).removeClass('mui-active');
	// })

	// $(this).addClass('mui-active');
	var href = $(this).attr('for');
	$('.madeSteps').hide();
	$(href).show();
})

/*定制部分*/
$('#subjectMade').click(function(){
	mui.openWindow({
	    url:'http://dev.dcloud.net.cn/mui/',
	    id:'dafdsaf',
	    styles:{
	      top:newpage-top-position,//新页面顶部位置
	      bottom:newage-bottom-position,//新页面底部位置
	      width:newpage-width,//新页面宽度，默认为100%
	      height:newpage-height,//新页面高度，默认为100%
	      ......
	    },
	    extras:{
	      .....//自定义扩展参数，可以用来处理页面间传值
	    },
	    createNew:false,//是否重复创建同样id的webview，默认为false:不重复创建，直接显示
	    show:{
	      autoShow:true,//页面loaded事件发生后自动显示，默认为true
	      aniShow:animationType,//页面显示动画，默认为”slide-in-right“；
	      duration:animationTime,//页面动画持续时间，Android平台默认100毫秒，iOS平台默认200毫秒；
	      event:'titleUpdate',//页面显示时机，默认为titleUpdate事件时显示
	      extras:{}//窗口动画是否使用图片加速
	    },
	    waiting:{
	      autoShow:true,//自动显示等待框，默认为true
	      title:'正在加载...',//等待对话框上显示的提示内容
	      options:{
	        width:waiting-dialog-widht,//等待框背景区域宽度，默认根据内容自动计算合适宽度
	        height:waiting-dialog-height,//等待框背景区域高度，默认根据内容自动计算合适高度
	        ......
	      }
	    }
	})
})