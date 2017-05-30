<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>WeUI</title>
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="/css/weui.css"/>
    <!--<link rel="stylesheet" href="/css/bootstrap.css"/>-->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.js"></script>
    <script src="/js/zepto.min.js" type="text/javascript"></script>
    <script src="/js/vipspa.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/user_define/index.css"/>
    <script>
        $(function () { 

            $('#obtainCode').click(function () { 
                $("#codeImg").attr("src","/front/getNumberImage");
             });
            

            // $('.weui-label').click(function () { 
            //     $('.weui-label').addClass('weui-btn_plain-disabled');
            //     var totalTime = 60;
            //     var timer = setInterval(function() {
            //         $('.weui-label').html(totalTime+'s');
            //         totalTime--;
            //         if(totalTime<0){
            //             clearInterval(timer);
            //             $('.weui-label').removeClass('weui-btn_plain-disabled');
            //             $('.weui-label').html('获取验证码');
            //         }
            //     },1000);
            //  })
         })
    </script>
</head>
<body>
    <div class="container" style="margin-top: 14%;">
        <div class="weui-media-box__hd" style="text-align: center;margin-top: 10%;margin-bottom: 10%;">
            <img class="weui-media-box__thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==" alt="" style="width: 25%;
             border-radius: 50%;">
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-before">
                    <div class="weui-cell__hd">
                        <select class="weui-select" name="select2">
                            <option value="1">+86</option>
                            <option value="2">+80</option>
                            <option value="3">+84</option>
                            <option value="4">+87</option>
                        </select>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入号码">
                    </div>
                </div>
        <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd"><label id="obtainCode" class="weui-label" data-toggle="modal" data-target=".bs-example-modal-sm">获取验证码</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" placeholder="请输入验证码">
                    </div>
                    <div class="weui-cell__ft" style="visibility: hidden;">
                        <img class="weui-vcode-img" src="./images/vcode.jpg" alt="">
                    </div>
                </div>
        <div class="login" style="text-align:center;margin-top: 6%;">
        <button type="button" class="weui-btn weui-btn_primary"   style="width:60%;border-radius: 24px;">进入</button>
        </div>  

        <!--<div class="weui-dialog" style="display:none" id="modal_tip" >
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">弹窗标题</strong></div>
            <div class="weui-dialog__bd">弹窗内容，告知当前状态、信息和解决方法，描述文字尽量控制在三行内</div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">辅助操作</a>
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">主操作</a>
            </div>
        </div>-->
        
        

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content" style="margin-top: 30%;">
                    <div class="form-group" style="text-align: center;">
                        <img id="codeImg" src="" alt="..." class="img-responsive img-rounded" style="width: 80%;
    height: 80%;
    margin-left: 10%;">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="请输入验证码" style="text-align: center;margin-left: 25%;
    width: 50%;">
                        <button type="button" class="btn btn-info" id="codeConfirm" style="margin-top: 4%;">确认</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    

</body>
</html>
