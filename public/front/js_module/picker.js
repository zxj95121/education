$(function () {
    var selfPicker = {
    	start: function(data){
    		var action = data.action;/*进行绑定的这个名称*/
    		$('#'+action).click(function(){
    			console.log('hehehe');
    		})

    		picker_init();
    	}
    }

    function picker_init(){
    	$('body').css('position','relative');
    	$('body').append('<div id="pickerBigDiv" style="position:fixed;display:none;top:0;left:0;"></div>');
    	var width = document.documentElement.clientWidth;
    	var height = document.documentElement.clientheight;
    	$('#pickerBigDiv').css({'width':width,'height':height});
		$('#pickerBigDiv').append($('div[class="zxjPicker"]'));
    }

    selfPicker.start({action:'showDatePicker'});

})