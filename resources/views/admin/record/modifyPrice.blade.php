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
                    <h3 class="title">修改订单记录表</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    修改订单记录表
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
                                                    <th>之前价格</th>
                                                    <th>之后价格</th>
                                                    <th>修改方式</th>
                                                    <th>修改管理员</th>
                                                    <th>修改时间</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recordObj as $value)
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->pre}}</td>
                                                    <td>{{$value->now}}</td>
                                                    <td>
                                                        @if($value->type == 0) 
                                                            <span class="label label-success">直接设定</span> 
                                                        @else 
                                                            <span class="label label-primary">打{{$value->type}}折</span> 
                                                        @endif
                                                    </td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->created_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$recordObj->total()}}条记录</div>
                                        </div>
                                        <div class="col-sm-6">
                                            {{$recordObj->links()}}
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