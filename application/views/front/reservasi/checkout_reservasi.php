<!DOCTYPE html>
<html lang="en">

<!-- doccure/checkout.html  30 Nov 2019 04:12:16 GMT -->

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets2/css/bootstrap.min.css">

   <!-- Fontawesome CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets2/plugins/fontawesome/css/fontawesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets2/plugins/fontawesome/css/all.min.css">

   <!-- Main CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/front/') ?>assets2/css/style.css">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

</head>

<body>

   <!-- Main Wrapper -->
   <div class="main-wrapper">

      <!-- Header -->
      <header class="header">
         <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
               <a href="index-2.html" class="navbar-brand logo">
                  <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
               </a>
            </div>
            <!-- <div class="main-menu-wrapper">
               <div class="menu-header">
                  <a href="index-2.html" class="menu-logo">
                     <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                  </a>
                  <a id="menu_close" class="menu-close" href="javascript:void(0);">
                     <i class="fas fa-times"></i>
                  </a>
               </div>
               
            </div> -->
         </nav>
      </header>
      <div class="breadcrumb-bar">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-md-12 col-12">
                  <nav aria-label="breadcrumb" class="page-breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                     </ol>
                  </nav>
                  <h2 class="breadcrumb-title">Data Pemesan</h2>
               </div>
            </div>
         </div>
      </div>
      <!-- /Breadcrumb -->

      <!-- Page Content -->
      <div class="content">
         <div class="container">

            <div class="row">
               <div class="col-md-7 col-lg-8">
                  <div class="card">
                     <div class="card-body">
                        <div class="card-body">
                           <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                              <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1" data-toggle="tab">
                                    <p style="font-weight: bold;">Booking Overview</p>
                                 </a></li>
                              <!-- <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2" data-toggle="tab">
                                    <p style="font-weight: bold;">Reschedule </p>
                                 </a></li> -->
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane show active" id="bottom-justified-tab1">
                                 <form action="https://dreamguys.co.in/demo/doccure/booking-success.html">
                                    <div class="info-widget">
                                       <h4 class="card-title">Data Pemesan</h4>
                                       <div class="row">
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Nama Depan</label>
                                                <input class="form-control" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Nama Belakang</label>
                                                <input class="form-control" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>Email</label>
                                                <input class="form-control" type="email">
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="form-group card-label">
                                                <label>No Telepon</label>
                                                <input class="form-control" type="text">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Detail Biaya</a>
                                    <div class="row">
                                       <div class="col">
                                          <div class="collapse multi-collapse" id="multiCollapseExample1">
                                             <div class="invoice-item invoice-table-wrap">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="table-responsive">
                                                         <table class="invoice-table table table-bordered">
                                                            <thead>
                                                               <tr>
                                                                  <th>Description</th>
                                                                  <th class="text-center">Quantity</th>
                                                                  <th class="text-center">VAT</th>
                                                                  <th class="text-right">Total</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>
                                                               <tr>
                                                                  <td>General Consultation</td>
                                                                  <td class="text-center">1</td>
                                                                  <td class="text-center">$0</td>
                                                                  <td class="text-right">$100</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>Video Call Booking</td>
                                                                  <td class="text-center">1</td>
                                                                  <td class="text-center">$0</td>
                                                                  <td class="text-right">$250</td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 col-xl-4 ml-auto">
                                                      <div class="table-responsive">
                                                         <table class="invoice-table-two table">
                                                            <tbody>
                                                               <tr>
                                                                  <th>Subtotal:</th>
                                                                  <td><span>$350</span></td>
                                                               </tr>
                                                               <tr>
                                                                  <th>Discount:</th>
                                                                  <td><span>-10%</span></td>
                                                               </tr>
                                                               <tr>
                                                                  <th>Total Amount:</th>
                                                                  <td><span>$315</span></td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                                                </div>
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
                                                         <th class="text-right">Total</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>Pemesanan Kamar</td>
                                                         <td class="text-right">Rp.300.000</td>
                                                      </tr>
                                                      <tr>
                                                         <td>Layanan</td>
                                                         <td class="text-right">Rp.20.000</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-xl-4 ml-auto">
                                             <table class="invoice-table-two table">
                                                <tbody>
                                                   <tr>
                                                      <th>Subtotal:</th>
                                                      <td><span>Rp.320.000</span></td>
                                                   </tr>
                                                   <tr>
                                                      <th>Total Bayar:</th>
                                                      <td><span>Rp.320.000</span></td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /Personal Information -->

                                    <div class="payment-widget">
                                       <!-- Submit Section -->
                                       <div class="submit-section mt-4">
                                          <!-- <button type="submit" class="btn btn-primary submit-btn">Lanjutkan Pemesanan</button> -->
                                          <a href="<?= base_url('backend/coba/review') ?>" class="btn btn-primary submit-btn">Lanjutkan Pemesanan</a>
                                       </div>
                                       <!-- /Submit Section -->

                                    </div>
                                 </form>
                              </div>
                              <div class="tab-pane" id="bottom-justified-tab2">
                                 <form action="<?= base_url('search/rooms') ?>" method="get">
                                    <div class="row justify-content-between align-items-end">
                                       <div class="col-md-6 col-sm-3 ">
                                          <label for="checkIn">Check In</label>
                                          <input type="text" class="datepicker1 form-control" id="checkIn" name="date_from" value="<?= @$_GET['date_from'] ?>" required=" " placeholder="Check-in">
                                       </div>
                                       <div class="col-md-6 col-sm-3">
                                          <label for="checkOut">Check Out</label>
                                          <input type="text" class="datepicker2 form-control" id="checkOut" name="date_to" value="<?= @$_GET['date_to'] ?>" required=" " placeholder="Check-out">
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 col-sm-6">
                                          <label for="adults">Dewasa</label>
                                          <select name="adults" id="country2" class="form-control wide">
                                             <option value="1" <?= (@$_GET['adults'] == 1) ? 'selected="selected"' : ''; ?>>1</option>
                                             <option value="2" <?= (@$_GET['adults'] == 2) ? 'selected="selected"' : ''; ?>>2</option>
                                             <option value="3" <?= (@$_GET['adults'] == 3) ? 'selected="selected"' : ''; ?>>3</option>
                                             <option value="4" <?= (@$_GET['adults'] == 4) ? 'selected="selected"' : ''; ?>>4</option>
                                             <option value="5" <?= (@$_GET['adults'] == 5) ? 'selected="selected"' : ''; ?>>5</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 col-sm-6">
                                          <label for="children">Anak-anak</label>
                                          <select name="kids" id="country3" class="form-control wide">
                                             <option value="0" <?= (@$_GET['kids'] == 0) ? 'selected="selected"' : ''; ?>>0</option>
                                             <option value="1" <?= (@$_GET['kids'] == 1) ? 'selected="selected"' : ''; ?>>1</option>
                                             <option value="2" <?= (@$_GET['kids'] == 2) ? 'selected="selected"' : ''; ?>>2</option>
                                             <option value="3" <?= (@$_GET['kids'] == 3) ? 'selected="selected"' : ''; ?>>3</option>
                                             <option value="4" <?= (@$_GET['kids'] == 4) ? 'selected="selected"' : ''; ?>>4</option>
                                             <option value="5" <?= (@$_GET['kids'] == 5) ? 'selected="selected"' : ''; ?>>5</option>
                                          </select>
                                       </div>
                                       <input type="hidden" name="tipe_kamar" value="<?php echo @$_GET['tipe_kamar'] ?>" <div class="col-md-12 mt-2">
                                    </div>
                                    <div class="text-center mt-3">
                                       <button type="submit" class="btn btn-primary submit-btn btn-block">Pencarian</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>

               </div>

               <div class="col-md-5 col-lg-4 theiaStickySidebar">

                  <!-- Booking Summary -->
                  <div class="card booking-card">
                     <div class="card-header">
                        <h4 class="card-title">Ringkasan Pemesanan</h4>
                     </div>
                     <div class="card-body">

                        <!-- Booking Doctor Info -->
                        <div class="booking-doc-info">
                           <a href="doctor-profile.html" class="booking-doc-img">
                              <img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
                           </a>
                           <div class="booking-info">
                              <h4><a href="doctor-profile.html">Superior Room</a></h4>
                              <div class="rating">
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star filled"></i>
                                 <i class="fas fa-star"></i>
                                 <span class="d-inline-block average-rating">35</span>
                              </div>
                           </div>
                        </div>
                        <!-- Booking Doctor Info -->

                        <div class="booking-summary">
                           <div class="booking-item-wrap">
                              <ul class="booking-date">
                                 <li>Dari <span>16 Nov 2019</span></li>
                                 <li>Sampai <span>16 Nov 2019</span></li>
                                 <li>Durasi <span>1 Malam</span></li>
                                 <li>Check-in <span>Min-14.00 WIB</span></li>
                                 <li>Check-out <span>Max- 12.00 WIB</span></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /Booking Summary -->

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

               <!-- Copyright -->
               <div class="copyright">
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                           <p class="mb-0" class="text-white">>Al Ashri Inn by Urban</p>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6">

                        <!-- Copyright Menu -->
                        <div class="copyright-menu">
                           <ul class="policy-menu">
                              <li><a href="term-condition.html">Terms and Conditions</a></li>
                              <li><a href="privacy-policy.html">Policy</a></li>
                           </ul>
                        </div>
                        <!-- /Copyright Menu -->

                     </div>
                  </div>
               </div>
               <!-- /Copyright -->

            </div>
         </div>
         <!-- /Footer Bottom -->

      </footer>
      <!-- /Footer -->

   </div>
   <!-- /Main Wrapper -->

   <!-- jQuery -->
   <script src="<?= base_url('assets/front/') ?>assets2/js/jquery.min.js"></script>

   <!-- Bootstrap Core JS -->
   <script src="<?= base_url('assets/front/') ?>assets2/js/popper.min.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets2/js/bootstrap.min.js"></script>

   <!-- Sticky Sidebar JS -->
   <script src="<?= base_url('assets/front/') ?>assets2/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
   <script src="<?= base_url('assets/front/') ?>assets2/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

   <!-- Custom JS -->
   <script src="<?= base_url('assets/front/') ?>assets2/js/script.js"></script>

</body>

<!-- doccure/checkout.html  30 Nov 2019 04:12:16 GMT -->

</html>