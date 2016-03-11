<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yliana Deza</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Sistema de Evaluación Nutricional">
    <meta name="author" content="Jesús Soto Gómez">
    <script>
      var url = "<?php echo $url; ?>";
    </script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $url; ?>favicon.ico" type="image/x-icon">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $url;?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="<?php echo $url;?>dist/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <link rel="stylesheet" href="<?php echo $url;?>dist/ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $url;?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo $url;?>dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- custom styles -->
    <link rel="stylesheet" href="<?php echo $url;?>dist/css/custom.css">
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-green-light fixed">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo $url;?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>D</b>N</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Evaluación</b>Nutricional</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo $url;?>images/foto.jpg" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Yliana Deza</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo $url;?>images/foto.jpg" class="img-circle" alt="User Image">
                    <p>
                      Yliana Deza Asion - Nutricionista
                      <small><?php echo strftime("%B del %Y");?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Bloquear</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo $url;?>home/logout" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $url;?>images/foto.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Yliana Deza Asion</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional)
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
         /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">EXAMEN</li>
            <li><a href="<?php echo $url;?>examen"><i class="fa fa-user-md"></i> <span>Evaluación Nutricional</span></a></li>

            <li class="header">AULAS</li>
            <?php $uri = $this->uri->segment(3);?>
            <li class="treeview <?php echo ($uri==1 or $uri==2)?'active':'';?>">
              <a href="#"><i class="fa fa-group"></i> <span>Lactantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php foreach($lactantes as $fila) {
                  $active = ($this->uri->segment(3) == $fila->id)?'active':'';
                  echo '<li class="'.$active.'"><a href="'.$url.'aula/index/'.$fila->id.'"><i class="fa fa-caret-right"></i>'.$fila->nombre.'</a></li>';
                 } ?>
              </ul>
            </li>

            <li class="treeview <?php echo ($uri==3 or $uri==4 or $uri==5 or $uri==6)?'active':'';?>">
              <a href="#"><i class="fa fa-group"></i> <span>Andantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php foreach($andantes as $fila) {
                  $active = ($this->uri->segment(3) == $fila->id)?'active':'';
                  echo '<li class="'.$active.'"><a href="'.$url.'aula/index/'.$fila->id.'"><i class="fa fa-caret-right"></i>'.$fila->nombre.'</a></li>';
                 } ?>
              </ul>
            </li>

            <li class="treeview <?php echo ($uri==7 or $uri==8 or $uri==9 or $uri==10 or $uri==11)?'active':'';?>">
              <a href="#"><i class="fa fa-group"></i> <span>Infantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php foreach($infantes as $fila) {
                  $active = ($this->uri->segment(3) == $fila->id)?'active':'';
                  echo '<li class="'.$active.'"><a href="'.$url.'aula/index/'.$fila->id.'"><i class="fa fa-caret-right"></i>'.$fila->nombre.'</a></li>';
                 } ?>
              </ul>
            </li>

            <li class="treeview <?php echo ($uri==12 or $uri==14 or $uri==15 or $uri==33)?'active':'';?>">
              <a href="#"><i class="fa fa-group"></i> <span>Jardín</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php foreach($jardin as $fila) {
                  $active = ($this->uri->segment(3) == $fila->id)?'active':'';
                  echo '<li class="'.$active.'"><a href="'.$url.'aula/index/'.$fila->id.'"><i class="fa fa-caret-right"></i>'.$fila->nombre.'</a></li>';
                 } ?>
              </ul>
            </li>

            <li class="header">MANTENIMIENTO</li>
              <li><a href="<?php echo $url;?>aula/mantenimiento"><i class="fa fa-folder"></i> <span>Aula</span></a></li>
            <li><a href="<?php echo $url;?>alumno"><i class="fa fa-male"></i> <span>Alumnos</span></a></li>

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
