@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
	.label-primary,.addTicketBtn{
		cursor: pointer;
	}
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">家长信息</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="portlet"><!-- /primary heading -->
							<div class="portlet-heading">
								<h3 class="portlet-title text-dark text-uppercase">
								    家长信息列表
								</h3>
								<div class="portlet-widgets">
								    <span class="divider"></span>
								    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
								    <span class="divider"></span>
								    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
								</div>
								<div class="clearfix"></div>
								</div>
								<div class="panel-collapse collapse in">
								<div class="portlet-body">
									<!-- search FORM -->
									<form id="search_form" action="/admin/parentInfo" method="get">
	                                    <input type="hidden" name="_token" value="8o0WCWkZVQQlILo6nNqy8G0GOC2Toii1z5HAfOjH">
	                                    <div class="row m-b-15">
	                                        <div class="form-group">
	                                            <label class="col-md-1 clh text-right">手机号:</label>
	                                            <div class="col-md-3">
	                                                <input type="number" name="tel" id="tel" class="form-control" placeholder="根据手机号查询" @if($req['tel']) value="{{$req['tel']}}" @else @endif>
	                                            </div>

	                                            <label class="col-md-1 clh text-right">家长姓名:</label>
	                                            <div class="col-md-3">
	                                                <input type="text" name="name" id="name" class="form-control" placeholder="根据姓名查询" @if($req['name']) value="{{$req['name']}}" @else @endif>
	                                            </div>

	                                            <label class="col-md-1 clh text-right">用户昵称:</label>
	                                            <div class="col-md-3">
	                                                <input type="text" name="nickname" id="nickname" class="form-control" placeholder="根据昵称查询" @if($req['nickname']) value="{{$req['nickname']}}" @else @endif>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="row m-t-15">
	                                        <div class="col-md-2 col-md-offset-1">
	                                            <button type="submit" class="btn btn-info w-md">查询</button>
	                                        </div>
	                                        <div class="col-md-2">
	                                            <button onclick="window.location.href='/admin/parentInfo'" type="button" class="btn btn-default w-md">重置查询条件</button>
	                                        </div>
	                                    </div>
	                                </form>

	                                <!-- search Form over -->
								    <div class="table-responsive" style="margin-top: 15px;">
								        <table class="table" id="parentDetail">
								            <thead>
								                <tr>
								                    <th>昵称</th>
								                    <th>姓名</th>
								                    <th>手机号</th>
								                    <th>身份</th>
								                    <th>类别</th>
								                    <th>优惠券余额</th>
								                    <th>住宅小区</th>
								                    <th>单元楼层</th>
								                    <th>操作</th>
								                </tr>
								            </thead>
								            <tbody>
								                @foreach($res as $value)
								                <tr pid="{{$value->id}}" userId="{{$value->userId}}">
								                    <td>{{$value->nickname}}</td>
								                    <td>{{$value->name}}</td>
								                    <td>{{$value->phone}}</td>
								                    <td>
								                        @if($value->sex == 0) 母亲
								                       	@elseif ($value->sex == 1)	父亲
								                       	@elseif ($value->sex == 2)	爷爷
								                       	@elseif ($value->sex == 3)	奶奶
								                       	@elseif ($value->sex == 4)	外公
								                       	@elseif ($value->sex == 5)	外婆
								                       	@endif
								                    </td>
								                    <td>
								                    	@if($value->type == 1)
								                    	学生家长
								                    	@else
								                    	辅导机构
								                    	@endif
								                    </td>
								                    <td class="voucherTd">
								                    	{{$value->voucher}}
								                    </td>
								                    <td>{{$value->address}}</td>
								                    <td>{{$value->place}}</td>
								                    <td>
								                    	<span class="label label-info addTicketBtn">增加优惠券</span>
								                    	<span class="label label-primary" onclick="deleteParent({{$value->id}});">删除用户</span>
								                    </td>
								                </tr>
								                @endforeach
								            </tbody>
								        </table>
								    </div>
								    <div class="row">
								        <div class="col-sm-6">
								            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共{{$res->total()}}条记录</div>
								        </div>
								         <div class="col-sm-6">
								            {{ $res->appends($req)->links() }}
								        </div> 
								    </div>
								</div>
							</div>
                        </div>
						
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>



            <div id="modal1" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="mySmallModalLabel" style="font-weight: bold;"><font><font id="bttitle">添加优惠券</font></font></h4>
                        </div>
                        <div class="modal-body">
                        	<div class="row">
	                        	<div class="form-group">
	                        		<div class="col-md-3" style="text-align: right;">
							    		<label>张三</label>
							    	</div>
					        		<div class="col-md-9">
					        			<span class="form-control">123234121</span>
					        		</div>
	                        	</div>
	                        </div>
	                       	<div class="row">
							    <div class="form-group" style="margin-top:13px;">
							    	<div class="col-md-3" style="text-align: right;">
							    		<label for="ticketNumInput">优惠券数量</label>
							    	</div>
					        		<div class="col-md-9">
					        			<input type="number" min="1" value="1" id="ticketNumInput" name="ticketNumInput" class="form-control">
					        		</div>
					        	</div>
					        </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关闭</font></font></button> 
                            <button type="button" class="btn btn-info" id="saveTicket"><font><font>确认添加</font></font></button> 
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
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


	    $(document).on('click', '.addTicketBtn', function(){
	    	$('#modal1').modal('show');
	    	var userId = $(this).parents('tr').attr('userId');
	    	$('#modal1').attr('userId', userId);
	    })


	    $('#saveTicket').click(function(){
	    	/*saveTicket*/
	    	var id = $('#modal1').attr('userId');
	    	$.ajax({
	    		url: '/admin/parent/addTicket',
				type: 'post',
				dataType: 'json',
				data: {
					id: id,
					num: $('#ticketNumInput').val()
				},
				success: function(data){
					if (data.errcode == 0) {
						window.layer.msg('添加成功');
						$('#modal1').modal('hide');
						$('#parentDetail tr[userId="'+id+'"]').find('.voucherTd').html(data.voucher);
					}
				}
	    	})
	    })

	})

	function deleteParent(id) {
		window.layer.confirm('确认<b style="color:green;">删除</b>吗，ID为'+id+'？', {
            btn: ['确认', '取消'] //可以无限个按钮
            ,btn2: function(index, layero){
            window.layer.close(index);
          }
        }, function(index, layero){
			$.ajax({
				url: '/admin/manage/deleteParent',
				type: 'post',
				dataType: 'json',
				data: {
					id: id
				},
				success: function(data){
					if (data.errcode == 0) {
						window.layer.msg('删除成功');
						$('#parentDetail tr[pid="'+id+'"]').remove();
					}
				}
			})
		})
	}
</script>
@endsection