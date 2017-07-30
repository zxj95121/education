@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
	.label-primary{
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
								    <div class="table-responsive">
								        <table class="table" id="parentDetail">
								            <thead>
								                <tr>
								                    <th>昵称</th>
								                    <th>姓名</th>
								                    <th>手机号</th>
								                    <th>性别</th>
								                    <th>类别</th>
								                    <th>住宅小区</th>
								                    <th>单元楼层</th>
								                    <th>操作</th>
								                </tr>
								            </thead>
								            <tbody>
								                @foreach($res as $value)
								                <tr pid="{{$value->id}}">
								                    <td>{{$value->nickname}}</td>
								                    <td>{{$value->name}}</td>
								                    <td>{{$value->phone}}</td>
								                    <td>
								                        @if($value->sex)
								                       	父亲
								                       	@else
								                       	母亲
								                       	@endif
								                    </td>
								                    <td>
								                    	@if($value->type == 1)
								                    	家长类别
								                    	@else
								                    	辅导机构
								                    	@endif
								                    </td>
								                    <td>{{$value->address}}</td>
								                    <td>{{$value->place}}</td>
								                    <td><span class="label label-primary" onclick="deleteParent({{$value->id}});">删除用户</span></td>
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
								            {{ $res->links() }}
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
<script type="text/javascript">
	$(function(){
	    layui.use('layer', function(){
	        window.layer = layui.layer;
	    });

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