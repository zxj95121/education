@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
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
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
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
                                                    @if($manageInfo->identity == 1)
                                                    <th>操作</th>
                                                    @else
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($adminInfo as $value)
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->nickname}}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->phone}}</td>
                                                    <td>
                                                        @if($value->status == 1)

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
                                                    @if($manageInfo->identity == 1)
                                                    <td class="operate">
                                                        @if($value->status == 1)
                                                            <span class="label label-info delete">禁用</span>
                                                        @else
                                                            <span class="label label-info open">启用</span>
                                                        @endif
                                                    </td>
                                                    @else
                                                    @endif
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
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){

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
    })
</script>
@endsection