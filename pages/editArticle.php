<?php 

require_once '../config.php';
checkLogined('../login.html');

$article = C('article');
$result = $article->showArtticle($_GET['id']);
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
            编辑文章
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header'>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  <form action="../index.php?action=editArticle&id=<?php echo $result['id'];?>" method="post">
                  <div class="form-group">
                    <label>文章标题：</label>
                    <input type="text" value="<?php echo $result['name'];?>" name="title" class="form-control my-colorpicker1"/>
                  </div><!-- /.form group -->
                    <textarea id="editor1" name="content" rows="10" cols="80">
                    <?php echo $result['content'];?>
                    </textarea>
						<table class="table table-bordered text-center">
		                    <tr><td style="width:60%"></td>
		                      <td style="width:20%;"><button type="submit" class="btn btn-block btn-default">编辑</button></td>
		                      <td style="width:20%;"><button type="reset" class="btn btn-block btn-default">重置</button></td>
		                    </tr>
                    	</table>
                  </form>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js" type="text/javascript"></script>  
    <!-- CK Editor -->
    <script src="../plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
  </body>
</html>
