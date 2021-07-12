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
   <script src='https://www.google.com/recaptcha/api.js'></script>
   <style>
      .error {
         color: red;
      }
   </style>
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/vendors/nice-select/css/nice-select.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.css" type="text/css" media="all" />
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/responsive.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/fontawesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/plugins/fontawesome/css/all.min.css">
   <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css2/style.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/style.css">
   <style>
      .quantity {
         position: relative;
      }

      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
         -webkit-appearance: none;
         margin: 0;
      }

      input[type=number] {
         -moz-appearance: textfield;
      }

      .quantity input {
         width: 130px;
         height: 45px;
         line-height: 1.65;
         float: left;
         display: block;
         padding: 0;
         margin: 0;
         padding-left: 20px;
         border: 1px solid #eee;
      }

      .quantity input:focus {
         outline: 0;
      }

      .quantity-nav {
         float: left;
         position: relative;
         height: 42px;
      }

      .quantity-button {
         position: relative;
         cursor: pointer;
         border-left: 1px solid #eee;
         width: 50px;
         text-align: center;
         color: #333;
         font-size: 13px;
         font-family: "Trebuchet MS", Helvetica, sans-serif !important;
         line-height: 1.9;
         -webkit-transform: translateX(-100%);
         transform: translateX(-100%);
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         -o-user-select: none;
         user-select: none;
      }

      .quantity-button.quantity-up {
         position: absolute;
         height: 50%;
         top: 0;
         border-bottom: 1px solid #eee;
      }

      .quantity-button.quantity-down {
         position: absolute;
         bottom: -1px;
         height: 50%;
      }
   </style>
</head>

<body>
   <!-- Preloader -->
   <div id="preloader">
      <div class="loader"></div>
   </div>
   <!-- /Preloader -->
   <div class="main-wrapper">
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
                  <h2 class="breadcrumb-title">Data Pemesan </h2>
               </div>
            </div>
         </div>
      </div>
      <div class="content">
         <div class="container">
            <div class="row">
               <div class="col-md-7 col-lg-8">
                  <div class="card shadow">
                     <div class="card-body">
                        <div class="card-body">
                           <div class="text-center">
                              <p><strong>Data Pemesan</strong></p>
                           </div>
                           <div class="tab-content">
                              <div class="tab-pane show active" id="bottom-justified-tab1">
                                 <form method="post" action="<?= base_url('front/reservasi/step') ?>" id="viewform">
                                    <?php
                                    $nights       =   GetDays($_GET['date_from'], $_GET['date_to']) - 1;
                                    $base_price   =   get_price($_GET['date_from'], $_GET['date_to'], $_GET['tipe_kamar'], $_GET['adults'], $_GET['jml_kamar']);
                                    // echo '<pre>'; print_r($base_price);die;
                                    if ($nights == 0) {
                                       $nights  = 1;
                                    }
                                    $amount      =   $base_price['total_price'];
                                    $amount      =   rate_exchange($amount);
                                    $total       =   $amount;
                                    ?>
                                    <input type="hidden" name="date_from" value="<?= $_GET['date_from'] ?>" id="date_from" />
                                    <input type="hidden" name="date_to" value="<?= $_GET['date_to'] ?>" id="date_to" />
                                    <!-- <input type="hidden" name="adults" value="<?= $_GET['adults'] ?>" id="adults" /> -->
                                    <input type="hidden" name="kids" value="<?= $_GET['kids'] ?>" />
                                    <input type="hidden" name="tipe_kamar" value="<?= $_GET['tipe_kamar'] ?>" />
                                    <input type="hidden" name="nights" value="<?= $nights ?>" id="nights" />
                                    <input type="hidden" name="jml_kamar" value="<?= $_GET['jml_kamar'] ?>" id="jml_kamar" />
                                    <input type="hidden" name="total" value="<?= $total; ?>" id="total" />
                                    <div class="info-widget">
                                       <div class="row">
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Nama Depan</label>
                                                <input class="form-control" type="text" value="<?= $tamu->nama_depan ?>">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Nama Belakang</label>
                                                <input class="form-control" type="text" value="<?= $tamu->nama_belakang ?>">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Email</label>
                                                <input class="form-control" type="email" value="<?= $tamu->email ?>">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>No Telepon</label>
                                                <input class="form-control" type="text" value="<?= $tamu->no_telepon ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <a class="btn btn-primary shadow" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Detail Biaya</a>
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                       <div class="invoice-item invoice-table-wrap">
                                          <div class="row mt-3">
                                             <div class="col-md-12">
                                                <div class="table-responsive">
                                                   <table class="invoice-table table table-bordered">
                                                      <thead>
                                                         <tr>
                                                            <th>#</th>
                                                            <th class="text-center">Tanggal</th>
                                                            <th class="text-center">Biaya</th>
                                                         </tr>
                                                      </thead>
                                                      <?php $i = 1;
                                                      foreach ($base_price['price_details'] as $key   => $val) : ?>
                                                         <tbody>
                                                            <tr>
                                                               <td><?= $i++ ?></td>
                                                               <td class="text-center"><?= tgl_indo($key); ?></td>
                                                               <td class="text-center">Rp <?= rupiah($val['price']) ?> x <?= @$_GET['jml_kamar'] ?> Kamar</td>
                                                            </tr>
                                                         </tbody>
                                                      <?php endforeach ?>
                                                   </table>
                                                </div>
                                             </div>
                                             <div class="col-md-8 col-xl-7 ml-auto">
                                                <table class="invoice-table-two table">
                                                   <tbody>
                                                      <tr>
                                                         <th>Total:</th>
                                                         <td><span>Rp <?= rupiah($base_price['amount']) ?></span></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="invoice-item invoice-table-wrap mt-3">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                   <thead>
                                                      <tr>
                                                         <th>Deskripsi</th>
                                                         <th class="text-right">Biaya</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td><?= $_GET['jml_kamar'] ?> Kamar Tipe <?= @$tipe_kamar->judul ?> (<?= $nights ?> Malam)</td>
                                                         <td class="text-right">Rp <?= rupiah($base_price['amount']) ?></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                             <?php if (!empty($services)) { ?>
                                                <a class="btn btn-primary shadow" data-toggle="collapse" href="#layanan" role="button" aria-expanded="false" aria-controls="layanan">+ Layanan</a>
                                                <div class="collapse multi-collapse" id="layanan">
                                                   <div class="invoice-item invoice-table-wrap">
                                                      <div class="row mt-3">
                                                         <div class="col-md-3 col-sm-12">
                                                            <div class="form-group card-label">
                                                               <div class="quantity">
                                                                  <label>Jumlah Pesan</label>
                                                                  <input type="number" name="adults" id="adults" class="form-control shadow" min="1" max="9" step="1" value="1">
                                                               </div>
                                                               <!-- <input class="form-control" type="text" value="" id="adults" name="adults"> -->
                                                            </div>
                                                         </div>
                                                         <div class="col-md-9">
                                                            <table class="invoice-table table table-bordered">
                                                               <thead>
                                                                  <tr>
                                                                     <th class="text-center">Nama Layanan + Biaya</th>
                                                                  </tr>
                                                               </thead>
                                                               <?php
                                                               foreach ($services as $serv) : ?>
                                                                  <tbody>
                                                                     <tr>
                                                                        <td class="text-center"> <input type="checkbox" name="layanan[]" <?= 'checked' ? $ds = $serv->id_layanan : $ds = '' ?> value="<?= $ds ?>" class="layanan" /> <?= $serv->judul ?> (
                                                                           Rp <?= rupiah($serv->biaya) ?>
                                                                           <?php
                                                                           $tipe_biaya   =   '';
                                                                           if ($serv->tipe_biaya == 1) {
                                                                              $tipe_biaya   =   '/Orang';
                                                                           }
                                                                           if ($serv->tipe_biaya == 2) {
                                                                              $tipe_biaya   =   '/Malam';
                                                                           }
                                                                           if ($serv->tipe_biaya == 3) {
                                                                              $tipe_biaya   =   'Biaya Tetap';
                                                                           }
                                                                           echo $tipe_biaya;
                                                                           ?>)
                                                                        </td>
                                                                     </tr>
                                                                  </tbody>
                                                               <?php endforeach ?>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             <?php } ?>
                                          </div>
                                          <div class="col-md-9 col-xl-7 ml-auto">
                                             <table class="invoice-table-two table">
                                                <tbody>
                                                   <tr>
                                                      <th>Total Biaya:</th>
                                                      <td><span id="grand_total">Rp <?= rupiah($total); ?></span></td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="mt-5">
                                       <?php
                                       if (count($tamu) > 0) { ?>
                                          <div class="float-sm-right">
                                             <button type="submit" name="continue" value="Continue To Payment" class="btn btn-primary submit-btn shadow">Lanjut Pemesanan</button>
                                          </div>
                                       <?php } else { ?>
                                          <div class="float-sm-right">
                                             <button type="button" class="btn btn-primary submit-btn shadow" data-toggle="modal" data-target="#ModalLogin">Login Terlebih Dahulu</button>
                                          </div>
                                       <?php } ?>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--  -->
                  <!-- <div class="card">
                     <div class="card-body">
                        <div class="card-body">
                           <div class="text-center">
                              <p><strong>Kebijakan Pembatalan</strong></p>
                           </div>
                           <div class="tab-content">
                              <p>Pemesanan Kamar Tidak Dapat dibatalkan</p>
                           </div>
                        </div>
                     </div>
                  </div> -->
               </div>
               <div class="col-md-5 col-lg-4 theiaStickySidebar">
                  <div class="card booking-card shadow">
                     <div class="card-header">
                        <h4 class="card-title">Ringkasan Pemesanan</h4>
                     </div>
                     <div class="card-body">
                        <div class="booking-doc-info">
                           <a href="doctor-profile.html" class="booking-doc-img">
                              <?php $tipe_kamar_image = get_room_type_featured_image_medium($tipe_kamar->id_tipe_kamar); ?>
                              <img src="<?= $tipe_kamar_image ?>" alt="User Image">
                           </a>
                           <div class="booking-info">
                              <h4><a href="doctor-profile.html"><?= @$tipe_kamar->judul ?></a></h4>
                              <!-- <div class="rating">
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star"></i>
                                 <span class="d-inline-block average-rating">35</span>
                              </div> -->
                           </div>
                        </div>
                        <div class="booking-summary mt-2">
                           <div class="booking-item-wrap">
                              <ul class="booking-date">
                                 <li>Dari <span><?= tgl_indo(@$_GET['date_from']) ?></span></li>
                                 <li>Sampai <span><?= tgl_indo(@$_GET['date_to']) ?></span></li>
                                 <li>Durasi <span><?= $nights; ?> Malam</span></li>
                                 <li>Jml Kamar <span><?= @$_GET['jml_kamar'] ?> Kamar</span></li>
                                 <!-- <li>Jml Dewasa <span><?= @$_GET['adults']; ?> Dewasa</span></li> -->
                                 <li>Check-in <span>Dari <?= date('H:i', strtotime($setting->waktu_check_in)); ?> WIB</span></li>
                                 <li>Check-out <span>Sebelum <?= date('H:i', strtotime($setting->waktu_check_out)); ?> WIB</span></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <footer class="footer">
         <!-- Footer Bottom -->
         <div class="footer-bottom">
            <div class="container-fluid">
               <!-- Copyright -->
               <div class="copyright">
                  <div class="text-center">
                     <p class="mb-0"><strong class="text-white"><?= $setting->footer_text ?></strong></p>
                  </div>
               </div>
            </div>
         </div>
      </footer>
   </div>
   <!-- /Main Wrapper -->

   <!-- jQuery -->
   <script src="<?= base_url('assets/front/') ?>assets/js/jquery.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/bootstrap.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/popper.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/slick.js"></script>
   <!-- <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script> -->
   <script src="<?= base_url('assets/front/') ?>radison/js/stellar.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.js"></script>
   <?php if ($this->uri->segment(1) != 'profile') : ?>
      <script src="<?= base_url('assets/front/') ?>radison/vendors/nice-select/js/jquery.nice-select.min.js"></script>
   <?php endif; ?>
   <script src="<?= base_url('assets/front/') ?>radison/js/jquery.ajaxchimp.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>radison/js/theme.js"></script>
   <script src="<?= base_url('assets/front/') ?>radison/js/aos.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
   <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
   <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
   <!-- <script type="text/javascript">
      $(document).ready(function() {
         $("#jumlah, #harga").keyup(function() {
            var harga = $("#harga").val();
            var jumlah = $("#jumlah").val();
            var total = parseInt(harga) * parseInt(jumlah);
            $("#total").val(total);
         });
      });
   </script> -->
   <script>
      $(document).ready(function() {
         $('input[type="radio"],input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
         });

         $('.layanan').on('ifChecked', function(event) {
            //alert($(this).val()); // alert value
            var total = $('#total').val();
            var id = $(this).val();
            var nights = $('#nights').val();
            var adults = $('#adults').val();
            var symb = 'Rp.';
            if (id) {
               call_loader();
               $.ajax({
                  url: '<?= site_url('front/reservasi/add_service_price') ?>',
                  type: 'POST',
                  data: {
                     id: id,
                     total: total,
                     adults: adults,
                     nights: nights
                  },
                  success: function(result) {
                     if (result) {
                        remove_loader();
                        $('#total').val(result);
                        $('#grand_total').text('');
                        $('#grand_total').html(symb + '' + result);
                     }
                  }
               });
            }
         });

         $('.layanan').on('ifUnchecked', function(event) {
            //alert($(this).val()); // alert value
            var total = $('#total').val();
            var id = $(this).val();
            var nights = $('#nights').val();
            var adults = $('#adults').val();
            var symb = 'Rp.';

            if (id) {
               call_loader();
               $.ajax({
                  url: '<?= site_url('front/reservasi/less_service_price') ?>',
                  type: 'POST',
                  data: {
                     id: id,
                     total: total,
                     adults: adults,
                     nights: nights
                  },
                  success: function(result) {

                     if (result) {
                        remove_loader();
                        $('#total').val(result);
                        $('#grand_total').text('');
                        $('#grand_total').html(symb + '' + result);
                     }
                  }
               });
            }
         });
      });
   </script>
   <div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h2 class="bold">Login</h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" id="signinForm">
                  <div class="form-group">
                     <label for="">Email</label>
                     <input type="text" class="form-control" name="email" placeholder="Username" autocomplete='off'>
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete='off'>
                  </div>
                  <div class="form-group">
                     <div class="g-recaptcha form-group form-focus mb-5" data-sitekey="6Lfo1-8ZAAAAAKyuz2TwwzWpJkFhCUuqPDCN_NqI"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-block btn-danger shadow">Login</button>
                  </div>
                  <a href="<?= base_url('forgot') ?>">Lupa Password?</a>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script>
      jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
      jQuery('.quantity').each(function() {
         var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

         btnUp.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
               var newVal = oldValue;
            } else {
               var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
         });

         btnDown.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
               var newVal = oldValue;
            } else {
               var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
         });

      });
   </script>
   <script>
      $("#signinForm").submit(function(event) {
         event.preventDefault();
         var form = $(form).closest('form');
         call_loader();
         $.ajax({
            url: '<?= site_url('front/reservasi/login_') ?>',
            type: 'POST',
            data: $("#signinForm").serialize(),
            success: function(result) {
               //alert(result);return false;
               if (result == 1) {
                  toastr.success('Login Berhasil');
                  //location.reload(); 
                  window.location.reload()
               } else {
                  remove_loader();
                  toastr.error(result);
                  //$('#err').html(result);
               }
            }
         });
      });
   </script>
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