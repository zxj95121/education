<div class="weui-tabbar">
    <a href="#weixin" class="weui-tabbar__item weui-bar__item_on">
                    <span style="display: inline-block;position: relative;">
                        <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                        <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">8</span>
                    </span>
        <p class="weui-tabbar__label">微信</p>
    </a>
    <a href="#message" class="weui-tabbar__item">
        <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">通讯录</p>
    </a>
    <a href="#search" class="weui-tabbar__item">
                    <span style="display: inline-block;position: relative;">
                        <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                        <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>
                    </span>
        <p class="weui-tabbar__label">发现</p>
    </a>
    <a href="#me" class="weui-tabbar__item">
        <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">我</p>
    </a>
    <a href="#me" class="weui-tabbar__item">
        <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">我1</p>
    </a>
</div>

<div id="ui-view"></div>

<script type="text/html" id="error">
    <!--可以自定义错误信息,可选，定义一些404页面等-->
    <div>
        {{errStatus}}
    </div>
    <div>
        {{errContent}}
    </div>
</script>