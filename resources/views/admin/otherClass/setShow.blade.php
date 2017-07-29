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
                    <h3 class="title">设置套餐展示页面</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase" style="font-size: 24px;position: relative;top: 11px;margin-right: 40px;">
                                    {{$package->name}}
                                </h3>&nbsp;
                                <a href="/admin/otherClass/add"><button class="btn btn-primary" style="display: inline-block;">返回上一级</button></a>
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
                                    <div class="row" style="margin-bottom: 13px;">
                                        <div class="col-md-7">
                                	       <button class="btn btn-success" id="seeResult">点我右侧预览效果</button>
                                        </div>
                                        <div class="col-md-5">
                                           <button class="btn btn-success" id="saveResult">保存</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7" style="">
                                            <script id="container" name="content" type="text/plain">{!!$package->show!!}</script>
                                        </div>
                                        <div class="col-md-5" style="padding: 0px;max-width: 400px;min-height: 300px;max-height: 800px;overflow-y: scroll;border: 1px solid #F0F;" id="showResult">{!!$package->show!!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>

            <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">添加新eclass套餐</h4>
			      		</div>
			      		<div class="modal-body">
			      			<div class="row">

                        	</div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				        	<button type="button" class="btn btn-primary" id="addBtn">确认添加</button>
				      	</div>
			    	</div><!-- /.modal-content -->
			  	</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<!-- 加载编辑器的容器 -->
<!-- 配置文件 -->
<script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        initialFrameHeight:450,//设置编辑器高度
        scaleEnabled:true//设置不自动调整高度
    });
    // ue.ready(function(){
    //     ue.setHeight(450);
    // })

    $('#seeResult').click(function(){
        $('#showResult').html(ue.getContent());
    })

    /*保存*/
    $('#saveResult').click(function(){
        var html = $('#showResult').html();
        if ( html!= '') {
            $.ajax({
                url: '/admin/otherClass/add/setShowPost',
                dataType: 'json',
                type: 'post',
                data: {
                    id: '{{$package->id}}',
                    html: html
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.msg('设置成功');
                        $('#tcName').val('');
                        $('#tcPrice').val('');
                        $('#addModal').modal('hide');
                        $('#tcTable').show();
                    } else {
                        window.layer.msg('设置失败');
                    }
                },
                error: function(){
                    window.layer.msg('设置失败');
                }
            });
        }
    })
</script>
<script type="text/javascript">
    $(function(){

        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    })
</script>
@endsection