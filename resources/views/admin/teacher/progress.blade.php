@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
    .settingProgress{
        cursor: pointer;
    }
    #classTable td{
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">学生课程进度管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	按条件查询课程
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
                                            <label for="pay_select" class="col-md-1 clh text-right">日期:</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="" id="inputstart">
                                                <input type="hidden" name="hiddenDate" id="hiddenDate">
                                            </div>
                                            <label class="col-md-1 clh text-right">班级:</label>
                                            <div class="col-md-2">
                                                <select name="banji_select" id="banji_select" class="form-control">
                                                    <option value="">请选择班级</option>
                                                    @foreach($banji as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-success" style="margin-left: 20px;" id="searchBtn">确认查询</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped" id="detailTable" style="">
                                            <thead>
                                                <tr>
                                                    <th>订单ID</th>
                                                    <th>订单编号</th>
                                                    <th>学生姓名</th>
                                                    <th>上课时间</th>
                                                    <th>课程名称(三级)</th>
                                                    <th>当前课时名称</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
			        	<h4 class="modal-title" id="myModalLabel">设置课程进度</h4>
			      	</div>
			      	<div class="modal-body">

	                    <h3>
                            学生姓名：  　 
                            <span style="color:#626A74;font-size:20px;font-weight: bold;">张仙剑</span>
                        </h3>
                    	<table class="table table-striped" id="classTable" style="display: table;">
                    		<thead>
                                <tr>
                    			    <th>ID</th>
                    			    <th>名称</th>
                    		        <th>操作</th>
                                </tr>
                    		</thead>
                            <tbody>
                                
                            </tbody>
                    	</table>
			      	</div>
			      	<div class="modal-footer">
			        	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <!-- <button type="button" class="btn btn-primary" id="nextTwo">下一步</button> -->
			        	<button type="button" class="btn btn-success" style="display: none;" id="baocun">确认保存</button>
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
    });
</script>

<script type="text/javascript">
    $(function(){
        $('#searchBtn').click(function(){
            var date = $('#hiddenDate').val();
            var banji = $('#banji_select option:selected').val();

            if (banji == '' || !date) {
                window.layer.msg('请选择日期或班级');
                return false;
            }

            $('#modal1').attr('date', date);

            $.ajax({
                url: '/admin/classProgress/search',
                type: 'post',
                dataType: 'json',
                data: {
                    date: date,
                    banji: banji
                },
                success: function(data) {
                    $('#detailTable tbody').html('');
                    if (data.errcode == 0) {
                        $('#detailTable').css('display', 'table');
                        for (var i in data.data) {
                            var res = data.data[i];
                            if (res.progress_id == 0) {
                                var progress_name = '<span class="label label-default">没有进度</span>';
                            } else {
                                var progress_name = '<span class="label label-primary">'+res.progress_name+'</span>';
                            }

                            if (res.is_set) {
                                $('#detailTable tbody').append('<tr ct_id="'+res.ct_id+'" isset="'+res.is_set+'" oid="'+res.oid+'"> <td>'+res.oct_id+'</td> <td>'+res.order_no+'</td> <td>'+res.name+'</td> <td>'+res.low+'-'+res.high+'</td> <td>'+res.className+'</td> <td>'+progress_name+'</td> <td><span class="label label-info settingProgress">设置课程进度</span><span class="label label-default" style="margin-left:9px;">此课时已设置</span></td> </tr>');
                            } else {
                                $('#detailTable tbody').append('<tr ct_id="'+res.ct_id+'" isset="'+res.is_set+'" oid="'+res.oid+'"> <td>'+res.oct_id+'</td> <td>'+res.order_no+'</td> <td>'+res.name+'</td> <td>'+res.low+'-'+res.high+'</td> <td>'+res.className+'</td> <td>'+progress_name+'</td> <td><span class="label label-info settingProgress">设置课程进度</span></td> </tr>');
                            }
                        }
                        console.log(data.data);
                    } else if (data.errcode == 1) {
                        window.layer.open({
                            title: '温馨提示'
                            ,content: '您选择的日期<span style="font-weight:bold;color:#2E8DED;">'+date+'</span>暂未设置是否为节假日，请前往<span style="font-weight:bold;">系统设置</span>><span style="font-weight:bold;">节假日设置</span>'
                        }); 
                    }
                }
            })
        })

        /*设置按钮点击*/
        $(document).on('click', '.settingProgress', function(){
            $('#modal1').modal('show');
            $('#modal1').attr('oid', $(this).parents('tr').attr('oid'));
            $('#classTable tbody').html('');
            var oid = $(this).parents('tr').attr('oid');
            var isset = $(this).parents('tr').attr('isset');
            var ct_id = $(this).parents('tr').attr('ct_id');
            $('#modal1').attr('ct_id', ct_id);
            console.log(ct_id);
            $.ajax({
                url: '/admin/classProgress/getClass',
                type: 'post',
                dataType: 'json',
                data: {
                    oid: oid
                },
                success: function(data) {
                    var flag = 0;
                    if (data.data.progress_id == 0) {
                        flag = 1;
                    }
                    for (var i in data.all) {
                        var res = data.all[i];
                        if (res.id <= data.data.progress_id) {
                            if (data.data.progress_id == res.id) {
                                flag = 1;
                            }
                            $('#classTable tbody').append('<tr> <td>'+res.id+'</td> <td>'+res.name+'</td> <td><button type="button" class="btn btn-success">已授课</button></td> </tr>');
                        } else {
                            if (isset != 1) {
                                if (flag == 1) {
                                    $('#classTable tbody').append('<tr> <td>'+res.id+'</td> <td>'+res.name+'</td> <td><button type="button" class="btn btn-info okProgress">确认该课程</button></td> </tr>');
                                    flag = 0;
                                } else {
                                    $('#classTable tbody').append('<tr> <td>'+res.id+'</td> <td>'+res.name+'</td> <td></td> </tr>');
                                }
                            } else {
                                /*已经设置*/
                                $('#classTable tbody').append('<tr> <td>'+res.id+'</td> <td>'+res.name+'</td> <td></td> </tr>');
                            }

                        }
                    }
                    /*success内结束*/
                }
            })
        })

        /*okProgress*/
        $(document).on('click', '.okProgress', function(){
            var fid = $(this).parents('tr').find('td:eq(0)').html();
            var oid = $('#modal1').attr('oid');
            var ct_id = $('#modal1').attr('ct_id');

            var cdom = $(this).parent();
            $.ajax({
                url: '/admin/classProgress/setDetailProgerss',
                type: 'post',
                dataType: 'json',
                data: {
                    oid: oid,
                    fid: fid,
                    date: $('#modal1').attr('date'),
                    ct_id: ct_id
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        cdom.html('<button type="button" class="btn btn-success">已授课</button>');
                        $('#detailTable tbody tr[oid="'+oid+'"][ct_id="'+ct_id+'"]').find('td:last').append('<span class="label label-default" style="margin-left:9px;">此课时已设置</span>');
                        $('#detailTable tbody tr[oid="'+oid+'"][ct_id="'+ct_id+'"]').attr('isset', '1');
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

$('#hiddenDate').val(str);

var start = {
    format: 'YYYY-MM-DD',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: false,
    isinitVal:true,                            //是否初始化时间，默认不初始化时间
    initAddVal:{DD:"+0"}, 
    maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        $('#hiddenDate').val(val);
    },
    okfun:function(elem, val, date) {
        $('#hiddenDate').val(val);
    }, 
};
// $('#inpstart').jeDate(start);
// $('#inpend').jeDate(end);
 
//或者是
$.jeDate('#inputstart',start);
</script>
@endsection