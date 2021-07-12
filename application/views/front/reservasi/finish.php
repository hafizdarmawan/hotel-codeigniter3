<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
   <meta charset="utf-8">
   <title><?= $this->setting->nama; ?> | <?= @$page_title; ?></title>
   <meta name="description" content="<?= $this->setting->meta_description ?>" />
   <meta name="keywords" content="<?= $this->setting->meta_keywords ?>" />
   <meta name="author" content="colorlib">
   <link rel="icon" href="<?= base_url('assets/img/logo/') . $this->setting->logo ?>" type="image/png">
   <script type="application/x-javascript">
      addEventListener("load", function() {
         setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
         window.scrollTo(0, 1);
      }
   </script>
   <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-SoGL3Mr5A-z9s1RS"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.css" type="text/css" media="all" />
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/fontawesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/all.min.css">
   <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css2/style.css">
</head>

<body>

   <!-- Main Wrapper -->
   <div class="main-wrapper">
      <!-- Header -->
      <header class="header">
         <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
               <a href="<?= base_url('') ?>" class="navbar-brand logo">
                  <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" style="width: 55px;" class="" alt="Logo">
               </a>
            </div>
         </nav>
      </header>
      <div class="breadcrumb-bar">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-md-12 col-12">
                  <nav aria-label="breadcrumb" class="page-breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                     </ol>
                  </nav>
                  <h2 class="breadcrumb-title">Informasi</h2>
               </div>
            </div>
         </div>
      </div>

      <div class="content success-page-cont" style="min-height: 131.132px;">
         <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-lg-6">
                  <!-- Success Card -->
                  <div class="card success-card">
                     <div class="card-body">
                        <div class="success-cont">
                           <h3>Terimakasih Telah Telah melakukan reservasi</h3>
                           <p><strong><?= $setting->nama ?></strong></p>
                           <p>Selesaikan pembayaran dan Invoice Anda akan dikirim melalui email</p>
                           <a href="<?= base_url('') ?>" class="btn btn-primary view-inv-btn">Kembali</a>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- /Page Content -->
   <!-- Footer -->
   <footer class="footer">
      <!-- Footer Bottom -->
      <div class="footer-bottom">
         <div class="container-fluid">
            <div class="copyright">
               <div class="text-center">
                  <p class="mb-0"><strong class="text-white"><?= $setting->footer_text ?></strong></p>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- /Footer -->
   </div>
   <!-- /Main Wrapper -->
   <!-- jQuery -->
   <script src="<?= base_url('assets/front/') ?>assets/js/jquery.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/bootstrap.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/popper.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/slick.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.js"></script>
   <?php if ($this->uri->segment(1) != 'profile') : ?>
      <script src="<?= base_url('assets/front/') ?>radison/vendors/nice-select/js/jquery.nice-select.min.js"></script>
   <?php endif; ?>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
   <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
   <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <?= "<script>" . $this->session->flashdata('message') . "</script>" ?>
   <script>
      function remove_loader() {
         $('#overlay1').remove();
      }

      function call_loader() {

         if ($('#overlay1').length == 0) {
            var over = '<div id="overlay1">' +
               '<img  style="padding-top:300px; margin: 0 auto; " class="img-responsive " id="loading" src="<?php echo base_url('assets/img/only/ajax-loader.gif') ?>"></div>';

            $(over).appendTo('body');
         }
      }
   </script>
</body>

</html>