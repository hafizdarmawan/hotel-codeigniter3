<!DOCTYPE html>
<html>

<head>
   <?php $setting = get_setting(); ?>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="<?= $setting->meta_description ?>" />
   <meta name="keywords" content="<?= $setting->meta_keywords ?>" />
   <!-- <meta name="author" content="colorlib"> -->
   <title><?= $setting->nama ?>|<?= $page_title ?></title>
   <link rel="icon" href="<?= base_url('assets/img/logo/') . $setting->logo ?>" type="image/png">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/adminlte.min.css">
   <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
   <div id="loading">
      <div style="display:none">
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="26" height="26">
            <param name="movie" value="flash/f_loader.swf" />
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="BGCOLOR" value="dddddd" />
            <embed src="flash/f_loader.swf" width="26" height="26" quality="high" wmode="opaque" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="dddddd"></embed>
         </object>
      </div>
   </div>
   <?php

   if ($this->session->flashdata('message'))
      $message = $this->session->flashdata('message');
   if ($this->session->flashdata('error'))
      $error  = $this->session->flashdata('error');
   if (function_exists('validation_errors') && validation_errors() != '') {
      $error  = validation_errors();
   }
   ?>
   <div class="login-box">
      <div class="login-logo">
         <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" alt="<?= $setting->nama ?>" style="width: 100px;">
         <!-- <a href="<?= site_url() ?>"><b><?= $setting->nama ?></b></a> -->
      </div>
      <div class="card shadow">
         <div class="card-body login-card-body">
            <p class="login-box-msg"><b><?= $setting->nama ?></b></p>

            <form action="<?= base_url('admin/login/aksi') ?>" method="post">

               <div class="input-group mb-3">
                  <input type="text" class="form-control <?= form_error('username')  ? 'is-invalid' : "" ?>" placeholder="Username" name="username">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" class="form-control <?= form_error('password')  ? 'is-invalid' : "" ?>" placeholder="Password" name="password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row mb-2">
                  <div class="col-7">
                     <?= $cap_img; ?>
                  </div>
                  <!-- /.col -->
                  <div class="col-5">
                     <input type="text" name="kode_captcha" class="form-control <?= form_error('kode_captcha')  ? 'is-invalid' : "" ?>">
                  </div>

                  <!-- /.col -->
               </div>
               <button type="submit" class="btn btn-primary btn-block shadow">Masuk</button>
               <input type="hidden" value="<?= $redirect; ?>" name="redirect" />
               <input type="hidden" value="submitted" name="submitted" />

            </form>
            <div class="text-center">
               <p class="mb-1 mt-3">
                  <a href="<?= site_url('admin/lupa/login') ?>">anda lupa password?</a>
               </p>
            </div>

         </div>
         <!-- /.login-card-body -->
      </div>
   </div>
   <!-- /.login-box -->

   <!-- jQuery -->
   <script src="<?= base_url('assets/admin/') ?>plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="<?= base_url('assets/admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?= base_url('assets/admin/') ?>dist/js/adminlte.min.js"></script>
   <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
   <script>
      $(function() {
         $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
         });
      });
   </script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <?= "<script>" . $this->session->flashdata('message') . "</script>" ?>

</body>

</html>