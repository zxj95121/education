@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .operate span{
        cursor: pointer;
    }
    #tabs_ul_type .active a{
        background-color: blue;
        color: #FFF;
    }
    #tabs_div1{
        width: 18%;
        display: inline-block;
    }
    #tabs_div2{
        width: 75%;
        display: inline-block;
    }
    .tabs-vertical-env .tab-pane button{
        margin: 0px 10px;
    }
    .edit2:hover{
    	cursor:pointer;
    }
    .delete2:hover{
    	cursor:pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">辅导学科管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    辅导学科列表
                                </h3>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- 学科分类新增 modal  -->
                            <div id="modal1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                                                <h4 class="modal-title" id="mySmallModalLabel"><font><font id="bttitle">新建学科分类</font></font></h4>
                                            </div>
                                            <div class="modal-body"><font><font>
                                              	<div class="row"> 
                                                    <div class="col-md-12"> 
                                                        <div class="form-group"> 
                                                            <label for="field-1" class="control-label" style="margin-top: 7px;"><font><font id="bttitle2">学科分类名称&nbsp;&nbsp;:</font></font></label> 
                                                            <input type="text" style="width:55%;float:right" class="form-control" id="field-1" placeholder=""> 
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </font></font></div>
                                            <div class="modal-footer"> 
	                                        	<button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关</font></font></button> 
	                                            <button type="button" class="btn btn-info" id="baocun1"><font><font>保存更改</font></font></button> 
                                           	</div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                            </div>                           
                             <!-- end modal  -->                          
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row" style="margin-bottom: 13px;padding-left: 10px;">
                                        <button id="addfenlei" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">新增学科分类 <span class="glyphicon glyphicon-plus"></span></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12"> 
                                            <div class="tabs-vertical-env" style="width: 100%;margin-bottom: 0px;">
                                                <div class="row">
                                                    <div id="tabs_div1">
                                                        <ul id="tabs_ul_type" class="nav tabs-vertical col-lg-6" style="border-right: 2px solid #39A4D6;padding-right: 14px;width: 100%;"> 
                                                            @foreach ($data['subjectone'] as $value)
	                                                            <li class="">
	                                                                <a href="#v-tab{{$value->id}}" data-toggle="tab" aria-expanded="true" idvalue="{{$value->id}}">{{$value->name}}</a>
	                                                            </li> 
                                                            @endforeach
                                                        </ul>
                                                       	<div style="margin-top: 20px;padding-left: 10px;">
                                                    		<button id="edit1" type="button" class="btn btn-primary w-xs m-b-5" data-toggle="modal" data-target=".bs-example-modal-sm">修改</button>
                                                        	<button id="delete1" type="button" class="btn btn-primary w-xs m-b-5">删除</button>
                                                    	</div> 
                                                    </div>
                                                    <div id="tabs_div2" class="tab-content" style="padding:0px 30px;position: relative;">
                                                        <div  style="position: absolute;top:-47px;"><button id="addxueke" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">添加学科 <span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                        @php $prev = 0; @endphp
                                                        @foreach ($data['subjecttwo']  as $key => $value)
                                                        
                                                        	@php unset($arr[$value->pid]); @endphp
                                                        	@if($value->pid!=$prev && $prev != 0)
	                                                                </tbody>
	                                                            </table>
	                                                        </div>
	                                                        @endif
                                                        	@if($value->pid!=$prev)
	                                                        <div class="tab-pane " id="v-tab{{$value->pid}}">
	                                                            <table class="table table-striped">
	                                                                <thead>
	                                                                    <tr>
	                                                                    <th>#</th>
	                                                                    <th>学科名称</th>
	                                                                    <th>学科分类</th>
	                                                                    <th>操作</th>
	                                                                </tr>
	                                                                </thead>
	                                                                <tbody>
	                                                        @endif
	                                                                    <tr>
	                                                                        <th class="num">{{$key}}</th>
	                                                                        <td ><span class="label label-default">{{$value->name}}</span></td>
	                                                                        <td>{{$value->pname}}</td>
	                                                                        <td>
	                                                                            <span class="label label-primary edit2" xkid="{{$value->id}}" data-toggle="modal" data-target=".bs-example-modal-sm">修改</span>
	                                                                            <span class="label label-primary delete2" xkid="{{$value->id}}">删除</span>
	                                                                        </td>
	                                                                    </tr>
	                                                        
	                                                        @php $prev = $value->pid; @endphp
                                                        @endforeach
                                                        @if($prev != 0)
                                                        			</tbody>
	                                                            </table>
	                                                        </div>
                                                        @endif
                                                  @foreach($arr as $key=>$value)
                                                        <div class="tab-pane" id="v-tab{{$key}}">
                                                            <table class="table table-striped">
	                                                                <thead>
	                                                                    <tr>
		                                                                    <th>#</th>
		                                                                    <th>学科名称</th>
		                                                                    <th>学科分类</th>
		                                                                    <th>操作</th>
	                                                               		</tr>
	                                                                </thead>
	                                                                <tbody>
	                                                                </tbody>
	                                                        </table>
                                                        </div>
                                                  @endforeach
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

                <!-- dialog -->
                <div id="dialog" class="modal-block mfp-hide" style="display: none;">
                    <section class="panel panel-danger panel-color">
                        <div class="panel-heading">
                            <h2 class="panel-title">Are you sure?</h2>
                        </div>
                        <div class="panel-body">
                            <div class="modal-wrapper">
                                <div class="modal-text">
                                    <p>Are you sure that you want to delete this row?</p>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-md-12 text-right">
                                    <button id="dialogConfirm" class="btn btn-primary">Confirm</button>
                                    <button id="dialogCancel" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                    </section>
                </div>

            </div>

@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script>
	var weizhi = '';
	$(function(){
		$('#tabs_ul_type li:eq(0)').addClass('active');
		var you = $('#tabs_div1 .active a').attr('href');
		you = you.substr(1,you.length);
		$('#'+you).addClass('active');
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
        
		$('#addfenlei').click(function(){
			$('#bttitle').text('新增学科分类');
			$('#field-1').val('');
			var button = '<button type="button" class="btn btn-info" id="baocun1"><font><font>保存更改</font></font></button> ';
			$('.modal-footer button:last').replaceWith(button);
		})
		/*新增分类保存  */
		$(document).on('click','#baocun1',function(){
			var text = $('#field-1').val();
			var href = $('#tabs_div1 li:last').find('a').attr('href');
			var num = parseInt(href.substr(6,href.length))+1;
			var html = '';
			var html2 = '';
			$('#bttitle').text('新增学科分类');
			/* 新增学科分类 ajax */
			$.ajax({
				url:'{{URL("admin/subjectone/add")}}',
				data:{
					text:text
				},
				type:'post',
				datatype:'json',
				success:function(date){
				 	html +=	'<li class="">';
				 	html += '<a href="#v-tab'+num+'" data-toggle="tab" aria-expanded="false" idvalue="'+date.id+'">'+text+'</a>';
		            html += '</li>'	;
		            html2 += '<div class="tab-pane" id="v-tab'+num+'">';
		            html2 += '<table class="table table-striped">';
		            html2 += '<thead>';
		            html2 += '<tr>';
		            html2 += '<th>#</th>';
		            html2 += '<th>学科名称</th>';
		            html2 += '<th>学科分类</th>';
		            html2 += '<th>操作</th>';
		            html2 += '</tr>';
		            html2 += '</thead>';
		            html2 += '<tbody>';
		            html2 += '</tbody>';
		            html2 += '</table>';
		            html2 += '</div>';
		            $('#tabs_div1 li:last').after(html);
		            $('.tab-pane:last').after(html2);
					$('#modal1').modal('hide');
				},
				error:function(date){
					alert('请重新添加');
				}
			})
			$('#modal1').modal('hide');
		})
		/*修改分类  */
		$('#edit1').click(function(){
			$('#bttitle').text('修改学科分类');
			var text = $('#tabs_div1 .active a').text();
			var button = '<button type="button" class="btn btn-info" id="baocun2"><font><font>保存更改</font></font></button> ';
			$('.modal-footer button:last').replaceWith(button);
			$('#field-1').val(text);
		})
		/*修改分类保存  */
		$(document).on('click','#baocun2',function(){
			var text = $('#field-1').val();
			var fenleiid = $('#tabs_div1 .active a').attr('idvalue');
			/* 修改学科分类 ajax */
			$.ajax({
				url:'{{URL("admin/subjectone/edit")}}',
				data:{
					text:text,
					fenleiid:fenleiid
				},
				type:'post',
				datatype:'json',
				success:function(date){
					$('#tabs_div1 .active a').text(text);
				},
				error:function(date){
					alert('请重新修改');
				}
			})
			$('#modal1').modal('hide');
		})
		/*删除分类  */
		$('#delete1').click(function(){
			var value = $('#tabs_div1 .active a').html();
	           window.layer.confirm('确认删除'+value+'分类吗？', {
	                btn: ['取消', '确认'] //可以无限个按钮
	                ,btn2: function(index, layero){
	                    var layerIndex = window.layer.load(2, {time: 5*1000});
	                    var fenleiid = $('#tabs_div1 .active a').attr('idvalue');
	        			$.ajax({
	        				url:'{{URL("admin/subjectone/delete")}}',
	        				data:{
	        					fenleiid:fenleiid
	        				},
	        				type:'post',
	        				datatype:'json',
	        				success:function(date){
	        					$('#tabs_div1 .active').remove();
	        					$('#tabs_div1 li:eq(0)').addClass('active');
	        					var you = $('#tabs_div1 .active a').attr('href');
	        					you = you.substr(1,you.length);
	        					$('#tabs_div2 .active').removeClass('active');
	        					$('#'+you).addClass('active');
	        					window.layer.close(layerIndex);
	        				},
	        				error:function(date){
	                                window.layer.msg('删除失败');
	                        }
	                    })
	                }
	            }, function(index, layero){
	                window.layer.close(index);
	            });
		})
		/* 学科添加  */
		$('#addxueke').click(function(){
			$('#bttitle').text('添加学科');
			$('#bttitle2').html('学科名称&nbsp;&nbsp;:');
			$('#field-1').val('');
			var button = '<button type="button" class="btn btn-info" id="baocun3"><font><font>保存更改</font></font></button> ';
			$('.modal-footer button:last').replaceWith(button);
		})
		/* 学科添加确定  */
		$(document).on('click','#baocun3',function(){
			var fenleiid = $('#tabs_div1 .active a').attr('idvalue');
			var text = $('#field-1').val();
			var fenlei = $('#tabs_div1 .active a').text();
			var num = parseInt($('#tabs_div2 .active .num:last').text())+1;
			if(isNaN(num)){
				num = 1;
			}
			/*学科添加ajax  */
			$.ajax({
				url:'{{URL("admin/subjecttwo/add")}}',
				data:{
					fenleiid:fenleiid,
					text:text
				},
				type:'post',
				datatype:'json',
				success:function(date){
					var html = '';
					html += '<tr>';
					html += '<th class="num">'+num+'</th>';
					html += '<td><span class="label label-default">'+text+'</span></td>';
					html += '<td>'+fenlei+'</td>';
					html += '<td>';
					html += '<span class="label label-primary edit2" xkid="'+date.id+'" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-right: 4px;">修改</span>';
					html += '<span class="label label-primary delete2" xkid="'+date.id+'">删除</span>';
					html += '</td>';
					html += '</tr>';
					if(num != 1){
						$('#tabs_div2 .active tbody tr:last').after(html);
					}else{
						$('#tabs_div2 .active tbody').html(html);
					}
				},
				error:function(date){
					alert('请重新添加');
				}
			})
			$('#modal1').modal('hide');
		})
		/* 学科修改  */
		$(document).on('click','.edit2',function(){
			$('#bttitle').text('修改学科');
			$('#bttitle2').html('学科名称&nbsp;&nbsp;:');
			var text = $(this).parents('tr').find('.label-default').text();
			$('#field-1').val(text);
			weizhi = $(this);
			var button = '<button type="button" class="btn btn-info" id="baocun4"><font><font>保存更改</font></font></button> ';
			$('.modal-footer button:last').replaceWith(button);
		})
		/* 学科修改确定  */
		$(document).on('click','#baocun4',function(){
			var text = $('#field-1').val();
			var xkid = weizhi.attr('xkid');
			/* 发送学科修改 ajax */
			$.ajax({
				url:"{{URL('admin/subjecttwo/edit')}}",
				data:{
					text:text,
					xkid:xkid
				},
				type:'post',
				datatype:'json',
				success:function(date){
					weizhi.parents('tr').find('.label-default').text(text);
				},
				error:function(date){
					alert('请重新修改学科');
				}
			})
			$('#modal1').modal('hide');
		})
		/* 学科删除  */
		$(document).on('click','.delete2',function(){
			var dangqian = $(this);
			var value = dangqian.parents('tr').find('.label-default').text();
			window.layer.confirm('确认删除'+value+'学科吗？', {
                btn: ['取消', '确认'] //可以无限个按钮
                ,btn2: function(index, layero){
        			var xkid = dangqian.attr('xkid');
        			var layerIndex = window.layer.load(2, {time: 5*1000});
        			/* 学科删除 ajax  */
        			$.ajax({
        				url:"{{URL('admin/subjecttwo/delete')}}",
        				data:{
        					xkid:xkid
        				},
        				type:'post',
        				datatype:'json',
        				success:function(date){
        					dangqian.parents('tr').remove();
        					window.layer.close(layerIndex);
        				},
        				error:function(date){
                                window.layer.msg('删除失败');
                        }
                    })
                }
            }, function(index, layero){
                window.layer.close(index);
            });
			
		})
	})
</script>
@endsection