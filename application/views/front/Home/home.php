     <!--================Home Banner Area =================-->
     <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
           <?php foreach ($banner as $data) : ?>
              <div class="single-welcome-slide bg-img bg-overlay img-fluid" style="background-image: url(<?= base_url('assets/img/banners/') . $data->gambar ?>);" data-img-url="<?= base_url('assets/img/banners/') . $data->gambar ?>">
                 <div class="welcome-content h-100">
                    <div class="container h-100">
                       <div class="row h-100 align-items-center">
                          <div class="col-12">
                             <div class="welcome-text text-center">
                                <h6 data-animation="fadeInDown" data-delay="200ms"><?= $data->judul ?></h6>
                                <h2 data-animation="fadeInDown" data-delay="500ms"><?= $data->deskripsi ?></h2>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           <?php endforeach; ?>
        </div>
     </section>
     <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
     <section class="roberto-about-area section-padding-100-0">
        <div class="hotel-search-form-area">
           <div class="container-fluid">
              <div class="hotel-search-form shadow">
                 <form action="<?= base_url('search/rooms') ?>" method="GET">
                    <div class="row justify-content-between align-items-end">
                       <div class="col-6 col-md-4 ">
                          <label for="checkIn">Check-In</label>
                          <input type="text" autocomplete='off' class="datepicker1 form-control" id="checkIn" name="date_from" value="<?= @$_GET['date_from'] ?>" required=" " placeholder="Check-in">
                       </div>
                       <div class="col-6 col-md-4">
                          <label for="checkOut">Check-Out</label>
                          <input type="text" autocomplete='off' class="datepicker2 form-control" id="checkOut" name="date_to" value="<?= @$_GET['date_to'] ?>" required=" " placeholder="Check-out">
                       </div>
                       <!-- <div class="col-6 col-md-2">
                          <label for="adults">Tamu</label>
                          <select name="adults" id="dewasa" class="form-control" required>
                             <?php for ($i = 1; $i <= 8; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?> Tamu</option>
                             <?php } ?>
                          </select>
                       </div> -->
                       <!-- <div class="col-6 col-md-3">
                          <label for="kamar">Kamar</label>
                          <select name="jml_kamar" id="jml_kamar" class="form-control jml_kamar" required>
                             <?php for ($i = 1; $i <= 4; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?> Kamar</option>
                             <?php } ?>
                          </select>
                       </div> -->
                       <div class="col-12 col-md-4">
                          <button type="submit" class="form-control btn genric-btn danger shadow">Cek Ketersediaan</button>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
        </div>
     </section>
     <section class="section" data-aos="fade-down" data-aos-delay="40">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-4">
                 <div class="section-header ">
                    <h3><?= $setting->section_judul ?></h3>
                 </div>
                 <div class="sub-title justify-content-center text-justify"><?= $setting->sort_section_deskripsi ?></div>
                 <a href="<?= base_url('tentang') ?>" class="genric-btn danger circle arrow mt-2 shadow">Lihat Selengkapnya</a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-8">
                 <div class="doctor-slider slider">
                    <?php foreach ($tipe_kamar as $data) : ?>
                       <?php $tipe_kamar_image = get_room_type_featured_image($data->id_tipe_kamar);
                        ?> ?>
                       <div class="profile-widget shadow">
                          <div class="doc-img">
                             <a href="<?= base_url('rooms/') . $data->slug ?>">
                                <img class="img-fluid" alt="User Image" src="<?= $tipe_kamar_image ?>">
                             </a>
                          </div>
                          <div class="pro-content text-center">
                             <h3 class="title">
                                <a href="<?= base_url('rooms/') . $data->slug ?>"> <b class="text-bold text-dark"><?= $data->judul ?></b></a>
                             </h3>
                             <h3 class="title">
                                <?php $tersedia = get_ketersediaan_hari_ini($data->id_tipe_kamar) ?>
                                <small class="">Hari Ini <strong class="text-danger"><?= $tersedia == 0 ? 'Kamar Penuh' : 'tersedia ' . $tersedia . ' kamar' ?></strong> </small>
                             </h3>
                             <!-- <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <span class="d-inline-block average-rating">(17)</span>
                             </div> -->
                             <ul class="available-info">
                                <li>
                                   <?= $harga = ambil_harga_sekarang($data->id_tipe_kamar) ?>
                                   <?php if ($data->tarif_dasar > $harga->price) : ?>
                                      <strike class="text-bold text-dark">Rp <?= rupiah($data->tarif_dasar) ?></strike>
                                      <b class="text-bold text-dark"> Rp <?= rupiah($harga->price) ?></b>
                                   <?php elseif (!empty($harga->price)) : ?>
                                      <b class="text-bold text-dark"> Rp <?= rupiah($harga->price) ?></b>
                                   <?php else : ?>
                                      <b class="text-bold text-dark"> Rp <?= rupiah($data->tarif_dasar) ?></b>
                                   <?php endif ?>
                                   <i class="fas fa-info-circle" data-toggle="tooltip" title="<?= $data->judul ?>"></i>
                                </li>
                             </ul>
                             <div class="row row-sm">
                                <div class="col-12">
                                   <a href="<?= site_url('rooms/' . $data->slug) ?>" class="btn view-btn shadow">Lihat Kamar</a>
                                </div>
                             </div>
                          </div>
                       </div>
                    <?php endforeach ?>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <?php if (!empty($fasilitas)) { ?>
        <section class="section section-specialities" data-aos="fade-up" data-aos-delay="60">
           <div class="container-fluid">
              <div class="section-header text-center">
                 <h3>Fasilitas & Layanan Hotel</h3>
                 <p class="sub-title"></p>
              </div>
              <div class="row justify-content-center">
                 <div class="col-md-9">
                    <div class="specialities-slider slider ">
                       <?php foreach ($fasilitas as $ame) : ?>
                          <div class="speicality-item text-center ">
                             <div class="speicality-img">
                                <img src="<?= base_url('assets/img/amenities/') . $ame->gambar ?>" class="img-fluid " style="width: 80px;" alt="<?= $ame->nama ?>">
                             </div>
                             <p><?= $ame->nama ?></p>
                          </div>
                       <?php endforeach ?>
                    </div>
                 </div>
              </div>
           </div>
        </section>
     <?php } ?>
     <?php if (!empty($voucher)) { ?>
        <section class="roberto-testimonials-area mt-4 mb-5" data-aos="fade-up" data-aos-delay="60">
           <div class="container">
              <div class="text-center">
                 <h3>Promo Hotel</h3>
                 <!-- <p class="sub-title">Anda selalu bisa berhemat dengan reservasi disini. Lihat semua promo yang sedang berlangsung hari ini</p> -->
              </div>
              <div class="row align-items-center mt-5">
                 <div class="col-12 col-md-6">
                    <div class="testimonial-thumbnail owl-carousel">
                       <?php foreach ($voucher as $cp) { ?>
                          <img src="<?= base_url('assets/img/coupons/medium/' . $cp->gambar) ?>" alt="Image" style="height: 300px;">
                       <?php } ?>
                    </div>
                 </div>
                 <div class="col-12 col-md-6 mt-2">
                    <div class="testimonial-slides owl-carousel">
                       <?php foreach ($voucher as $cp) { ?>
                          <div class="single-testimonial-slide">
                             <h4><?= $cp->judul ?></h4>
                             <p><?= $cp->deskripsi ?></p>
                             <p class="sub-title">Berlaku: <?= tgl_indo($cp->date_from) ?> sampai dengan <?= tgl_indo($cp->date_to) ?></p>
                             <p class="sub-title">Voucher: <?php if ($cp->tipe == 'Tetap') : ?>
                                   Rp <?= rupiah($cp->nilai) ?>
                                <?php else : ?>
                                   % <?= $cp->nilai ?>
                                <?php endif ?></p>
                             <p class="btn btn-secondary">Kode Voucher : <strong style="color: #800000;"><?= $cp->kode ?></strong></p>
                          </div>
                       <?php } ?>
                    </div>
                 </div>
              </div>
           </div>
        </section>
     <?php } ?>
     <!-- <script>
        setTimeout(function() {
           window.location.href = window.location.href;
        }, 5000);
     </script> -->
     <script src="<?= base_url('assets/front/assets/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
     <script>
        $(function() {
           $('.datepicker1').datepicker({
              todayHighlight: true,
              autoclose: true,
              format: 'yyyy-mm-dd',
              orientation: "bottom",
              startDate: new Date(),
              // endDate : new Date('2014-08-08'),
           }).on('changeDate', function(selected) {
              $('.datepicker2').focus();
           });;
           $('.datepicker2').datepicker({
              todayHighlight: true,
              autoclose: true,
              format: 'yyyy-mm-dd',
              orientation: "bottom",
              startDate: new Date(),
           }).on('changeDate', function(selected) {
              var date1 = $(".datepicker1").datepicker('getDate');
              var date2 = $(".datepicker2").datepicker('getDate');
              if (date2 < date1) {
                 toastr.error('Tanggal Check Out Tidak diperbolehkan');
                 $('.datepicker2').val('');
                 $('.datepicker2').focus();
              }
           });
        });

        $(document).ready(function() {
           $("#jml_kamar").on("change", function() {
              var dewasa = $("#dewasa").val();
              var jml_kamar = $(this).val();
              if (jml_kamar > dewasa) {
                 toastr.error('Jumlah Kamar Tidak Boleh Lebih Dari Tamu Dewasa');
                 $('.jml_kamar').val('');
                 $('.jml_kamar').focus();
              }
           });
        });
     </script>