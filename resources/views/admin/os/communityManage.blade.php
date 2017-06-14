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
                                        <div class="col-md-4 part1">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#modal1">添加市 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                        <div class="col-md-4 part2">
                                             <button class="btn btn-success" data-toggle="modal" data-target="#modal2">添加区/县 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                        <div class="col-md-4 part3">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#modal3">添加社区 <span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col col_border part1" id="type_city">
                                            <ol>
                                                @foreach($cityInfo as $value)
                                                <li class="" did="{{$value->id}}">
                                                    <span>{{$value->name}}</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                @endforeach
                                                
                                                <!-- <li cid="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li> -->
                                            </ol>
                                        </div>
                                        <div class="col-md-4 col col_border part2" id="type_area">
                                            <ol>
                                                <li class="" did="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                
                                                <li did="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="col-md-4 col part3" id="type_community">
                                            <ol>
                                                <li class="" did="">
                                                    <span>Lorem ipsum dolor sit amets</span>
                                                    <div class="type_operate">
                                                        <span class="glyphicon glyphicon-pencil"></span>　
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </div>
                                                </li>
                                                
                                                <li did="">
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

            <div id="modal1" class="modal fade bs-example-modal-md modal_add_community" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">添加城市</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cityName">请输入城市名</label>
                                <input type="text" name="cityName" id="cityName" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="add_city">确认添加</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal2" class="modal fade bs-example-modal-md modal_add_community" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">添加地区</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="areaName">请输入地区名</label>
                                <input type="text" name="areaName" id="areaName" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="add_area">确认添加</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal3" class="modal fade bs-example-modal-md modal_add_community" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">添加社区</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cityName">请输入社区名</label>
                                <input type="text" name="cityName" id="cityName" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="add_city">确认添加</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="editName" modal="" editId="" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">修改名称</h3>
                        </div>
                        <div class="modal-body">
                            <p style="font-size:22px;">原<span id="pre_type"></span>名称: <span id="pre_name">芜湖</span></p><br>
                            <p>
                                <input class="form-control" id="editInput" type="text" name="" value="">
                            </p>
                            <button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" id="editOK" class="btn btn-success">保存更改</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
	$(function(){
        layui.use('layer', function(){
            window.layer = layui.layer;
        }); 

        /*确认添加一级城市*/
        $('#add_city').click(function(){
            var val = $('#cityName').val();
            if (val != '') {
                $.ajax({
                    url: '/admin/community/city/add',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        val: val
                    },
                    success: function(data) {
                        if (data.errcode == 0) {
                            window.layer.msg('添加成功');
                            $('#cityName').html('');
                            $('#type_city ol').append('<li cid="'+data.id+'"> <span>'+val+'</span> <div class="type_operate"> <span class="glyphicon glyphicon-pencil"></span>　 <span class="glyphicon glyphicon-trash"></span> </div> </li>');
                        }
                    }
                })
            }
            $('#modal1').modal('hide');
        })

        /*打开模态框文本自动获得焦点*/
        $('.modal_add_community').on('shown.bs.modal', function () {
            $(this).find('input')[0].focus();
        })

        /*点击li效果*/
        $(document).on('click', '#portlet2 li', function(){
            var srcId = $(this).parents('.col').attr('id');
            $('#'+srcId+' li').each(function(){
                $(this).removeClass('li_active');
            })
            $(this).addClass('li_active');

            /*srcId三个值:type_city,type_area,type_community*/
            if (srcId == 'type_city') {
                $('.part2').css('display', 'block');
                $('.part3').css('display', 'none');
            } else if(srcId == 'type_area') {
                $('.part3').css('display', 'block');
            } else {

            }
        })

        $(document).on('click', '#portlet2 .glyphicon-pencil', function(){
            var srcId = $(this).parents('.col').attr('id');
            var value = $(this).parent().prev().html();
            var did = $(this).parents('li').attr('did');

            $('#editName').modal('show');

            $('#pre_name').html(value);
            $('#editInput')[0].focus();
            $('#editName').attr('editId', did);

            if (srcId == 'type_city') {
                $('#editName').attr('modal', 'community_city');
                $('#pre_type').html('城市');
            } else if(srcId == 'type_area') {
                $('#editName').attr('modal', 'community_area');
                $('#pre_type').html('地区');
            } else {
                $('#editName').attr('modal', 'community_community');
                $('#pre_type').html('社区');
            }
        })

        $('#editOK').click(function(){
            var value = $('#editInput').val();/*修改后的名称*/
            /*要知道当前修改的是那个模块，是哪条记录*/
            var did = $('#editName').attr('editId');
            var type = $('#editName').attr('modal');

            

        })
	})
</script>
@endsection