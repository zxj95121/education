@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
<style type="text/css">
    .operate span{
        cursor: pointer;
    }
   .abc a{
		margin-right:10px;   			
   	}
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">免费试听课发送通知</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    免费试听课发送通知
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
	                                       	<div class="abc" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
                                            	<a href="#"  class="label label-info"  onclick="allyes()">全选</a><a href="#" class="label label-inverse" onclick="allno()">取消</a><a href="#" onclick="settime()" id="piliang" class="label label-primary">批量设置时间</a><a href="#" class="label label-primary" onclick="notice()">批量发送通知</a></td>
                                            </div>
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
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">分配时间</h4>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="message-text" class="control-label">已选(<span id="number"></span>)人,分配试听课时间:</label>
									<input type="text" class="form-control" name="" id="inputstart">
                                   	<input type="hidden" name="hiddenDate" id="hiddenDate">
								</div>
								<div class="form-group">
									<label for="recipient-name" class="control-label">当前日期还可以分配人数:</label>
									<input type="text" class="form-control" id="sum" value="12" disabled>
								</div>

							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<button type="button" class="btn btn-primary" id="add">提交</button>
						</div>
					</div>
				</div>
			</div>
@endsection
           
<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/js/jeui/jedate.js"></script>
<script> 
var start = {
    format: 'YYYY-MM-DD hh:mm:ss',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: false,
    isinitVal:false,                            //是否初始化时间，默认不初始化时间
    isTime:true, //是否开启时间选择
    maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        $.ajax({
			url:'/admin/classFree/setActiveTime/inspect',
			data:{
				active_time:val
			},
			type:'post',
			datatype:'json',
			success:function(data){
				if(data.code == 1){
					var count = 12 - parseInt(data.count);
					$('#sum').val(count);
					 $('#hiddenDate').val(val);
				}
			}
        })
        
    },
    okfun:function(elem, val, date) {
        console.log(2);
        $('#hiddenDate').val(val);
    }, 
};
//或者是
$.jeDate('#inputstart',start);
</script>
<script type="text/javascript">
	var ids = '';
    $(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

    })
    function allyes(){
    	$("input[name='ids']").prop("checked",'true');//全选 
   	}
   	function allno(){
   		$("input[name='ids']").removeAttr("checked");
   	}	
    function settime(){ 
    	ids = [];
    	$('input[name="ids"]:checked').each(function(){ 
    		ids.push($(this).val()); 
    	}); 
    	if(ids.length == 0){
			layer.msg('未进行选择');
        }else{
        	$('#number').text(ids.length);
        	$('#exampleModal').modal('toggle');
        }
    	
    }
	$('#add').click(function(){
		if($('#hiddenDate').val() == ''){
			layer.msg('还未选择日期');
			return false;
		}
		var count1 = parseInt($('#number').text());
		var count2 = parseInt($('#sum').text());
		if(count1 > count2){
			layer.msg('该日期已超过限制人数，请重选择');
			return false;
		}else{
			$.ajax({
				url:'/admin/classFree/setActiveTime/post',
				data:{
					ids:ids,
					active_time:$('#hiddenDate').val()
				},
				type:'post',
				datatype:'json',
				success:function(data){
					if(data.code == 1){
						$('#exampleModal').modal('hide');
						$('#inputstart').val('');
						$('#hiddenDate').val('');
						$('#sum').val(12);
						layer.msg('分配时间成功，请进行通知');
						setTimeout(function(){
							window.location.href="/admin/classFree/notice";
						},2000)
						
					}else{
						$('#exampleModal').modal('hide');
						layer.msg('分配时间失败');
					}
				}
			})
		}
	})
	function notice(){
    	ids = [];
    	$('input[name="ids"]:checked').each(function(){ 
    		ids.push($(this).val()); 
    	}); 
    	if(ids.length == 0){
			layer.msg('未进行选择');
			return false;
	    }
	    $.ajax({
			url:'/admin/classFree/notice_post',
			data:{
				ids:ids
			},
			type:'post',
			datatype:'json',
			success:function(data){
				if(data.code == 1){
					layer.msg('发送通知成功');
					setTimeout(function(){
						window.location.href="/admin/classFree/notice";
					},2000)
				}
			}
		})
	}
</script>
@endsection