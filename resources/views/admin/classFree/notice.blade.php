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
                                	<div class="row" style="margin-bottom: 5px;">
                                        <div class="form-group">
                                      		<form id="search_form" action="/admin/classFree/notice/query" method="get">
	                                            <label for="pay_select" class="col-md-1 clh text-right">日期:</label>
	                                            <div class="col-md-2">
	                                                <input type="text" class="form-control" name="" id="cxdate" value="@if($querytime) {{$querytime}} @endif">
	                                                <input type="hidden" name="hiddencxdate" id="hiddencxdate" value="@if($querytime) {{$querytime}} @endif">
	                                            </div>
	                                            <label class="col-md-1 clh text-right">通知状态:</label>
	                                            <div class="col-md-2">
	                                                <select name="querytype"  class="form-control">
	                                                    <option value="">全部</option>
	                                                    <option value="0" @if($querytype != null && $querytype == 0) selected="selected" @endif>未发送</option>
	                                                    <option value="1" @if($querytype ==1) selected="selected" @endif>已发送</option>
	                                                </select>
	                                            </div>
	                                            <label class="col-md-1 clh text-right">完成状态:</label>
	                                            <div class="col-md-2">
	                                                <select name="complete"  class="form-control">
	                                                    <option value="">全部</option>
	                                                    <option value="0" @if($complete != null && $complete == 0) selected="selected" @endif>未完成</option>
	                                                    <option value="1" @if($complete ==1) selected="selected" @endif>已完成</option>
	                                                </select>
	                                            </div>
	                                            <button class="btn btn-success" style="margin-left: 20px;" id="searchBtn">确认查询</button>
                                        	</form>
                                        </div>
                                    </div>
                                	<div class="row">
	                                    <div class="table-responsive">
	                                       	<div class="abc" style="padding-left:10px;margin-top:5px;margin-bottom:5px;">
                                            	<a href="#"  class="label label-info"  onclick="allyes()">全选</a>
                                            	<a href="#" class="label label-inverse" onclick="allno()">取消</a>
                                            	<a href="#" class="label label-primary" onclick="settime()">批量修改时间</a>
                                            	<a href="#" class="label label-primary"  onclick="notice()" >批量发送通知</a>
                                            	<a href="#" class="label label-primary" onclick="complete()"  >批量完成</a>
                                            </div>
	                                        <table class="table">
	                                            <thead>
	                                                <tr>
	                                                    <th>ID</th>
	                                                    <th>申请时间</th>
	                                                    <th>用户昵称</th>
	                                                    <th>手机号</th>
	                                                    <th>预约时间</th>
	                                                    <th>发送状态</th>
	                                                    <th>完成状态</th>
	                                                    <th>操作</th>
	                                                </tr>
	                                            </thead>
	                                            <tbody>
	                                            	@php $currentPage = $res->currentPage(); @endphp
	                                            	@php $currentDate = substr($res[0]->created_at, 0, 10); @endphp
	                                                @foreach($res as $key => $value)
		                                                @if($currentDate != substr($value->created_at, 0, 10)) {
		                                                	echo '<tr><td>'.$currentDate.'</td></tr>';
		                                                	$currentDate = substr($value->created_at, 0, 10);
		                                                }
		                                                @else
		                                                @endif
	                                                <tr>
	                                                    <td>
	                                                    	@if($value->complete)
	                                                    	@else
	                                                    		<input type="checkbox" name="ids" value="{{$value->id}}">
	                                                    	@endif
	                                                    	{{$key+(($currentPage-1)*10)+1}}
	                                                   	</td>
	                                                   	<td>{{substr($value->created_at, 0, 16)}}</td>
	                                                    <td>{{$value->nickname}}</td>
	                                                    <td>{{$value->phone}}</td>
	                                                    <td>{{$value->active_time}}</td>
	                                                    <td>
	                                                    	@if($value->type)
	                                                    		<span class="label label-success">已通知</span>
	                                                    	@else
	                                                    		<span class="label label-default">未通知</span>
	                                                    	@endif
	                                                    </td>
	                                                    <td>
	                                                    	@if($value->complete)
	                                                    		<span class="label label-success">已完成</span>
	                                                    	@else
	                                                    		<span class="label label-default">未完成</span>
	                                                    	@endif
	                                                    </td>
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
    hmsSetVal:{hh:00,mm:00,ss:00},
    isTime:true, //是否开启时间选择
    maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        $.ajax({
			url:'/admin/classFree/setActiveTime/inspect',
			data:{
				ids:ids,
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
        $.ajax({
			url:'/admin/classFree/setActiveTime/inspect',
			data:{
				ids:ids,
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
};
//或者是
$.jeDate('#inputstart',start);

var start2 = {
	    format: 'YYYY-MM-DD',
	    minDate: '2017-07-01', //设定最小日期为当前日期
	    festival: false,
	    isinitVal:false,                            //是否初始化时间，默认不初始化时间
	    hmsSetVal:{hh:00,mm:00,ss:00},
	    isTime:true, //是否开启时间选择
	    maxDate: '2099-01-01', //最大日期
	    choosefun: function(elem, val, date){
	        // end.minDate = val; //开始日选好后，重置结束日的最小日期
	        // endDates();
			$('#hiddencxdate').val(val);
	    },
	    okfun:function(elem, val, date) {
	    	$('#hiddencxdate').val(val);
	    }, 
	};
	//或者是
	$.jeDate('#cxdate',start2);
</script>
<script type="text/javascript">
	var ids = '';
    $(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

    })
    $('.pagination li a').each(function(){
   		var href = $(this).attr('href');
        if (href)
       		$(this).attr('href', href+'{!!$str!!}');
    })
    function allyes(){
    	$("input[name='ids']").prop("checked",'true');//全选 
   	}
   	function allno(){
   		$("input[name='ids']").removeAttr("checked");
   	}	
    function settime(){
        $('#inputstart').val('');
        $('#sum').val('12'); 
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
	function complete(){
    	ids = [];
    	$('input[name="ids"]:checked').each(function(){ 
    		ids.push($(this).val()); 
    	}); 
    	if(ids.length == 0){
			layer.msg('未进行选择');
			return false;
	    }
	    $.ajax({
			url:'/admin/classFree/complete_post',
			data:{
				ids:ids
			},
			type:'post',
			datatype:'json',
			success:function(data){
				if(data.code == 1){
					layer.msg('已完成');
					setTimeout(function(){
						window.location.href="/admin/classFree/notice";
					},2000)
				}
			}
		})
	}
</script>
@endsection