<?php require('../../config/config.php'); require("../../config/session.php"); require("../../function.php");  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo DOMAIN; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo DOMAIN; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo DOMAIN; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo DOMAIN; ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo DOMAIN; ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo DOMAIN; ?>/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo DOMAIN; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo DOMAIN; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo DOMAIN; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                PT. Cipta Gemilang
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo getUserInfo('nama'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo DOMAIN; ?>/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo getUserInfo('nama'); ?> - <?php echo getUserLevel(); ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo DOMAIN; ?>/page/user/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo DOMAIN; ?>/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo getUserInfo('nama'); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li <?php if($pageActive == 'dashboard'): ?>class="active"<?php endif; ?> >
                            <a href="<?php echo DOMAIN; ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <?php if($_SESSION['level'] == 1): ?>
                        <li class="treeview <?php if($pageActive == 'user'): ?>active<?php endif; ?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo DOMAIN; ?>/page/user" ><i class="fa fa-angle-double-right"></i>Manage User</a></li>
                                <li><a href="<?php echo DOMAIN; ?>/page/user/input.php" ><i class="fa fa-angle-double-right"></i>Tambah User</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Produksi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a ><i class="fa fa-angle-double-right"></i>Manage Produksi</a></li>
                                <li><a ><i class="fa fa-angle-double-right"></i>Tambah Produksi</a></li>
                            </ul>
                        </li>

                        <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                        <li class="treeview <?php if($pageActive == 'kain'): ?>active<?php endif; ?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Kain</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo DOMAIN; ?>/page/kain"><i class="fa fa-angle-double-right"></i>Manage Kain</a></li>
                                <li><a href="<?php echo DOMAIN; ?>/page/kain/input.php"><i class="fa fa-angle-double-right"></i>Tambah Kain</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php if($pageActive == 'warna'): ?>active<?php endif; ?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Warna Kain</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo DOMAIN; ?>/page/warna"><i class="fa fa-angle-double-right"></i>Manage Warna</a></li>
                                <li><a href="<?php echo DOMAIN; ?>/page/warna/input.php"><i class="fa fa-angle-double-right"></i>Tambah Warna</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php if($pageActive == 'size'): ?>active<?php endif; ?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Size</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo DOMAIN; ?>/page/size" ><i class="fa fa-angle-double-right"></i>Manage Size</a></li>
                                <li><a href="<?php echo DOMAIN; ?>/page/size/input.php"><i class="fa fa-angle-double-right"></i>Tambah Size</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php if($pageActive == 'spesifikasi'): ?>active<?php endif; ?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Spesifikasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo DOMAIN; ?>/page/spesifikasi"><i class="fa fa-angle-double-right"></i>Manage Spesifikasi</a></li>
                                <li><a href="<?php echo DOMAIN; ?>/page/spesifikasi/input.php"><i class="fa fa-angle-double-right"></i>Tambah Spesifikasi</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Sub Spesifikasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a ><i class="fa fa-angle-double-right"></i>Manage Spesifikasi</a></li>
                                <li><a ><i class="fa fa-angle-double-right"></i>Tambah Spesifikasi</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   