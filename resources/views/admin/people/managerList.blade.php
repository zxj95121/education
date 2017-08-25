@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link href="/admin/assets/toggles/toggles.css" rel="stylesheet" />
<style type="text/css">
    .operate span{
        cursor: pointer;
    }
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">管理员管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    管理员列表
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>昵称</th>
                                                    <th>姓名</th>
                                                    <th>手机号</th>
                                                    <th>状态</th>
                                                    <th>登录次数</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($adminInfo as $value)
                                                <tr>
                                                    <td>{{$value->aid}}</td>
                                                    <td>{{$value->nickname}}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->phone}}</td>
                                                    <td>
                                                        @if($value->aStatus == 1)

                                                            <span class="label label-success status">可用</span>
                                                        @else
                                                            <span class="label label-warning status">已禁用</span>
                                                        @endif
                                                        　
                                                        @if($value->identity == 1)
                                                            <span class="label label-success identity">超级管理员</span>
                                                        @else
                                                            <span class="label label-primary identity">普通管理员</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$value->count}}</td>
                                                    
                                                    <td class="operate">
                                                        @if($manageInfo->identity == 1)
                                                            @if($value->aStatus == 1)
                                                                <span class="label label-info delete">禁用</span>
                                                            @else
                                                                <span class="label label-info open">启用</span>
                                                            @endif

                                                        @else
                                                        @endif
                                                        @if($powerInfo->set_power == '1')
                                                        <span class="label label-info setPowerLabel">设置管理权限</span>
                                                        @else
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$adminInfo->total()}}条记录</div>
                                        </div>
                                        <div class="col-sm-6">
                                            {{ $adminInfo->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>


            <div id="setModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">设置管理员权限</h4>
                        </div>
                        <div class="modal-body" style="min-height: 150px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">设置权限的权限</label>
                                        <div class="col-sm-6 control-label">
                                            <div class="toggle toggle-success toggle_power" power="set_power" style="height: 20px; width: 50px;">
                                                <div class="toggle-slide">
                                                    <div class="toggle-inner" style="width: 80px; margin-left: 0px;">
                                                        <div class="toggle-on" style="height: 20px; width: 40px; text-align: center; text-indent: -10px; line-height: 20px;">
                                                            ON
                                                        </div>
                                                        <div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;">
                                                            
                                                        </div>
                                                        <div class="toggle-off" style="height: 20px; width: 40px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">
                                                            OFF
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">用户沟通权限</label>
                                        <div class="col-sm-6 control-label">
                                            <div class="toggle toggle-success toggle_power" power="chat" style="height: 20px; width: 50px;">
                                                <div class="toggle-slide">
                                                    <div class="toggle-inner" style="width: 80px; margin-left: 0px;">
                                                        <div class="toggle-on" style="height: 20px; width: 40px; text-align: center; text-indent: -10px; line-height: 20px;">
                                                            ON
                                                        </div>
                                                        <div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;">
                                                            
                                                        </div>
                                                        <div class="toggle-off" style="height: 20px; width: 40px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">
                                                            OFF
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6" style="margin-top: 10px;">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">订单改价权限</label>
                                        <div class="col-sm-6 control-label">
                                            <div class="toggle toggle-success toggle_power" power="modify_price" style="height: 20px; width: 50px;">
                                                <div class="toggle-slide">
                                                    <div class="toggle-inner" style="width: 80px; margin-left: 0px;">
                                                        <div class="toggle-on" style="height: 20px; width: 40px; text-align: center; text-indent: -10px; line-height: 20px;">
                                                            ON
                                                        </div>
                                                        <div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;">
                                                            
                                                        </div>
                                                        <div class="toggle-off" style="height: 20px; width: 40px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">
                                                            OFF
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                            <button type="button" class="btn btn-primary" onclick="ajaxPower();">保存设置</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/admin/assets/toggles/toggles.min.js"></script>
<script type="text/javascript">
    // jQuery('.toggle').toggles({on: false});

    $(function(){
        power = eval('({!!$power!!})');
        // console.log(power);

        layui.use('layer', function(){
            window.layer = layui.layer;
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).parents('tr').find('td:eq(0)').html();
            var cdom = $(this).parents('tr');
            var ccdom = $(this);
            $.ajax({
                url: '/admin/managerRemove',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data){
                    if (data.errcode == 0) {
                        window.layer.msg('禁用成功');
                        cdom.find('.status').replaceWith('<span class="label label-warning status">已禁用</span>');
                        ccdom.replaceWith('<span class="label label-info open">启用</span>');
                    } else if (data.errcode == 1) {
                        window.layer.msg('禁用失败，自己不能禁用自己');
                    }
                }
            })
        })

        $(document).on('click', '.open', function(){
            var id = $(this).parents('tr').find('td:eq(0)').html();
            var cdom = $(this).parents('tr');
            var ccdom = $(this);
            $.ajax({
                url: '/admin/managerOpen',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data){
                    if (data.errcode == 0) {
                        window.layer.msg('启用成功');
                        cdom.find('.status').replaceWith('<span class="label label-success status">可用</span>');
                        ccdom.replaceWith('<span class="label label-info delete">禁用</span>');
                    }
                }
            })
        })

        $(document).on('click', '.setPowerLabel', function() {
            $('#setModal').modal('show');
            var id = $(this).parents('tr').find('td:eq(0)').html();

            $('#setModal').attr('uid', id);

            var obj = power[id];
            for (var i in obj) {
                if (obj[i]) {
                    jQuery('.toggle_power[power="'+i+'"]').toggles({on: true});
                } else {
                    jQuery('.toggle_power[power="'+i+'"]').toggles({on: false});
                }
            }
        })

    })

    function ajaxPower() {
        var id = $('#setModal').attr('uid');

        var data = new Object();
        $('.toggle_power').each(function() {
            var power = $(this).attr('power');
            var detail = $(this).find('.toggle-slide').hasClass('active');
            if (detail)
                data[power] = 1;
            else
                data[power] = 0;
        })

        $.ajax({
            url: '/admin/manage/setPower',
            type: 'post',
            dataType: 'json',
            data: {
                power: data,
                id: id
            },
            success: function(res) {
                if (res.errcode == 0) {
                    window.layer.msg('设置成功');
                    $('#setModal').modal('hide');
                    power[id] = data;
                    // window.location.reload();
                }
            }
        })
    }
</script>
@endsection