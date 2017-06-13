@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .operate span{
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">社区管理</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	社区管理列表
                                </h3>
                                <div style="position:absolute;left: 145px;top:6px;">
                                	<button id="add" type="button" class="btn btn-success btn-sm m-b-5"><font><font>添加社区</font></font></button>
                                </div>
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>昵称</th>
                                                    <th>姓名</th>
                                                    <th>手机号</th>
                                                    <th>状态</th>
                                                    <th>登录次数</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>young</td>
                                                    <td>张贤健</td>
                                                    <td>13095533632</td>
                                                    <td>
                                                    	<span class="label label-success status">可用</span>
														<span class="label label-success identity">超级管理员</span>
                                                    </td>
                                                    <td>5</td>
                                                    <td class="operate">
                                                        <span class="label label-info delete">禁用</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>youth</td>
                                                    <td>姚春</td>
                                                    <td>17557286038</td>
                                                    <td>
                                                       <span class="label label-success status">可用</span>
                                                       <span class="label label-primary identity">普通管理员</span>
                                                    </td>
                                                    <td>1</td>
                                                </tr>
                                         </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共 2条记录</div>
                                        </div>
                                        <div class="col-sm-6">
                                            
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
<script type="text/javascript">
	$(function(){
		$('#add').click(function(){
			location.href="{{URL('admin/communityManage/add')}}";
		})
	})
</script>
@endsection