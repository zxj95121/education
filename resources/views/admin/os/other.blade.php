@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap3-editable/bootstrap-editable.css">
<style type="text/css">
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">其他简单管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    其他管理
                                </h3>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-lg-6">
		                        <div class="panel panel-default">
		                            <div class="panel-body"> 
		                               <!-- <form action="" class="form-horizontal"> -->
		                               @if($powerObj->identity == 1 && $powerObj->modify_price == 1)
		                                <div class="form-group setValue" type="modifyPrice">
		                                    <label class="col-sm-3 control-label" style="font-size: 18px;">订单改价口令</label>
		                                    <div class="col-sm-9" style="position: relative;top:3px;">
		                                        <a href="#" id="inline-username" data-type="text" data-pk="1" data-title="Enter username" class="editable editable-click" style="font-size: 18px;">{{$modifyPricePasswd}}</a>
		                                    </div>
		                                </div>
		                                @else
		                                @endif
		                            <!-- </form> -->
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
<script type="text/javascript" src="/admin/assets/bootstrap3-editable/moment.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap3-editable/bootstrap-editable.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap3-editable/demo-xeditable.js"></script>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });

        $(document).on('click', '.setValue button[type="submit"]', function() {
        	var val = $(this).parents('form').find('input').val();
        	if($(this).parents('.setValue').attr('type') == 'modifyPrice') {
        		$.ajax({
        			url: '/admin/otherSetting/modifyPrice',
        			type: 'post',
        			dataType: 'html',
        			data: {
        				val: val
        			},
        			success: function(data) {
                        window.layer.msg('修改成功');
        			}
        		})
        	}
        })
    });
</script>
@endsection