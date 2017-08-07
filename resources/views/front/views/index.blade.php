<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>绑定手机号</title>
    <link rel="stylesheet" type="text/css" href="/css/weui.css">
    <link rel="stylesheet" href="/front/css_module/bind.css"/>
    <link rel="stylesheet" type="text/css" href="/js/h-ui/static/h-ui/css/H-ui.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="/js/sky/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/js/sky/css/default.css"> -->
    <style type="text/css">
        #head{
            background-image:url('{{$headimgurl}}');
        }
        .radio-box{
            color: #FFF;
        }
        .iBtn{
            display: inline-block;
        }
        .roleActive{
            background-color: #48C23D;
            border-color: #48C23D;
            color: #FFF;
        }
    </style>
</head>

<body>
    <div id="big">
        <div id="title">
            <h3>加辰教育定制</h3>
            <!-- <p>请绑定手机号</p> -->
        </div>
        <div id="head">
        </div>
        <div id="form">
            <div id="Phone" class="input" style="position: relative;">
                <lable>手机号：</lable>
                <input type="text" id="phone" name="phone" placeholder="请输入手机号" isok=0 required/>
                <button class="weui-btn weui-btn_mini weui-btn_default" type="button" style="position: absolute;top: 0px;right: 0px;height: 100%;" id="getPhoneCode">获取验证码</button>
            </div>
            <div id="phonecode" class="input">
                <lable>验证码：</lable>
                <input type="text" id="phoneCode" name="phoneCode" placeholder="请输入验证码" isok=0 required/>
            </div>
            <!-- <div class="skin-minimal">
                <div class="mt-20 skin-minimal">
                    <div class="radio-box">
                        <input type="radio" id="role1" name="role" value="1">
                        <label for="role1">我是家长</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="roal2" name="role" value="2">
                        <label for="role2">我是名师</label>
                    </div>
                </div>
            </div> -->
            <div class="identity" style="height: 60px;padding: 20px 0px 10px;text-align: center;box-sizing: border-box;">
                <div class="iBtn btn btn-default radius" style="margin-right: 10px;" val="1">我是家长</div>
                <div class="iBtn btn btn-default radius" style="margin-left: 10px;" val="2">我是名师</div>
            </div>
            <p id="tishi">让你看不到，哈哈哈</p>

            <button id="login_btn" type="submit">确认绑定</button>
        </div>
        <div id="information">
            <p>{{$phone_footer}}</p>
        </div>
    </div>

    <div id="toast" style="opacity: 0; display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content">验证码发送成功</p>
        </div>
    </div>
    <script type="text/javascript" src="/admin/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/h-ui/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
        
    <script type="text/javascript">
    </script>
    <script type="text/javascript">
        $(function(){
            var width=parseInt(document.body.clientWidth);
            var height=parseInt(window.innerHeight);
            $('body').css('height', height+'px');
            $('#big').css('top',0.03*height+'px');
            $('#big').css('height',0.97*height+'px');
            $('#title').css('height',0.15*height+'px');
            $('#form').css('marginTop',0.06*height+'px');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            window.phoneCode = 0;

            /*开始js检查*/
            $('#getPhoneCode').click(function(){
                var phone=$('#phone').val();
                var reg=/^1\d{10}$/;
                var phonejquery=$('#phone');
                if(!reg.test(phone)){
                    $('#tishi').html('手机号输入不正确！');
                    $('#tishi').css('opacity',1);
                    $('#phone').attr('isok',0);
                }
                else{
                    // 请求后台看是否已经有该数据
                    $.ajax({
                        url:'/front/register/phoneCode',
                        type:'post',
                        data:{
                            phone:phone
                        },
                        dataType:'json',
                        success:function(data){
                            console.log(data);
                            if(data.errcode == 0){
                                //表示账号未绑定
                                $('#tishi').css('opacity',0);
                                phonejquery.attr('isok',1);
                                $('#toast').css({'opacity': 1,'display': 'block'});
                                $('#phoneCode')[0].focus();
                                window.phoneCode = data.phoneCode;
                                setTimeout(function(){
                                    $('#toast').css({'opacity': 0,'display': 'none'});
                                }, 1200);
                                $('#getPhoneCode').html('60秒');
                                $('#getPhoneCode').prop('disabled', 'disabled');
                                var phoneTime = 59;
                                var inter = setInterval(function(){
                                    if(phoneTime > 0)
                                        $('#getPhoneCode').html(phoneTime--+'秒');
                                    else {
                                        $('#getPhoneCode').html('获取验证码');
                                        clearInterval(inter);
                                        $('#getPhoneCode').removeProp('disabled');
                                    }
                                },1000);
                            }
                            else if (data.errcode == 2){
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
                if (phoneCode = window.phoneCode){
                    $(this).attr('isok',1);
                    $('#tishi').css('opacity',0);
                } else {
                    $('#tishi').html('验证码不正确！');
                    $('#tishi').css('opacity',1);
                    $(this).attr('isok',0);
                }
            })

            $('#login_btn').click(function(){
                // var role = $('input[type="radio"]:checked').val();
                var role = $('.roleActive').attr('val');
                console.log(role);
                return false;
                if (!role) {
                    $('#tishi').html('请选择身份！');
                    $('#tishi').css('opacity',1);
                    return false;
                }
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
                if (phoneCode != window.phoneCode) {
                    $('#tishi').html('验证码不正确');
                    $('#tishi').css('opacity',1);
                    $('#phoneCode').attr('isok',0);
                    return;
                }

                if($('#phone').attr('isok')==1&&$('#phoneCode').attr('isok')==1){
                    $('#tishi').html('正在绑定...');
                    $('#tishi').css('opacity',1);
                    $.ajax({
                        url:'/front/register/registerSubmit',
                        type:'post',
                        data:{
                            phone: phone,
                            phoneCode: phoneCode,
                            openid: '{{$openid}}',
                            nickname: '{{$nickname}}',
                            headimg: '{{$headimgurl}}',
                            role: role
                        },
                        dataType:'json',
                        success: function(data){
                            if(data.errcode ==0){
                                //表示手机号验证码无误
                                $('#tishi').html('绑定成功！页面即将跳转...');
                                $('#tishi').css('opacity',1);
                                setTimeout(function(){$('#phone').val('');$('#phoneCode').val('');window.location.href="/front/home";},10);
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
    <!-- <script src="/js/sky/dist/jquery-starfield.js"></script>
    <script>
        $('body').starfield({
            starDensity: 2.0,
            mouseScale: 0.5,
            seedMovement: true
        });
    </script> -->


    <script type="text/javascript">
        // button切换
        $(function(){
            $('.iBtn').click(function(){
                var index = $(this).index();
                var other = (index+1)%2;
                if ($(this).hasClass('roleActive')) {
                    $(this).removeClass('roleActive');
                    $('.iBtn:eq('+other+')').addClass('roleActive');
                } else {
                    $(this).addClass('roleActive');
                    $('.iBtn:eq('+other+')').removeClass('roleActive');
                }
            })
        })
    </script>

</body>
</html>