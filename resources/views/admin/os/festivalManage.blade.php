@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
    .nousespan{
        display: inline-block;
        margin-right: 14px;
        font-size:19px;
        padding: 5px;
    }
    .cursor{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">节假日管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	节假日设置
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
                                    <div class="row" style="margin-bottom: 5px;">
                                        <div class="form-group">
                                            <!-- <label class="col-md-1 clh text-right">订单编号:</label>
                                            <div class="col-md-3">
                                                <input type="text" name="orderno" id="orderno" class="form-control" placeholder="根据订单编号查询" value=" ">
                                            </div> -->
                                            <label for="pay_select" class="col-md-1 clh text-right">选择日期：</label>
                                                <div class="col-md-2">
                                                    <div class="bootstrap-timepicker">
                                                    <input id="inputstart" type="text" class="form-control">
                                                    <input type="hidden" name="date" id="hiddenDate">
                                                </div>
                                                <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span> -->
                                            </div>
                                            <label class="col-md-1 clh text-right">是否假期:</label>
                                            <div class="col-md-2">
                                                <select name="hospital_select" id="hospital_select" class="form-control">
                                                    <option value="">请选择是否节假日</option>
                                                    <option value="0">上课日</option>
                                                    <option value="1">节假日</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 clh text-right">未来N日:</label>
                                            <div class="col-md-2">
                                                <input type="number" id="future" class="form-control" name="nDay" value="1">
                                            </div>
                                            <button class="btn btn-success" style="margin-left: 20px;" id="newDayBtn">确认添加</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>日期</th>
                                                    <th>类别</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dateObj as $value)
                                                <tr did="{{$value->id}}">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->day}}</td>
                                                    <td>@if($value->type == 1) <span class="label label-success">节假日</span> @else <span class="label label-danger">上课日</span> @endif</td>
                                                    <td>
                                                        <span class="label label-info cursor change">切换类型</span>
                                                        <span class="label label-info cursor delete">删除</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


        <!-- Large modal -->
		<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="myModalLabel">添加结果反馈</h4>
			      	</div>
			      	<div class="modal-body">
                        <div class="row" style="margin-bottom: 20px;">
                            <h3>以下日期添加失败</h3>
    			        	<p style="margin-bottom: 12px;" id="nousep">
                            </p>
                            <p>
                                失败原因:<span style="font-weight: bold;color: red;">这些日期已经设置！</span>
                            </p>
                        </div>
                        <hr />
                        <div class="row" style="margin-top: 12px;">
                            <h3>成功日期</h3>
                            <p style="margin-bottom: 20px;color: green;" id="usep">
                            </p>
                        </div>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <!-- <button type="button" class="btn btn-primary" id="nextTwo">下一步</button> -->
			        	<!-- <button type="button" class="btn btn-success" style="display: none;">确认保存</button> -->
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

        $('#newDayBtn').click(function(){
            var date = $('#hiddenDate').val();
            var hospital_select = $('#hospital_select option:selected').val();
            var future = $('#future').val();

            if (date == '') {
                window.layer.msg('日期选择不能为空');
                return false;
            }

            if (!hospital_select) {
                window.layer.msg('请选择是否节假日');
                return false;
            }

            if (future == '') {
                window.layer.msg('请输入未来多少日如此');
                return false;
            }
            
            $.ajax({
                url: '/admin/festivalSetting/add',
                dataType: 'json',
                type: 'post',
                data: {
                    date: date,
                    hospital_select: hospital_select,
                    future: future
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        $('#nousep').html('');
                        $('#usep').html('');
                        $('#modal1').modal('show');
                        if (data.nouse.length > 0) {
                            for (var i in data.nouse) {
                                $('#nousep').append('<span class="nousespan">'+data.nouse[i]+'</span>');
                            }
                        } else {
                            $('#nousep').append('<span class="nousespan">无</span>');
                        }
                        if (data.useful.length > 0) {
                            for (var i in data.useful) {
                                $('#usep').append('<span class="nousespan">'+data.useful[i].day+'</span>');
                            }
                        } else {
                            $('#usep').append('<span class="nousespan">无</span>');
                        }
                        
                    }
                }
            });
        })

        /*change改变类型*/
        $(document).on('click', '.change', function(){
            var id = $(this).parents('tr').attr('did');
            var cdom = $(this).parent().prev();
            $.ajax({
                url: '/admin/festivalSetting/change',
                dataType: 'json',
                type: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        if (data.type == 1) {
                            cdom.html('<span class="label label-success">节假日</span>');
                        } else {
                            cdom.html('<span class="label label-danger">上课日</span>');
                        }
                    }
                }
            })
        })


        $('#modal1').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
    });
</script>
<script>
var start = {
    format: 'YYYY-MM-DD',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: true,
    ishmsVal:false,
    manDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        $('#hiddenDate').val(val);
    },
    okfun:function(elem, val, date) {
        $('#hiddenDate').val(val);
    }, 
};
$('#inputstart').jeDate(start);
// $('#inpend').jeDate(end);
 
//或者是
// $.jeDate('#inputstart',start);
</script>
@endsection