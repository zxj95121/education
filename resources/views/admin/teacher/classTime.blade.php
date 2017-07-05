@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<style type="text/css">
	.edit, .delete{
		cursor: pointer;
	}
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">上课时间设置</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	上课时间设置
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
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                   							<div class="panel-body">
				                                <div class="row" style="margin-bottom: 12px;">
				                                	<button class="btn btn-success" id="addBtn">添加课程时间</button>
				                                </div>
				                                <div class="col-lg-6"> 
							                        <div class="panel-group panel-group-joined" id="accordion-test1">
							                            <div class="panel panel-default"> 
							                                <div class="panel-heading"> 
							                                    <h4 class="panel-title"> 
							                                        <a data-toggle="collapse" data-parent="#accordion-test1" href="#collapseTwo" aria-expanded="true" class="">
							                                            周一到周五
							                                        </a> 
							                                    </h4> 
							                                </div> 
							                                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true"> 
							                                    <div class="panel-body">
							                                        <table class="table">
							                                        	<thead>
							                                        		<tr>
							                                        			<th>ID</th>
							                                        			<th>课程时间段</th>
							                                        			<th>操作</th>
							                                        		</tr>
							                                        	</thead>
							                                        	<tbody>
							                                        		@foreach($type1 as $value)
							                                        		<tr tid="{{$value->id}}">
							                                        			<td>{{$value->id}}</td>
							                                        			<td>{{$value->low}}-{{$value->high}}</td>
							                                        			<td>
							                                        				<span class="label label-primary edit">修改</span>
							                                        				<span class="label label-primary delete">删除</span>
							                                        			</td>
							                                        		</tr>
							                                        		@endforeach
							                                        	</tbody>
							                                        </table>
							                                    </div> 
							                                </div> 
							                            </div> 
							                        </div> 
							                    </div>
							                    <div class="col-lg-6"> 
							                        <div class="panel-group panel-group-joined" id="accordion-test2">
							                    		<div class="panel panel-default"> 
							                                <div class="panel-heading"> 
							                                    <h4 class="panel-title"> 
							                                        <a data-toggle="collapse" data-parent="#accordion-test1" href="#collapseTwo" aria-expanded="true" class="">
							                                            周末、节假日
							                                        </a> 
							                                    </h4> 
							                                </div> 
							                                <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true"> 
							                                    <div class="panel-body">
							                                        <table class="table">
							                                        	<thead>
							                                        		<tr>
							                                        			<th>ID</th>
							                                        			<th>课程时间段</th>
							                                        			<th>操作</th>
							                                        		</tr>
							                                        	</thead>
							                                        	<tbody>
							                                        		@foreach($type2 as $value)
							                                        		<tr tid="{{$value->id}}">
							                                        			<td>{{$value->id}}</td>
							                                        			<td>{{$value->low}}-{{$value->high}}</td>
							                                        			<td>
							                                        				<span class="label label-primary edit">修改</span>
							                                        				<span class="label label-primary delete">删除</span>
							                                        			</td>
							                                        		</tr>
							                                        		@endforeach
							                                        	</tbody>
							                                        </table>
							                                    </div> 
							                                </div> 
							                            </div>
							                        </div>
							                    </div>
				                            </div>
                                    	</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


            <div id="newClassTimeModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">添加上课时间安排</h4>
			      		</div>
			      		<div class="modal-body">
			        		<div class=" form">
                                <form class="cmxform form-horizontal tasi-form" id="newTimeForm" novalidate="novalidate">
                                    <div class="form-group ">
                                        <label for="classType" class="control-label col-lg-2">上课时间类型</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" name="classType" id="classType" style="color:#000;">
                                            	<option value="">请选择时间类型</option>
                                            	<option value="1">周一到周五</option>
                                            	<option value="2">周末节假日</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                    	<label for="timepicker1" class="control-label col-lg-2">课程开始时间</label>
                                        <div class="input-group col-lg-10">
                                    		<div class="bootstrap-timepicker">
                                    			<input id="timepicker1" type="text" class="form-control">
                                    		</div>
                                    		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                		</div>
                                    </div>
                                    <div class="form-group ">
                                    	<label for="timepicker2" class="control-label col-lg-2">课程结束时间</label>
                                        <div class="input-group col-lg-10">
                                    		<div class="bootstrap-timepicker">
                                    			<input id="timepicker2" type="text" class="form-control">
                                    		</div>
                                    		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                		</div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit">确认添加</button>
                                            <button class="btn btn-default" data-dismiss="modal" type="button">关闭</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
			      		</div>
			      		<div class="modal-footer">
			      		</div>
			    	</div><!-- /.modal-content -->
			  	</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<!-- 修改时间段模态框 -->
			<div id="editClassTimeModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">修改上课时间安排</h4>
			      		</div>
			      		<div class="modal-body">
			        		<div class=" form">
                                <form class="cmxform form-horizontal tasi-form" id="newTimeForm" novalidate="novalidate">
                                	<div class="form-group">
                                		<label for="kcid" class="control-label col-lg-2">课程ID</label>
                                		<div class="input-group col-lg-10">
                                			<span class="form-control" id="kcid" style="font-size: 19px;user-select: none;">23</span>
                                		</div>
                                	</div>
                                    <div class="form-group ">
                                    	<label for="timepicker3" class="control-label col-lg-2">课程开始时间</label>
                                        <div class="input-group col-lg-10">
                                    		<div class="bootstrap-timepicker">
                                    			<input id="timepicker3" type="text" class="form-control">
                                    		</div>
                                    		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                		</div>
                                    </div>
                                    <div class="form-group ">
                                    	<label for="timepicker4" class="control-label col-lg-2">课程结束时间</label>
                                        <div class="input-group col-lg-10">
                                    		<div class="bootstrap-timepicker">
                                    			<input id="timepicker4" type="text" class="form-control">
                                    		</div>
                                    		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                		</div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit" id="editConfirm">确认修改</button>
                                            <button class="btn btn-default" data-dismiss="modal" type="button">关闭</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
			      		</div>
			      		<div class="modal-footer">
			      		</div>
			    	</div><!-- /.modal-content -->
			  	</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
@endsection
<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script src="assets/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="assets/jquery.validate/jquery.validate.min.js"></script>
<script type="text/javascript">
	
	/**
	* Theme: Velonic Admin Template
	* Author: Coderthemes
	* Form Validator
	*/

	!function($) {
	    "use strict";

	    var FormValidator = function() {
	        this.$newTimeForm = $("#newTimeForm");
	    };

	    //init
	    FormValidator.prototype.init = function() {
	        //validator plugin
	        $.validator.setDefaults({
	            submitHandler: function() {
	            	/*将数据带走把*/
	            	$.ajax({
	            		url: '/admin/setClassTime/newTime',
	            		dataType: 'json',
	            		type: 'post',
	            		data: {
	            			time1: $('#timepicker1').val(),
	            			time2: $('#timepicker2').val(),
	            			classType: $('#classType option:selected').val()
	            		},
	            		success: function(data){
	            			if (data.errcode == 0) {
	            				window.location.reload();
	            			}
	            		}
	            	})
	            }
	        });

	        // validate signup form on keyup and submit
	        this.$newTimeForm.validate({
	            rules: {
	                classType: "required",
	            },
	            messages: {
	                classType: "请选择时间类型",
	            }
	        });

	    },
	    //init
	    $.FormValidator = new FormValidator, $.FormValidator.Constructor = FormValidator
	}(window.jQuery),


	//initializing 
	function($) {
	    "use strict";
	    $.FormValidator.init()
	}(window.jQuery);
</script>
<script type="text/javascript">
	$(function(){

		layui.use('layer', function(){
            window.layer = layui.layer;
        }); 
		 // $("#timepicker2").timepicker({format: 'hh:ii'});
		jQuery('#timepicker1').timepicker({showMeridian: false,minuteStep: 5});
		jQuery('#timepicker2').timepicker({showMeridian: false,minuteStep: 5});
		jQuery('#timepicker3').timepicker({showMeridian: false,minuteStep: 5});
		jQuery('#timepicker4').timepicker({showMeridian: false,minuteStep: 5});
		$('#timepicker2').val('');

		getTime($('#timepicker1').val());
		$('#timepicker1').change(function(){
			var val = $(this).val();
		  	getTime(val);
		})

		$('#timepicker3').change(function(){
			var val = $(this).val();
		  	getTime(val, 2);
		})

		$('#addBtn').click(function(){
			$('#newClassTimeModal').modal({backdrop: 'static', keyboard: false});
		})

		$(document).on('click', '.edit', function(){
			$('#editClassTimeModal').modal({backdrop: 'static', keyboard: false});
			var time = $(this).parents('tr').find('td:eq(1)').html();
			var split = time.split('-');
			$('#timepicker3').val(split[0]);
			$('#timepicker4').val(split[1]);
			$('#kcid').html($(this).parents('tr').attr('tid'));
		})

		$('#editConfirm').click(function(){
			var id = $('#kcid').html();
			var time1 = $('#timepicker3').val();
			var time2 = $('#timepicker4').val();

			$(this).prop('disabled', true).html('正在修改');
			$.ajax({
				url: '/admin/setClassTime/editTime',
				dataType: 'json',
				type: 'post',
				data: {
					id: id,
					time1: time1,
					time2: time2
				},
				success: function(data) {
					if (data.errcode == 0) {
						window.layer.msg('修改成功');
						$('#editConfirm').removeProp('disabled');
						$('#editClassTimeModal').modal('hide');

						$('tr[tid="'+id+'"]').find('td:eq(1)').html(time1+'-'+time2);
					}
				},
				error: function(){
					window.layer.msg('修改失败');
					$('#editConfirm').removeProp('disabled');
					$('#editClassTimeModal').modal('hide');
				}
			});
		})

		$(document).on('click', '.delete', function(){
			var id = $(this).parents('tr').attr('tid')
			window.layer.confirm('确认删除编号 <span style="font-weight:bold;">'+id+'</span> 吗？', {
			  	btn: ['确认', '取消'] //可以无限个按钮
			  	,btn2: function(index, layero){
			  		window.layer.close(index);
			  	}
			}, function(index, layero){
			  	window.layer.close(index);
			    	var loadIndex = window.layer.load(2, {time:5000});
					$.ajax({
						url: '/admin/setClassTime/deleteTime',
						dataType: 'json',
						type: 'post',
						data: {
							id: id
						},
						success: function(data) {
							window.layer.close(loadIndex);
							if (data.errcode == 0) {
								window.layer.msg('删除成功');

								$('tr[tid="'+id+'"]').remove();
							}
						},
						error: function(){
							window.layer.msg('删除失败');
							window.layer.close(loadIndex);
						}
					});
			});
		})

		function getTime(val,type=1){
		  	var reg = /^\d{2}\:\d{2}$/;
		  	if (reg.test(val)) {
		  		var hour = parseInt(val.split(':')[0]);
		  		var minute = parseInt(val.split(':')[1]);
		  		var nMinute = minute+90;
		  		var temp = parseInt(nMinute/60);
		  		minute = nMinute%60;
		  		hour += temp;
		  		if (hour == 24)
		  			hour = 0;
		  		if (hour == 25)
		  			hour = 1;
		  		if (hour < 10)
		  			hour = '0'+hour;
		  		if (minute < 10)
		  			minute = '0'+minute;

		  		$('#timepicker2').val(hour+':'+minute);
		  		if (type != 1) {
		  			$('#timepicker4').val(hour+':'+minute);
		  		}
		  	}
		}
	})
</script>
@endsection