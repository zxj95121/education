@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link href="assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
<style type="text/css">
    #areaTable td{
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">双师Class价格设置</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	双师Class价格设置
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
                                        <div class="col-md-4 part1">
                                            <button id="newPrice"  class="btn btn-success" data-toggle="modal" data-target="#newPriceModal"> 设置新价格 <span class="glyphicon glyphicon-cog"></span></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">一级课程</h3>
                                                </div>
                                                <div class="panel-body">
                                                @foreach($teacherOne as $key => $value)
                                                    @if($key == 0)
                                                        <button type="button" tid="{{$value->id}}" class="btn btn-block btn--md btn-primary teacherBtn">{{$value->name}}</button>
                                                    @else
                                                        <button type="button" tid="{{$value->id}}" class="btn btn-block btn--md btn-default teacherBtn">{{$value->name}}</button>
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="showPrice" style="max-width: 800px;">
                                                    <thead>
                                                        <tr>
                                                            <th><font><font>序号</font></font></th>
                                                            <th><font><font>课程数区间</font></font></th>
                                                            <th><font><font>单价</font></font></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $priceObjLength = count($priceObj); @endphp
                                                    	@foreach($priceObj as $key => $value)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>
                                                                @if($key == 0)
                                                                    <={{$value->area}}
                                                                @elseif($key == $priceObjLength-1)
                                                                    >={{$value->area}}
                                                                @else
                                                                    {{$value->area}}
                                                                @endif
                                                            </td>
                                                            <td>{{number_format((float)$value->price, 2)}}</td>
                                                        </tr>
                                                        @endforeach

                                                        @if($priceObjLength == 0) <tr><td>未设置价格</td></tr> @else @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


        <!-- Large modal -->
		<div id="newPriceModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="myModalLabel">设置新的课程价格</h4>
			      	</div>
			      	<div class="modal-body">
                        <div class="row" style="margin-bottom: 12px;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">请选择eclass课程</label>
                                    <div class="col-sm-10">
                                        <select id="classSelect" class="form-control">
                                            @foreach($teacherOne as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
			        	<form class="form-horizontal" role="form" id="firstStep">
	                        <div class="form-group">
	                            <label class="col-sm-2 control-label">请输入间隔的数字</label>
	                            <div class="col-sm-10">
	                                <input name="tags" id="tags" class="form-control" value="" style="display: none;">
	                            </div>
	                        </div>
                    	</form>
                        <p id="error_p" style="display: none;color:red;font-size: 14px;">
                            <span class="col-sm-2"></span>
                            <span class="col-sm-10"></span>
                        </p>
                    	<table class="table" id="areaTable" style="display: none;">
                    		<tr>
                    			<th>#</th>
                    			<th>区间段</th>
                    			<th>价格</th>
                    		</tr>
                    	</table>
			      	</div>
			      	<div class="modal-footer">
			        	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <!-- <button type="button" class="btn btn-primary" id="nextTwo">下一步</button> -->
			        	<button type="button" class="btn btn-success" style="display: none;" id="nextThree">确认保存</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script src="assets/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="/js/json2.js"></script>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

		jQuery('#tags').tagsInput({width:'auto',
            onAddTag:function(tag){
                autoload();
            },
            onRemoveTag:function(tag){
                autoload();
            }
        });

        $(document).on('focus', '#tags_tag', function(){
            $('#error_p').hide();
        })


        /*确认保存按钮*/
        $('#nextThree').click(function(){
            var reg = /^(\d{1,8})(\.\d{1,2})?$/;
            var flag = 0;
            $('#areaTable tr:gt(0)').find('input').each(function(){
                var value = $(this).val();
                if (reg.test(value)){
                    $(this).parent().removeClass('has-error');
                }
                else{
                    $(this).parent().addClass('has-error');
                    flag = 1;
                }
            })
            if(flag == 0) {
                // console.log('成功');
                var data = new Object();
                var k = 0;
                $('#areaTable tr:gt(0)').find('input').each(function(){
                    var price = $(this).val();
                    var area = $(this).attr('area');
                    data[k] = new Object();
                    data[k]['price'] = price;
                    data[k++]['area'] = area;
                })
            } else {
                return false;
            }
            
            // data = JSON.stringify(data);
            var loadIndex = window.layer.load(2,{time: 5000});
            /*ajax存储价格*/
            $.ajax({
                url: '/admin/classPrice/newPrice',
                dataType: 'json',
                type: 'post',
                data: {
                    data: data,
                    id: $('#classSelect option:selected').val()
                },
                success: function (data) {
                    if (data.errcode == 0) {
                        window.layer.close(loadIndex);
                        window.layer.msg('更新价格成功');
                        window.location.reload();
                    }
                }
            })
        })

        $(document).on('blur', '.input_price', function(){
            var reg = /^(\d{1,8})(\.\d{1,2})?$/;
            var value = $(this).val();
            if (reg.test(value)){
                $(this).parent().removeClass('has-error');
            }
            else{
                $(this).parent().addClass('has-error');
            }
        })

        $('#newPriceModal').on('hidden.bs.modal', function (e) {
            $('#areaTable tr:gt(0)').remove();
            $('#areaTable').hide();

            $('#tags_tagsinput .tag').each(function(){
                var value = $(this).find('span').text().trim();
                $('#tags').removeTag(value);
            })

            // $('#nextTwo').show();
            $('#nextThree').hide();
        })

        function autoload(){
            var tagArr = new Array();
            var reg = /^\d+$/;
            var flag = 0;
            $('#tags_tagsinput .tag').each(function(){
                var value = $(this).find('span').text().trim();
                if (!reg.test(value)) {
                    $('#error_p').show().find('.col-sm-10').html('必须全部为数字');
                    flag = 1;
                }
                tagArr[tagArr.length] = parseInt(value);
            })
            if (tagArr.length == 0) {
                $('#error_p').show().find('.col-sm-10').html('不能为空');
                flag = 1;
            }

            if (flag == 0) {
                $('#areaTable tr:gt(0)').remove();
                $('#areaTable').show();
                $('#nextTwo').hide();
                $('#nextThree').show();
                var len = tagArr.length;
                for (var i = 0;i < len-1;i++) {
                    for(var j = i+1;j < len;j++) {
                        if (tagArr[i] > tagArr[j]) {
                            var temp = tagArr[i];
                            tagArr[i] = tagArr[j];
                            tagArr[j] = temp;
                        }
                    }
                }

                var prev = 1;
                for (var k = 0;k <= len;k++) {
                    if (k == 0) {
                        $('#areaTable tbody').append('<tr> <td>'+(k+1)+'</td> <td> <= '+(tagArr[k]-1)+'</td> <td><input area="'+(tagArr[k]-1)+'" type="text" class="input_price form-control"/></td> </tr>');
                        prev = tagArr[k];
                    }
                    else if (k == len) {
                        $('#areaTable tbody').append('<tr> <td>'+(k+1)+'</td> <td> >= '+prev+'</td> <td><input area="'+prev+'" type="text" class="input_price form-control"/></td> </tr>');
                        prev = tagArr[k];
                    } else {
                        $('#areaTable tbody').append('<tr> <td>'+(k+1)+'</td> <td>'+prev+'-'+(tagArr[k]-1)+'</td> <td><input area="'+prev+'-'+(tagArr[k]-1)+'" type="text" class="input_price form-control"/></td> </tr>');
                        prev = tagArr[k];
                    }
                }
            } else {
                $('#areaTable tr:gt(0)').remove();
                $('#areaTable').hide();
                $('#nextThree').hide();
            }
        }
	})
</script>

<script type="text/javascript">
    /*二改js*/
    $(function(){
        $('.teacherBtn').click(function(){
            $(this).parent().find('.btn-primary').removeClass('btn-primary').addClass('btn-default');
            $(this).addClass('btn-primary');

            $.ajax({
                url: '/admin/classPrice/getTeacherPrice',
                dataType: 'json',
                type: 'post',
                data: {
                    id: $(this).attr('tid')
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        if (data.str == '')
                            data.str = '<tr><td>未设置价格</td></tr>';
                        $('#showPrice tbody').html(data.str);
                    }
                }
            })
        })
    })
</script>
@endsection