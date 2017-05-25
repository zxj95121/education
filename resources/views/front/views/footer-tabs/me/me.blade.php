<!-- 相当于替换这个 -->
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
    <script type="text/javascript">
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
    </script>
</head>
<body>
<p style="font-size:60px;font-weight: bold;">SB</p>

</body>
</html>

<!-- 然后index继承的，相当于就是index现在就是这个样子的没了 -->