@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .edit, .delete{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">班级管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	班级列表
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
                                    <div class="row" style="margin-bottom: 13px;padding-left: 10px;">
                                        <button id="addbanji" class="btn btn-success" data-toggle="modal" data-target="#modal1">添加班级 <span class="glyphicon glyphicon-plus"></span></button>
                                    </div>
                                    <div class="row" id="classList">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>ID</td>
                                                    <td>名称</td>
                                                    <td>操作</td>
                                                </tr>
                                            </thead>
                                            <tbody id="classListTbody">
                                                @foreach($banji as $value)
                                                <tr bid="{{$value->id}}">
                                                    <td class="h4">{{$value->id}}</td>
                                                    <td class="h4">{{$value->name}}</td>
                                                    <td>
                                                        <span class="label label-info edit">修改</span>
                                                        <span class="label label-info delete">删除</span>
                                                    </td>
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

            <!-- 班级新增 modal  -->
            <div id="modal1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="" style="font-weight: bold;"><font><font id="bttitle">添加班级</font></font></h4>
                        </div>
                        <div class="modal-body"><font><font>
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label class="control-label" style="margin-top: 7px;"><font><font>班级名称&nbsp;:</font></font></label> 
                                        <input type="text" id="BName" class="form-control" placeholder=""> 
                                    </div> 
                                </div> 
                            </div>
                        </font></font></div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关</font></font></button> 
                            <button type="button" id="baocun" class="btn btn-info"><font><font>确认添加</font></font></button> 
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>    


            <!-- 修改班级名称 modal  -->
            <div id="modal2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="" style="font-weight: bold;"><font><font id="bttitle">修改班级</font></font></h4>
                        </div>
                        <div class="modal-body"><font><font>
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label class="control-label" style="margin-top: 7px;"><font><font>班级名称&nbsp;:</font></font></label> 
                                        <input type="text" id="BName2" class="form-control" placeholder=""> 
                                    </div> 
                                </div>
                            </div>
                        </font></font></div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关</font></font></button> 
                            <button type="button" id="baocun2" class="btn btn-info"><font><font>确认修改</font></font></button> 
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


        $('#baocun').click(function(){
            var name = $('#BName').val();
            if (name == '') {
                window.layer.msg('名称不能为空');
                return false;
            }
            $.ajax({
                url: '/admin/classSetting/add',
                dataType: 'json',
                type: 'post',
                data: {
                    name: name
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.msg('添加成功');
                        $('#classListTbody').append('<tr bid="'+data.id+'"> <td class="h4">'+data.id+'</td> <td class="h4">'+name+' </td> <td> <span class="label label-info edit">修改</span> <span class="label label-info delete">删除</span> </td> </tr>');
                        $('#modal1').modal('hide');
                    }
                }
            })
        })

        $(document).on('click', '.edit', function(){
            var id = $(this).parents('tr').attr('bid');
            var name = $(this).parents('tr').find('td:eq(1)').html();

            $('#modal2').modal('show');
            $('#modal2').attr('bid', id);
            $('#BName2').val(name);
        })

        $('#baocun2').click(function(){
            var id = $('#modal2').attr('bid');
            var name = $('#BName2').val();
            if (name == '') {
                window.layer.msg('名称不能为空');
                return false;
            }
            $.ajax({
                url: '/admin/classSetting/edit',
                dataType: 'json',
                type: 'post',
                data: {
                    id: id,
                    name: name
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.msg('修改成功');
                        $('#classListTbody tr[bid="'+id+'"]').find('td:eq(1)').html(name);
                        $('#modal2').modal('hide');
                    }
                }
            })
        })

        $(document).on('click', '.delete', function(data){
            var id = $(this).parents('tr').attr('bid');
            var name = $(this).parents('tr').find('td:eq(1)').html();

            window.layer.confirm('确认删除班级<b>'+name+'</b>吗？', {
                btn: ['确认', '取消'] //可以无限个按钮
                ,btn2: function(index, layero){
                window.layer.close(index);
              }
            }, function(index, layero){
                window.layer.close(index);
                var loadIndex = window.layer.load(2, {time:5000});
                $.ajax({
                    url: '/admin/classSetting/delete',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.layer.close(loadIndex);
                            window.layer.msg('删除成功！');
                            $('#classListTbody tr[bid="'+id+'"]').remove();
                        }
                    }
                });
            });
        })
    });
</script>
@endsection