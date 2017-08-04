@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .operate span{
        cursor: pointer;
    }
    .label{
        cursor: pointer;
    }
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">半价购课&用户分享</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                   半价购课&用户分享
                                </h3>
                                <div class="portlet-widgets">
                                    <!-- <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a> -->
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                            	<form  action="/admin/share" method="get">
                            		<input type="hidden" name="_token" value="8o0WCWkZVQQlILo6nNqy8G0GOC2Toii1z5HAfOjH">
                            		<div class="row m-b-15">
                            			<div class="form-group">
                            				<label class="col-md-1 clh text-right" style="margin-top: 7px;">手机号:</label>
                            				<div class="col-md-3">
                                                <input type="text" name="phone" class="form-control" placeholder="根据手机号查询" value="@if($phone) {{$phone}} @else @endif">
                                            </div>
                                            <div class="col-md-3 ">
                                            	<button type="submit" class="btn btn-info w-md" style="margin-right: 16px;">查询</button>
                                            	<button onclick="window.location.href='/admin/share'" type="button" class="btn btn-default w-md">重置查询条件</button>
                                       		</div>
                            			</div>
                            		</div>
                            	</form>
                            </div>
                            <div class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>微信昵称</th>
                                                    <th>手机号</th>
                                                    <th>总分享数</th>
                                                    <th>已关注</th>
                                                    <th>剩余半价券</th>
                                                    <th>已购买次数</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($res as $value)
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->nickname}}</td>
                                                    <td>{{$value->phone}}</td>
                                                    <td>{{$value->count}}</td>
                                                    <td>{{$value->succeed}}</td>
                                                    <td>{{$value->ticket->ticket_num}}</td>
                                                    <td>{{$value->ticket->used_num}}次</td>
                                                    <td>
                                                        <span class="label label-primary seeOrder">查看订单</span>　
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共{{$res->total()}} 条记录</div>
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

</script>
@endsection