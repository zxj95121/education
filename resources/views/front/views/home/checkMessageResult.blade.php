@if($result)
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">出错提示</label>
            <em class="weui-form-preview__value">关闭</em>
        </div>
    </div>
    <div class="weui-form-preview__bd">
        @foreach($result as $value)
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">{{$value->word}}</label>
            <span class="weui-form-preview__value">{{$value->reason}}</span>
        </div>
        @endforeach
    </div>
    <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">操作</a>
    </div>
</div>
@else
@endif