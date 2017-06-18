$(function () {
    var selfPicker = {
    	start: function(data){
    		var action = data.action;/*进行绑定的这个名称*/
    		var id = data.id;
    		$('#'+action).click(function(){
    			console.log('hehehe');
    		})

    		picker_init(id);//初始化插件
    	}
    }

    function picker_init(id){
    	$('body').css('position','relative');
    	if ($('#pickerBigDiv').length == 0) {
    		$('body').append('<div id="pickerBigDiv" style=""></div>');
    		var width = document.documentElement.clientWidth;
    		var height = document.documentElement.clientHeight;
    		$('#pickerBigDiv').css({'width':width,'height':height});
    	}
		$('#pickerBigDiv').append($('#'+id));
    }

    selfPicker.start({
    	id: 'birthPicker', 
    	action:'showDatePicker'
    });

})