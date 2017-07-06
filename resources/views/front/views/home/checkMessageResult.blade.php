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
        <a href="/front/user_info_parent?action=eclass" style="width: 90%;margin: 0 auto;" class="weui-btn weui-btn_warn">现在去完善信息</a>
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
            <label class="weui-form-preview__label">至少选择三个上课时间</label>
            <span class="weui-form-preview__value">未完成</span>
        </div>
    </div>
<!--     <div class="weui-form-preview__ft"> -->
        <a href="/front/setClassTime#eclass" style="width: 90%;margin: 0 auto;" class="weui-btn weui-btn_warn">现在去填写时间</a>
    <!-- </div> -->
</div>
@else
<div class="page__bd">
    <div class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">课程名称</label>
                <em class="weui-form-preview__value">地方撒GV但是</em>
            </div>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">课时数量</label>
                <span class="weui-form-preview__value">59</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">课程价格</label>
                <span class="weui-form-preview__value">¥2400.00</span>
            </div>
        </div>
        <div class="weui-form-preview__ft">
            <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">操作</a>
        </div>
    </div>
</div>

@endif