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
                    <h3 class="title">学校申请审核</h3> 
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    	学校申请列表
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
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Responsive Table</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>学校名称</th>
                                                                            <th>状态</th>
                                                                            <th>提示</th>
                                                                            <th>申请人昵称</th>
                                                                            <th>真实姓名</th>
                                                                            <th>联系电话</th>
                                                                            <th>申请时间</th>
                                                                            <th>操作</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($schoolInfo as $value)
                                                                        <tr>
                                                                            <td>{{$value['id']}}</td>
                                                                            <td>{{$value['schoolName']}}</td>
                                                                            <td>
                                                                                @if($value['status'] == 0)
                                                                                    <span class="label label-default">待审核</span>
                                                                                @elseif($value['status'] == 1)
                                                                                    <span class="label label-success">审核通过</span>
                                                                                @else
                                                                                    <span class="label label-danger">未通过审核</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if($value['explain'] == 0)
                                                                                    <span class="label label-info">系统暂无</span>
                                                                                @else
                                                                                    <span class="label label-danger">系统已有</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>{{$value['nickname']}}</td>
                                                                            <td>{{$value['name']}}</td>
                                                                            <td>{{$value['phone']}}</td>
                                                                            <td>{{$value['time']}}</td>
                                                                            <td>
                                                                                <span class="label label-primary reviewOk">通过审核</span>
                                                                                <span class="label label-primary reviewFalse">驳回审核</span>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>



            <!-- 学科分类新增 modal  -->
            <div id="modal1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font><font class="">×</font></font></button>
                            <h4 class="modal-title" id="mySmallModalLabel" style="font-weight: bold;"><font><font id="bttitle">添加爱好特长</font></font></h4>
                        </div>
                        <div class="modal-body"><font><font>
                            <div class="row"> 
                                <div class="col-md-12">
                                </div> 
                            </div>
                        </font></font></div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-white" data-dismiss="modal"><font><font>关</font></font></button> 
                            <button type="button" id="addNewHobbyBtn" class="btn btn-info" id="baocun1"><font><font>确认添加</font></font></button> 
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
    });

    $(function(){
        $('#hName').keyup(function(){
            var name = $(this).val();
            var type = query(name);
            $('#hType option[value="'+ type +'"]').prop('selected', 'selected');
        })

        $('#addNewHobbyBtn').click(function(){
            var name = $('#hName').val();
            if (name == '') {
                return false;
            }

            var type = $('#hType option:selected').val();
            
            $.ajax({
                url: '/admin/hobbyManage/newHobby',
                type: 'post',
                dataType: 'json',
                data: {
                    name: name,
                    type: type
                },
                success: function(data) {
                    if (data.errcode == 0) {
                        window.layer.msg('添加成功');
                        window.location.reload();
                    }
                }
            })
        })

        $(document).on('click', '#hideHobby', function(){
            var id = $(this).parent().attr('lid');

            var cdom = $(this).parent();

            window.layer.confirm('确认删除吗？', {
                btn: ['确认', '取消']
                ,btn3: function(index, layero){
                    window.layer.close(index);
                }
            }, function(index, layero){
                $.ajax({
                    url: '/admin/hobbyManage/hideHobby',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.errcode == '0') {
                            console.log(cdom.parent().find('li').length);
                            if (cdom.parent().find('li').length <= 1)
                                cdom.parents('.panel_hobby').remove();
                            else
                                cdom.remove();
                            window.layer.close(index);
                        }
                    }
                })
            });
            
        })

        /*让几个div保持同高*/
        var panel_height = new Array();
        $('.panel_hobby').each(function(){
            var index = $(this).index('.panel_hobby');
            panel_height[index%3] = $(this).height();
            if ((index+1)%3 == 0) {
                var max = Math.max.apply(null, panel_height);
                for (var j=index-2;j<=index;j++) {
                    $('.panel_hobby:eq('+ j +')').css('height', max+'px');
                }
            }
        })
    })
</script>
@endsection