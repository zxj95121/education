$(function () {
    selfPicker = {
    	start: function(data){
    		// selfPicker['size'+(selfPicker.length)] = selfPicker.size;
    		selfPicker.length = selfPicker.length;
    		selfPicker.current = selfPicker.length;
    		selfPicker['size'+(selfPicker.current)].action = data.action;/*进行绑定的这个名称*/
    		selfPicker['size'+(selfPicker.current)].id = data.id;
    		selfPicker['size'+(selfPicker.current)].content = data.content;
    		selfPicker['size'+(selfPicker.current)].select = data.select;

    		selfPicker.arr[data.action] = selfPicker.current;

    		picker_init(selfPicker['size'+(selfPicker.current)].id, data.content);//初始化插件
    		selfPicker.length = selfPicker.length+1;
    		// console.log(selfPicker);
    	},
    	length: 1,
    	arr: [],
    	current: 0,
    	size1:{
    		content: {},
	    	id: 0,
	    	action: 0,
	    	colHeight: 35,
	    	result: {},
	    	select: ''
	    },
	    size2:{
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

            /*要知道哪一个层在中间*/
            var len = selfPicker['size'+(selfPicker.current)].content[$(this).index('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker')].length;
        	var  marginTop = parseFloat($(this).css('marginTop'));
        	
        	
        	
        }
    })

    $(document).on('touchend', '.colPicker', function(e){
    	state.dragable = false;
    	var marginTop =  parseFloat($(this).css('marginTop'));
    	/*不正确对其中间横线的处理代码*/
    	var mod = parseInt(marginTop)%selfPicker['size'+(selfPicker.current)].colHeight;
    	var shang = Math.ceil(selfPicker['size'+(selfPicker.current)].colHeight/2);
    	var xia = -1*Math.floor(selfPicker['size'+(selfPicker.current)].colHeight/2);
    	if (mod >=shang)
    		mod = marginTop-mod+selfPicker['size'+(selfPicker.current)].colHeight;
    	else if(mod < xia) {
    		mod = marginTop-mod-selfPicker['size'+(selfPicker.current)].colHeight;
    	} else if (mod >= xia) {
    		mod = marginTop-mod;
    	} else {
    		mod = marginTop-mod;
    	}



    	var flag = 0;//0表示没有出现滚动效果
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
    	var clength = selfPicker['size'+(selfPicker.current)].content[$(this).index('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker')].length;//表示内容的个数
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
    		// if ($(this).hasClass('active0'))
    			$(this).removeClass('active0');//去除class
    		// if ($(this).hasClass('active1'))
    			$(this).removeClass('active1');//去除class
    	})
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
    })

    $(document).on('click', '.okPicker', function(){
    	var colPickerJquery = $('#'+selfPicker['size'+(selfPicker.current)].id+' .colPicker');
    	for (var i = 0;i < colPickerJquery.length;i++) {
    		var marginTop = parseInt($(colPickerJquery[i]).css('marginTop'));
    		var num = (selfPicker['size'+(selfPicker.current)].colHeight*3-marginTop)/selfPicker['size'+(selfPicker.current)].colHeight;

    		var value = selfPicker['size'+(selfPicker.current)].content[i][num];

    		selfPicker['size'+(selfPicker.current)].result[i] = value.value;
    	}

    	selfPicker['size'+(selfPicker.current)].select(selfPicker['size'+(selfPicker.current)].result);//执行函数

    	$('#pickerBigDiv').css('display', 'none');
    	$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','none');
    })

    /*取消*/
    $(document).on('click', '.canclePicker', function(){
    	$('#pickerBigDiv').css('display', 'none');
    	$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','none');
    })

    $('#showDatePicker').click(function(){
		console.log(selfPicker);
		$('#pickerBigDiv').css('display', 'block');
		selfPicker.current = selfPicker.arr[$(this).attr('id')];
		$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','block');
    })
    $('#moneyPicker').click(function(){
		console.log(selfPicker);
		$('#pickerBigDiv').css('display', 'block');
		selfPicker.current = selfPicker.arr[$(this).attr('id')];
		$('#'+selfPicker['size'+(selfPicker.current)].id).css('display','block');
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
			marginTop -= parseInt((count)/2)*selfPicker['size'+(selfPicker.current)].colHeight;
			$('#'+id+' .colPicker:eq('+i+')').css({'left': Math.floor(100/length)*i+'%','marginTop': marginTop+'px'});
			for (var j = 0;j < content[i].length;j++) {
				$('#'+id+' .colPicker:eq('+i+')').append('<div class="basicPicker" val="'+content[i][j].value+'">' + content[i][j].name + '</div>');
			}

			var num = (selfPicker['size'+(selfPicker.current)].colHeight*3-marginTop)/selfPicker['size'+(selfPicker.current)].colHeight;
    	
    		$('#'+id+' .colPicker:eq('+i+')').find('.basicPicker').eq(num).addClass('active0');
		}

		console.log(selfPicker);

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
    	],
    	select: function(result){
    		console.log(result);
    		$('#showDatePicker span').html(result[0] + '年 ' + result[1] +'月');
    	}
    });

    selfPicker.start({
    	id: 'myMoneyPicker', 
    	action: 'moneyPicker',
    	content: [
			[{
	            name: '50元',
	            value: 50
	        }, {
	            name: '60元',
	            value: 60,
	            checked: true
	        },{
	            name: '70元',
	            value: 70
	        },{
	            name: '80元',
	            value: 80
	        },{
	            name: '90元',
	            value: 90
	        },{
	            name: '100元',
	            value: 100
	        },{
	            name: '110元',
	            value: 110
	        },{
	            name: '120元',
	            value: 120
	        },{
	            name: '130元',
	            value: 130
	        },{
	            name: '140元',
	            value: 140
	        },{
	            name: '150元',
	            value: 150
	        },{
	            name: '160元',
	            value: 160
	        },{
	            name: '170元',
	            value: 170
	        },{
	            name: '180元',
	            value: 180
	        },{
	            name: '190元',
	            value: 190
	        },{
	            name: '200元',
	            value: 200
	        },{
	            name: '210元',
	            value: 210
	        },{
	            name: '220元',
	            value: 220
	        },{
	            name: '230元',
	            value: 230
	        },{
	            name: '240元',
	            value: 240
	        },{
	            name: '250元',
	            value: 250
	        },{
	            name: '260元',
	            value: 260
	        },{
	            name: '270元',
	            value: 270
	        },{
	            name: '280元',
	            value: 280
	        },{
	            name: '290元',
	            value: 290
	        },{
	            name: '300元',
	            value: 300
	        }],	 [{
	            name: '60分钟',
	            value: 60
	        }, {
	            name: '90分钟',
	            value: 90
	        }]
    	],
    	select: function(result){
    		$('#moneyPicker span').html(result[0] + '元 / ' + result[1] +'分钟');
    	}
    });

})