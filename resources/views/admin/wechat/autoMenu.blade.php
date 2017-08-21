@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/admin/wechat/automenu/automenu.css">
<!-- <link rel="stylesheet" type="text/css" href="/js/jqueryemoji/css/main.css" /> -->

@endsection

@section('content')


            <div class="wraper container-fluid" style="background: #FFF;">
                <div class="page-title"> 
                    <h3 class="title">设置自定义菜单</h3>
                </div>

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="highlight_box icon_wrap border menu_setting_msg js_menustatus dn" id="menustatus_1" style="display: block;">
                            <i class="icon icon icon_msg_small success"></i>            
                            <p class="title">API版本菜单编辑中</p>            
                            <p class="desc">
                                该页面显示的菜单版本正在编辑中。若停用菜单，请
                                <a href="#" class="js_closeMenu">点击这里</a>
                            </p>        
                        </div>

                        <div class="highlight_box icon_wrap border menu_setting_msg js_menustatus dn" id="menustatus_2" style="display: block;">
                            <i class="icon icon icon_msg_small success"></i>            
                            <p class="title">API版本已发布</p>            
                            <p class="desc">
                                该页面显示的菜单版本已发布。若恢复已发布菜单，请
                                <a href="#" class="js_closeMenu">点击这里</a>
                            </p>        
                        </div>

                    </div> <!-- end col -->

                    <div class="col-lg-3" style="padding-right: 0px;margin-top: 30px;margin-left: 10px;height:500px;background: #FFF;">
                        <div style="width: 100%;height: 100%;">
                            <div class="row">
                                <div class="col-lg-4 btn btn-success menu1">
                                    ——
                                </div>
                                <div class="col-lg-4 btn btn-default menu1">
                                    ——
                                </div>
                                <div class="col-lg-4 btn btn-default menu1">
                                    ——
                                </div>
                                <div class="col-lg-4 arrowMenuDiv">
                                    <div class="arrow-menu arrow-menu-green"></div>
                                </div>
                                <div class="col-lg-4 arrowMenuDiv">
                                    <div class="arrow-menu"></div>
                                </div>
                                <div class="col-lg-4 arrowMenuDiv">
                                    <div class="arrow-menu"></div>
                                </div>
                                <!-- 第一行 -->
                                <div class="col-lg-4 menu2 menu1s menuRow1">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu2s menuRow1">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu3s menuRow1">
                                    ——
                                </div>
                                <!-- 第二行 -->
                                <div class="col-lg-4 menu2 menu1s menuRow2">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu2s menuRow2">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu3s menuRow2">
                                    ——
                                </div>
                                <!-- 第三行 -->
                                <div class="col-lg-4 menu2 menu1s menuRow3">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu2s menuRow3">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu3s menuRow3">
                                    ——
                                </div>
                                <!-- 第四行 -->
                                <div class="col-lg-4 menu2 menu1s menuRow4">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu2s menuRow4">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu3s menuRow4">
                                    ——
                                </div>
                                <!-- 第五行 -->
                                <div class="col-lg-4 menu2 menu1s menuRow5">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu2s menuRow5">
                                    ——
                                </div>
                                <div class="col-lg-4 menu2 menu3s menuRow5">
                                    ——
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8" style="padding-right: 0px;margin-top: 30px;margin-left: 30px;background: #F4F5F9;">
                        <div style="width: 100%;height: 100%;">
                            <div class="row">
                                <div class="col-lg-11" style="margin: 8px auto;left: 4.1666%;border-bottom: 1px solid #E7E7EB;">
                                    <div style="width:100%;">
                                        <h4 class="global_info" style="float: left;">子菜单名称</h4>
                                        <div class="global_extra" style="float: right;">
                                            <a href="javascript:void(0);" id="jsDelBt">删除子菜单</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-11" style="margin: 8px auto;left: 4.1666%;">
                                    <div class="form-group">
                                            <span>菜单名称</span>　　
                                            <input type="text" name="menuName" id="menuName">　
                                            <span  style="font-size: 15px;color: #8D8D8D;">字数不超过8个汉字或16个字母</span>
                                    </div>
                                </div>
                                <div class="col-lg-11" style="margin: 8px auto;left: 4.1666%;">
                                    <span>子菜单内容</span>
                                    <button class="layui-btn layui-btn-primary layui-btn-small menu2Type" style="margin-left: 15px;">发送消息</button>
                                    <button class="layui-btn layui-btn-primary layui-btn-small menu2Type">跳转网页</button>
                                    <br>
                                    <div class="layui-tab layui-tab-card">
                                        <ul class="layui-tab-title">
                                            <li class="layui-this">自定义图文</li>
                                            <li>文字</li>
                                            <li>图片</li>
                                        </ul>
                                        <div class="layui-tab-content">
                                            <div class="layui-tab-item layui-show">
                                                <p>
                                                    <button class="layui-btn"><i class="layui-icon"></i> 添加图文</button>
                                                </p>
                                                <form class="layui-form" action="" style="margin-top: 9px;">
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">标题</label>
                                                        <div class="layui-input-block">
                                                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入图文标题" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">图片</label>
                                                        <div class="layui-input-block">
                                                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入图片地址" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">链接</label>
                                                        <div class="layui-input-block">
                                                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入链接跳转地址" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">说明</label>
                                                        <div class="layui-input-block">
                                                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入图文说明文字" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                    <div class="layui-input-block">
                                                        <button class="layui-btn" lay-submit="" lay-filter="formDemo">立即添加</button>
                                                        <!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
                                                    </div>

                                                    <table class="layui-table">
                                                      <!-- <colgroup>
                                                        <col width="150">
                                                        <col width="200">
                                                        <col>
                                                      </colgroup> -->
                                                        <thead>
                                                            <tr>
                                                                <th>顺序</th>
                                                                <th>标题</th>
                                                                <th>时间</th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>人生就像是一场修行</td>
                                                                <td>2016-11-29</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>于千万人之中遇见你所遇见的人，于千万年之中，时间的无涯的荒野里…</td>
                                                                <td>2016-11-28</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="layui-tab-item">
                                                <form class="layui-form" action="">
                                                    <div class="layui-form-item layui-form-text">
                                                        <label class="layui-form-label">内容</label>
                                                        <div class="layui-input-block">
                                                            <textarea name="desc" id="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                                                            <span class="emotion">表情</span></p>
                                                        </div>
                                                        <!-- <div class="ad_demo"><script src="/js/jqueryemoji/js/ad_js/ad_demo.js" type="text/javascript"></script></div> -->
                                                    </div>
                                                    <p id="show"></p>
                                                    <div class="layui-form-item">
                                                        <div class="layui-input-block">
                                                            
                                                            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                                          <!-- <p id="stat"><script type="text/javascript" src="http://js.tongji.linezing.com/1870888/tongji.js"></script></p> -->
                                                          <!-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="layui-tab-item">内容3</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div> <!-- end row -->

            </div>
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript">
    $(function(){
        $('#computer_footer').css('display', 'none');
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    })
</script>
<script>
//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
layui.use('element', function(){
  var element = layui.element;
  
  //…
});
</script>
<script type="text/javascript" src="/admin/wechat/automenu/automenu.js"></script>

<!-- <script type="text/javascript" src="/admin/js/jquery.1.7.2.min.js"></script> -->
<script type="text/javascript" src="/js/jqueryemoji/jquery.qqFace.js"></script>
<script type="text/javascript">
$(function(){
    $('.emotion').qqFace({
        id : 'facebox', //表情盒子的ID
        assign:'desc', //给那个控件赋值
        path:'face/'    //表情存放的路径
    });
    $(".sub_btn").click(function(){
        var str = $("#desc").val();
        $("#show").html(replace_em(str));
    });
});
//查看结果
function replace_em(str){
    str = str.replace(/\</g,'&lt;');
    str = str.replace(/\>/g,'&gt;');
    str = str.replace(/\n/g,'<br/>');
    str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/js/jqueryemoji/face/$1.gif" border="0" />');
    return str;
}
</script>
@endsection