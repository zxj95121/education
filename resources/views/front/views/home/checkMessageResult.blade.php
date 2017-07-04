@if($result)
<div class="weui-form-preview" style="position: absolute;bottom: 0px;">
    <div class="weui-form-preview__hd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">出错提示</label>
            <em class="weui-form-preview__value">关闭</em>
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
    <div class="weui-form-preview__ft">
        <a href="javascript:;" class="weui-btn weui-btn_warn">警告类操作 Normal</a>
    </div>
</div>

@else
@endif