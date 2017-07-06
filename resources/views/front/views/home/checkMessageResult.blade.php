@if($result)
<div class="weui-form-preview" style="">
<!--     <div class="weui-form-preview__hd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">出错提示</label>
            <em class="weui-form-preview__value">关闭</em>
        </div>
    </div> -->
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label"></label>
            <span class="weui-form-preview__value glyphicon glyphicon-remove" style="color:#22AAE8;" id="closeOpen0"></span>
        </div>
    </div>
    <div class="weui-form-preview__bd">
        @foreach($result as $value)
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">{{$value['word']}}</label>
            <span class="weui-form-preview__value">{{$value['reason']}}</span>
        </div>
        @endforeach
    </div>
<!--     <div class="weui-form-preview__ft"> -->
        <a href="/front/user_info_parent" style="width: 90%;margin: 0 auto;" class="weui-btn weui-btn_warn">现在去完善信息</a>
    <!-- </div> -->
</div>
@elseif($noTime)
<div class="weui-form-preview" style="">
<!--     <div class="weui-form-preview__hd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">出错提示</label>
            <em class="weui-form-preview__value">关闭</em>
        </div>
    </div> -->
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label"></label>
            <span class="weui-form-preview__value glyphicon glyphicon-remove" style="color:#22AAE8;" id="closeOpen0"></span>
        </div>
    </div>
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">上课时间</label>
            <span class="weui-form-preview__value">未填写</span>
        </div>
    </div>
<!--     <div class="weui-form-preview__ft"> -->
        <a href="/front/setClassTime#eclass" style="width: 90%;margin: 0 auto;" class="weui-btn weui-btn_warn">现在去填写时间</a>
    <!-- </div> -->
</div>
@else
    <div id="dialogs">
        <!--BEGIN dialog1-->
        <div class="js_dialog" id="iosDialog1" style="opacity: 1;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__hd"><strong class="weui-dialog__title">订单详情</strong></div>
                <div class="weui-dialog__bd">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            课程名称
                        </li>
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            课程次数
                        </li>
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            订单总价
                        </li>
                    </ul>
                </div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消订单</a>
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确认订单</a>
                </div>
            </div>
        </div>
        <!--END dialog1-->
    </div>

@endif