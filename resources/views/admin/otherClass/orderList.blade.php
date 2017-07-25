@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
	.error{
		color: red;
	}
	.label{
		cursor: pointer;
	}
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">class课程套餐订单</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase" style="font-size:1.75em;">
                                    {{$package->name}}
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
                                	<div class="row">
                                		<table class="table table-hover" id="tcTable">
                                			<thead>
												<tr>
													<th>ID</th>
													<th>名称</th>
                                                    <th>课时数量</th>
                                                    <th>课程订单数量</th>
													<th>展示内容</th>
													<th>价格</th>
													<th>操作</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
                                	</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>

            <div id="addModal" pid="" class="modal fade" tabindex="-1" role="dialog">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">添加新eclass套餐</h4>
			      		</div>
			      		<div class="modal-body">
			      			<div class="row">
				        		<div class="form-group row" style="margin-bottom: 20px;">
		                            <div class="col-md-2" style="text-align: right;">
		                                <label for="tcName">套餐名称</label>
		                            </div>
		                            <div class="col-md-10">
		                                <input type="text" name="tcName" id="tcName" class="form-control">
		                                <span class="error" id="tc_name_error"></span>
		                            </div>
	                        	</div>
	                        	<div class="form-group row">
		                            <div class="col-md-2" style="text-align: right;">
		                                <label for="tcPrice">套餐价格</label>
		                            </div>
		                            <div class="col-md-10">
		                                <input type="text" name="tcPrice" id="tcPrice" class="form-control">
		                                <span class="error" id="tc_price_error"></span>
		                            </div>
	                        	</div>
                                <div class="form-group row">
                                    <div class="col-md-2" style="text-align: right;">
                                        <label for="tcNumber">课时数量</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="number" name="tcNumber" id="tcNumber" required class="form-control">
                                        <span class="error" id="tc_number_error"></span>
                                    </div>
                                </div>
                        	</div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="addBtn">确认添加</button>
				        	<button type="button" class="btn btn-primary" id="editBtn">确认修改</button>
				      	</div>
			    	</div><!-- /.modal-content -->
			  	</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){

        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    })
</script>
@endsection