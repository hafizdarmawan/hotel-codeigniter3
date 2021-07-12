<!DOCTYPE html>
<html lang="en">

<head>
   <?php $setting = get_setting(); ?>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="<?= $setting->meta_description ?>" />
   <meta name="keywords" content="<?= $setting->meta_keywords ?>" />
   <title><?= $setting->nama ?>|<?= $page_title ?></title>
   <link rel="icon" href="<?= base_url('assets/img/logo/') . $setting->logo ?>" type="image/png">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/fontawesome-free/css/all.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.css" type="text/css" media="all" />
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/adminlte.min.css">
   <!-- <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/style.css"> -->
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
   <div id="preloader">
      <div class="loader"></div>
   </div>
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                     <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                           <h3 class="dropdown-item-title">
                              Brad Diesel
                              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                           </h3>
                           <p class="text-sm">Call me whenever you can...</p>
                           <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                     </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                     <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                           <h3 class="dropdown-item-title">
                              John Pierce
                              <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                           </h3>
                           <p class="text-sm">I got your message bro</p>
                           <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                     </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                     <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                           <h3 class="dropdown-item-title">
                              Nora Silvester
                              <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                           </h3>
                           <p class="text-sm">The subject goes here</p>
                           <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                     </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
               </div>
            </li> -->
            <!-- Notifications Dropdown Menu -->
            <?php $data_order_new = get_order_new() ?>
            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <?php if(count($data_order_new) > 0) :?>
                  <span class="badge badge-warning navbar-badge"><?= count($data_order_new) ?></span>
                  <?php endif ?>
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header"><?= count($data_order_new) ?> Reservasi</span>
                  <?php foreach ($data_order_new as $data) : ?>
                     <div class="dropdown-divider"></div>
                     <a href="<?= base_url('admin/booking/detail/').$data->id_order ?>" class="dropdown-item">
                        <?= $data->no_order ?>
                        <span class="float-right text-muted text-sm">Jam <?= date_time_convert($data->tgl_order); ?> WIB</span>
                     </a>
                  <?php endforeach ?>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url('admin/booking/data')?>" class="dropdown-item dropdown-footer">Lihat Semua Reservasi</a>
               </div>
            </li>
            <?php $data_admin = get_admin() ?>
            <li class="nav-item dropdown mr-4">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <div class="image">
                     <img src="<?= base_url('assets/img/pengguna/') . $data_admin->foto ?>" style="width: 30px;" class="img-circle elevation-2 shadow" alt="User Image">
                  </div>
               </a>
               <div class="dropdown-menu dropdown-menu-lg">
                  <h1 class="dropdown-item dropdown-header"><b><?= $data_admin->nama_depan ?> <?= $data_admin->nama_belakang ?></b></h1>
                  <div class="text-center">
                     <img src="<?= base_url('assets/img/pengguna/') . $data_admin->foto ?>" width="250" alt="">
                  </div>
                  <div class="row mt-2 mb-2">
                     <div class="col-md-1"></div>
                     <div class="col-md-5 mb-1">
                        <a href="<?= base_url('admin/profile') ?>" class="btn btn-block btn-primary">
                           <i class="fas fa-user"></i> Profil
                        </a>
                     </div>
                     <div class="col-md-5 mb-1">
                        <a href="#" data-toggle="modal" data-target="#ModalLogout" class="btn btn-block btn-danger">
                           <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->