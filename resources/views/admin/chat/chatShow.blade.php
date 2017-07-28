@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">用户沟通</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	沟通用户列表
                                </h3>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <form id="search_form" action="/admin/eclassOrderList" method="get" style="display: none;">
                                    <div class="row m-b-15">
                                        <div class="form-group">
                                            <label class="col-md-1 clh text-right">订单编号:</label>
                                            <div class="col-md-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-15">
                                        <div class="col-md-2 col-md-offset-1">
                                            <button type="submit" class="btn btn-info w-md">查询</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button onclick="window.location.href='/admin/eclassOrderList'" type="button" class="btn btn-default w-md">重置查询条件</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row" style="overflow-x: scroll;">
                                        <div class="col-md-12" style="min-width: 1300px;">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th><!-- parent_info -->
                                                        <th>昵称</th>
                                                        <th>姓名</th>
                                                        <th>手机号</th>
                                                        <th>未读消息</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 条记录</div>
                                        </div>
                                        <div class="col-md-8">
                                            
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
</script>
@endsection