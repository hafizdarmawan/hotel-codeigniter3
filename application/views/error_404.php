<!DOCTYPE html>
<html>
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
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/adminlte.min.css">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="">
   <div class="row">
      <div class="col-md-12">
         <section class="content">
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                  </div>
               </div>
            </section>
            <div class="error-page">
               <h2 class="headline text-danger">404</h2>
               <div class="error-content">
                  <h3><i class="fas fa-exclamation-triangle text-danger"></i> Tidak Ditemukan.</h3>
                  <p>
                     Maaf yang anda cari tidak ditemukan.
                     <a href="#" onclick="history.back(-1)">Kembali</a>.
                  </p>
               </div>
            </div>
         </section>
      </div>
   </div>
   <script src="<?= base_url('assets/admin/') ?>plugins/jquery/jquery.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>dist/js/adminlte.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>dist/js/demo.js"></script>
</body>
</html>