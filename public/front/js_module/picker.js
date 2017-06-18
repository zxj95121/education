$(function () {
    var selfPicker = {
    	start: function(data){
    		console.log(data.tid);
    	}
    }

    selfPicker.start({tid:23});

})