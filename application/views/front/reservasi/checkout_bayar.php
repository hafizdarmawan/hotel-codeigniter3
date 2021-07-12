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
      <!-- /Header -->

      <!-- Breadcrumb -->
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
                  <h2 class="breadcrumb-title">Review Pemesanan</h2>
               </div>
            </div>
         </div>
      </div>
      <!-- /Breadcrumb -->

      <!-- Page Content -->
      <div class="content">
         <div class="container">

            <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-7 col-lg-8">
                  <div class="card">
                     <div class="card-body">

                        <!-- Checkout Form -->
                        <form action="https://dreamguys.co.in/demo/doccure/booking-success.html">
                           <!-- Personal Information -->
                           <div class="info-widget">
                              <h4 class="card-title">Pembayaran</h4>
                              <div class="invoice-item">
                                 <div class="col-md-12">
                                    <div class="row mt-3">
                                       <div class="col-md-6">
                                          <div class="invoice-info">
                                             <table>
                                                <tr>
                                                   <th>Check In</th>
                                                   <td>:</td>
                                                   <td>16/01/2021</td>
                                                </tr>
                                                <tr>
                                                   <th>Check Out</th>
                                                   <td>:</td>
                                                   <td>16/01/2021</td>
                                                </tr>
                                                <tr>
                                                   <th>Durasi</th>
                                                   <td>:</td>
                                                   <td>1 Malam</td>
                                                </tr>
                                                <tr>
                                                   <th>Tipe Kamar</th>
                                                   <td>:</td>
                                                   <td>Superior Room</td>
                                                </tr>
                                                <tr>
                                                   <th>Nama</th>
                                                   <td>:</td>
                                                   <td>Hafiz Darmawan</td>
                                                </tr>
                                                <tr>
                                                   <th>Email</th>
                                                   <td>:</td>
                                                   <td>Hafiz Darmawan</td>
                                                </tr>
                                                <tr>
                                                   <th>No Telepon</th>
                                                   <td>:</td>
                                                   <td>Hafiz Darmawan</td>
                                                </tr>
                                                <tr>
                                                   <th>Total Biaya</th>
                                                   <td>:</td>
                                                   <td>Rp.500.000</td>
                                                </tr>
                                             </table>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="submit-section mt-4">
                                             <a href="<?= base_url('backend/coba/review') ?>" class="btn btn-primary btn-block submit-btn">Bayar Sekarang</a>
                                          </div>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <!-- /Checkout Form -->

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

               <!-- Copyright -->
               <div class="copyright">
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                           <p class="mb-0"><a href="templateshub.net">Al Ashri Inn by Urban</a></p>
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