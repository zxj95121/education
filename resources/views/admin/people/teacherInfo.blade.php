@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
</style>
@endsection

@section('content')


            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">教师信息</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                        	<div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    家长信息列表
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
							        <div class="table-responsive">
							            <table class="table">
							                <thead>
							                    <tr>
							                        <th>昵称</th>
							                        <th>姓名</th>
							                        <th>手机号</th>
							                        <th>性别</th>
							                        <th>爱好特长</th>
							                        <th>擅长学科</th>
							                        <th>教师分类</th>
							                        <th>所学专业</th>
							                        <th>求职状态</th>
							                        <th>期望薪资</th>
							                        <th>期望教学社区</th>
							                    </tr>
							                </thead>
							                <tbody>
							                    @foreach($res as $value)
							                    <tr>
							                        <td>{{$value->nickname}}</td>
							                        <td>{{$value->name}}</td>
							                        <td>{{$value->phone}}</td>
							                        <td>
								                        @if($value->sex)
								                       	男
								                       	@else
								                       	女
								                       	@endif
							                        </td>
							                        <td>{{$value->hobby}}</td>
							                        <td>{{$value->subject}}</td>
							                        <td>
							                        	@if($value->type == 1)
								                       	学生教师
								                       	@else
								                       	职业教师
								                       	@endif
							                        </td>
							                        <td>{{$value->project}}</td>
							                        <td>
							                        	@if($value->find_status == 1)
							                        	兼职
							                        	@elseif($value->find_status==2)
							                        	全职
							                        	@else
							                        	暂不考虑求职
							                        	@endif
							                        </td>
							                        <td>{{$value->money}}</td>
							                        <td>{{$value->address}}</td>
							                    </tr>
							                    @endforeach
							                </tbody>
							            </table>
							        </div>
							        <div class="row">
							            <div class="col-sm-6">
							                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">共{{$res->total()}}条记录</div>
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
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
@endsection