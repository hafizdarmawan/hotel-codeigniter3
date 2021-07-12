 <section class="contact_area mt-5">
    <div class="container">
       <div class="row">
          <div class="col-md-6">
             <div class="about-thumbnail pr-lg-5 mb-3" data-aos="fade-right" data-aos-delay="40">
                <img src="<?= base_url('assets/img/logo/') . $setting->image ?>" alt="">
             </div>
          </div>
          <div class="col-md-6 mb-4">
             <h3 class="text-justify mb-3">
                <?= $setting->nama ?>
             </h3>
             <div class="text-justify mb-3">
                <?= $setting->section_deskripsi ?>
             </div>
          </div>
       </div>
       <div class="container mt-4">
          <div class="row">
             <div class="col-12">
                <div class="section-heading text-center" data-aos="fade-up" data-aos-delay="60">
                   <h3>Tipe Kamar Yang Tersedia</h3>
                </div>
             </div>
          </div>
          <div class="row mt-3">
             <?php foreach ($tipe_kamar as $data) : ?>
                <?php $tipe_kamar_image = get_room_type_featured_image_medium($data->id_tipe_kamar); ?>
                <div class="col-12 col-md-6 col-lg-4 shadow">
                   <div class="single-service-area" data-aos="fade-up" data-aos-delay="60">
                      <img src="<?= $tipe_kamar_image ?>" alt="" class="img-fluid">
                      <div class="service-title d-flex align-items-center justify-content-center">
                         <a href="<?= base_url('rooms/') . $data->slug ?>">
                            <h5><?= $data->judul ?></h5>
                         </a>
                      </div>
                   </div>
                </div>
             <?php endforeach; ?>
          </div>
       </div>
       <div class="container mt-5 mb-4">
          <div class="row">
             <div class="col-12">
                <div class="section-heading text-center" data-aos="fade-up" data-aos-delay="60">
                   <h3>Lokasi Hotel <?= $setting->nama ?></h3>
                </div>
             </div>
          </div>
          <div class="row mt-2" data-aos="fade-up" data-aos-delay="60">
             <div class="col-md-12 shadow m-1">
                <?= $setting->map ?>
             </div>
          </div>
       </div>
    </div>
 </section>