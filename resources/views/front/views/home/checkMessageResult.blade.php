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
        <a href="/front/user_info_parent" class="weui-btn weui-btn_warn">现在去完善信息</a>
    <!-- </div> -->
</div>

@else
@endif