@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
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
                                            <label for="pay_select" class="col-md-1 clh text-right">星期：</label>
                                            <div class="col-md-2">
                                                <select name="pay_select" id="pay_select" class="form-control">
                                                    <option value="">请选择星期</option>
                                                    <option value="1">星期一</option>
                                                    <option value="2">星期二</option>
                                                    <option value="3">星期三</option>
                                                    <option value="4">星期四</option>
                                                    <option value="5">星期五</option>
                                                    <option value="6">星期六</option>
                                                    <option value="7">星期日</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 clh text-right">班级:</label>
                                            <div class="col-md-2">
                                                <select name="confirm_select" id="confirm_select" class="form-control">
                                                    <option value="">请选择班级</option>
                                                    <option value="0">未审核</option>
                                                    <option value="1">审核通过</option>
                                                    <option value="2">已驳回</option>
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
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    });
</script>
@endsection