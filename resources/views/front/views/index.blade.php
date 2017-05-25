<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>WeUI</title>
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="/css/weui.css"/>
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/zepto.min.js" type="text/javascript"></script>
    <script src="/js/vipspa.js" type="text/javascript"></script>
    <!-- <script type="text/javascript">
        $(function () {
            $('.weui-label').css({
                'text-align': 'center'
            });
            $('#login').load('login.html');//初始load的界面
            $('body').load('footer-tabs/footer-tabs.html');

            //路由配置文件
            $(function(){
                vipspa.start({
                    view: '#ui-view',
                    router: {
                        'me': {
                            templateUrl: 'views/me.blade.php',
                            controller: 'js/app/me.js'
                        },
                        'message': {
                            templateUrl: 'views/message.blade.php',
                            controller: 'js/app/message.js'
                        },
                        'search': {
                            templateUrl: 'views/search.blade.php',
                            controller: 'js/app/search.js'
                        },
                        'weixin': {
                            templateUrl: 'views/weixin.blade.php',
                            controller: 'js/app/weixin.js'
                        },
                        'defaults': 'me' //默认路由
                    },
                    errorTemplateId: '#error'  //可选的错误模板，用来处理加载html模块异常时展示错误内容
                });

            });
        })
    </script> -->
</head>
<body>
    <!-- 暂且隐藏 先编写路由
        <div id="login"></div>
    -->
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
</div>
</body>
</html>
