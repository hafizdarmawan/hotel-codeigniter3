  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
  <section id="portfolio">
     <div class="container">
        <div class="row">
           <div class="col-md-12 col-sm-12">
              <!-- iso section -->
              <div class="iso-section wow fadeInUp" data-aos="fade-down" data-aos-delay="10">
                 <ul class="filter-wrapper clearfix mb-2">
                    <li><a href="#" data-filter="*" class="selected opc-main-bg shadow text-bold">All</a></li>
                    <?php foreach ($gallery as $galler) : ?>
                       <li><a href="#" class="opc-main-bg shadow ml-2" data-filter=".<?= $galler->id_galleri ?>"><?= $galler->judul ?></a></li>
                    <?php endforeach ?>
                 </ul>
                 <!-- iso box section -->
                 <div class="iso-box-section wow fadeInUp" data-aos="fade-up" data-aos-delay="20">
                    <div class="iso-box-wrapper col4-iso-box">
                       <?php foreach ($images as $img) : ?>
                          <div class="iso-box <?= $img->id_galleri ?> branding col-md-3 col-sm-4">
                             <div class="portfolio-thumb">
                                <img src="<?= base_url('assets/img/gallery/medium/') . $img->gambar ?>" class="img-fluid mb-2" alt="<?= $img->caption ?>" />
                                <div class="portfolio-overlay">
                                   <div class="portfolio-item">
                                      <a href="<?= base_url('assets/img/gallery/medium/') . $img->gambar ?>" data-toggle="lightbox" data-title="<?= $img->caption ?>" data-gallery="gallery">
                                         <i class="fa fa-link"></i>
                                      </a>
                                      <!-- <a href="radison/img/rooms/room-1.jpg" class="item-wrap fancybox" data-fancybox="gallery2"><i class="fa fa-link"></i></a>
                                      <h2><?= $img->caption ?></h2> -->
                                   </div>
                                </div>
                             </div>
                          </div>
                       <?php endforeach ?>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>

  <!-- Footer -->
  <script src="<?= base_url('assets/admin/') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <script type="text/javascript">
     $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
           alwaysShowClose: true
        });
     });
  </script>