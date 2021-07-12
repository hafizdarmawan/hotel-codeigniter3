<!DOCTYPE html>
<html>

<head>
   <?php $setting = get_setting(); ?>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="<?= $setting->meta_description ?>" />
   <meta name="keywords" content="<?= $setting->meta_keywords ?>" />
   <meta name="author" content="colorlib">
   <title><?= $setting->nama ?>|<?= $page_title ?></title>
   <link rel="icon" href="<?= base_url('assets/img/logo/') . $setting->logo ?>" type="image/png">
   <!-- Font Awesome -->
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
            <p class="login-box-msg">Silahkan masukan email untuk melakukan reset password anda.</p>
            <form action="<?= base_url('admin/lupa/aksi') ?>" method="post">
               <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control <?= form_error('kode_captcha')  ? 'is-invalid' : "" ?>" placeholder="Email">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
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
               </div>
               <div class="row">
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block shadow">Request Password Baru</button>
                  </div>
               </div>
            </form>

            <p class="mt-3 mb-1 text-center">
               <a href="<?= site_url('admin/login') ?>">Kembali ke halaman Login</a>
            </p>
         </div>
      </div>
   </div>
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