@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">学生课程进度管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	按条件查询课程
                                </h3>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <div class="form-group">
                                            <!-- <label class="col-md-1 clh text-right">订单编号:</label>
                                            <div class="col-md-3">
                                                <input type="text" name="orderno" id="orderno" class="form-control" placeholder="根据订单编号查询" value=" ">
                                            </div> -->
                                            <label for="pay_select" class="col-md-1 clh text-right">日期:</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="" id="inputstart">
                                                <input type="hidden" name="hiddenDate" id="hiddenDate">
                                            </div>
                                            <label class="col-md-1 clh text-right">班级:</label>
                                            <div class="col-md-2">
                                                <select name="confirm_select" id="confirm_select" class="form-control">
                                                    <option value="">请选择班级</option>
                                                    @foreach($banji as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-success" style="margin-left: 20px;">确认查询</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


        <!-- Large modal -->
		<div id="newPriceModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="myModalLabel">设置新的课程价格</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form class="form-horizontal" role="form" id="firstStep">
	                        <div class="form-group">
	                            <label class="col-sm-2 control-label">请输入间隔的数字</label>
	                            <div class="col-sm-10">
	                                <input name="tags" id="tags" class="form-control" value="" style="display: none;">
	                            </div>
	                        </div>
                    	</form>
                        <p id="error_p" style="display: none;color:red;font-size: 14px;">
                            <span class="col-sm-2"></span>
                            <span class="col-sm-10"></span>
                        </p>
                    	<table class="table" id="areaTable" style="display: none;">
                    		<tr>
                    			<th>#</th>
                    			<th>区间段</th>
                    			<th>价格</th>
                    		</tr>
                    	</table>
			      	</div>
			      	<div class="modal-footer">
			        	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <!-- <button type="button" class="btn btn-primary" id="nextTwo">下一步</button> -->
			        	<button type="button" class="btn btn-success" style="display: none;" id="nextThree">确认保存</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/js/jeui/jedate.js"></script>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    });
</script>
<script>
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth()+1;
if(month < 10)
    month = '0'+month;
var day = date.getDate();
if(day < 10)
    day = '0'+day;
var str = year+'-'+month+'-'+day;

$('#hiddenDate').val(str);

var start = {
    format: 'YYYY-MM-DD',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: false,
    isinitVal:true,                            //是否初始化时间，默认不初始化时间
    initAddVal:{DD:"+0"}, 
    maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        $('#hiddenDate').val(val);
    },
    okfun:function(elem, val, date) {
        $('#hiddenDate').val(val);
    }, 
};
// $('#inpstart').jeDate(start);
// $('#inpend').jeDate(end);
 
//或者是
$.jeDate('#inputstart',start);
</script>
@endsection