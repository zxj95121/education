@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
    .orderXXBtn,.orderOKBtn,.orderUseBtn,.orderClassDetailBtn{
        cursor: pointer;
    }
    .orderOverBtn,.orderPayBtn,.orderSuccessBtn,.orderUseBtn,.orderClassDetailBtn{
        user-select: none;
    }
    ::-webkit-scrollbar{  
        height: 20px;  
        background-color: #C1C1C1;  
    }
    #useOrderModal tr{
        border-top: 0px solid transparent;
    }
    #useOrderModal td,#useOrderModal th{
        font-size: 16px;
        border-top: 0px solid transparent;
    }
    .classOrderDelete{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">双师class大订单列表</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	按条件查询订单
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
                                <form id="search_form" action="/admin/eclassBigOrderList" method="get">
                                    <input type="hidden" name="_token" value="8o0WCWkZVQQlILo6nNqy8G0GOC2Toii1z5HAfOjH">
                                    <div class="row m-b-15">
                                        <div class="form-group">
                                            <label class="col-md-1 clh text-right">订单编号:</label>
                                            <div class="col-md-3">
                                                <input type="text" name="orderno" id="orderno" class="form-control" placeholder="根据订单编号查询" value="@if($order_no) {{$order_no}} @else @endif">
                                            </div>
                                            <label for="pay_select" class="col-md-1 clh text-right">支付状态：</label>
                                            <div class="col-md-2">
                                                <select name="pay_select" id="pay_select" class="form-control">
                                                    <option value="">请选择支付状态</option>
                                                    <option value="1" @if($pay_select == 1) selected="selected" @else @endif>已支付</option>
                                                    <option value="2" @if($pay_select == 2) selected="selected" @else @endif>已退款</option>
                                                    <option value="0" @if($pay_select != null && $pay_select == 0) selected="selected" @else @endif>未支付</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 clh text-right">审核状态:</label>
                                            <div class="col-md-2">
                                                <select name="confirm_select" id="confirm_select" class="form-control">
                                                    <option value="">请选择审核状态</option>
                                                    <option value="0" @if($confirm_select != null && $confirm_select == 0) selected="selected" @else @endif>未审核</option>
                                                    <option value="1" @if($confirm_select == 1) selected="selected" @else @endif>审核通过</option>
                                                    <option value="2" @if($confirm_select == 2) selected="selected" @else @endif>已驳回</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-b-15">
                                        <div class="form-group">
                                            <label class="col-md-1 clh text-right">订单时间范围：</label>
                                            <div class="col-md-2">
                                                <span class="wstxt"><b>开始日期：</b></span><input type="text" class="workinput wicon form-control" id="inpstart" readonly>
                                                <input type="hidden" name="date0" id="date0" value='{{$date0}}'>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="wstxt"><b>结束日期：</b></span><input type="text" class="workinput wicon form-control" id="inpend" readonly>
                                                <input type="hidden" name="date1" id="date1" value='{{$date1}}'>
                                            </div>
                                            <label for="stuName" class="col-md-1 clh text-right">学生姓名：</label>
                                            <div class="col-md-2">
                                                <input type="text" name="stuName" id="stuName" class="form-control" placeholder="根据学生姓名查询">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-15">
                                        <div class="col-md-2 col-md-offset-1">
                                            <button type="submit" class="btn btn-info w-md">查询</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button onclick="window.location.href='/admin/eclassBigOrderList'" type="button" class="btn btn-default w-md">重置查询条件</button>
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
                                                        <th>ID</th>
                                                        <th>操作</th>
                                                        <th>订单编号</th>
                                                        <th>课程名称</th>
                                                        <th>课时数量</th>
                                                        <th>学生名称</th>
                                                        <th>订单价格</th>
                                                        <th>支付状态</th>
                                                        <th>操作状态</th>
                                                        <th>用户昵称</th>
                                                        <th>手机号码</th>
                                                        <th>订单时间</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orderList as $value)
                                                    <tr oid="{{$value->id}}">
                                                        <td id="td_id">{{$value->id}}</td>
                                                        <td>
                                                        @if($value->complete == 0)
                                                            @if($value->pay_status == 1 && $value->confirm_status == 0)
                                                                <span class="label label-info orderOKBtn">确认订单</span>
                                                                <span class="label label-warning orderXXBtn">驳回订单</span>
                                                            @else
                                                            @endif
                                                            @if($value->pay_status == 0)
                                                                <span class="label label-default orderPayBtn">订单待支付</span>
                                                            @else
                                                            @endif
                                                            @if($value->pay_status == 2)
                                                                <span class="label label-danger orderOverBtn">订单已驳回</span>
                                                            @else
                                                            @endif
                                                            @if($value->pay_status == 1 && $value->confirm_status == 1)
                                                                <span class="label label-success orderSuccessBtn">订单已通过</span>
                                                                <!-- <span class="label label-info orderUseBtn">分配该订单</span> -->
                                                            @else
                                                            @endif
                                                        @else
                                                            <span class="label label-success">订单已授课完成</span>
                                                        @endif
                                                        </td>
                                                        <td id="td_no">{{$value->order_no}}</td>
                                                        <td id="td_name"><span class="label label-info orderClassDetailBtn">查看课程详情</span></td>
                                                        <td id="td_count">{{$value->count}}</td>
                                                        <td>{{$value->stuName}}</td>
                                                        <td id="td_price">{{$value->price}}</td>
                                                        <td>
                                                            @if($value->pay_status == 1)
                                                                <span class="label label-success">已支付</span>
                                                            @elseif($value->pay_status == 0)
                                                                <span class="label label-default">未支付</span></td>
                                                            @elseif($value->pay_status == 2)
                                                                <span class="label label-danger">已退款</span></td>
                                                            @endif
                                                        <td>
                                                            @if($value->confirm_status == 0)
                                                                <span class="label label-info">待确认</span>
                                                            @elseif($value->confirm_status == 1)
                                                                <span class="label label-success">已通过</span></td>
                                                            @else
                                                                <span class="label label-danger">已驳回</span></td>
                                                            @endif
                                                        </td>
                                                        <td id="td_nickname">{{$value->nickname}}</td>
                                                        <td>{{$value->phone}}</td>
                                                        <td id="td_time">{{$value->created_at}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$orderList->total()}}条记录</div>
                                        </div>
                                        <div class="col-md-8">
                                            {{ $orderList->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> 




            <!-- Modal -->

            <div id="orderDetailModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document" style="width: 60%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;font-size: 18px;font-family: '宋体';">订单ID：<span></span></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row" id="detailDiv">
                                <div class="col-md-6">
                                    <div class="row detail1 detail0" id="detailID0">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row detail2 detail0" id="detailID1">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <!-- <button type="button" class="btn btn-primary">保存</button> -->
                        </div>
                    </div>
                </div>
            </div>

@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/js/jeui/jedate.js"></script>
<script type="text/javascript">
    $(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });   

        /*确认审核订单*/
        $(document).on('click', '.orderOKBtn', function(){
            var id = $(this).parents('tr').attr('oid');
            window.layer.confirm('确认审核<b style="color:green;">通过</b>吗，ID为'+id+'？', {
                btn: ['确认', '取消'] //可以无限个按钮
                ,btn2: function(index, layero){
                window.layer.close(index);
              }
            }, function(index, layero){
                window.layer.close(index);
                var loadIndex = window.layer.load(2, {time:5000});
                $.ajax({
                    url: '/admin/eclassBigOrderList/confirmOK',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.layer.close(loadIndex);
                            window.layer.msg('确认成功！');
                            window.location.reload();
                        }
                    }
                });
            });
        })

        /*确认驳回*/
        $(document).on('click', '.orderXXBtn', function(){
            var id = $(this).parents('tr').attr('oid');
            window.layer.confirm('确认<b style="color:red;">驳回</b>审核吗，ID为'+id+'将自动退款!', {
                btn: ['确认', '取消'] //可以无限个按钮
                ,btn2: function(index, layero){
                window.layer.close(index);
              }
            }, function(index, layero){
                window.layer.close(index);
                var loadIndex = window.layer.load(2, {time:5000});
                $.ajax({
                    url: '/admin/eclassBigOrderList/confirmXX',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.layer.close(loadIndex);
                            window.layer.msg('驳回成功！');
                            window.location.reload();
                        } else if (data.errcode == 1) {
                            window.layer.close(loadIndex);
                            window.layer.msg(data.msg);
                        }
                    }
                });
            });
        })

        /*查看订单课程详情*/
        $(document).on('click', '.orderClassDetailBtn', function(){
            $('#orderDetailModal').modal('show');
            var id = $(this).parents('tr').attr('oid');

            $('#myModalLabel span').html(id);
            $('.detail0').html('');
            $.ajax({
                url: '/admin/eclassBigOrderList/getOrderDetail',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        var obj = data.obj;
                        for (var i in obj) {
                            var id2 = obj[i]['id'];
                            var name2 = obj[i]['name'];

                            /*获取detail0的高度*/
                            
                            if (i % 2 == 0) {
                                var appendDiv = $('.detail1');
                            } else {
                                var appendDiv = $('.detail2');
                            }

                            appendDiv.append('<div class="col-md-12 detailList" twoid="'+id2+'"> <div class="panel panel-default"> <div class="panel-heading"> <h3 class="panel-title">'+name2+'</h3> </div> <div class="panel-body"> <ol> </ol> </div> </div> </div>');
                            var liObj = obj[i]['detail'];
                            for (var j in liObj) {
                                var cdom = $('.detailList[twoid="'+id2+'"]').find('ol');
                                cdom.append('<li>'+liObj[j]['name3']+'</li>');
                            }
                        }
                    } else {
                        alert('系统错误，请联系管理员。');
                    }
                }
            })
        })
    })
</script>
<script>
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth()+1;
if(month < 10)
    month = '0'+month;
var day = date.getDate();
if(day < 10)
    day = '0'+day;
var str = year+'-'+month+'-'+day;

var start = {
    format: 'YYYY-MM-DD',
    minDate: '2017-07-01', //设定最小日期为当前日期
    @if($date0)
    // isinitVal: true,
    // initAddVal: {'DD':"-2"},
    @else
    @endif
    festival: false,
    ishmsVal:false,
    maxDate: str, //最大日期
    choosefun: function(elem, val, date){
        end.minDate = val; //开始日选好后，重置结束日的最小日期
        endDates();
        $('#date0').val(date);
    }
};
var end = {
    format: 'YYYY-MM-DD',
    minDate: '2017-07-01', //设定最小日期为当前日期
     @if($date0)
    // isinitVal: true,
    // initAddVal: '',
    @else
    @endif
    festival: false,
    maxDate: '2099-06-16', //最大日期
    choosefun: function(elem, val, date){
        // start.maxDate = date; //将结束日的初始值设定为开始日的最大日期
        $('#date1').val(date);
    }
};
//这里是日期联动的关键        
function endDates() {
    //将结束日期的事件改成 false 即可
    end.trigger = false;
    $("#inpend").jeDate(end);
}
// $('#inpstart').jeDate(start);
// $('#inpend').jeDate(end);
 
//或者是
$.jeDate('#inpstart',start);
$.jeDate('#inpend',end);
</script>
@endsection