@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/js/jeui/jedate.css">
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">添加Class抢课活动</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	添加Class抢课活动
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
																<option value="{{$value->id}}">{{$value->name}}</option>
															@endforeach
														</select>
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>原价格</font></font></label>
				                                        <select disabled="disabled" class="form-control yprice" name="">
				                                        	@foreach($classpackage as $value)
																<option value="{{$value->id}}">{{$value->price}}/元</option>
															@endforeach
														</select>
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>抢课价格</font></font></label>
														<input type="text" class="form-control" placeholder="抢课价格/元" name="discount_price">
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>活动开始时间</font></font></label>
				                                        <input type="text" class="form-control" name="" id="inputstart">
                                               			<input type="hidden" name="hiddenDate" id="hiddenDate">
				                                    </div>
				                                    <div class="form-group">
				                                        <label for="text"><font><font>抢课概率</font></font></label>
														<input type="text" class="form-control" placeholder="抢课概率/%" name="probability">
				                                    </div>
				                                    <div class="form-group">
				                                    	<button id="fanhui" type="submit" class="btn btn-default"><font><font>返回</font></font></button>
				                                    	<button id="add" type="submit" class="btn btn-success"><font><font>添加</font></font></button>
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
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth()+1;

if(month < 10)
    month = '0'+month;
var day = date.getDate();
if(day < 10)
    day = '0'+day;
var str = year+'-'+month+'-'+day+' '+'16:16:00';

$('#hiddenDate').val(str);

var start = {
    format: 'YYYY-MM-DD hh:mm:ss',
    minDate: '2017-07-01', //设定最小日期为当前日期
    festival: false,
    isinitVal:true,                            //是否初始化时间，默认不初始化时间
    isTime:true, //是否开启时间选择
    initAddVal:{DD:"+0"}, 
    hmsSetVal:{hh:16,mm:16,ss:00},
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
		$('#add').click(function(){
  			$.ajax({
    			url:"/admin/otherClass/discount/add_post",
    			data:{
    				pid:$('select[name="pid"]').val(),
    				discount_price:$('input[name="discount_price"]').val(),
    				probability:$('input[name="probability"]').val(),
					start_time:$('#hiddenDate').val()
        		},
    			type:'post',
    			datatype:'json',
    			success:function(date){
    				if(date.code == 200){
						window.layer.msg('添加成功');
						window.location.href="/admin/otherClass/discount";
            		}else{
						window.layer.msg('添加失败，请重新添加');
                	}
    			}
            }) 	
            return false; 
		})
	})
</script>
@endsection