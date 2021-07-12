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
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets/css2/style.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>radison/css/style.css">
</head>

<body onload="bayar()">
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
                  <h2 class="breadcrumb-title">Pembayaran</h2>
               </div>
            </div>
         </div>
      </div>
      <!-- Page Content -->
      <div class="content">
         <div class="container">
            <form id="payment-form" method="post" action="<?= site_url() ?>midtrans/snap/finish">
               <div class="row">
                  <div class="col-md-7 col-lg-8">
                     <div class="card">
                        <div class="card-body">
                           <div class="card-body">
                              <!-- Personal Information -->
                              <div class="info-widget">
                                 <h4 class="card-title">Data Pemesan</h4>
                                 <div class="invoice-item">
                                    <div class="row mt-3">
                                       <div class="col-md-2">
                                          <?php $tipe_kamar_image = get_room_type_featured_image_medium($booking_data['id_tipe_kamar']); ?>
                                          <img src="<?= $tipe_kamar_image ?>" style="width: 100px;" alt="User Image">
                                       </div>
                                       <div class="col-md-10">
                                          <input type="hidden" name="result_type" id="result-type" value="">
                                          <input type="hidden" name="result_data" id="result-data" value="">
                                          <?php $pemesan = get_tamu($booking_data['id_tamu']) ?>
                                          <?php $nama = $pemesan->nama_depan . ' ' . $pemesan->nama_belakang ?>
                                          <input type="hidden" name="no_order" id="no_order" value="<?= $booking_data['no_order'] ?>">
                                          <input type="hidden" name="id_order" id="id_order" value="<?= $booking_data['id_order'] ?>">
                                          <input type="hidden" name="id_tamu" id="id_tamu" value="<?= $booking_data['id_tamu'] ?>">
                                          <input type="hidden" name="no_telepon" id="no_telepon" value="<?= $pemesan->no_telepon ?>">
                                          <input type="hidden" name="nama" id="nama" value="<?= $nama ?>">
                                          <input type="hidden" name="email" id="email" value="<?= $pemesan->email ?>">
                                          <input type="hidden" name="tipe_kamar" id="tipe_kamar" value="<?= $booking_data['tipe_kamar'] ?>">
                                          <input type="hidden" name="durasi" id="durasi" value="<?= $booking_data['malam'] ?>">
                                          <input type="hidden" name="jml_kamar" id="jml_kamar" value="<?= $booking_data['jml_kamar'] ?>">
                                          <input type="hidden" name="total_biaya" id="total_biaya" value="<?= $booking_data['total_jumlah'] ?>">
                                          <?php $pemesan = get_tamu($booking_data['id_tamu']);
                                          $nama = $pemesan->nama_depan . $pemesan->nama_belakang
                                          ?>
                                          <div class="row">
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info">
                                                   <strong class="customer-text">Check In</strong>
                                                   <p class="invoice-details invoice-details-two">
                                                      <!-- Check-in <br> -->
                                                      <?= tgl_indo($booking_data['check_in']) ?><br>
                                                      Dari <?= date('H:i', strtotime($setting->waktu_check_in)); ?> WIB <br>
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info invoice-info2">
                                                   <strong class="customer-text">Check Out</strong>
                                                   <p class="invoice-details">
                                                      <?= tgl_indo($booking_data['check_out'])  ?><br>
                                                      Sampai <?= date('H:i', strtotime($setting->waktu_check_out)); ?> WIB<br>
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="col-md-4 col-4">
                                                <div class="invoice-info invoice-info2">
                                                   <strong class="customer-text">Durasi</strong>
                                                   <p class="invoice-details">
                                                      <?= $booking_data['malam'] ?> Malam <br>
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
                                                   <strong class="customer-text">Detail Pemesanan</strong>
                                                   <table>
                                                      <th>
                                                         <tr>
                                                            <td>Tipe Kamar</td>
                                                            <td>:</td>
                                                            <td><?= $booking_data['tipe_kamar'] ?></td>
                                                         </tr>
                                                      </th>
                                                      <tr>
                                                         <td>Dewasa</td>
                                                         <td>:</td>
                                                         <td><?= $booking_data['dewasa'] ?> Orang</td>
                                                      </tr>
                                                      </th>
                                                      <th>
                                                         <tr>
                                                            <td>Jumlah Kamar</td>
                                                            <td>:</td>
                                                            <td><?= $booking_data['jml_kamar'] ?> Kamar</td>
                                                         </tr>
                                                      </th>
                                                      <th>
                                                         <?php if (!empty($booking['layanan'])) : ?>
                                                            <?php foreach ($booking['layanan'] as $data_layanan) : ?>
                                                               <?php $nama_layanan =  get_layanan_by_id($data_layanan) ?>
                                                               <?= '(' . $booking['adults'] . ')' . $nama_layanan->judul . ',' ?>
                                                            <?php endforeach ?>
                                                         <?php endif ?>
                                                      </th>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                          <hr>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-8 col-xl-6 ml-auto">
                                       <div class="table-responsive">
                                          <table class="invoice-table-two table">
                                             <tbody>
                                                <tr>
                                                   <th>Total Bayar:</th>
                                                   <!-- <?php print_r($booking_data) ?> -->
                                                   <td><span>Rp <?= rupiah($booking_data['total_jumlah']) ?></span></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="submit-section mt-4">
                                    <input type="button" onclick="bayar()" name="pay" value="Bayar Sekarang" class="btn btn-primary submit-btn" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5 col-lg-4 theiaStickySidebar">
                     <!-- Booking Summary -->
                     <!-- Booking Summary -->
                     <div class="card booking-card">
                        <div class="card-header">
                           <h4 class="card-title">Ringkasan Pemesanan</h4>
                        </div>
                        <div class="card-body">
                           <div class="booking-doc-info">
                              <div class="booking-info">
                                 Reservasi ini tidak dapat dibatalkan.
                              </div>
                           </div>
                           <div class="submit-section mt-4">
                              <input type="button" name="pay" onclick="bayar()" value="Bayar Sekarang" class="btn btn-primary submit-btn btn-block" />
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
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
   <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
   <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
   <script type="text/javascript">
      function bayar() {
         var nama = $('#nama').val();
         var email = $('#email').val();
         var no_telepon = $('#no_telepon').val();
         var no_order = $('#no_order').val();
         var id_order = $('#id_order').val();
         var id_tamu = $('#id_tamu').val();
         var tipe_kamar = $('#tipe_kamar').val();
         var durasi = $('#durasi').val();
         var jml_kamar = $('#jml_kamar').val();
         var total_biaya = $('#total_biaya').val();
         $.ajax({
            type: 'POST',
            url: '<?= site_url() ?>midtrans/snap/token',
            data: {
               nama: nama,
               email: email,
               no_telepon: no_telepon,
               no_order: no_order,
               id_order: id_order,
               id_tamu: id_tamu,
               tipe_kamar: tipe_kamar,
               durasi: durasi,
               jml_kamar: jml_kamar,
               total_biaya: total_biaya
            },
            cache: false,
            success: function(data) {
               //location = data;
               console.log('token = ' + data);
               var resultType = document.getElementById('result-type');
               var resultData = document.getElementById('result-data');

               function changeResult(type, data) {
                  $("#result-type").val(type);
                  $("#result-data").val(JSON.stringify(data));
                  //resultType.innerHTML = type;
                  //resultData.innerHTML = JSON.stringify(data);
               }

               snap.pay(data, {
                  onSuccess: function(result) {
                     changeResult('success', result);
                     console.log(result.status_message);
                     console.log(result);
                     $("#payment-form").submit();
                  },
                  onPending: function(result) {
                     changeResult('pending', result);
                     console.log(result.status_message);
                     $("#payment-form").submit();
                  },
                  onError: function(result) {
                     changeResult('error', result);
                     console.log(result.status_message);
                     $("#payment-form").submit();
                  }
               });
            }
         });
      }
      // $('#pay-button').click(function(event) {
      //    event.preventDefault();
      //    $(this).attr("disabled", "disabled");
      // });
   </script>
</body>

</html>