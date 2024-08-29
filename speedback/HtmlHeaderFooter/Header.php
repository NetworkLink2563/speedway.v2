<?php session_start();

$m = "";
$dnow = date('Y-m-d H:i:s');

?>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>E-VA </title>


  <link href="../lib/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../lib/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="../lib/gentelella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <link href="../lib/gentelella/build/css/custom.min.css" rel="stylesheet">


</head>
<style>
 .right_col{
  min-height: auto !important;
 }

</style>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col" style="width:15%;">
        <div class="left_col scroll-view" style="width:100%;">
          <div class="navbar nav_title" style="border: 0;">
            <a href="http://127.0.0.1/speedback/Dashboard/" class="site_title">
              <i class="fa fa-globe"></i>&nbsp;<span style="font-size: 100%;">SpeedWay</span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
              <img src="../img/test2.png" class="img-circle profile_img" alt="">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION['XVUsrCode']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">

              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Customer <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu"
                    <?php if ($_GET['m'] == 'customer' ||  $_GET['m'] == 'project'  ||  $_GET['m'] == 'user') { ?> style="display: block;" <?php } ?>>
                    <li><a href="?m=customer">Customer</a></li>
                    <li><a href="?m=project">Project</a></li>
                    <li><a href="?m=user">User</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-users"></i>Setting<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" <?php if ($_GET['m'] == 'privilegeuser') { ?> style="display: block;" <?php } ?>>
                    <li><a href="?m=privilegeuser">Privilege User</a></li>

                  </ul>
                </li>

             

              </ul>
            </div>
            <div hidden class="menu_section">
              <h3>Live On</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="e_commerce.html">E-commerce</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="project_detail.html">Project Detail</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="profile.html">Profile</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="page_403.html">403 Error</a></li>
                    <li><a href="page_404.html">404 Error</a></li>
                    <li><a href="page_500.html">500 Error</a></li>
                    <li><a href="plain_page.html">Plain Page</a></li>
                    <li><a href="login.html">Login Page</a></li>
                    <li><a href="pricing_tables.html">Pricing Tables</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="#level1_1">Level One</a>
                    <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="level2.html">Level Two</a>
                        </li>
                        <li><a href="#level2_1">Level Two</a>
                        </li>
                        <li><a href="#level2_2">Level Two</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#level1_2">Level One</a>
                    </li>
                  </ul>
                </li>
                <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
              </ul>
            </div>

          </div>

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu nav_title">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>

            <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->


          </div>

          <nav class="nav ">

            <ul class="nav navbar-right panel_toolbox" style=" margin:9px;">

              <li class="nav-item dropdown open show " style="padding-left: 15px;">
              <li class="dropdown">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="true">
                  <img src="../img/test2.png" alt="">
                  <d style="color: white;"><?php echo $_SESSION['XVUsrCode']; ?></d>
                </a>


                <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; transform: translate3d(0px, 31px, 0px);">

                  <li><a class="dropdown-item" href="?m=usersetting">บัญชีผู้ใช้งาน</a>
                  </li>
                  <div class="clearfix"></div>

                  <li><a class="dropdown-item" href="../logout/index.php"><i class="fa fa-sign-out pull-right"></i>ออกจากระบบ</a>
                  </li>
                </ul>
              </li>
              </li>
              </li>
            </ul>
          </nav>


        </div>
      </div>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main" style="min-height:auto;">

        <div class="page-title">
          <div class="title_left">
            <!--<h3>General Elements</h3>-->
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              <?php

              //if ($_GET['m'] == "") {
              //    require("../model/model-index/index.php");
              //  } else

              if ($_GET['m'] == "customer") {
                require("../Customer/component/module_customer.php");
              } elseif ($_GET['m'] == "user") {
                require("../user/component/module_user.php");
              } elseif ($_GET['m'] == "project") {
                require("../project/component/module_project.php");
              } elseif ($_GET['m'] == "usersetting") {
                require("../User/component/module_user.php");
              } elseif ($_GET['m'] == "map") {
                require("../map/map.php");
              } elseif ($_GET['m'] == "privilegeuser") {
                require("../User/component/module_user.php");
              }
              ?>


              <!-- end of accordion -->


            </div>
          </div>
        </div>



        <div class="clearfix"></div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Networklink Platform Version 1.0 -<a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>

      <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
      </div>


</body>

</html>