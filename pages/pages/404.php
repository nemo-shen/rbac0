<?php 

require_once '../../config.php';
checkLogined('../../login.html');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | 404 Page not found</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="../js/html5shiv.min.js"></script>
        <script src="../js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>A</b>LT</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>后台管理</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Tasks: style can be found in dropdown.less -->
                  <li class="dropdown tasks-menu">
                    <ul class="dropdown-menu">
                      <li class="header">You have 9 tasks</li>
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                          <li><!-- Task item -->
                            <a href="#">
                              <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                              </h3>
                              <div class="progress xs">
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">20% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                          <li><!-- Task item -->
                            <a href="#">
                              <h3>
                                Create a nice theme
                                <small class="pull-right">40%</small>
                              </h3>
                              <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">40% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                          <li><!-- Task item -->
                            <a href="#">
                              <h3>
                                Some task I need to do
                                <small class="pull-right">60%</small>
                              </h3>
                              <div class="progress xs">
                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">60% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                          <li><!-- Task item -->
                            <a href="#">
                              <h3>
                                Make beautiful transitions
                                <small class="pull-right">80%</small>
                              </h3>
                              <div class="progress xs">
                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">80% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                        </ul>
                      </li>
                      <li class="footer">
                        <a href="#">View all tasks</a>
                      </li>
                    </ul>
                  </li>
                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../../img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                      <span class="hidden-xs">Kien Shin</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../../img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        <p>
                          Kien Shin - PHP Developer
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="../../index.php?action=logout" class="btn btn-default btn-flat">退出</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>
      <!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Kien Shin</p>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active treeview">
              <a href="../../index.php">
                 <span>首页</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                 <span>文章管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.php?action=articleList"> 文章列表</a></li>
                <li><a href="../../index.php?action=addArticle"> 添加文章</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <span>权限管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pages/permissionList.php">权限列表</a></li>
                <li><a href="../pages/addPermission.php">添加权限</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <span>角色管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pages/roleList.php">角色列表</a></li>
                <li><a href="../pages/addRole.php">添加角色</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <span>用户管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.php?action=userList">用户列表</a></li>
                <li><a href="../../index.php?action=addUser">添加用户</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            404 Error Page
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href='../../index.html'>return to dashboard</a> or try using the search form.
              </p>
              <form class='search-form'>
                <div class='input-group'>
                  <input type="text" name="search" class='form-control' placeholder="Search"/>
                  <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                  </div>
                </div><!-- /.input-group -->
              </form>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <!-- Control Sidebar -->      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../js/demo.js" type="text/javascript"></script>
  </body>
</html>
