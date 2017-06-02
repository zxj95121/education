<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>账号注册</title>
    <link rel="stylesheet" type="text/css" href="/css/weui.css">
    <link rel="stylesheet" href="/front/css_module/bind.css"/>
    <style type="text/css">
        #head{
            background-image:url('<?php echo 'http://wx.qlogo.cn/mmopen/w6MofXPc5Nj9oWjZKbm3svI0grH1AMuYg6OaoQoc5TNjuic9iazY1YZKD9yQ4p8WP0Ovo6QVG6kxyrHvWJPJ39V9vM0zS033OS/0'; ?>');
        }
    </style>
</head>

<body>
    <div id="big">
        <div id="title">
            <h3>加辰教育定制</h3>
            <p>请绑定手机号</p>
        </div>
        <div id="head">
        </div>
        <!-- <p>注意:请认准本页面从安师大蓝天论坛微信公众号进入。</p> -->
        <div id="form">
            <div id="Phone" class="input" style="position: relative;">
                <lable>手机号：</lable>
                <input type="text" id="phone" name="phone" placeholder="请输入手机号" isok=0 required/>
                <button class="weui-btn weui-btn_mini weui-btn_default" type="button" style="position: absolute;top: 0px;right: 0px;height: 100%;">获取验证码</button>
            </div>
            <div id="phonecode" class="input">
                <lable>验证码：</lable>
                <input type="text" id="phoneCode" name="phoneCode" placeholder="请输入验证码" isok=0 required/>
            </div>
            <p id="tishi">让你看不到，哈哈哈</p>

            <button id="login_btn" type="submit">确认绑定</button>
        </div>
        <div id="information">
            <p>Copyright 皖 2013-2017 zhangxianjian.com</p>
        </div>
    </div>
    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        
    <script type="text/javascript">
    </script>
    <script type="text/javascript">
        $(function(){
            var width=parseInt(document.body.clientWidth);
            var height=parseInt(window.innerHeight);
            $('#big').css('top',0.03*height+'px');
            $('#big').css('height',0.97*height+'px');
            $('#title').css('height',0.15*height+'px');
            $('#form').css('marginTop',0.06*height+'px');

            /*开始js检查*/
            $('#phone').blur(function(){
                var phone=$(this).val();
                var reg=/1\d{10}/;
                var phonejquery=$(this);
                if(!reg.test(phone)){
                    $('#tishi').html('手机号输入不正确！');
                    $('#tishi').css('opacity',1);
                    $(this).attr('isok',0);
                }
                else{
                    // 请求后台看是否已经有该数据
                    $.ajax({
                        url:'',
                        type:'post',
                        data:{
                            phone:phone
                        },
                        dataType:'json',
                        success:function(data){
                            console.log(data);
                            if(data.error==0){
                                //表示账号未绑定
                                $('#tishi').css('opacity',0);
                                phonejquery.attr('isok',1);
                            }
                            else{
                                //表示该学号已绑定
                                $('#tishi').html('该手机号已经被占用。');
                                $('#tishi').css('opacity',1);
                                phonejquery.attr('isok',0);
                            }
                        }
                    });
                }
            })
            $('#phoneCode').blur(function(){
                var phoneCode=$(this).val();
                if(phoneCode==''){
                    $('#tishi').html('验证码不能为空！');
                    $('#tishi').css('opacity',1);
                    $(this).attr('isok',0);
                }
                else{
                    $(this).attr('isok',1);
                    $('#tishi').css('opacity',0);
                }
            })

            $('#login_btn').click(function(){
                var phone=$('#phone').val();
                var phoneCode=$('#phoneCode').val();
                //先检查是否为空，并做出提示
                if(phone==''){
                    $('#tishi').html('手机号不能为空！');
                    $('#tishi').css('opacity',1);
                    $('#phone').attr('isok',0);
                    return;
                }
                if(phoneCode==''){
                    $('#tishi').html('验证码不能为空！');
                    $('#tishi').css('opacity',1);
                    $('#phoneCode').attr('isok',0);
                    return;
                }
                if($('#phone').attr('isok')==1&&$('#phoneCode').attr('isok')==1){
                    $('#tishi').html('正在绑定...');
                    $('#tishi').css('opacity',1);
                    $.ajax({
                        url:'',
                        type:'post',
                        data:{
                            phone: phone,
                            phoneCode: phoneCode,
                            openid: ''
                        },
                        dataType:'json',
                        success: function(data){
                            if(data.error==0){
                                //表示账号密码无误
                                $('#tishi').html('绑定成功！页面即将跳转...');
                                $('#tishi').css('opacity',1);
                                setTimeout(function(){$('#phone').val('');$('#phoneCode').val('');window.location.href="";},500);
                            }
                            else{
                                //绑定失败
                                $('#tishi').html('手机号验证码不匹配，绑定失败。');
                                $('#tishi').css('opacity',1);
                            }
                        }
                    });
                }
            })
        })
    </script>

</body>
</html>