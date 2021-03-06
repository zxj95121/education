@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .badge{
        background: #D9534F;
    }
    table th,td{
        text-align: center;
    }
    label{
        cursor: pointer;
    }
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
                                <form id="search_form" action="/admin/chatShow" method="get">
                                    <div class="row m-b-15">
                                        <div class="form-group">
                                            <label class="col-md-1 clh text-right">消息阅读:</label>
                                            <div class="col-md-3">
                                                <select id="readSelect" class="form-control" name="read">
                                                    <option value="0" @if($read) @else selected="selected" @endif>未读</option>
                                                    <option value="1" @if($read) selected="selected" @else @endif>全部</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-15">
                                        <div class="col-md-2 col-md-offset-1">
                                            <button type="submit" class="btn btn-info w-md">查询</button>
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
                                                        <th>身份</th>
                                                        <th>昵称</th>
                                                        <th>手机号</th>
                                                        <th>未读消息</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($chatUser as $key => $value)
                                                    @if($value['id'])
                                                    <tr uid="{{$value['id']}}">
                                                        <td>{{$value['id']}}</td>
                                                        <td>@if($value['type']) <span class="label label-success">系统用户</span>@else <span class="label label-info">未注册用户</span> @endif</td>
                                                        <td>{{$value['nickname']}}</td>
                                                        <td>{{$value['phone']}}</td>
                                                        <td>@if($numArr[$key])<span class="badge">{{$numArr[$key]}}</span>@else 0 @endif</td>
                                                        <td><label class="label label-info communication">继续沟通</label></td>
                                                    </tr>
                                                    @else
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$chatUser->total()}} 条记录</div>
                                        </div>
                                        <div class="col-md-8">
                                            {{$chatUser->appends(['read' => $read])->links()}}
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


        $('.communication').click(function(){
            var uid = $(this).parents('tr').attr('uid');
            window.location.href = '/admin/chatting?uid='+uid;
        })
    })
</script>
@endsection