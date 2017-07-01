@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .oReview{
        cursor: pointer
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">学校申请审核</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	学校申请列表
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
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Responsive Table</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>学校名称</th>
                                                                            <th>状态</th>
                                                                            <th>提示</th>
                                                                            <th>申请人昵称</th>
                                                                            <th>真实姓名</th>
                                                                            <th>联系电话</th>
                                                                            <th>申请时间</th>
                                                                            <th>操作</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($schoolInfo as $value)
                                                                        <tr>
                                                                            <td class="tdId">{{$value['id']}}</td>
                                                                            <td class="tdName">{{$value['schoolName']}}</td>
                                                                            <td>
                                                                                @if($value['status'] == 0)
                                                                                    <span class="label label-default">待审核</span>
                                                                                @elseif($value['status'] == 1)
                                                                                    <span class="label label-success">审核通过</span>
                                                                                @else
                                                                                    <span class="label label-danger">未通过审核</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($value['explain'] == 0)
                                                                                    <span class="label label-info">系统暂无</span>
                                                                                @else
                                                                                    <span class="label label-danger">系统已有</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>{{$value['nickname']}}</td>
                                                                            <td>{{$value['name']}}</td>
                                                                            <td>{{$value['phone']}}</td>
                                                                            <td>{{$value['time']}}</td>
                                                                            <td>
                                                                                @if($value['status'] == 0)
                                                                                <span class="label label-primary oReview reviewOk" data-toggle="modal" data-target="#selectSchoolOne">通过审核</span>
                                                                                <span class="label label-primary oReview reviewFalse">驳回审核</span>
                                                                                @else
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>



            <!-- 学科分类新增 modal  -->
            <div id="modal1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="mySmallModalLabel" style="font-weight: bold;"><font><font id="bttitle">添加爱好特长</font></font></h4>
                        </div>
                        <div class="modal-body"><font><font>
                            <div class="row"> 
                                <div class="col-md-12">
                                </div> 
                            </div>
                        </font></font></div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关</font></font></button> 
                            <button type="button" id="addNewHobbyBtn" class="btn btn-info" id="baocun1"><font><font>确认添加</font></font></button> 
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>    


            <div id="selectSchoolOne" cid="" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" style="font-weight: bold;font-size: 22px;">通过学校申请</h2>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>选择该学校分类</label>
                                        <select class="form-control" id="schoolType">
                                            @foreach($schoolOneInfo as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <p style="font-size:13px;margin-top:12px;text-decoration: underline;cursor: pointer;" onclick="window.location.href='/admin/schoolManage';">找不到所属分类？点击前往新增</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="schoolAdd">确认添加</button>
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
    });

    $(function(){
        /*驳回审核*/
        $(document).on('click', '.reviewFalse', function(){
            var id = $(this).parents('tr').find('.tdId').html();
            window.layer.confirm('确认驳回申请吗?', {
                btn: ['确认','取消']
                ,btn2: function(index, layero){
                    window.layer.close(index);
                }
            }, function(index, layero){
                window.layer.close(index);
                var loadIndex = window.layer.load(2, {time: 5000});
                $.ajax({
                    url: '/admin/applySchool/failed',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.errcode == '0') {
                            window.layer.close(loadIndex);
                            window.layer.msg('驳回成功!');
                            window.location.reload();
                        }
                    }
                });
            });
        });

        /*通过申请*/
        $(document).on('click', '.reviewOk', function(){
            var id = $(this).parents('tr').find('.tdId').html();
            var name = $(this).parents('tr').find('.tdName').html();
            $('#selectSchoolOne .modal-title').html(name);
            $('#selectSchoolOne').attr('cid', id);
        });

        $('#schoolAdd').click(function(){
            var name = $('#selectSchoolOne .modal-title').html();
            var id = $('#schoolType option:selected').val();
            var cid = $('#selectSchoolOne').attr('cid');
            $('#selectSchoolOne').modal('hide');
            var loadIndex = window.layer.load(2, {time: 5000});

            $.ajax({
                url: '/admin/applySchool/success',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    cid: cid,
                    name: name
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.close(loadIndex);
                        window.layer.msg('添加成功');
                        window.location.reload();
                    }
                }
            })
        });

        $('#selectSchoolOne').on('hidden.bs.modal', function (e) {
            $('#schoolType option:selected').removeProp('selected');
        })
    })
</script>
@endsection