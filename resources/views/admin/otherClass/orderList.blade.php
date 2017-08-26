@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
	.error{
		color: red;
	}
	.label{
		cursor: pointer;
	}
	#parentDetail td{
        vertical-align: middle;
    }
    #parentDetail .label{
        margin-top: 5px;
        display: inline-block;
    }
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">class课程套餐订单</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase" style="font-size:1.75em;">
                                    {{$package->name}}
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
                                        @if(count($orderObj) == 0)
                                            暂无订单
                                        @else
                                    		<table class="table table-hover" id="parentDetail">
                                    			<thead>
    												<tr>
    													<th>ID</th>
    													<th>订单编号</th>
                                                        <th>昵称</th>
                                                        <th>英语party(本次)</th>
                                                        <th>英语party(合计)</th>
                                                        <th>手机号</th>
    													<th>优惠金额</th>
    													<th>实际支付价格</th>
    													<th>操作</th>
    												</tr>
    											</thead>
    											<tbody>
    												@foreach($orderObj as $value)
                                                    <tr oid="{{$value->id}}" userId="{{$value->userId}}" cid="{{$value->cid}}">
                                                        <td>{{$value->id}}</td>
                                                        <td>{{$value->order_no}}</td>
                                                        <td>{{$value->nickname}}</td>
                                                        <td class="bpaty">{{$value->paty}}</td>
                                                        <td class="patyTd">{{$value->patynum}}</td>
                                                        <td>{{$value->phone}}</td>
                                                        <td>@if($value->voucher_name) 88元*{{$value->voucher_num}} @else <span class="label label-default">未使用优惠券</span> @endif</td>
                                                        <td class="td_price">¥ {{number_format($value->price, 2)}}</td>
                                                        <td>
                                                        	<span class="label label-info addPaty">添加party</span>
                                                        	@if($powerObj->modify_price)
                                                        		<span class="label label-info modifyPriceBtn">修改订单价格</span>
                                                        	@else
                                                        	@endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
    											</tbody>
    										</table>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 {{$orderObj->total()}}条记录</div>
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ $orderObj->appends(['cid' => $cid])->links() }}
                                                </div>
                                            </div>
                                        @endif
                                	</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>

            <div id="addModal" pid="" class="modal fade" tabindex="-1" role="dialog">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">添加新eclass套餐</h4>
			      		</div>
			      		<div class="modal-body">
			      			<div class="row">
				        		<div class="form-group row" style="margin-bottom: 20px;">
		                            <div class="col-md-2" style="text-align: right;">
		                                <label for="tcName">套餐名称</label>
		                            </div>
		                            <div class="col-md-10">
		                                <input type="text" name="tcName" id="tcName" class="form-control">
		                                <span class="error" id="tc_name_error"></span>
		                            </div>
	                        	</div>
	                        	<div class="form-group row">
		                            <div class="col-md-2" style="text-align: right;">
		                                <label for="tcPrice">套餐价格</label>
		                            </div>
		                            <div class="col-md-10">
		                                <input type="text" name="tcPrice" id="tcPrice" class="form-control">
		                                <span class="error" id="tc_price_error"></span>
		                            </div>
	                        	</div>
                                <div class="form-group row">
                                    <div class="col-md-2" style="text-align: right;">
                                        <label for="tcNumber">课时数量</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="number" name="tcNumber" id="tcNumber" required class="form-control">
                                        <span class="error" id="tc_number_error"></span>
                                    </div>
                                </div>
                        	</div>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="addBtn">确认添加</button>
				        	<button type="button" class="btn btn-primary" id="editBtn">确认修改</button>
				      	</div>
			    	</div><!-- /.modal-content -->
			  	</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- 英语 -->
			<div id="modal2" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mypatyLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="mypatyLabel" style="font-weight: bold;"><font><font id="bttitle2">添加paty</font></font></h4>
                        </div>
                        <div class="modal-body">
	                       	<div class="row">
							    <div class="form-group" style="margin-top:13px;">
							    	<div class="col-md-3" style="text-align: right;">
							    		<label for="ticketNumInput">paty次数</label>
							    	</div>
					        		<div class="col-md-9">
					        			<input type="number" min="1" value="1" id="patyNumber" name="patyNumber" class="form-control">
					        		</div>
					        	</div>
					        </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关闭</font></font></button> 
                            <button type="button" class="btn btn-info" id="addPostPaty"><font><font>确认添加</font></font></button> 
                        </div>

                        <div class="row" style="margin-top: 5px;">
	                        <div class="col-md-12 col-sm-12 col-xs-12">
	                            <table class="table table-hover" id="recordTable2">
	                                <thead>
	                                    <tr>
	                                        <th>序号</th>
	                                        <th>paty数量</th>
	                                        <th>操作</th>
	                                        <th>操作时间</th>
	                                    </tr>
	                                </thead>
	                                <tbody>

	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div> 


            <div id="editPriceModal" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mypatyLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="mypatyLabel" style="font-weight: bold;"><font><font id="bttitle2">修改课程价格</font></font></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="layui-tab">
                                    <ul class="layui-tab-title">
                                        <li class="layui-this">通过打折</li>
                                        <li>直接设价格</li>
                                    </ul>
                                    <div class="layui-tab-content">
                                        <div class="layui-tab-item layui-show">
                                            <div class="row">
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="standPrice1">课程标准价</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="¥ 966元" id="standPrice1" name="" class="form-control" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="zhekou">打几折</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="zhekou" class="form-control">
                                                            <option value="0.9">9折</option>
                                                            <option value="0.8">8折</option>
                                                            <option value="0.7">7折</option>
                                                            <option value="0.6">6折</option>
                                                            <option value="0.5" selected="selected">5折</option>
                                                            <option value="0.4">4折</option>
                                                            <option value="0.3">3折</option>
                                                            <option value="0.2">2折</option>
                                                            <option value="0.1">1折</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="nextPrice">折后价</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="¥ 966元" id="nextPrice" name="" class="form-control" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="passwd1">改价口令</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input value="" id="passwd1" name="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        
                                                    </div>
                                                    <div class="col-md-9">
                                                        <button type="button" class="btn btn-info" id="editPriceBtn1"><font><font>确认打折</font></font></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-tab-item">
                                            <div class="row">
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="standPrice2">课程标准价</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" value="¥ 966元" id="standPrice2" name="" class="form-control" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="setPrice">设定价格</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="decimal" value="" id="setPrice" name="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        <label for="passwd2">改价口令</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input value="" id="passwd2" name="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12" style="margin-top:13px;">
                                                    <div class="col-md-3" style="text-align: right;">
                                                        
                                                    </div>
                                                    <div class="col-md-9">
                                                        <button type="button" class="btn btn-info" id="editPriceBtn2"><font><font>确认改价</font></font></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关闭</font></font></button> 
                             
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div> 
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){

        layui.use('layer', function(){
            window.layer = layui.layer;
        });
        /*添加英语party  */
        $(document).on('click', '.addPaty', function(){
	    	$('#modal2').modal('show');
	    	var userId = $(this).parents('tr').attr('userId');
			var orderId = $(this).parents('tr').attr('oid');
	    	$('#modal2').attr('userId', userId);
			$('#modal2').attr('oId', orderId);
	    	$.ajax({
	    		url: '/admin/parent/getPatyRecord',
				type: 'post',
				dataType: 'json',
				data: {
					id: userId,
					type: 2,
					oid:orderId
				},
				success: function(data){
					var obj = data.obj;
					if (obj.length > 0) {
						$('#recordTable2').show();
						$('#recordTable2 tbody').html('');
						for (var i in obj) {
							if (obj[i].status == 1) {
								var str = '<span class="label label-info backPaty">撤销操作</span>';
							} else {
								var str = '<span class="label label-success">已撤销</span>';
							}
							$('#recordTable2 tbody').append('<tr pid="'+obj[i].id+'"> <td>'+(i+1)+'</td> <td>'+(obj[i].number)+'</td>  <td>'+str+'</td> <td>'+obj[i].updated_at+'</td> </tr>');
						}

					} else {
						$('#recordTable2').hide();
					}
				}
	    	});
	    })
	    $('#addPostPaty').click(function(){
	    	/*saveTicket*/
	    	var id = $('#modal2').attr('userId');
	    	var oid = $('#modal2').attr('oid');
	    	$.ajax({
	    		url: '/admin/parent/addPostPaty',
				type: 'post',
				dataType: 'json',
				data: {
					id: id,
					oid: oid,
					type: 2,
					num: $('#patyNumber').val()
				},
				success: function(data){
					if (data.errcode == 0) {
						window.layer.msg('添加成功');
						$('#modal2').modal('hide');
						$('#patyNumber').val('1');
						$('#parentDetail tr[oid="'+oid+'"]').find('.bpaty').html(data.bpaty);
						$('#parentDetail tr[userId="'+id+'"]').find('.patyTd').html(data.paty);
					}
				}
	    	})
	    })
	    /*撤销添加paty*/
	    $(document).on('click', '.backPaty', function(){
	    	var pid = $(this).parents('tr').attr('pid');
	    	var uid = $('#modal2').attr('userId');
	    	var oid = $('#modal2').attr('oid');
	    	var cdom = $(this);


	    	$.ajax({
	    		url: '/admin/parent/dealPatyRecord',
				type: 'post',
				dataType: 'json',
				data: {
					uid: uid,
					oid: oid,
					type: 2,
					pid: pid
				},
				success: function(data){
					// cdom.remove();
					cdom.replaceWith('<span class="label label-success">已撤销</span>');
					$('#parentDetail tr[oid="'+oid+'"]').find('.bpaty').html(data.bpaty);
					$('#parentDetail tr[userId="'+uid+'"]').find('.patyTd').html(data.patynum);
				}
	    	});
	    })

	    @if($powerObj->modify_price)
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;
        });

        /*修改价格*/
        $('.modifyPriceBtn').click(function(){
            var oid = $(this).parents('tr').attr('oid');
            var cid = $(this).parents('tr').attr('cid');
            $('#editPriceModal').attr('oid', oid);
            $.ajax({
                url: '/admin/otherClass/getStandardPrice',
                dataType: 'json',
                type: 'post',
                data: {
                    cid: cid
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        data.price = twoxs(data.price);
                        $('#standPrice1').val('¥ '+data.price+'元');
                        $('#standPrice2').val('¥ '+data.price+'元');
                        var kou = parseFloat($('#zhekou option:selected').val());
                        var halfPrice = kou*parseFloat(data.price);
                        $('#nextPrice').val('¥ '+twoxs(halfPrice)+'元');
                        $('#zhekou').attr('price', data.price);
                    }
                    $('#editPriceModal').modal('show');
                }

            })
        })

        $('#zhekou').click(function(){
            var val = $('#zhekou option:selected').val();
            var kouPrice = twoxs(parseFloat(val)*parseFloat($('#zhekou').attr('price')));
            $('#nextPrice').val('¥ '+kouPrice+'元');
        })

        $('#editPriceBtn1').click(function(){
            var oid = $('#editPriceModal').attr('oid');
            var val = $('#zhekou option:selected').val();
            var kouPrice = twoxs(parseFloat(val)*parseFloat($('#zhekou').attr('price')));
            var passwd = $('#passwd1').val();
            var zhe = parseFloat($('#zhekou option:selected').val())*10;

            $.ajax({
                url: '/admin/otherClass/editECPrice',
                dataType: 'json',
                type: 'post',
                data: {
                    oid: oid,
                    price: kouPrice,
                    psd: passwd,
                    type: zhe
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        $('#editPriceModal').modal('hide');
                        $('#parentDetail tr[oid="'+oid+'"]').find('.td_price').html('¥ '+twoxs(kouPrice));
                        window.layer.msg('设置价格成功');
                    } else{
                        window.layer.msg('口令不正确');
                    }
                    
                }

            })

        })

        $('#editPriceBtn2').click(function(){
            var oid = $('#editPriceModal').attr('oid');
            var price = $('#setPrice').val();
            var reg = /^(\d{1,8})(\.\d{1,2})?$/;
            var passwd2 = $('#passwd2').val();
            if(reg.test(price)) {
                $.ajax({
                    url: '/admin/otherClass/editECPrice',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        oid: oid,
                        price: price,
                        psd: passwd2,
                        type: 0
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            $('#editPriceModal').modal('hide');
                            $('#parentDetail tr[oid="'+oid+'"]').find('.td_price').html('¥ '+twoxs(price));
                            window.layer.msg('设置价格成功');
                        } else {
                            window.layer.msg('口令不正确');
                        }
                        
                    }

                })
            }
        })
    @else
    @endif
    })
    

    /*计算两位小数*/
    function twoxs(a){
        if((a+'').indexOf('.')>=0)
            a=a+'0000';
        else
            a=a+'.0000';
        var sp=a.split('.');
        if(sp[1].substring(2,3)=='5')
            a=sp[0]+'.'+sp[1].substring(0,2)+'6';
        a=parseFloat(a);
        return a.toFixed(2);
    }
</script>
@endsection