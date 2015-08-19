<?php 

require_once '../config.php';
checkLogined('../login.html');
$role = C('role');
$list = $role->roleList(true);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>RBAC0模型实例 | Kien Shin</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>后台管理</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                      <span class="hidden-xs">Kien Shin</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        <p>
                          Kien Shin - PHP Developer
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="../index.php?action=logout" class="btn btn-default btn-flat">退出</a>
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
              <a href="../index.php">
                 <span>首页</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                 <span>文章管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../index.php?action=articleList"> 文章列表</a></li>
                <li><a href="../index.php?action=addArticle"> 添加文章</a></li>
              </ul>
            </li>
            <li class="treeview">
                      <a href="#">
                         <span>权限管理</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="../index.php?action=permissionList">权限列表</a></li>
                        <li><a href="../index.php?action=addPermission">添加权限</a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                         <span>角色管理</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="../index.php?action=roleList">角色列表</a></li>
                        <li><a href="../index.php?action=addRole">添加角色</a></li>
                      </ul>
                    </li>
            <li class="treeview">
              <a href="#">
                 <span>用户管理</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../index.php?action=userList">用户列表</a></li>
                <li><a href="../index.php?action=addUser">添加用户</a></li>
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
            角色列表
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-9" style="width:100%">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  
                  <div class="table-responsive mailbox-messages">
                  <span style="width: 10%; margin-left:10px; display: block;"><a href="addRole.php"><button class="btn btn-block btn-default">添加角色</button></a></span>
                    <table class="table table-hover table-striped">
                    <style>
                      .caozuo {float:left; width:100%; height:100%; padding-left:0; margin-bottom:0;}
                      .caozuo li {list-style-type:none; float:left;margin-right:10px;}
                      
                    </style>
                      <tbody>
                    <thead>
                    	<th>
                        	<td>角色名</td><td>操作</td>
                        </th>
                    </thead>
                      <?php 
                      if ($list = $role->roleList(true)){
                          foreach ($list as $value) {
                      ?>
                        <tr>
                          <td width="3%"></td>
                          <td class="mailbox-name"><a href="read-mail.html"><?php echo $value['name'];?></a></td>
                          <td class="mailbox-date">
                          <ul class="caozuo">
                          	<li><a href="../index.php?action=editRole&id=<?php echo $value['id'];?>"><button class="btn btn-block btn-default">编辑</button></a></li>
                          	<li><a href="../index.php?action=delRole&id=<?php echo $value['id'];?>"><button class="btn btn-block btn-default">删除</button></a></li>
                          </ul>
                          </td>
                        </tr>
                        <?php 
                        }
                      } else {
                          
                      
                          ?>
                          <tr><span style="marign:10px auto; font-size:100px;">没有角色╮(╯▽╰)╭</span></tr>
                          <?php }?>
                        </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js" type="text/javascript"></script>  
  </body>
</html>