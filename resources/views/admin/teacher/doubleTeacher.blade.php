@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">

@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">双师Class管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	双师Class管理列表
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
                                            <button id="add"  class="btn btn-success"> 添加 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="teacherOneTable">
                                                <thead>
                                                    <tr>
                                                        <th><font><font>名称</font></font></th>
                                                        <th><font><font>状态</font></font></th>
                                                        <th><font><font>操作</font></font></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	@foreach($res as $value)
                                                    <tr>
                                                        <td><font><font class="otitle">{{$value->name}}</font></font></td>
                                                        @if($value->status!=1)
                                                        	<td class="halfTd"><font><font class=""><span class="label label-danger">隐藏</span></font></font>
                                                            @if($value->half_buy == 1)
                                                                <span class="label label-success halfspan">半价购</span>
                                                            @else
                                                            @endif
                                                            </td>
                                                        	<td class="caozuo">
                                                        		<a href="/admin/teacherone/hide?id={{$value->id}}"><span class="label label-success" tid="{{$value->id}}" style="margin-right: 4px;">显示</span></a>
                                                        @else
                                                        	<td class="halfTd"><font><font class=""><span class="label label-success">显示</span></font></font>
                                                            @if($value->half_buy == 1)
                                                                <span class="label label-success halfspan">半价购</span>
                                                            @else
                                                            @endif
                                                            </td>
                                                        	<td class="caozuo">
                                                        		<a href="/admin/teacherone/hide?id={{$value->id}}"><span class="label label-danger" tid="{{$value->id}}" style="margin-right: 4px;">隐藏</span></a>
                                                        @endif
                                                        	<a href="/admin/teachertwo?pid={{$value->id}}"><span class="label label-info" tid="{{$value->id}}" style="margin-right: 4px;">设置</span></a>
                                                        	<a href="/admin/teacherone/edit?id={{$value->id}}"><span class="label label-primary" tid="{{$value->id}}" style="margin-right: 4px;">修改</span></a>
                                                        	<a class="delete"><span class="label label-default" tid="{{$value->id}}" style="margin-right: 4px;">删除</span></a>
                                                            　　<a class="setHalf"><span tid="{{$value->id}}" class="label label-info">半价购课设置</span></a>
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
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>

@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script>
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
        $('#add').click(function(){
            window.location.href="{{URL('admin/teacherone/add')}}";
        })
        $('.delete').click(function(){
            var otitle = $(this).parents('tr').find('.otitle').text();
			var tid = $(this).find('span').attr('tid');
			window.layer.confirm('确定要删除该'+otitle+'类吗?',{
			},function(){
				var index = window.layer.index; //获取当前弹层的索引号
				window.layer.close(index);
				window.location.href="/admin/teacherone/delete?id="+tid;
			},function(){
			})
			return false;
        })

        $('.setHalf').click(function(){
            var tid = $(this).find('span').attr('tid');
            var cdom = $(this).parents('tr').find('.halfTd');
            $.ajax({
                url: '/admin/teacherone/halfBuy',
                dataType: 'json',
                type: 'post',
                data: {
                    id: tid
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        $('#teacherOneTable').find('.halfspan').remove();

                        if (data.half == 1) {
                            cdom.append('<span class="label label-success halfspan">半价购</span>');
                        }/* else {
                            cdom.find('.halfspan').remove();
                        }*/
                    }
                }
            })
        })
	})
</script>
@endsection