<!DOCTYPE html>
<html>
<head>
    <title>加辰教育</title>
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/sm.min.css">
</head>
<body>
<!-- page集合的容器，里面放多个平行的.page，其他.page作为内联页面由路由控制展示 -->
    <div class="page-group">
        <!-- 单个page ,第一个.page默认被展示-->
        <div class="page">
            <!-- 标题栏 -->
            <header class="bar bar-nav">
                <h1 class="title">错误提示</h1>
            </header>
            <!-- 这里是页面内容区 -->
            <div class="content" style="max-width: 500px;margin: 0 auto;">
                <img src="/images/error.jpg" style="width: 100%;">
                <p style="font-size: 18px;color: #A2A2A2;text-align: center;">
                    您要访问的页面走丢了...
                </p>
                <p style="text-align: center;">
                    <a href="/front/home/oauth" class="button button-fill" style="width: 50%;margin:10px auto 0px;">返回首页 </a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/zepto.min.js"></script>
    <script type="text/javascript" src="/js/sm.min.js"></script>
    <!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->
    <script>$.init()</script>
</body>
</html>