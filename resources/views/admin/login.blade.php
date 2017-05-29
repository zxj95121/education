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
                    <form id="Loginform" class="form-horizontal m-t-10 p-20 p-b-0" action="index.html">
                                            
                        <div class="form-group" id="imgdiv">
                            <img id="qrcodeimg" iid="{{$qrcodeInfo['id']}}" src="{{$qrcodeInfo['qrcode']}}">
                        </div>

                        <div class="form-group" style="text-align: center;">
                            <div class="col-xs-12">
                                <label class="cr-styled">
                                    请使用管理员微信扫码登陆。
                                </label>
                            </div>
                            <div class="js_status" id="js_status" style="display: none;">
                                <div class="status">
                                    <i class="icon_qrcode_scan succ"></i>
                                    <div class="status_txt">
                                        <h5>扫描成功</h5>
                                        <p>请在微信上进行后续操作</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right" id="login_div" style="display: none;">
                            <div class="col-xs-12">
                                <button class="btn btn-success w-md" type="submit">Log In</button>
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
                            }
                        }
                    })
                }, 2000);
            })
        </script>
    </body>
</html>
