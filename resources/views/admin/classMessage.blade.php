@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link href="/admin/assets/toggles/toggles.css" rel="stylesheet" />
<style type="text/css">
    tbody .label{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">订单短信通知管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                   订单通知列表
                                </h3>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <button class="btn btn-success" style="margin-left: 20px;" data-toggle="modal" data-target="#addModal">添加手机号</button>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>手机号</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($res as $value)
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td class="phone">{{$value->phone}}</td>
                                                    <td>
                                                   		<span class="label label-primary myedit" vid="{{$value->id}}">修改</span>
                                                    	<span class="label label-default mydelete" vid="{{$value->id}}">删除</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$res->total()}}条记录</div>
                                        </div>
                                        <div class="col-sm-6">
                                            {{ $res->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>
			<!-- addModal -->
			<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">添加通知手机号</h4>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="recipient-name" class="control-label">手机号:</label>
									<input type="text" class="form-control" id="phone">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<button type="button" class="btn btn-primary" id="add">添加</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end addModal -->
			
			<!-- editModal -->
			<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">修改通知手机号</h4>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="recipient-name" class="control-label">手机号:</label>
									<input type="text" class="form-control" id="editphone">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<button type="button" class="btn btn-primary" id="editpost">确定修改</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end editModal -->
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">

    $(function(){
        var id = '';
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
        $('#add').click(function(){
            var phone = $('#phone').val();
			var reg = /^1\d{10}$/;
			if(!reg.test(phone)){
				layer.msg("手机号输入不正确");
				return false;
			}
            $.ajax({
    			url:'/admin/classMessage/add',
    			data:{
    				phone:phone
    			},
    			type:'post',
    			datatype:'json',
    			success:function(data){
    				if(data.code == 1){
    					$('#addModal').modal('hide');
    					layer.msg('添加完成');
    					setTimeout(function(){
    						window.location.href="/admin/classMessage/";
    					},2000)
    				}
    			}
            })
       	})
		$('.myedit').click(function(){
			id = $(this).attr('vid');
			var phone = $(this).parents('tr').find('.phone').text();
			$('#editphone').val(phone);
			$('#editModal').modal('show');
		})
		$('#editpost').click(function(){
            var phone = $('#phone').val();
			var reg = /^1\d{10}$/;
			if(!reg.test(phone)){
				layer.msg("手机号输入不正确");
				return false;
			}
		    $.ajax({
    			url:'/admin/classMessage/edit',
    			data:{
	    			id:id,
    				phone:$('#editphone').val(),
    			},
    			type:'post',
    			datatype:'json',
    			success:function(data){
    				if(data.code == 1){
    					$('#editModal').modal('hide');
    					layer.msg('修改完成');
    					setTimeout(function(){
    						window.location.href="/admin/classMessage/";
    					},2000)
    				}
    			}
	    	})
		})
		$('.mydelete').click(function(){
			id = $(this).attr('vid');
		     $.ajax({
	    			url:'/admin/classMessage/delete',
	    			data:{
		    			id:id
	    			},
	    			type:'post',
	    			datatype:'json',
	    			success:function(data){
	    				if(data.code == 1){
	    					layer.msg('删除完成');
	    					setTimeout(function(){
	    						window.location.href="/admin/classMessage/";
	    					},2000)
	    				}
	    			}
	            })
		})
    })
</script>
@endsection