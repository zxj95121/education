@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">修改Class抢课活动</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	修改Class抢课活动
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
				                                <form role="form" class="p-20">
				                                    <div class="form-group">
				                                        <label for="text"><font><font>课程名称</font></font></label>
				                                        <select class="form-control classname" name="pid">
				                                        	@foreach($classpackage as $value)
																<option value="{{$value->id}}"@if($value->id == $res->id) slected="selected" @endif>{{$value->name}}</option>
															@endforeach
														</select>
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>原价格</font></font></label>
				                                        <select disabled="disabled" class="form-control yprice" name="">
				                                        	@foreach($classpackage as $value)
																<option value="{{$value->id}}"@if($value->id == $res->id) slected="selected" @endif>{{$value->price}}/元</option>
															@endforeach
														</select>
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>抢课价格</font></font></label>
														<input type="text" class="form-control" placeholder="抢课价格/元" name="discount_price" value="{{$res->discount_price}}">
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>活动开始时间</font></font></label>
				                                        <input type="text" class="form-control" name="" id="inputstart">
                                               			<input type="hidden" name="hiddenDate" id="hiddenDate" value="{{$res->start_time}}">
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>抢课概率</font></font></label>
														<input type="text" class="form-control" placeholder="抢课概率/%" name="probability" value="{{$res->probability}}">
				                                    </div>
				                                    <div class="form-group">
				                                    	<button id="fanhui" type="submit" class="btn btn-default"><font><font>返回</font></font></button>
				                                    	<input type="hidden" name="id" value="{{$res->id}}">
				                                    	<button id="edit" type="submit" class="btn btn-success"><font><font>修改</font></font></button>
				                                    </div>
				                                </form>
				                            </div>
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
<script type="text/javascript" src="/js/jeui/jedate.js"></script>
<script>
var stringTime = "{{$res->start_time}}";
var str = /(\d{4})-(\d{2})-(\d{2})\s(\d{2})\:(\d{2})\:(\d{2})/;
var arr = stringTime.match(str); 
var hh = arr[4];
var mm = arr[5];
var ss = arr[6];
var start = {
    format: 'YYYY-MM-DD hh:mm:ss',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: false,
    isinitVal:true,                            //是否初始化时间，默认不初始化时间
    isTime:true, //是否开启时间选择
    hmsSetVal:{hh:hh,mm:mm,ss:ss},
    maxDate: '2099-01-01', //最大日期
    choosefun: function(elem, val, date){
        // end.minDate = val; //开始日选好后，重置结束日的最小日期
        // endDates();
        console.log(dd);
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
$('#inputstart').val(stringTime);
</script>
<script>
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
		$('#fanhui').click(function(){
			window.history.go(-1);
			return false;
		})
		$(document).on('change','.classname',function(){
			var index = $(this).get(0).selectedIndex; // 选中索引
			$('.yprice').find('opiton').removeProp('selected');
			$('.yprice').find('option').eq(index).prop('selected','selected');
		})
		$('#edit').click(function(){
  			$.ajax({
    			url:"/admin/otherClass/discount/edit_post",
    			data:{
        			id:$('input[name="id"]').val(),
    				pid:$('select[name="pid"]').val(),
    				discount_price:$('input[name="discount_price"]').val(),
    				probability:$('input[name="probability"]').val(),
					start_time:$('#hiddenDate').val()
        		},
    			type:'post',
    			datatype:'json',
    			success:function(date){
        			console.log(date);
    				if(date.code == 200){
						window.layer.msg('修改成功');
						window.location.href="/admin/otherClass/discount";
            		}else{
						window.layer.msg('修改失败，请重新修改');
                	}
    			}
            }) 	
            return false; 
		})
	})
</script>
@endsection