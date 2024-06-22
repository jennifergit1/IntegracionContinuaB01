<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Barber AgendApp - <?php $nombreModulo ?></title>
  <link rel="shortcut icon" href="../../dist/img/icono_peluqueria.png" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- DataTable BS4 -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.css">
  <?php
  if ($style) :
    foreach ($style as $key => $value) :
      echo ($value);
    endforeach;
  endif;
  ?>
</head>


<div class="modal fade" id="modalMiInfo" tabindex="-1" aria-labelledby="modalMiInfoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalMiInfoLabel">Editar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEditarUsuario">
        <div class="modal-body">
          <input type="hidden" value="<?php echo ($_SESSION["id"]); ?>" name="idMiInfo" id="idMiInfo">
          <div class="container">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <p><strong>Correo electrónico</strong></p>
                <p><?php echo ($_SESSION["correo"]); ?></p>
              </div>
              <div class="col-md-12 mb-3">
                <label for="nombresMiInfo">Nombres</label>
                <input type="text" class="form-control" id="nombresMiInfo" name="nombresMiInfo" required value="<?php echo ($_SESSION["nombres"]); ?>">
              </div>
              <div class="col-md-12 mb-3">
                <label for="claveMiInfo">Cambiar contraseña</label>
                <input type="password" class="form-control" id="claveMiInfo" name="claveMiInfo" required>
                <small>Si no deseas cambiar tu contraseña deja este campo en blanco.</small>
              </div>
              <div class="col-md-12 mb-3">
                <label for="confirmarClaveMiInfo">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmarClaveMiInfo" name="confirmarClaveMiInfo" required>
              </div>
              <div class="col-md-12 mb-3">
                <p><strong>Rol</strong></p>
                <p><?php echo (($_SESSION["admin"] == 1) ? "Administrador" : "Cliente"); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnEditarMiInfo" name="btnEditarMiInfo">Editar mi información</button>
        </div>
      </form>
    </div>
  </div>
</div>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../dist/img/icono_peluqueria.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../index.php" class="nav-link">Inicio</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contacto</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-cog"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalMiInfo">
              <i class="fas fa-sign-out-alt"></i> Mi información
              <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="../login/logout.php" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i> Cerrar sesión
              <span class="float-right text-muted text-sm"></span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-primary">
      <!-- Brand Logo -->
      <a href="../../index.php" class="brand-link">
        <img src="../../dist/img/icono_barber.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Barber Agend<strong>App</strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/icono_peluqueria.png" class="img-circle" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block" data-toggle="modal" data-target="#modalMiInfo"><?php echo ($_SESSION["nombres"]); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <?php if (isset($_SESSION["correo"])) : ?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#modalMiInfo">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Mi información</p>
                </a>
              </li>
              <?php
              if ($_SESSION["admin"] == 1) :
              ?>
                <li class="nav-item">
                  <a href="../usuarios/usuarios.php" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Gestionar usuarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../citasAdmin/citasAdmin.php" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Gestionar citas</p>
                  </a>
                </li>
              <?php
              elseif ($_SESSION["admin"] == 0) :
              ?>
                <li class="nav-item">
                  <a href="../citas/citas.php" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Gestionar mis citas</p>
                  </a>
                </li>
              <?php
              endif;
              ?>
              <li class="nav-item">
                <a href="../login/logout.php" class="nav-link">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Cerrar sesión</p>
                </a>
              </li>
            </ul>
          <?php endif; ?>
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
              <h1 class="m-0"><?php echo ($nombreModulo); ?></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content pb-4">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">