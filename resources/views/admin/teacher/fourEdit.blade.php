@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style>
	.text-uppercase .ion-chevron-right{
		margin-left: 5px;
		margin-right:5px;
	}
</style>
@endsection
@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">添加双师Class</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	<a href="/admin/doubleTeacher">双师class</a><i class="ion-chevron-right"></i>
                                    	<a href="/admin/teachertwo?pid={{$two['pid']}}">{{$one['name']}}</a><i class="ion-chevron-right"></i>
                                    	<a href="/admin/teacherthree?pid={{$three['pid']}}">{{$two['name']}}</a><i class="ion-chevron-right"></i>
                                    	{{$three['name']}}
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
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                   							<div class="panel-body">
				                                <form role="form" class="p-20">
				                                    <div class="form-group">
				                                        <label for="text"><font><font>名称</font></font></label>
				                                        <input type="input" class="form-control" id="text" placeholder="名称" value="{{$res->name}}">
				                                    </div>
				                                    <div class="form-group">
				                                    	<input type="hidden" id="id" value="{{$res->id}}">
				                                    	<button id="fanhui" type="submit" class="btn btn-default"><font><font>返回</font></font></button>
				                                    	<button id="edit" type="submit" class="btn btn-success"><font><font>确认修改</font></font></button>
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
<script>
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
		$('#fanhui').click(function(){
			window.history.go(-1);
			return false;
		})
		$('#edit').click(function(){
   			$.ajax({
    			url:"{{URL('admin/teacherfour/edit_post')}}",
    			data:{
    				text:$('#text').val(),
    				id:$('#id').val()
    			},
    			type:'post',
    			datatype:'json',
    			success:function(date){
    				if(date.code == 200){
						window.layer.msg('修改成功');
						window.location.href="/admin/teacherfour?pid="+date.pid;
            		}else{
						window.layer.msg('添加失败，请重新添加');
                	}
    			}
            })  	
            return false; 
		})
	})
</script>
@endsection