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
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row" style="margin-bottom: 13px;">
                                        <button class="btn btn-success">新增学科分类 <span class="glyphicon glyphicon-plus"></span></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12"> 
                                            <div class="tabs-vertical-env" style="width: 100%;">
                                                <div class="row">
                                                    <div id="tabs_div1">
                                                        <ul id="tabs_ul_type" class="nav tabs-vertical col-lg-6" style="border-right: 2px solid #39A4D6;padding-right: 14px;width: 100%;"> 
                                                            <li class="active">
                                                                <a href="#v-tab1" data-toggle="tab" aria-expanded="true">基本学科</a>
                                                            </li> 
                                                            <li class="">
                                                                <a href="#v-tab2" data-toggle="tab" aria-expanded="false">艺术学科</a>
                                                            </li> 
                                                            <li class="">
                                                                <a href="#v-tab3" data-toggle="tab" aria-expanded="false">技术学科</a>
                                                            </li> 
                                                        </ul> 
                                                    </div>

                                                    <div id="tabs_div2" class="tab-content" style="padding:0px 30px;position: relative;">
                                                        <div  style="position: absolute;top:-47px;"><button class="btn btn-success">添加学科 <span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                        <div class="tab-pane active" id="v-tab1">
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
                                                                    <tr>
                                                                        <th>1</th>
                                                                        <td><span class="label label-default">语文</span></td>
                                                                        <td>基本学科</td>
                                                                        <td>
                                                                            <span class="label label-primary">修改</span>
                                                                            <span class="label label-primary">删除</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="tab-pane" id="v-tab2">
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
                                                                    <tr>
                                                                        <th>1</th>
                                                                        <td><span class="label label-default">小提琴</span></td>
                                                                        <td>艺术学科</td>
                                                                        <td>
                                                                            <span class="label label-primary">修改</span>
                                                                            <span class="label label-primary">删除</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="tab-pane" id="v-tab3">
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
                                                                    <tr>
                                                                        <th>1</th>
                                                                        <td><span class="label label-default">C++</span></td>
                                                                        <td>技术学科</td>
                                                                        <td>
                                                                            <span class="label label-primary">修改</span>
                                                                            <span class="label label-primary">删除</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
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
        <script src="assets/magnific-popup/magnific-popup.js"></script>
        <script src="assets/jquery-datatables-editable/jquery.dataTables.js"></script> 
        <script src="assets/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/jquery-datatables-editable/datatables.editable.init.js"></script>

@endsection