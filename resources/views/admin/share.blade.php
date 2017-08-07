@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .label{
        cursor: pointer;
    }
    tbody .label{

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
                                        <table class="table" id="userTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>微信昵称</th>
                                                    <th>手机号</th>
                                                    <th>链接分享数</th>
                                                    <th>成功关注数</th>
                                                    <th>剩余半价券</th>
                                                    <th>已购买次数</th>
                                                    <th>新纪录</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($res as $value)
                                                <tr uid="{{$value->pid}}">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->nickname}}</td>
                                                    <td>{{$value->phone}}</td>
                                                    <td>{{$value->count}}</td>
                                                    <td>{{$value->succeed}}</td>
                                                    <td>{{$value->ticket->ticket_num}}</td>
                                                    <td>{{$value->ticket->used_num}}次</td>
                                                    <td>@if($value->confirm) <span class="label label-success label-newRecord">新纪录</span> @else @endif</td>
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


            <div id="recordModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">订单详情</h4>
                        </div>
                        <div class="modal-body" style="min-height: 250px;">
                            <table class="table table-hover" id="orderDetailTable">
                                <thead>
                                    <tr>
                                        <th>课程名称</th>
                                        <th>购买次数</th>
                                        <th>课程价格</th>
                                        <th>订单状态</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Sa</button>
                        </div> -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){
        $('.seeOrder').click(function(){
            var uid = $(this).parents('tr').attr('uid');
            $('#recordModal').modal('show');
            $('#recordModal').attr('uid', uid);

            $('#orderDetailTable tbody').html('');

            $.ajax({
                url: '/admin/share/getRecords',
                dataType: 'json',
                type: 'post',
                data: {
                    uid: uid
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        if (data.record.length == 0) {
                            $('#orderDetailTable tbody').html('<tr> <td colspan="4">暂无订单</td></tr>')
                            return false;
                        }
                        for (var i in data.record) {
                            if (data.record[i].confirm_status) 
                                var status = '<span class="label" style="background: #17D812;">已确认</span>';
                            else
                                var status = '<span class="label label-confirm" style="background: #3664E5;">点我确认</span>';

                            $('#orderDetailTable tbody').append('<tr rid="'+data.record[i].id+'"> <td>'+data.record[i].name+'</td> <td>'+data.record[i].record_num+'</td> <td>'+data.record[i].price+'</td> <td>'+status+'</td> </tr>');
                        }
                    }
                }
            })
        })


        $(document).on('click', '.label-confirm', function(){
            var rid = $(this).parents('tr').attr('rid');/*record的ID*/
            $.ajax({
                url: '/admin/share/confirmRecord',
                dataType: 'json',
                type: 'post',
                data: {
                    rid: rid
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        $('#orderDetailTable tr[rid="'+rid+'"]').find('.label-confirm').replaceWith('<span class="label" style="background: #17D812;">已确认</span>');


                        /*找剩余的个数，为0，则外面的表消除新纪录*/

                        var len = $('#orderDetailTable tbody').find('.label-confirm').length;
                        if (len == 0) {
                            var uid = $('#recordModal').attr('uid');
                            $('#userTable tr[uid="'+uid+'"]').find('.label-newRecord').remove();
                        }
                    }
                }
            })
        })
    })
</script>
@endsection