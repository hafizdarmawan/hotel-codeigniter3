<!DOCTYPE html>
<html lang="en">
<!-- doccure/checkout.html  30 Nov 2019 04:12:16 GMT -->

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
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/vendors/nice-select/css/nice-select.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.css" type="text/css" media="all" />
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/responsive.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/fontawesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/all.min.css">
   <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
   <!-- Main CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css2/style.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/style.css">
</head>

<body>
   <!-- Preloader -->
   <div id="preloader">
      <div class="loader"></div>
   </div>
   <!-- /Preloader -->
   <!-- Main Wrapper -->
   <div class="main-wrapper">
      <!-- Header -->
      <header class="header">
         <nav class="navbar navbar-expand-lg header-nav">
            <div class="container">
               <div class="navbar-header">
                  <a href="<?= base_url('') ?>" class="navbar-brand logo">
                     <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" style="width: 52px;" class="" alt="Logo">
                  </a>
               </div>
            </div>
         </nav>
      </header>
      <div class="breadcrumb-bar">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-12 col-12">
                  <nav aria-label="breadcrumb" class="page-breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                     </ol>
                  </nav>
                  <h2 class="breadcrumb-title">Review Pemesanan </h2>
               </div>
            </div>
         </div>
      </div>
      <!-- Page Content -->
      <div class="content">
         <div class="container">
            <form method="POST">
               <?php $pemesan = get_tamu($booking['id_tamu']);
               $nama = $pemesan->nama_depan . $pemesan->nama_belakang
               ?>
               <input type="hidden" name="payment_gateway" value="1">
               <div class="row">
                  <div class="col-md-7 col-lg-8">
                     <div class="card shadow">
                        <div class="card-body">
                           <div class="card-body">
                              <!-- Personal Information -->
                              <div class="info-widget">
                                 <h4 class="card-title">Data Pemesan</h4>
                                 <div class="invoice-item">
                                    <div class="row mt-3">
                                       <div class="col-md-2">
                                          <?php $tipe_kamar_image = get_room_type_featured_image_medium($booking['id_tipe_kamar']); ?>
                                          <img src="<?= $tipe_kamar_image ?>" style="width: 100px;" alt="User Image">
                                       </div>
                                       <div class="col-md-10">
                                          <div class="row">
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info">
                                                   <strong class="customer-text">Check In</strong>
                                                   <p class="invoice-details invoice-details-two">
                                                      <!-- Check-in <br> -->
                                                      <?= $booking['check_in'] ?><br>
                                                      Dari <?= date('H:i', strtotime($setting->waktu_check_in)); ?> WIB <br>
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info invoice-info2">
                                                   <strong class="customer-text">Check Out</strong>
                                                   <p class="invoice-details">
                                                      <?= $booking['check_out'] ?> <br>
                                                      Sampai <?= date('H:i', strtotime($setting->waktu_check_out)); ?> WIB<br>
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info invoice-info2">
                                                   <strong class="customer-text">Durasi</strong>
                                                   <p class="invoice-details">
                                                      <?= $booking['nights'] ?> Malam <br>
                                                   </p>
                                                </div>
                                             </div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="invoice-info">
                                                   <strong class="customer-text">Data Pemesan</strong>
                                                   <p class="invoice-details invoice-details-two">
                                                      <?= $nama ?>
                                                   </p>
                                                   <p class="invoice-details invoice-details-two">
                                                      <?= $pemesan->email ?>
                                                   </p>
                                                   <p class="invoice-details invoice-details-two">
                                                      <?= $pemesan->no_telepon ?>
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="invoice-info">
                                                   <strong class="customer-text">Detail Pesanan</strong>
                                                   <table>
                                                      <th>
                                                         <tr>
                                                            <td>Tipe Kamar</td>
                                                            <td>:</td>
                                                            <td><?= $booking['tipe_kamar'] ?></td>
                                                         </tr>
                                                      </th>
                                                      <!-- <tr>
                                                         <td>Dewasa</td>
                                                         <td>:</td>
                                                         <td><?= $booking['adults'] ?> Orang</td>
                                                      </tr> -->
                                                      </th>
                                                      <th>
                                                         <tr>
                                                            <td>Jumlah Kamar</td>
                                                            <td>:</td>
                                                            <td><?= $booking['jml_kamar'] ?> Kamar</td>
                                                         </tr>
                                                      </th>
                                                      <?php if (!empty($booking['layanan'])) : ?>
                                                         <th>
                                                            <tr>
                                                               <td>Layanan</td>
                                                               <td>:</td>
                                                               <td>
                                                                  <p>
                                                                     <?php foreach ($booking['layanan'] as $data_layanan) : ?>
                                                                        <?php $nama_layanan =  get_layanan_by_id($data_layanan) ?>
                                                                        <?= '(' . $booking['adults'] . ' Porsi)' . $nama_layanan->judul . ',' ?>
                                                                     <?php endforeach ?>
                                                                  </p>
                                                               </td>
                                                            </tr>
                                                         </th>
                                                      <?php endif ?>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                          <hr>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="submit-section mt-4">
                                    <div class="col-md-10 col-12 input-group">
                                       <input type="text" name="voucher" id="voucher" class="form-control" placeholder='KODE VOUCHER' autocomplete="off" />
                                       <span class="input-group-btn ml-2">
                                          <button class="btn btn-primary submit-btn form-control shadow text-white" type="submit" name="voucher_apply" value="apply">Terapkan</button>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="invoice-item invoice-table-wrap mt-5">
                                    <div class="row">
                                       <div class="col-md-8 col-xl-6 ml-auto">
                                          <div class="table-responsive">
                                             <table class="invoice-table-two table">
                                                <tbody>
                                                   <?php if (!empty($coupon_data)) : ?>
                                                      <tr>
                                                         <th>Voucher</th>
                                                         <td>- Rp. <?= rupiah($coupon_data['discount']) ?> </td>
                                                      </tr>
                                                      <tr>
                                                         <th>Total Bayar:</th>
                                                         <td><strike><span>Rp. <?= rupiah($booking['totalamount']) ?></span></strike> <br>
                                                            Rp. <?= rupiah($coupon_data['totalamount']) ?>
                                                         </td>
                                                      </tr>
                                                   <?php else : ?>
                                                      <tr>
                                                         <th>Total Bayar:</th>
                                                         <td><span class="text-bold">Rp. <?= rupiah($booking['totalamount']) ?></span></td>
                                                      </tr>
                                                   <?php endif ?>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /Personal Information -->
                                 <div class="payment-widget">
                                    <!-- Submit Section -->
                                    <div class="submit-section mt-4">
                                       <!-- <button type="submit" class="btn btn-primary submit-btn">Lanjutkan Pemesanan</button> -->
                                       <input type="submit" name="pay" value="Lanjutkan Pembayaran" class="btn btn-primary submit-btn shadow" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5 col-lg-4 theiaStickySidebar">
                     <!-- Booking Summary -->
                     <!-- Booking Summary -->
                     <div class="card booking-card shadow">
                        <div class="card-header">
                           <h4 class="card-title">Informasi Pemesanan</h4>
                        </div>
                        <div class="card-body">
                           <div class="booking-doc-info">
                              <div class="booking-info">
                                 Reservasi ini tidak dapat dibatalkan.
                              </div>
                           </div>
                           <div class="submit-section mt-4">
                              <input type="submit" name="pay" value="Lanjutkan Pembayaran" class="btn btn-primary submit-btn btn-block shadow" />
                           </div>
                        </div>
                     </div>
                  </div>
            </form>
         </div>
      </div>
   </div>
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
   </div>
   <script src="<?= base_url('assets/front/') ?>assets/js/jquery.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/bootstrap.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/popper.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/slick.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.js"></script>
   <?php if ($this->uri->segment(1) != 'profile') : ?>
      <script src="<?= base_url('assets/front/') ?>radison/vendors/nice-select/js/jquery.nice-select.min.js"></script>
   <?php endif; ?>
   <script src="<?= base_url('assets/front/') ?>radison/vendors/popup/jquery.magnific-popup.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>radison/js/jquery.ajaxchimp.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>radison/js/theme.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
   <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
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

   <?php
   if (function_exists('validation_errors') && validation_errors() != '') {
      $error  = validation_errors();
   }
   if ($this->session->flashdata('message')) : ?>
      <script>
         toastr.success("<?php echo preg_replace("/\r|\n/", "", strip_tags($this->session->flashdata('message'))); ?>");
      </script>
   <?php endif; ?>
   <?php if ($this->session->flashdata('error')) : ?>
      <script>
         toastr.error("<?php echo preg_replace("/\r|\n/", "", strip_tags($this->session->flashdata('error'))); ?>");
      </script>
   <?php endif; ?>
   <?php if (!empty($error)) : ?>
      <script>
         toastr.error("<?php echo preg_replace("/\r|\n/", "", strip_tags($error)); ?>");
      </script>
   <?php endif; ?>

</body>

</html>