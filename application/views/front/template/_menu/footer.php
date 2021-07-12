<footer class="footer">
   <!-- Footer Top -->
   <div class="footer-top">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-4">
               <h2 class="footer-title"><?= $setting->nama ?></h2>
               <!-- Footer Widget -->
               <div class="footer-widget footer-about">
                  <!-- <div class="footer-logo">
                     <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" style="width: 70px;" alt="<?= $setting->name ?>">
                  </div> -->
                  <div class="text-justify text-white">
                     <small><?= $setting->sort_section_deskripsi ?></small>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-2">
               <h2 class="footer-title">Menu Website</h2>
               <div class="row">
                  <div class="col-md-12">

                     <div class="footer-widget footer-menu">
                        <ul>
                           <li><a href="<?= base_url('') ?>"></i>Beranda</a>
                           </li>
                           <li><a href="<?= base_url('galleri') ?>"></i>Galleri</a>
                           </li>
                           <li><a href="<?= base_url('tentang') ?>"></i>Tentang Hotel</a></li>
                           <?php if ($this->session->userdata('id_tamu') == '') : ?>
                              <li><a href="<?= base_url('register') ?>"></i>Login/Daftar</a></li>
                           <?php endif ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-3">
               <h2 class="footer-title">Tipe Kamar Hotel</h2>
               <?php $tipe_kamar = get_tipe_kamar() ?>
               <div class="row">
                  <div class="col-md-12">
                     <div class="footer-widget footer-menu">
                        <ul>
                           <?php foreach ($tipe_kamar as $pag) : ?>
                              <li><a href="<?= base_url('rooms/') . $pag->slug ?>"></i><?= $pag->judul ?></a>
                              </li>
                           <?php endforeach ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-md-3">
               <!-- Footer Widget -->
               <div class="footer-widget footer-contact">
                  <h2 class="footer-title">Informasi Kontak</h2>
                  <div class="footer-contact-info">
                     <div class="footer-address">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <p><?= $setting->alamat ?></p>
                     </div>
                     <p>
                        <i class="fas fa-phone-alt"></i>
                        <?= $setting->no_telepon ?>
                     </p>
                     <p class="mb-0">
                        <i class="fas fa-envelope"></i>
                        <?= $setting->email ?>
                     </p>
                  </div>
               </div>
               <div class="footer-about-content mt-2">
                  <div class="social-icon">
                     <ul>
                        <li>
                           <a href="<?= $setting->facebook_link ?>" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                        </li>
                        <li>
                           <a href="<?= $setting->twitter_link ?>" target="_blank"><i class="fab fa-twitter"></i> </a>
                        </li>
                        <li>
                           <a href="<?= $setting->linkedin_link ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                           <a href="<?= $setting->instagram_link ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                           <a href="<?= $setting->google_plus_link ?>" target="_blank"><i class="fab fa-google-plus"></i> </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>

</div>
<div class="modal fade" id="ModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h2 class="bold">Logout</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <h6 class="">Yakin keluar?</h6>
         </div>
         <div class="modal-footer">
            <a href="<?= base_url('logout') ?>" class="btn btn-danger">Iya</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
         </div>
      </div>
   </div>
</div>
<!-- Slick JS -->
<script src="<?= base_url('assets/front/') ?>assets/js/slick.js"></script>
<!-- Custom JS -->
<script src="<?= base_url('assets/front/') ?>assets/js/script.js"></script>
<!-- 		< src="radison/js/jquery.min.js"></> -->
<!-- < src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></> -->
<!-- 		< src="radison/js/popper.js"></>
		< src="radison/js/bootstrap.min.js"></> -->
<script src="<?= base_url('assets/front/') ?>radison/js/stellar.js"></script>
<script src="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/lightbox/simpleLightbox.min.js"></script>
<?php if ($this->uri->segment(1) != 'profile') : ?>
   <script src="<?= base_url('assets/front/') ?>radison/vendors/nice-select/js/jquery.nice-select.min.js"></script>
<?php endif; ?>
<script src="<?= base_url('assets/front/') ?>radison/vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/owl-carousel-thumb.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/vendors/counter-up/jquery.counterup.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/mail-script.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/theme.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/aos.js"></script>
<script src="<?= base_url('assets/front/') ?>radison/js/main2.js"></script>
<!-- <script>
$(window).on('load', function() {
         $('#preloader-active').delay(450).fadeOut('slow');
         $('body').delay(450).css({
            'overflow': 'visible'
         });
      });
</script> -->

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