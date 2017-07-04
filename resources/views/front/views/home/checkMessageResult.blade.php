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
            <span class="weui-form-preview__value" id="closeOpen0">关闭</span>
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

@else
    <div id="dialogs">
        <!--BEGIN dialog1-->
        <div class="js_dialog" id="iosDialog1" style="opacity: 1;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__hd"><strong class="weui-dialog__title">订单详情</strong></div>
                <div class="weui-dialog__bd">
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>标题文字</p>
                            </div>
                            <div class="weui-cell__ft">说明文字</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>标题文字</p>
                            </div>
                            <div class="weui-cell__ft">说明文字</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>标题文字</p>
                            </div>
                            <div class="weui-cell__ft">说明文字</div>
                        </div>
                    </div>
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