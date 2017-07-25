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
                    <h3 class="title">class课程套餐</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    添加class课程
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
                                	<button class="btn btn-success" data-toggle="modal" data-target="#addModal">添加新class套餐 <span class="glyphicon glyphicon-plus"></span></button><br>
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
												@foreach($package as $value)
												<tr pid="{{$value->id}}">
													<td>{{$value->id}}</td>
													<td class="td_tcName">{{$value->name}}</td>
                                                    <td class="td_tcNumber">{{$value->number}}</td>
                                                    <td class="td_tcOrderCount">{{$value->order_count}}</td>
													<td>@if($value->show) <span class="label label-success seeShow">查看详情</span> @else <span class="label label-info setShow">立即设置</span> @endif</td>
													<td class="td_tcPrice">¥ {{number_format($value->price, 2)}}</td>
													<td><span class="label label-primary edit">修改</span>　　<span class="label label-primary delete">删除</span>　　<span class="label label-primary seeOrder">查看订单</span>　　<span class="label label-primary copySpan" url="http://{{$SERVER_NAME}}/front/classPackage?id={{$value->id}}">复制网址</span></td>
												</tr>
												@endforeach
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
<script type="text/javascript" src="/js/clipboard/ZeroClipboard.min.js"></script>
<script type="text/javascript">
    $(function(){

         $('[data-toggle="tooltip"]').tooltip();

        layui.use('layer', function(){
            window.layer = layui.layer;
        });

        if ($('#tcTable tbody tr').length == 0) {
        	$('#tcTable').hide();
        }

        $('#addBtn').click(function(){
        	var tcName = $('#tcName').val();
        	var tcPrice = $('#tcPrice').val();
            var tcNumber = $('#tcNumber').val();
        	var temp = 0;
        	var reg = /^(\d{1,8})(\.\d{1,2})?$/;
        	if ( !reg.test(tcPrice) ) {
        		$('#tc_price_error').html('价格格式不正确');
        		temp = 1;
        	}
        	if ( tcName == '' ) {
        		$('#tc_name_error').html('名称不能为空');
        		temp = 1;
        	}
            if (tcNumber == '') {
                $('#tc_number_error').html('课时数量不能为空');
                temp = 1;
            }
        	if (temp == 1)
        		return;

        	/*发送ajax*/
        	$.ajax({
        		url: '/admin/otherClass/add/addPost',
        		dataType: 'json',
        		type: 'post',
        		data: {
        			name: tcName,
        			price: tcPrice,
                    number: tcNumber
        		},
        		success: function(data) {
        			if (data.errcode == 0) {
        				window.layer.msg('添加成功');
        				$('#tcName').val('');
        				$('#tcPrice').val('');
        				$('#addModal').modal('hide');
        				$('#tcTable').show();
        			} else {
        				window.layer.msg('添加失败');
        			}
        		},
        		error: function(){
        			window.layer.msg('添加失败');
        		}
        	})
        })


        $('#editBtn').click(function(){
            var tcName = $('#tcName').val();
            var tcPrice = $('#tcPrice').val();
            var tcNumber = $('#tcNumber').val();
            var temp = 0;
            var reg = /^(\d{1,8})(\.\d{1,2})?$/;
            if ( !reg.test(tcPrice) ) {
                $('#tc_price_error').html('价格格式不正确');
                temp = 1;
            }
            if ( tcName == '' ) {
                $('#tc_name_error').html('名称不能为空');
                temp = 1;
            }
            if (tcNumber == '') {
                $('#tc_number_error').html('课时数量不能为空');
                temp = 1;
            }

            if (temp == 1)
                return;

            /*发送ajax*/
            $.ajax({
                url: '/admin/otherClass/add/editPost',
                dataType: 'json',
                type: 'post',
                data: {
                    name: tcName,
                    price: tcPrice,
                    number: tcNumber,
                    id: $('#addModal').attr('pid')
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.msg('修改成功');
                        $('#tcName').val('');
                        $('#tcPrice').val('');
                        
                        var cdom = $('#tcTable tr[pid="'+$('#addModal').attr('pid')+'"]');
                        cdom.find('.td_tcName').html(tcName);
                        cdom.find('.td_tcNumber').html(tcNumber);
                        cdom.find('.td_tcPrice').html('¥ '+tcPrice);

                        $('#addModal').modal('hide');
                        $('#tcTable').show();
                    } else {
                        window.layer.msg('修改失败');
                    }
                },
                error: function(){
                    window.layer.msg('修改失败');
                }
            })
        })


        $('#tcName').focus(function(){
        	$('#tc_name_error').html('');
        })
        $('#tcPrice').focus(function(){
        	$('#tc_price_error').html('');
        })


        $(document).on('click', '.setShow', function(){
        	var pid = $(this).parents('tr').attr('pid');
        	window.location.href = '/admin/otherClass/add/setShow?pid='+pid;
        })
        $(document).on('click', '.seeShow', function(){
            var pid = $(this).parents('tr').attr('pid');
            window.location.href = '/admin/otherClass/add/setShow?pid='+pid;
        })

        $(document).on('click', '.delete', function(){
            var pid = $(this).parents('tr').attr('pid');
            var cdom = $(this).parents('tr');
            window.layer.confirm('确认删除吗？', {
                btn: ['确认', '取消']
                ,btn3: function(index, layero){
                    window.layer.close(index);
                }
            }, function(index, layero){
                $.ajax({
                    url: '/admin/otherClass/add/delete',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: pid
                    },
                    success: function(data) {
                        if (data.errcode == '0') {
                            if (cdom.parent().find('tr').length <= 1)
                                cdom.parents('table').css('display', 'none');
                            cdom.remove(); 
                            window.layer.close(index);
                        }
                    }
                })
            });
        });


        $(document).on('click', '.edit', function(){
            var cdom = $(this).parents('tr');
            var pid = cdom.attr('pid');

            var tcName = cdom.find('.td_tcName').html();
            var tcNumber = cdom.find('.td_tcNumber').html();
            var tcPrice = parseFloat(cdom.find('.td_tcPrice').html().split(' ')[1]);

            $('#addModal').attr('pid', pid);

            $('#tcName').val(tcName);
            $('#tcNumber').val(tcNumber);
            $('#tcPrice').val(tcPrice);

            $('#addModal .modal-title').html('修改class套餐');
            $('#addModal').modal('show');
        })

        $('#addModal').on('show.bs.modal', function (e) {
            var pid = $('#addModal').attr('pid');
            if ( pid != '') {
                $('#editBtn').css('display', 'inline-block');
                $('#addBtn').css('display', 'none');
            } else {
                $('#addBtn').css('display', 'none');
                $('#editBtn').css('display', 'inline-block');
            }
        })

        $('#addModal').on('hide.bs.modal', function (e) {
            $('#addModal').attr('pid', '');
            $('#addModal .modal-title').html('添加新eclass套餐');
        })


         ZeroClipboard.config( { swfPath: 'http://{{$SERVER_NAME}}/js/clipboard/ZeroClipboard.swf' } );
            
        var doms = $('.copySpan');
        var clip = new ZeroClipboard( doms );


        $(document).on('click', '.copySpan', function(){
            /*复制到剪切板*/
            
            $(this).tooltip({'title':'已复制'});
            $(this).tooltip('show');
        })

        $(document).on('mouseleave', '.copySpan', function(){
            $(this).tooltip('destroy');
            clip.off();
            // $(this).toolt$(this).tooltip({'title':'点我复制'});
        })

        $(document).on('mouseover', '.copySpan', function(){
            doms = $(this);
            clip = new ZeroClipboard( doms );
            clip.setText($(this).attr('url'));
        })

    });
</script>
@endsection