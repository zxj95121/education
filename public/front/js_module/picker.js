$(function () {
    var selfPicker = {
    	start: function(data){
    		var id = data.id;/*进行绑定的这个名称*/
    		$('#'+id).click(function(){
    			console.log('hehehe');
    		})
    	}
    }

    selfPicker.start({id:'showDatePicker'});

})