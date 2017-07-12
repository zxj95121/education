<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="shortcut icon" href="/admin/img/favicon_1.ico">

        <title>加辰教育定制</title>

        <!-- Bootstrap core CSS -->
        <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
	
        <!--Animation css-->
        <link href="/admin/css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="/admin/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="/admin/assets/material-design-iconic-font/css/material-design-iconic-font.min.css" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/admin/assets/morris/morris.css">

        <!-- sweet alerts -->
        <link href="/admin/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/admin/css/style.css" rel="stylesheet">
        <link href="/admin/css/helper.css" rel="stylesheet">
        


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="/admin/js/html5shiv.js"></script>
          <script src="/admin/js/respond.min.js"></script>
        <![endif]-->
        @yield('style')

    </head>


    <body>

        <!-- Aside Start-->
        <aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="/admin/dashboard" class="logo-expanded">
                    <i class="ion-social-buffer"></i>
                    <span class="nav-label">加辰教育定制</span>
                </a>
            </div>
            <!-- / brand -->
        
            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
                    <li class="{!!(Request::is('admin/dashboard')? 'active' : '') !!}">
                        <a href="/admin/dashboard">
                            <i class="zmdi zmdi-view-dashboard"></i> 
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    
                    <li class="has-submenu {!!(Request::is('admin/managerList','admin/managerReview','admin/parentInfo','admin/teacherInfo')? 'active' : '') !!}">
                        <a href="#">
                            <i class="zmdi zmdi-format-underlined"></i> 
                            <span class="nav-label">用户基本管理</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{!!(Request::is('admin/managerReview')? 'active' : '') !!}">
                                <a href="/admin/managerReview">管理员申请</a>
                            </li>
                            <li class="{!!(Request::is('admin/managerList')? 'active' : '') !!}">
                                <a href="/admin/managerList">管理员列表</a>
                            </li>
                            <li class="{!!(Request::is('admin/parentInfo')? 'active' : '') !!}">
                                <a href="/admin/parentInfo">家长列表</a>
                            </li>
                            <li class="{!!(Request::is('admin/teacherInfo')? 'active' : '') !!}">
                                <a href="/admin/teacherInfo">教师列表</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {!!(Request::is('admin/doubleTeacher', 'admin/classPrice', 'admin/setClassTime', 'admin/eclassOrderList')? 'active' : '') !!}">
                        <a href="#">
                            <i class="zmdi zmdi-book"></i> 
                            <span class="nav-label">双师class</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{!!(Request::is('admin/eclassOrderList')? 'active' : '') !!}">
                                <a href="/admin/eclassOrderList">双师class订单</a>
                            </li>
                            <li class="{!!(Request::is('admin/doubleTeacher')? 'active' : '') !!}">
                                <a href="/admin/doubleTeacher">课程内容管理</a>
                            </li>
                            <li class="{!!(Request::is('admin/classPrice')? 'active' : '') !!}">
                                <a href="/admin/classPrice">课程价格设置</a>
                            </li>
                            <li class="{!!(Request::is('admin/setClassTime')? 'active' : '') !!}">
                                <a href="/admin/setClassTime">上课时间设置</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {!!(Request::is('admin/applySchool', 'admin/applyHobby')? 'active' : '') !!}">
                        <a href="#">
                            <i class="ion-hammer"></i> 
                            <span class="nav-label">请求待审核</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{!!(Request::is('admin/applySchool')? 'active' : '') !!}">
                                <a href="/admin/applySchool">待审核学校</a>
                            </li>
                            <li class="{!!(Request::is('admin/applyHobby')? 'active' : '') !!}">
                                <a href="/admin/applyHobby">待审核爱好</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu {!!(Request::is('admin/communityManage','admin/subjectManage','admin/schoolManage','admin/hobbyManage','admin/classSetting')? 'active' : '') !!}">
                        <a href="#">
                            <i class="fa fa-cog"></i> 
                            <span class="nav-label">系统设置</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{!!(Request::is('admin/communityManage')? 'active' : '') !!}">
                                <a href="/admin/communityManage">社区管理   </a>
                            </li>
                            <li class="{!!(Request::is('admin/subjectManage')? 'active' : '') !!}">
                                <a href="/admin/subjectManage">学科管理   </a>
                            </li>
                            <li class="{!!(Request::is('admin/schoolManage')? 'active' : '') !!}">
                                <a href="/admin/schoolManage">学校管理   </a>
                            </li>
                            <li class="{!!(Request::is('admin/hobbyManage')? 'active' : '') !!}">
                                <a href="/admin/hobbyManage">爱好特长   </a>
                            </li>
                            <li class="{!!(Request::is('admin/classSetting')? 'active' : '') !!}">
                                <a href="/admin/classSetting">班级设置   </a>
                            </li>
                        </ul>
                    </li>
                   	<li class="has-submenu {!!(Request::is('admin/bill')? 'active' : '') !!}">
                        <a href="#">
                            <i class="zmdi zmdi-money"></i> 
                            <span class="nav-label">流水账管理</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{!!(Request::is('admin/bill')? 'active' : '') !!}">
                                <a href="/admin/bill">流水账   </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
                
        </aside>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">

                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">

                    <!-- Right navbar -->
                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                        <!-- Notification -->
                        <!-- <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="zmdi zmdi-notifications-none"></i>
                                <span class="badge badge-sm up bg-pink count">0</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                                <li class="noti-header">
                                    <p>Notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                                        <span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                                        <span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                                        <span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
                                    </a>
                                </li>
                                
                                <li>
                                    <p><a href="#" class="text-right">See all notifications</a></p>
                                </li>
                            </ul>
                        </li> -->
                        <!-- /Notification -->

                        <!-- user login dropdown start-->
                        <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" id="layout_headimg" src="/admin/img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                                <span class="username" id="layout_username">John Deo </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->       
                    </ul>
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->


            @yield('content')



            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer" id="computer_footer">
                
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="/admin/js/jquery.js"></script>
        <script src="/admin/js/bootstrap.min.js"></script>
        <script src="/admin/js/modernizr.min.js"></script>
        <script src="/admin/js/pace.min.js"></script>
        <script src="/admin/js/wow.min.js"></script>
        <script src="/admin/js/jquery.scrollTo.min.js"></script>
        <script src="/admin/js/jquery.nicescroll.js" type="text/javascript"></script>

        <!-- Counter-up -->
        <script src="/admin/js/waypoints.min.js" type="text/javascript"></script>
        <script src="/admin/js/jquery.counterup.min.js" type="text/javascript"></script>

         <!-- sparkline --> 
        <script src="/admin/assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="/admin/assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

        <!-- skycons -->
        <script src="/admin/js/skycons.min.js" type="text/javascript"></script>
    
        <!--Morris Chart-->
        <!-- <script src="assets/morris/morris.min.js"></script> -->
        <script src="/admin/assets/morris/raphael.min.js"></script>


        <script src="/admin/js/jquery.app.js"></script>
        
        <!-- Dashboard -->
        <!-- <script src="js/jquery.dashboard.js"></script> -->


        <script type="text/javascript">
            jQuery(document).ready(function($) {
                /* Counter Up */
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/admin/getAdminBasic',
                    dataType: 'json',
                    type: 'post',
                    data: {

                    },
                    success: function(data){
                        if (data.errcode == 0) {
                            document.title = data.site_name;
                            $('.logo-expanded span').html(data.site_name);

                            $('#layout_headimg').attr('src', data.adminInfo.headimg);
                            $('#layout_username').html(data.adminInfo.nickname);
                            $('#computer_footer').html(data.computer_footer);
                        }
                    }
                })
            });
            /* BEGIN SVG WEATHER ICON */
            if (typeof Skycons !== 'undefined'){
            var icons = new Skycons(
                {"color": "#fff"},
                {"resizeClear": true}
                ),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;

                for(i = list.length; i--; )
                icons.set(list[i], list[i]);
                icons.play();
            };
        </script>

        @yield('jquery')

    

    </body>
</html>
