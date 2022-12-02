<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Main design
	Version: 1
	Author: Elos
================================================================================ -->

<head>
    <?php include('inc/css.php') ?>
    <?php include('inc/ncss_main.php') ?>
    <?php include('inc/ncss_custom.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Loader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url()?>assets/img/logo-bpdb.png" alt="BPDB Logo" height="60" width="60"/>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url()?>assets/img/logo-bpdb.png" alt="BPDB Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BPDB Sleman</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                WebGIS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                SDIN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-map"></i>
              <p>
                Peta Cuaca
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('login'); ?>" class="nav-link">
              <i class="nav-icon fa fa-arrow-circle-right"></i>
              <p>
                Login
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Map -->
        <div class="row  my-2">
          <div class="col">
            <div class="card-map">
              <h4 class="card-map_header">Laporan Peta Kejadian
                <?php if($range != ' - '){
                    echo $range;
                  }else{
                    echo "Hari Ini";
                  } ?>
              </h4>
              <div id="map_canvas" style="width:100%; height:500px;"></div>
            </div>
          </div>
        </div>
        <!-- Map -->
        
        <!-- <div class="row">
          <div class="col s12 m12 l12">
            <form class="col s12" id="formValidate" action="<?php echo base_url()?>main" method="get">
              <div class="card-panel" style="padding-top:1px;">
                <h4 class="header2">Filter Kejadian</h4>
                <div class="row" id="row_tanggal">
                  <div class="input-field col m4 s12">
                    <i class="mdi-action-account-circle prefix"></i>
                    <input name="dari" type="text" class="datepicker" required data-error=".errorTxt11">
                    <div class="warna_error errorTxt11"></div>
                    <label for="first_name">Dari</label>
                  </div>
                  <div class="input-field col m4 s12">
                    <i class="mdi-action-account-circle prefix"></i>
                    <input name="hingga" type="text" class="datepicker" required data-error=".errorTxt112">
                    <div class="warna_error errorTxt112"></div>
                    <label for="first_name">Hingga</label>
                  </div>
                  <div class="input-field col m4 s12">
                    <button class="btn cyan waves-effect waves-light left" type="submit">Proses
                      <i class="mdi-content-send right"></i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div> -->
        <h4 class="card-map_header">Filter Kejadian</h4>
        <form id="formValidate" action="<?php echo base_url()?>main" method="get">
        <div id="row_tanggal">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Dari:</label>
              <div class="input-group date" id="firstDate" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#firstDate"/>
                <div class="input-group-append" data-target="#firstDate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Hingga:</label>
              <div class="input-group date" id="secondDate" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#secondDate"/>
                <div class="input-group-append" data-target="#secondDate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row my-2">
          <button type="submit" class="btn btn-block btn-primary">Proses</button>
        </div>
        </div>

        </form>

        

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include('inc/footer.php') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

</body>
<?php include('inc/nscript_map.php') ?>
<?php include('inc/nscript.php') ?>
</html>
