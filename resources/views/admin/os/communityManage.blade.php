@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<style type="text/css">
    .col_border{
        border-right: 2px solid #39A4D6;
    }
    .col{
        padding: 0px 15px;
    }
    ol li{
        height: 50px;
        line-height: 40px;
        padding: 5px;
        cursor: pointer;
        text-align: center;
        background-color: #E8E5E5;
        user-select: none;
        position: relative;
        border-bottom: 1px solid #D3CECE;
    }
    ol li:last-child{
        border-bottom: 0px solid transparent;
    }
    #type_city .li_active{
        background-color: #86B2F0;
        color: #FFF;
    }
    #type_area .li_active{
        background-color: #679DED;
        color: #FFF;
    }
    #type_community .li_active{
        background-color: #0089F7;
        color: #FFF;
    }
    .type_operate{
        position: absolute;
        top: 5px;
        right:10px;
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
                                        <div class="col-md-4">
                                            <button class="btn btn-success">添加市 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                        <div class="col-md-4">
                                             <button class="btn btn-success">添加区/县 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success">添加社区 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col col_border" id="type_city">
                                            <ol>
                                                <li class="">
                                                    <span>FDAFDS</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="col-md-4 col col_border" id="type_area">
                                            <ol>
                                                <li class="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="col-md-4 col" id="type_community">
                                            <ol>
                                                <li class="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                            </ol>
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

	})
</script>
@endsection