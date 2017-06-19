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
    	if(marginTop > 105) {
    		$(this).animate({'marginTop': '105px'}, 500);
    	}
    	var allLength = (selfPicker.content[$(this).index('#'+selfPicker.id+' .colPicker')].length-4)*35;
    	if (allLength > 0 && (marginTop+allLength < 0|| marginTop < (105+allLength))) {
    		$(this).animate({'marginTop': '-'+allLength+'px'}, 500);
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
			var marginTop = 105;
			marginTop -= parseInt((count)/2)*35;
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
    		}]
    	]
    });

})