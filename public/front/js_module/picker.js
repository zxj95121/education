$(function () {
    var selfPicker = {
    	start: function(data){
    		var action = data.action;/*进行绑定的这个名称*/
    		var id = data.id;
    		$('#'+action).click(function(){
    			console.log('hehehe');
    		})

    		picker_init(id, data.content);//初始化插件

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
            var x = e.originalEvent.changedTouches[0].pageX - obj.state.mouseX;
            var y = e.originalEvent.changedTouches[0].pageY - obj.state.mouseY;

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