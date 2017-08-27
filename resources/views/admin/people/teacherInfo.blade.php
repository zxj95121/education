@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
	.identity:hover{
    	cursor:pointer;
    }
    .label-primary{
    	cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title">教师信息</h3> 
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
				            <table class="table" id="teacherDetail">
				                <thead>
				                    <tr>
				                        <th>昵称</th>
				                        <th>姓名</th>
				                        <th>手机号</th>
				                        <th>性别</th>
				                        <th>爱好特长</th>
				                        <th>擅长学科</th>
				                        <th>教师分类</th>
				                        <th>所学专业</th>
				                        <th>求职状态</th>
				                        <th>期望薪资</th>
				                        <th>期望教学社区</th>
				                        <th>操作</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach($res as $value)
				                    <tr tid="{{$value->id}}">
				                        <td>{{$value->nickname}}</td>
				                        <td class="tname">{{$value->name}}</td>
				                        <td>{{$value->phone}}</td>
				                        <td>
					                        @if($value->sex)
					                       	男
					                       	@else
					                       	女
					                       	@endif
				                        </td>
				                        <td>{{$value->aihao}}</td>
				                        <td>{{$value->subject}}</td>
				                        <td>
				                        	@if($value->type == 1)
					                       	学生教师
					                       	@else
					                       	职业教师
					                       	@endif
				                        </td>
				                        <td>{{$value->project}}</td>
				                        <td>
				                        	@if($value->find_status == 1)
				                        	兼职
				                        	@elseif($value->find_status==2)
				                        	全职
				                        	@else
				                        	暂不考虑求职
				                        	@endif
				                        </td>
				                        <td>{{$value->money}}</td>
				                        <td><span class="label label-info identity" tid="{{$value->id}}">查看</span></td>
				                        <!-- 
				                        <td><span class="label label-primary" onclick="deleteTeacher({{$value->id}});">删除用户</span></td>
				                         -->
				                    </tr>
				                    @endforeach
				                </tbody>
				            </table>
				        </div>

                        <!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header" style="border-bottom: 0px;padding-bottom: 0px; ">
						        <h4 class="modal-title" id="myModalLabel" style="font-size: 16px;"></h4>
						      </div>
						      <div class="modal-body" style="padding: 20px 0px 0px 0px;">
						      	<table class="table">
						      		<tbody>
							        </tbody>
						        </table>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						      </div>
						    </div>
						  </div>
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
<script>
	$(function(){
	    layui.use('layer', function(){
	        window.layer = layui.layer;
	    });
	})
	$('.identity').click(function(){
		var id = $(this).attr('tid'); 
		var tname = $(this).parents('tbody').find('.tname').text();
		$.ajax({
			url:'/admin/expect',
			data:{
					id:id
				},
			type:'post',
			datatype:'json',
			success:function(date){
				if(date.code == 200){
					var html = '';
					for(var i = 0; i < (date.res).length; i++){
						html += "<tr><td>"+date.res[i]+"</td></tr>";
					}
					$('#myModalLabel').html(tname+'期望教学社区');
					$('#myModal tbody').html(html);
					$('#myModal').modal('show');
				}else if(date.code == 233){
					window.layer.msg('该用户未填写期望教学社区'); 
				}
				
			}
		})
		
	})

	function deleteTeacher(id) {
		window.layer.confirm('确认<b style="color:green;">删除</b>吗，ID为'+id+'？', {
            btn: ['确认', '取消'] //可以无限个按钮
            ,btn2: function(index, layero){
            window.layer.close(index);
          }
        }, function(index, layero){
			$.ajax({
				url: '/admin/manage/deleteTeacher',
				type: 'post',
				dataType: 'json',
				data: {
					id: id
				},
				success: function(data){
					if (data.errcode == 0) {
						window.layer.msg('删除成功');
						$('#teacherDetail tr[tid="'+id+'"]').remove();
					}
				}
			})
		})
	}
</script>

@endsection