<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>WeUI</title>
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="../style/weui.css"/>
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.css"/>
    <script src="zepto.min.js" type="text/javascript"></script>
    <script src="vipspa-master/src/vipspa.js" type="text/javascript"></script>
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
                            templateUrl: 'views/me.html',
                            controller: 'js/app/me.js'
                        },
                        'message': {
                            templateUrl: 'views/message.html',
                            controller: 'js/app/message.js'
                        },
                        'search': {
                            templateUrl: 'views/search.html',
                            controller: 'js/app/search.js'
                        },
                        'weixin': {
                            templateUrl: 'views/weixin.html',
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
    <!-- 暂且隐藏 先编写路由
        <div id="login"></div>
    -->

</body>
</html>