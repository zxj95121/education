$(function () {
    selfPicker = {
    	start: function(data){
    		selfPicker['size'+(selfPicker.length)] = {};
            
            if (data.len) {
                selfPicker.current = data.len;
                selfPicker.length = data.len;
                selfPicker['size'+selfPicker.length] = {};
                $('#pickerBigDiv #'+data.id).html('');
            } else {
    	        selfPicker.current = selfPicker.length;
            }

            $.extend( true, selfPicker['size'+(selfPicker.length)], selfPicker.size );
            
    		selfPicker['size'+(selfPicker.current)].action = data.action;/*进行绑定的这个名称*/
    		selfPicker['size'+(selfPicker.current)].id = data.id;
    		$.extend( true, selfPicker['size'+(selfPicker.current)].content, data.content );
    		selfPicker['size'+(selfPicker.current)].select = data.select;

    		selfPicker.arr[data.action] = selfPicker.current;


    		if (data.default) {
    			selfPicker.default[selfPicker.current] = new Array();
    			$.extend(true, selfPicker.default[selfPicker.current], data.default);
    		} else {
    			selfPicker.default[selfPicker.current] = new Array();
    		}

    		/*click事件*/
    		$('#'+selfPicker['size'+(selfPicker.current)].action).click(function(){
				$('#pickerBigDiv').css('display', 'block');
				selfPicker.current = selfPicker.arr[$(this).attr('id')];
				$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','block');
		    });

            if (data.len) {
    	        picker_init(selfPicker['size'+(selfPicker.current)].id, data.content,data.len);/*初始化插件*/
            } else {
                picker_init(selfPicker['size'+(selfPicker.current)].id, data.content);
            }
    		selfPicker.length = selfPicker.length+1;

    	},
    	length: 1,
    	arr: [],
    	current: 0,
    	default: [],
    	size:{
    		content: {},
	    	id: 0,
	    	action: 0,
	    	colHeight: 35,
	    	result: {},
	    	select: ''
	    }
    };

    var state = {};

    $(document).on('touchstart', '.colPicker', function(e){
    	state.dragable = true;
        state.mouseX = e.originalEvent.changedTouches[0].pageX;
        state.mouseY = e.originalEvent.changedTouches[0].pageY;
    });

    $(document).on('touchmove', '.colPicker', function(e){
    	e.preventDefault();

        if (state.dragable)
        {
            var x = e.originalEvent.changedTouches[0].pageX - state.mouseX;
            var y = e.originalEvent.changedTouches[0].pageY - state.mouseY;

            var bg = parseFloat($(this).css('marginTop'));

/*            var bgX = x + parseInt(bg[0]);*/
            var bgY = y + bg;

            $(this).css('marginTop', bgY + 'px');

            state.mouseX = e.originalEvent.changedTouches[0].pageX;
            state.mouseY = e.originalEvent.changedTouches[0].pageY;

            /*要知道哪一个层在中间*/
            var len = selfPicker['size'+(selfPicker.current)].content[$(this).index('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker')].length;
        	var  marginTop = parseFloat($(this).css('marginTop'));
        	
        	
        	
        }
    });

    $(document).on('touchend', '.colPicker', function(e){
    	state.dragable = false;
    	var marginTop =  parseFloat($(this).css('marginTop'));
    	var IntTop = parseInt(marginTop);

    	/*不正确对其中间横线的处理代码*/
    	var mod = parseInt(marginTop)%selfPicker['size'+(selfPicker.current)].colHeight;
    	var shang = Math.ceil(selfPicker['size'+(selfPicker.current)].colHeight/2);
    	var xia = -1*Math.floor(selfPicker['size'+(selfPicker.current)].colHeight/2);
    	if (mod >=shang)
    		mod = IntTop-mod+selfPicker['size'+(selfPicker.current)].colHeight;
    	else if(mod < xia) {
    		mod = IntTop-mod-selfPicker['size'+(selfPicker.current)].colHeight;
    	} else if (mod >= xia) {
    		mod = IntTop-mod;
    	} else {
    		mod = IntTop-mod;
    	}



    	var flag = 0;/*0表示没有出现滚动效果*/
    	var flagTop = 0;
    	/*长度很长的时候*/
    	if(marginTop > selfPicker['size'+(selfPicker.current)].colHeight*3) {
    		$(this).animate({'marginTop': '105px'}, 200);
    		flagTop = 105;
    		flag = 1;
    	}
    	var allLength = (selfPicker['size'+(selfPicker.current)].content[$(this).index('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker')].length-4)*selfPicker['size'+(selfPicker.current)].colHeight;
    	if (allLength > 0 && (marginTop+allLength < 0)) {
    		$(this).animate({'marginTop': '-'+allLength+'px'}, 200);
    		flagTop = -1*allLength;
    		flag = 1;
    	}
    	/*太少的情况，往上滑动*/
    	var clength = selfPicker['size'+(selfPicker.current)].content[$(this).index('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker')].length;/*表示内容的个数*/
    	if (clength > 0 && clength < 5 && marginTop < (selfPicker['size'+(selfPicker.current)].colHeight*3-selfPicker['size'+(selfPicker.current)].colHeight*clength)) {
    		marginTop = selfPicker['size'+(selfPicker.current)].colHeight*3-parseInt((clength)/2)*selfPicker['size'+(selfPicker.current)].colHeight;
			$(this).animate({'marginTop': marginTop+'px'}, 200);
			flagTop = marginTop;
			flag = 1;
    	}

    	/*如果没有进行上面的滚动效果*/
    	if (flag == 0) {
    		flagTop = mod;
    		$(this).animate({'marginTop': mod+'px'}, 200);
    	}

    	var num = (selfPicker['size'+(selfPicker.current)].colHeight*3-flagTop)/selfPicker['size'+(selfPicker.current)].colHeight;

    	$(this).find('.basicPicker').each(function(){
    			$(this).removeClass('active0');/*去除class*/
    			$(this).removeClass('active1');/*去除class*/
    	});
    	var min = 0,max = num+3;
    	if (clength < num-3)
    		min = num-3;
    	if (clength < num+3)
    		max = clength;
    	for (var i = min;i <= max;i++) {
    		if(i == num) {
    			$(this).find('.basicPicker').eq(num).addClass('active0');
    			continue;
    		}
    		$(this).find('.basicPicker').eq(i).addClass('active1');
    	}
    });

    $(document).on('click', '.okPicker', function(){
    	var colPickerJquery = $('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker');
    	for (var i = 0;i < colPickerJquery.length;i++) {
    		var marginTop = parseInt($(colPickerJquery[i]).css('marginTop'));
    		var num = (selfPicker['size'+(selfPicker.current)].colHeight*3-marginTop)/selfPicker['size'+(selfPicker.current)].colHeight;

    		var value = selfPicker['size'+(selfPicker.current)].content[i][num];

    		selfPicker['size'+(selfPicker.current)].result[i] = value.value;
    	}

    	selfPicker['size'+(selfPicker.current)].select(selfPicker['size'+(selfPicker.current)].result);/*执行函数*/

    	$('#pickerBigDiv').css('display', 'none');
    	$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','none');
    });

    /*取消*/
    $(document).on('click', '.canclePicker', function(){
    	$('#pickerBigDiv').css('display', 'none');
    	$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','none');
    });

    function picker_init(id,content,len=0){
    	$('body').css('position','relative');
    	if ($('#pickerBigDiv').length == 0) {
    		$('body').append('<div id="pickerBigDiv" style=""></div>');
    		var width = document.documentElement.clientWidth;
    		var height = document.documentElement.clientHeight;
    		$('#pickerBigDiv').css({'width':width,'height':height});
    	}
        if (len!=0)
		   $('#pickerBigDiv').append($('#'+id));

		var length = content.length;

		/*插入若干个列*/
		for (var i = 0;i < length;i++) {
			$('#'+id+' .contentPicker').append('<div class="colPicker"></div>');
		}
		var widthBL = Math.floor(100/length)+'%';
		$('#'+id+' .colPicker').css('width', widthBL);/*设置每个的宽度*/

		/*对chontent进行填充*/
		for (var i = 0;i < length;i++) {
			var count = selfPicker['size'+(selfPicker.current)].content[i].length;
			var marginTop = selfPicker['size'+(selfPicker.current)].colHeight*3;
			
			for (var j = 0;j < content[i].length;j++) {
				$('#'+id+' .colPicker:eq('+i+')').append('<div class="basicPicker" val="'+content[i][j].value+'">' + content[i][j].name + '</div>');
			}
			if (selfPicker.default[selfPicker.current].length > 0) {
				
				var defaultValue = selfPicker.default[selfPicker.current][i];
				var placeNum = 0;
				var easyUse = selfPicker['size'+(selfPicker.current)].content[i];
				for (var p in easyUse) {
					if (easyUse[p].value == defaultValue) {
						placeNum = p;
						break;
					}
				}
			} else {
				var placeNum = (selfPicker['size'+(selfPicker.current)].colHeight*3-marginTop)/selfPicker['size'+(selfPicker.current)].colHeight;
    		}

    		/*先定位*/
			marginTop -= placeNum*selfPicker['size'+(selfPicker.current)].colHeight;
			$('#'+id+' .colPicker:eq('+i+')').css({'left': Math.floor(100/length)*i+'%','marginTop': marginTop+'px'});
			/*再添加class*/
    		$('#'+id+' .colPicker:eq('+i+')').find('.basicPicker').eq(placeNum).addClass('active0');
		}
    }
});