@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link href="assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />

@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">双师Class价格设置</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	双师Class价格设置
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
                                        <div class="col-md-4 part1">
                                            <button id="newPrice"  class="btn btn-success" data-toggle="modal" data-target="#newPriceModal"> 设置新价格 <span class="glyphicon glyphicon-cog"></span></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><font><font>名称</font></font></th>
                                                        <th><font><font>状态</font></font></th>
                                                        <th><font><font>操作</font></font></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
	                            <div class="col-sm-7">
	                                <input name="tags" id="tags" class="form-control" value="" style="display: none;">
	                            </div>
	                        </div><!-- form-group -->
                    	</form>
                    	<table class="table">
                    		<tr>
                    			<th>#</th>
                    			<th>区间段</th>
                    			<th>价格</th>
                    		</tr>
                    		<tr></tr>
                    		<tr></tr>
                    		<tr></tr>
                    	</table>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        	<button type="button" class="btn btn-primary">Save changes</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script src="assets/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
	$(function(){
		jQuery('#tags').tagsInput({width:'auto'});
	})
</script>
@endsection