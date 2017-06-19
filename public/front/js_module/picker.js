$(function () {
    var selfPicker = {
    	start: function(data){
    		selfPicker.action = data.action;/*进行绑定的这个名称*/
    		selfPicker.id = data.id;
    		selfPicker.content = data.content;
    		$('#'+selfPicker.action).click(function(){
    			console.log('hehehe');
    		})

    		picker_init(selfPicker.id, data.content);//初始化插件

    	},
    	content: {},
    	id: 0,
    	action: 0,
    	colHeight: 35,
    	result: 0
    };

    var state = {};

    $(document).on('touchstart', '.colPicker', function(e){
    	state.dragable = true;
        state.mouseX = e.originalEvent.changedTouches[0].pageX;
        state.mouseY = e.originalEvent.changedTouches[0].pageY;
    })

    $(document).on('touchmove', '.colPicker', function(e){
    	e.preventDefault();

        if (state.dragable)
        {
            var x = e.originalEvent.changedTouches[0].pageX - state.mouseX;
            var y = e.originalEvent.changedTouches[0].pageY - state.mouseY;

            var bg = parseFloat($(this).css('marginTop'));

            // var bgX = x + parseInt(bg[0]);
            var bgY = y + bg;

            $(this).css('marginTop', bgY + 'px');

            state.mouseX = e.originalEvent.changedTouches[0].pageX;
            state.mouseY = e.originalEvent.changedTouches[0].pageY;
        }
    })

    $(document).on('touchend', '.colPicker', function(e){
    	state.dragable = false;
    	var marginTop =  parseFloat($(this).css('marginTop'));
    	/*不正确对其中间横线的处理代码*/
    	var mod = parseInt(marginTop)%selfPicker.colHeight;
    	var shang = Math.ceil(selfPicker.colHeight/2);
    	var xia = -1*Math.floor(selfPicker.colHeight/2);
    	if (mod >=shang)
    		mod = marginTop-mod+selfPicker.colHeight;
    	else if(mod < xia) {
    		mod = marginTop-mod-selfPicker.colHeight;
    	} else if (mod >= xia) {
    		mod = marginTop-mod;
    	} else {
    		mod = marginTop-mod;
    	}



    	var flag = 0;//0表示没有出现滚动效果
    	/*长度很长的时候*/
    	if(marginTop > selfPicker.colHeight*3) {
    		$(this).animate({'marginTop': '105px'}, 200);
    		flag = 1;
    	}
    	var allLength = (selfPicker.content[$(this).index('#'+selfPicker.id+' .colPicker')].length-4)*selfPicker.colHeight;
    	if (allLength > 0 && (marginTop+allLength < 0)) {
    		$(this).animate({'marginTop': '-'+allLength+'px'}, 200);
    		flag = 1;
    	}
    	/*太少的情况，往上滑动*/
    	var clength = selfPicker.content[$(this).index('#'+selfPicker.id+' .colPicker')].length;//表示内容的个数
    	if (clength > 0 && clength < 5 && marginTop < (selfPicker.colHeight*3-selfPicker.colHeight*clength)) {
    		marginTop = selfPicker.colHeight*3-parseInt((clength)/2)*selfPicker.colHeight;
			$(this).animate({'marginTop': marginTop+'px'}, 200);
			flag = 1;
    	}

    	/*如果没有进行上面的滚动效果*/
    	if (flag == 0) {
    		$(this).animate({'marginTop': mod+'px'}, 200);
    	}
    })

    $(document).on('click', '.okPicker', function(){
    	var colPickerJquery = $('#'+selfPicker.id+' .colPicker');
    	for (var i = 0;i < colPickerJquery.length;i++) {
    		var marginTop = parseInt($(colPickerJquery[i]).css('marginTop'));
    		var num = (105-marginTop)/selfPicker.colHeight;
    		console.log(num);
    		var value = selfPicker.content[i][num];
    		console.log(value);
    	}
    })

    function picker_init(id,content){
    	$('body').css('position','relative');
    	if ($('#pickerBigDiv').length == 0) {
    		$('body').append('<div id="pickerBigDiv" style=""></div>');
    		var width = document.documentElement.clientWidth;
    		var height = document.documentElement.clientHeight;
    		$('#pickerBigDiv').css({'width':width,'height':height});
    	}
		$('#pickerBigDiv').append($('#'+id));

		console.log(content);
		var length = content.length;

		/*插入若干个列*/
		for (var i = 0;i < length;i++) {
			$('#'+id+' .contentPicker').append('<div class="colPicker"></div>');
		}
		var widthBL = Math.floor(100/length)+'%';
		$('#'+id+' .colPicker').css('width', widthBL);/*设置每个的宽度*/

		/*对chontent进行填充*/
		for (var i = 0;i < length;i++) {
			var count = selfPicker.content[i].length;
			var marginTop = selfPicker.colHeight*3;
			marginTop -= parseInt((count)/2)*selfPicker.colHeight;
			$('#'+id+' .colPicker:eq('+i+')').css({'left': Math.floor(100/length)*i+'%','marginTop': marginTop+'px'});
			for (var j = 0;j < content[i].length;j++) {
				$('#'+id+' .colPicker:eq('+i+')').append('<div class="basicPicker" val="'+content[i][j].value+'">' + content[i][j].name + '</div>');
			}
		}

    }

    selfPicker.start({
    	id: 'birthPicker', 
    	action: 'showDatePicker',
    	content: [
    		[{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		},{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		},{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		},{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		},{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		},{
    			'name': '1960年',
    			'value': 1960
    		},{
    			'name': '1961年',
    			'value': 1961
    		},{
    			'name': '1962年',
    			'value': 1962
    		}],
    		[{
    			'name': '1月',
    			'value': 1
    		},{
    			'name': '2月',
    			'value': 2
    		}]
    	]
    });

})