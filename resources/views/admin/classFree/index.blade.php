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
                    <h3 class="title">免费试听课</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    免费试听课列表
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
                                	<div class="row">
	                                    <div class="table-responsive">
	                                        <table class="table">
	                                            <thead>
	                                                <tr>
	                                                    <th>ID</th>
	                                                    <th>用户昵称</th>
	                                                    <th>手机号</th>
	                                                    <th>预约时间</th>
	                                                    <th>操作</th>
	                                                </tr>
	                                            </thead>
	                                            <tbody>
	                                                @foreach($res as $value)
	                                                <tr>
	                                                    <td><input type="checkbox" name="ids" value="{{$value->id}}">{{$value->id}}</td>
	                                                    <td>{{$value->nickname}}</td>
	                                                    <td>{{$value->phone}}</td>
	                                                    <td>{{$value->active_time}}</td>
	                                                    <td>
															<a >
																<span class="label label-default">暂无操作</span>
															</a>
	                                                    </td>
	                                                </tr>
	                                                @endforeach
	                                            </tbody>
	                                        </table>
	                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$res->total()}}条记录</div>
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
<script type="text/javascript">
    $(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

    })


</script>
@endsection