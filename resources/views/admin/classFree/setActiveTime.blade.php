@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">修改免费抢课时间</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	修改免费抢课时间
                                </h3>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                   							<div class="panel-body">
				                                <form role="form" class="p-20">
				                                    <div class="form-group">
				                                        <label for="text"><font><font>起始时间</font></font></label>
				                                        <input type="text" class="form-control" name="" id="inpstart" >
                                               			<input type="hidden" name="hiddenStart" id="hiddenStart" value="{{$res->start_time}}">
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>结束时间</font></font></label>
														<input type="text" class="form-control" name=""  id="inpend" >
														<input type="hidden" name="hiddenEnd" id="hiddenEnd" value="{{$res->end_time}}">
				                                    </div>
				                                    <div class="form-group">
				                                    	<button id="edit" type="submit" class="btn btn-success"><font><font>修改</font></font></button>
				                                    </div>
				                                </form>
				                            </div>
                                    	</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
@endsection
<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/js/jeui/jedate.js"></script>
<script>
var startTime = "{{$res->start_time}}";
var endTime = "{{$res->end_time}}";
var start = {
    format: 'YYYY-MM-DD',
    minDate: $.nowDate({DD:0}), //设定最小日期为当前日期
    festival: false,
    isinitVal:true,                            //是否初始化时间，默认不初始化时间
    isTime:false, //是否开启时间选择
    maxDate: endTime, //最大日期
    //maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
         end.minDate = val; //开始日选好后，重置结束日的最小日期
        $('#hiddenStart').val(val);
    },
    okfun:function(elem, val, date) {
        $('#hiddenStart').val(val);
    }, 
};
var end = {
	    format: 'YYYY-MM-DD',
	    minDate: $.nowDate({DD:0}), //设定最小日期为当前日期
	    maxDate: '2099-06-16', //最大日期
	    choosefun: function(elem, val, date){
	        start.maxDate = date; //将结束日的初始值设定为开始日的最大日期
	        $('#hiddenEnd').val(val);
		},
	    okfun:function(elem, val, date) {
	        $('#hiddenEnd').val(val);
	    }, 
	};
	//这里是日期联动的关键        
	function endDates() {
	    //将结束日期的事件改成 false 即可
	    end.trigger = false;
	    $("#hiddenEnd").jeDate(end);
	}
	$.jeDate('#inpstart',start);
	$('#inpstart').val(startTime);
	$.jeDate('#inpend',end);
	$('#inpend').val(endTime);
</script>
<script>
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
		$('#edit').click(function(){
   			$.ajax({
    			url:"/admin/classFree/setActiveTime/post",
    			data:{
					start_time:$('#hiddenStart').val(),
					end_time:$('#hiddenEnd').val()
        		},
    			type:'post',
    			datatype:'json',
    			success:function(date){
    				if(date.code == 200){
						window.layer.msg('修改成功');
						//window.location.href="/admin/classFree/setActiveTime";
            		}else{
						window.layer.msg('修改失败，请重新修改');
                	}
    			}
            })  	
            return false; 
		})
	})
</script>
@endsection