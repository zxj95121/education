<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="img/favicon_1.ico">

        <title>Velonic - Responsive Admin Dashboard Template</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="assets/material-design-iconic-font/css/material-design-iconic-font.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="/css/weui.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            body{
                position: relative;
                top: -50px;
            }
            #Loginform{
                padding-top: 0px;
                margin-top: 0px;
            }
            #imgdiv{
                text-align: center;
            }
            .form-group{
                position: relative;
                top:-65px;
            }
            .form-group:nth-of-type(1){
                top:-30px;
            }
        </style>

    </head>


    <body>

        <div class="wrapper-page">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Sign In to <strong>Velonic</strong> </h3>
                </div> 

                <div class="panel-body">
                    <form id="Loginform" class="form-horizontal m-t-10 p-20 p-b-0" action="" onsubmit="return false;">
                                            
                        <div class="form-group" id="imgdiv">
                            <img id="qrcodeimg" iid="{{$qrcodeInfo['id']}}" src="{{$qrcodeInfo['qrcode']}}">
                        </div>

                        <div class="form-group" style="text-align: center;">
                            <div class="col-xs-12">
                                <label class="cr-styled" id="please">
                                    请使用管理员微信扫码登陆。
                                </label>
                            </div>
                            <div class="col-md-10 col-md-offset-1" id="js_status" style="display: none;">
                                <div class="row">                                   
                                    <div class="status_txt">
                                        <h5><i class="weui-icon-success"></i>扫描成功</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="请输入密码" />
                                    </div>
                                    <p class="col-md-12" id="password_error" style="color:red;text-align: left;"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right" id="login_div" style="display: none;">
                            <div class="col-xs-12">
                                <button class="btn btn-success w-md" type="button" id="login_btn" isok="0">登　录</button>
                            </div>
                        </div>
                        <div class="form-group m-t-30">
                            <div class="col-sm-7">
                                <a href="pages-recoverpw.html"><i class="fa fa-lock m-r-5"></i> 忘记密码?</a>
                            </div>
                            <div class="col-sm-5 text-right">
                                <a href="pages-register.html">申请管理员</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- <script src="js/pace.min.js"></script> -->
        <!-- <script src="js/wow.min.js"></script> -->
        <!-- <script src="js/jquery.nicescroll.js" type="text/javascript"></script> -->
            

        <!--common script for all pages-->
        <!-- <script src="js/jquery.app.js"></script> -->

        <script type="text/javascript">
            $.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            })

            $(function(){
                var inter = setInterval(function(){
                    $.ajax({
                        url: '/admin/login_scanok',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: $('#qrcodeimg').attr('iid')
                        },
                        success: function(data){
                            if (data.errcode == 0) {
                                clearInterval(inter);
                                $('#login_div').css('display', 'block');
                                $('#js_status').css('display', 'block');
                                $('#please').css('display', 'none');
                            }
                        }
                    })
                }, 2000);

                $('#password').blur(function(){
                    var password = $(this).val();
                    var reg = /^[0-9a-zA-Z_]{6,18}$/;
                    if (!reg.test(password)) {
                        $('#login_btn').attr('is_ok', '0');
                        $('#password_error').html('密码格式不正确');
                    } else {
                        $('#login_btn').attr('is_ok', '1');
                        $('#password_error').html('');
                    }
                })

                $('#password').keyup(function(){
                    var password = $(this).val();
                    var reg = /^[0-9a-zA-Z_]{6,18}$/;
                    if (!reg.test(password)) {
                        $('#login_btn').attr('is_ok', '0');
                    } else {
                        $('#login_btn').attr('is_ok', '1');
                        $('#password_error').html('');
                    }
                })

                $('#login_btn').click(function(){
                    var isok = $(this).attr('isok');
                    if (isok) {
                        /*ajax请求密码是否正确*/
                        $.ajax({
                            url: '/admin/passwordConfirm',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                password: $('#password').val(),
                                id: $('#qrcodeimg').attr('iid')
                            },
                            success: function(data){
                                if (data.errcode == 1) {
                                    $('#password_error').html('密码错误');
                                } else if (data.errcode == 0) {
                                    var url = window.location.search.split('=')[1];
                                    if (url != '') {
                                        window.location.href = '/admin/dashboard';
                                    } else {
                                        console.log(url);
                                        // window.location.href = url;
                                    }
                                }
                            }
                        })
                    }
                })
            })
        </script>
    </body>
</html>
