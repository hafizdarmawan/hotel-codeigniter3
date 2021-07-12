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
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/adminlte.min.css">
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
   <div class="login-box">
      <div class="login-logo">
         <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" alt="<?= $setting->nama ?>" style="width: 100px;">
         <!-- <a href="<?= site_url() ?>"><b><?= $setting->nama ?></b></a> -->
      </div>
      <div class="card shadow">
         <div class="card-body login-card-body">
            <p class="login-box-msg"><b><?= $setting->nama ?></b></p>
            <p class="login-box-msg">Silahkan isi password baru anda</p>
            <form action="<?= base_url('admin/reset/aksi') ?>" method="post">
               <div class="input-group mb-3">
                  <input type="password" class="form-control <?= form_error('password')  ? 'is-invalid' : "" ?>" placeholder="Password" name="password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" class="form-control <?= form_error('konfirmasi_pass')  ? 'is-invalid' : "" ?>" placeholder="Confirm Password" name="konfirmasi_pass">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block shadow">Ubah Password</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>
            <p class="mt-3 mb-1 text-center">
               <a href="<?= base_url('admin/login') ?>">Kembali ke Login</a>
            </p>
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
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <?php echo "<script>" . $this->session->flashdata('message') . "</script>" ?>

</body>

</html>