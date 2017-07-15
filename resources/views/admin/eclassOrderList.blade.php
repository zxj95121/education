@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
    .orderXXBtn,.orderOKBtn,.orderUseBtn{
        cursor: pointer;
    }
    .orderOverBtn,.orderPayBtn,.orderSuccessBtn,.orderUseBtn{
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
                    <h3 class="title">双师class订单列表</h3> 
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
                                <form id="search_form" action="/admin/eclassOrderList" method="get">
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
                                                <input type="text" name="stuName" id="stuName" class="form-control" placeholder="根据学生姓名查询" @if($stuName) value="{{$stuName}}" @else value="" @endif">
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
                                                                <span class="label label-info orderUseBtn">分配该订单</span>
                                                            @else
                                                            @endif
                                                        @else
                                                            <span class="label label-success">订单已授课完成</span>
                                                        @endif
                                                        </td>
                                                        <td id="td_no">{{$value->order_no}}</td>
                                                        <td id="td_name">{{$value->name1}}&gt;{{$value->name2}}&gt;{{$value->name3}}</td>
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



<!--             <div class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">订单确认提醒</h4>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary">确认通过</button>
                        </div>
                    </div>
                </div>
            </div> -->

            <div id="useOrderModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;font-size: 18px;font-family: '宋体';">分配订单到教室、日期</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table" style="width: 100%;display: inline-table;">
                                        <tr>
                                            <th width="50%">订单详情</th>
                                            <th width="50%"></th>
                                        </tr>
                                        <tr>
                                            <td>订单ID: <span id="span_id">8</span></td>
                                            <td>订单编号: <span id="span_no">145151</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">课程名称: <span id="span_name" style="color:red;"></span></td>
                                        </tr>
                                        <tr>
                                            <td>课时数量: <span id="span_count">8</span></td>
                                            <td>订单价格: <span id="span_price">80.00</span></td>
                                        </tr>
                                        <tr>
                                            <td>用户昵称: <span id="span_nickname">young</span></td>
                                            <td>订单时间: <span id="span_time">2017</span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">用户选择时间</div>
                                        <div class="panel-body">
                                            <p id="timeP">
                                                <span class="label label-primary">周一放学后</span>
                                                <span class="label label-primary">周二放学后</span>
                                                <span class="label label-primary">周三放学后</span>
                                                <span class="label label-primary">周四放学后</span>
                                                <span class="label label-primary">周五放学后</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">用户每周上课次数</div>
                                        <div class="panel-body">
                                            <h2 id="h2Times" style="font-weight: bold;font-size: 17px;">3次</h2>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">用户要求备注</div>
                                        <div class="panel-body">
                                            <h2 id="time_remark" style="font-weight: bold;font-size: 17px;"></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <table id="classTable" class="table table-striped" style="width: 100%;display: inline-table;">
                                        <tr>
                                            <th width="25%">班级详情</th>
                                            <th width="25%"></th>
                                            <th width="25%"></th>
                                            <th width="25%"></th>
                                        </tr>
                                        <tr>
                                            <th>ID:</th>
                                            <th>名称:</th>
                                            <th>班级已有人数:</th>
                                            <th>课程种类:</th>
                                        </tr>
                                        @foreach($classObj as $value)
                                        <tr cid="{{$value->id}}">
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>5</td>
                                            <td>2</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">当前所选课时、星期、班级<b>已有课程</b></div>
                                        <div class="panel-body" id="span_hasHave">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <form class="form-inline p-20" role="form">
                                    <div class="form-group" style="margin-right: 20px;">
                                        <label for="weekSelect">选择星期 </label>
                                        <select class="form-control" id="weekSelect">
                                            <option value="1" type="1">星期一</option>
                                            <option value="2" type="1">星期二</option>
                                            <option value="3" type="1">星期三</option>
                                            <option value="4" type="1">星期四</option>
                                            <option value="5" type="1">星期五</option>
                                            <option value="6" type="2">星期六</option>
                                            <option value="7" type="2">星期日</option>
                                        </select>
                                    </div>
                                      
                                    <div class="form-group m-l-10" style="margin-right: 20px;">
                                        <label for="keshiSelect">选择课时 </label>
                                        <select class="form-control" id="keshiSelect">
                                        @foreach ($classTime as $value)
                                            <option type="{{$value->type}}" value="{{$value->id}}">{{$value->low}}-{{$value->high}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group m-l-10" style="margin-right: 20px;">
                                        <label for="classSelect">选择班级 </label>
                                        <select class="form-control" id="classSelect">
                                        @foreach($classObj as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-l-10" style="margin-right: 20px;">
                                        <!-- <input type="checkbox" name="hospital" id="hospitalCheckBox" onclick="weekTimeChange();"> -->
                                        <!-- <label for="classSelect">节假日 </label> -->
                                        <label class="cr-styled">
                                            <input type="checkbox" name="hospital" id="hospitalCheckBox" onclick="weekTimeChange();setUseMessage();">
                                            <i class="fa"></i> 
                                            节假日
                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-success m-l-10" id="ksAdd">确认添加该课时</button>
                                </form>
                            </div>
                            <div class="row">
                                <table class="table table-striped" id="orderClassTime">
                                    <thead>
                                        <tr>
                                            <th>星期</th>
                                            <th>详细时间</th>
                                            <th>所在班级</th>
                                            <th>是否节假日</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
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
    })
</script>
<script type="text/javascript">
    $(function(){
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
                    url: '/admin/eclassOrderList/confirmOK',
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
                    url: '/admin/eclassOrderList/confirmXX',
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
                        } else if (date.errcode == 1) {
                            window.layer.close(loadIndex);
                            window.layer.msg(date.msg);
                        }
                    }
                });
            });
        })

        /*分配订单*/
        $(document).on('click', '.orderUseBtn', function(){
            $('#useOrderModal').modal('show');
            $('#orderClassTime tbody').html('');

            var cdom = $(this).parents('tr');
            var id = cdom.find('#td_id').html();
            var no = cdom.find('#td_no').html();
            var count = cdom.find('#td_count').html();
            var price = cdom.find('#td_price').html();
            var name = cdom.find('#td_name').html();
            var nickname = cdom.find('#td_nickname').html();
            var time = cdom.find('#td_time').html();

            $('#useOrderModal').attr('oid', id);

            $('#span_time').html(time);
            $('#span_nickname').html(nickname);
            $('#span_name').html(name);
            $('#span_price').html(price);
            $('#span_count').html(count);
            $('#span_no').html(no);
            $('#span_id').html(id);

            $('#timeP').html('');
            $('#h2Times').html('');

            $.ajax({
                url: '/admin/classOrder/useDetail',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        console.log(data);
                        var classTimes = data.result.classTimes;
                        $('#h2Times').html(classTimes+' 次');
                        $('#time_remark').html(data.result.time_remark);
                        var time = data.result.time;
                        for (var i in time) {
                            switch (time[i]) {
                                case '1':
                                    var str = '周一放学后';
                                    break;
                                case '2':
                                    var str = '周二放学后';
                                    break;
                                case '3':
                                    var str = '周三放学后';
                                    break;
                                case '4':
                                    var str = '周四放学后';
                                    break;
                                case '5':
                                    var str = '周五放学后';
                                    break;
                                case '6':
                                    var str = '周六上午';
                                    break;
                                case '7':
                                    var str = '周六下午';
                                    break;
                                case '8':
                                    var str = '周日上午';
                                    break;
                                case '9':
                                    var str = '周日下午';
                                    break;
                            }
                            $('#timeP').append('<span class="label label-primary">'+str+'</span>　');
                        }

                        var oct = data.result.order_class_time;
                        for (var i in oct) {
                            switch (oct[i]['week']) {
                                case 1:
                                    var weekStr = '星期一';
                                    break;
                                case 2:
                                    var weekStr = '星期二';
                                    break;
                                case 3:
                                    var weekStr = '星期三';
                                    break;
                                case 4:
                                    var weekStr = '星期四';
                                    break;
                                case 5:
                                    var weekStr = '星期五';
                                    break;
                                case 6:
                                    var weekStr = '星期六';
                                    break;
                                case 7:
                                    var weekStr = '星期日';
                                    break;
                            }
                            var type = (oct[i]['type']=='1')?'节假日':'普通';
                            $('#orderClassTime tbody').append('<tr kid="'+oct[i]['id']+'"><td>'+weekStr+'</td><td>'+oct[i]['low']+'-'+oct[i]['high']+'</td><td>'+oct[i]['cname']+'</td><td>'+type+'</td><td><span class="label label-info classOrderDelete">删除</span></td></tr>');
                        }
                    }
                }
            })
        })

        $('.pagination li a').each(function(){
            var href = $(this).attr('href');
            if (href)
                $(this).attr('href', href+'{!!$str!!}');
        })
        weekTimeType = 0;
        weekTimeChange();
        setUseMessage();
        $('#weekSelect').change(function(){
            weekTimeChange();
            setUseMessage();
        })

        $('#keshiSelect').change(function(){
            setUseMessage();
        })

        $('#classSelect').change(function(){
            setUseMessage();
        })

        $('#ksAdd').click(function(){
            var week = $('#weekSelect option:selected').val();
            var keshi = $('#keshiSelect option:selected').val();
            var clas = $('#classSelect option:selected').val();
            var id = $('#useOrderModal').attr('oid');
            var checkbox = $('input[name="hospital"]:checked').val()?'1':'0';
            var checkboxTd = (checkbox==1)?'节假日':'普通';

            $.ajax({
                url: '/admin/classOrder/keAdd',
                dataType: 'json',
                type: 'post',
                data: {
                    week: week,
                    keshi: keshi,
                    class: clas,
                    id: id,
                    checkbox: checkbox
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        $('#orderClassTime tbody').append('<tr kid="'+data.id+'"><td>'+$('#weekSelect option[value="'+week+'"]').html()+'</td><td>'+$('#keshiSelect option[value="'+keshi+'"]').html()+'</td><td>'+$('#classSelect option[value="'+clas+'"]').html()+'</td><td>'+checkboxTd+'</td><td><span class="label label-info classOrderDelete">删除</span></td></tr>');
                        setUseMessage();
                    } else {
                        window.layer.msg(data.reason);
                    }
                }
            })
        })

        /*删除课时安排*/
        $(document).on('click', '.classOrderDelete', function(){
            var kid = $(this).parents('tr').attr('kid');
            var cdom = $(this).parents('tr');
            window.layer.confirm('确认删除该课时吗？', {
                btn: ['确认', '取消'] //可以无限个按钮
                ,btn2: function(index, layero){
                window.layer.close(index);
              }
            }, function(index, layero){
                window.layer.close(index);
                var loadIndex = window.layer.load(2, {time:5000});
                $.ajax({
                    url: '/admin/classOrder/deleteKeshi',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: kid
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.layer.close(loadIndex);
                            window.layer.msg('删除成功！');
                            setUseMessage();
                            cdom.remove();
                        }
                    }
                });
            });
        })
    })

    function weekTimeChange(){
        var type = $('#weekSelect option:selected').attr('type');
        var checkbox = $('input[name="hospital"]:checked').val();
        if (type == 1 && !checkbox) {
            $('#keshiSelect option[type="2"]').css('display', 'none');
            $('#keshiSelect option[type="1"]').css('display', 'block');
                
            $('#keshiSelect option[type="1"]').eq(0).prop('selected', 'selected');
        } else if(type == 1 && checkbox) {
            $('#keshiSelect option[type="1"]').css('display', 'none');
            $('#keshiSelect option[type="2"]').css('display', 'block');
            
            $('#keshiSelect option[type="2"]').eq(0).prop('selected', 'selected');
        } else if (type == 1 && !checkbox){
            $('#keshiSelect option[type="1"]').css('display', 'none');
            $('#keshiSelect option[type="2"]').css('display', 'block');
            if (weekTimeType != type) {
                $('#keshiSelect option[type="2"]').eq(0).prop('selected', 'selected');
                weekTimeType = type;
            }
        } else {
            $('#keshiSelect option[type="1"]').css('display', 'none');
            $('#keshiSelect option[type="2"]').css('display', 'block');
            $('#keshiSelect option[type="2"]').eq(0).prop('selected', 'selected');
        }
    }

    function setUseMessage(){
        var week = $('#weekSelect option:selected').val();
        var keshi = $('#keshiSelect option:selected').val();
        var clas = $('#classSelect option:selected').val();
        // var id = $('#useOrderModal').attr('oid');

        $.ajax({
            url: '/admin/classOrder/useDetails',
            dataType: 'json',
            type: 'post',
            data: {
                week: week,
                keshi: keshi,
                class: clas
            },
            success: function(data) {
                if (data.errcode == 0) {
                    console.log(data);
                    $('#span_hasHave').html('');
                    for (var i in data.nameArr) {
                        $('#span_hasHave').append('<span class="label label-primary">'+data.nameArr[i]+'</span>　');
                    }

                    for (var i in data.classDetail) {
                        var cdom = $('#classTable').find('tr[cid="'+i+'"]');
                        cdom.find('td:eq(2)').html(data.classDetail[i]['count']);
                        cdom.find('td:eq(3)').html(data.classDetail[i]['kcCount']);
                    }
                }
            }
        })
    }
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