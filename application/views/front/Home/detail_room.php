 <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
 <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
 <div class="content">
    <div class="container">
       <!-- Doctor Widget -->
       <div class="" data-aos="fade-down" data-aos-delay="20">
          <div class="card-body">
             <div class="row">
                <div class="col-md-7">
                   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner mt-2">
                         <?php $i = 0; ?>
                         <?php foreach ($gambar as $row) : ?>
                            <?php if ($i == 0) { ?>
                               <div class="carousel-item active ">
                                  <div class="text-center">
                                     <a href="<?= base_url('assets/img/kamar/medium/') . $row->image; ?>" data-toggle="lightbox" data-title="<?= $img->judul ?>" data-gallery="gallery">
                                        <img class="img-responsive" style="width:100%;height:375px;" src="<?= base_url('assets/img/kamar/medium/') . $row->image; ?>" alt=" <?= $img->judul ?>">
                                     </a>
                                  </div>
                               </div>
                            <?php } else { ?>
                               <div class="carousel-item">
                                  <div class="text-center">
                                     <img class="img-responsive" style="width:100%;height:375px;" src="<?= base_url('assets/img/kamar/medium/') . $row->image; ?>" alt=" <?= $img->judul ?>">
                                  </div>
                               </div>
                            <?php }
                              $i++ ?>
                         <?php endforeach; ?>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                         <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                         <span class="carousel-control-next-icon" aria-hidden="true"></span>
                         <span class="sr-only">Next</span>
                      </a>
                   </div>
                </div>
                <div class="col-md-5">
                   <div class="text-center">
                      <h3 class="doc-name"><?= $tipe_kamar->judul ?></h3>
                      <?= $harga = ambil_harga_sekarang($tipe_kamar->id_tipe_kamar) ?>
                      <?php if ($tipe_kamar->tarif_dasar > $harga->price) : ?>
                         <strike>Rp <?= rupiah($tipe_kamar->tarif_dasar) ?></strike>
                         <b class="text-dark">Rp <?= rupiah($harga->price) ?></b>
                      <?php elseif (!empty($harga->price)) : ?>
                         <b class="text-dark">Rp <?= rupiah($harga->price) ?></b>
                      <?php else : ?>
                         Rp <?= rupiah($data->tarif_dasar) ?>
                      <?php endif ?>
                      <?php $tersedia = get_ketersediaan_hari_ini($tipe_kamar->id_tipe_kamar) ?>
                      <p class="">Hari Ini <strong class="text-danger"><?= $tersedia == 0 ? 'Kamar Penuh' : 'Tersedia ' . $tersedia . ' Kamar' ?></strong> </p>

                      <!-- <p style="font-weight: bold;">Harga Mulai : Rp.<?= rate_exchange($tipe_kamar->tarif_dasar) ?> / Malam</p> -->
                      <!-- <div class="rating">
                         <i class="fas fa-star filled"></i>
                         <i class="fas fa-star filled"></i>
                         <i class="fas fa-star filled"></i>
                         <i class="fas fa-star filled"></i>
                         <i class="fas fa-star"></i>
                         <span class="d-inline-block average-rating">(35)</span>
                      </div> -->
                      <div class="hotel-reservation--area mb-100 mt-5" style="position: relative;">
                         <!-- <form method="GET" action="<?= site_url('search/rooms') ?>"> -->
                         <form method="GET" action="<?= site_url('search/rooms') ?>" id="checkform">
                            <input type="hidden" id="id_tipe_kamar" name="tipe_kamar" value="<?= $tipe_kamar->id_tipe_kamar ?>" />
                            <input type="hidden" name="checked" value="" id="checked" />
                            <div class="form-group mb-30">
                               <label for="checkInDate">Tanggal Reservasi</label>
                               <div class="input-daterange" id="datepicker">
                                  <div class="row no-gutters">
                                     <div class="col-6">
                                        <input type="text" autocomplete='off' class="datepicker1 input-small form-control" id="checkIn" name="date_from" placeholder="Check In" value="<?= @$_GET['date_from'] ?>" required=" ">
                                     </div>
                                     <div class="col-6">
                                        <input type="text" autocomplete='off' class="datepicker2 input-small form-control" id="checkOut" name="date_to" placeholder="Check Out" value="<?= @$_GET['date_to'] ?>" required=" ">
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="form-group">
                               <label for="guests"></label>
                               <div class="row">
                                  <div class="col-12 col-md-12">
                                     <select name="jml_kamar" id="jml_kamar" class="form-control jml_kamar" required>
                                        <?php for ($i = 1; $i <= $tersedia; $i++) { ?>
                                           <option value="<?= $i ?>"><?= $i ?> Kamar</option>
                                        <?php } ?>
                                     </select>
                                  </div>
                               </div>
                            </div>
                            <div class="text-center">
                               <button type="submit" class="btn genric-btn danger shadow btn-block">
                                  Cek Ketersediaan
                               </button>
                            </div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-12 col-lg-9">
                   <h4 class="widget-title">Tentang Kamar</h4>
                   <div class="col-md-12">
                      <div class="text-justify">
                         <?= $tipe_kamar->deskripsi ?>
                      </div>
                   </div>
                   <div class="service-list mb-3">
                      <h4>Ketentuan</h4>
                      <ul class="clearfix">
                         <li>Maksimal Dewasa <?= $tipe_kamar->higher_occupancy ?> Orang</li>
                         <li>Pesanan ini tidak dapat dibatalkan.</li>
                      </ul>
                      <ul class="clearfix">
                         <li>Check-in : <?= $setting->waktu_check_in ?> WIB</li>
                         <li>Check-out : <?= $setting->waktu_check_out ?> WIB</li>
                      </ul>
                   </div>
                   <div class="service-list mb-3">
                      <h4>Fasilitas Kamar</h4>
                      <ul class="clearfix">
                         <?php foreach ($fasilitas as $fas) : ?>
                            <li> <img src="<?= base_url('assets/img/amenities/') . $fas->gambar ?>" alt="" style="width: 40px;"> <?= $fas->nama ?></li>
                         <?php endforeach ?>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- /Doctor Widget -->
       <section class="roberto-service-area">
          <div class="container">
             <div class="row">
                <div class="col-12">
                   <!-- Section Heading -->
                   <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                      <h2>Tipe Kamar yang Tersedia</h2>
                   </div>
                </div>
             </div>
             <div class="row mt-5">
                <?php foreach ($tipe_kamar_ as $data) : ?>
                   <?php $tipe_kamar_image = get_room_type_featured_image_medium($data->id_tipe_kamar); ?>
                   <div class="col-12 col-md-6 col-lg-4">
                      <div class="single-service-area mb-100 wow fadeInUp shadow" data-wow-delay="300ms">
                         <a href="<?= base_url('rooms/') . $data->slug ?>">
                            <img src="<?= $tipe_kamar_image ?>" alt="" class="img-fluid">
                            <div class="service-title d-flex align-items-center justify-content-center">
                               <h5><?= $data->judul ?></h5>
                            </div>
                         </a>

                      </div>
                   </div>
                <?php endforeach; ?>
             </div>
          </div>
       </section>

       <p id="jml_tersedia"></p>
       <!-- /Doctor Details Tab -->

    </div>
 </div>

 <script src="<?= base_url('assets/front/assets/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script>
    $(function() {
       $('.datepicker1').datepicker({
          //  dateFormat: 'yyyy-mm-dd',
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
          //  dateFormat: 'yyyy-mm-dd',
          format: 'yyyy-mm-dd',
          orientation: "bottom",
          startDate: new Date(),
       }).on('changeDate', function(selected) {
          //  var date1 = $(".datepicker1").datepicker('setDate');
          //  var date2 = $(".datepicker2").datepicker('setDate');
          var date_from = $(".datepicker1").val();
          var date_to = $(".datepicker2").val();
          if (date_to < date_from) {
             toastr.error('Check-out tidak diperbolehkan');
             $('.datepicker2').val('');
             $('.datepicker2').focus();
          } else {
             var id_tipe_kamar = $('#id_tipe_kamar').val();
             $.ajax({
                url: '<?= site_url('front/reservasi/ketersediaan') ?>',
                type: 'POST',
                data: {
                   date_from: date_from,
                   date_to: date_to,
                   id_tipe_kamar: id_tipe_kamar
                },
                cache: false,
                success: function(data) {
                   var $response = $(data);
                   var jml_tersedia = $response.filter('#jml_tersedia').html();
                }
             })
          }
       });


       $("#checkform").submit(function(event) {
          var checked = $("#checked").val();
          if (checked != 1) {
             event.preventDefault();
          }
          var form = $(form).closest('form');
          call_loader();
          $.ajax({
             url: '<?= site_url('frontend/check') ?>',
             type: 'POST',
             data: $("#checkform").serialize(),
             success: function(result) {
                //alert(result);return false;
                if (result == 1) {
                   if (checked != 1) {
                      toastr.success('Tersedia');
                   }
                   $("#checked").val(1);
                   $('#checkform').submit();
                   remove_loader();
                } else {
                   remove_loader();
                   toastr.error(result);
                   //$('#err').html(result);
                }
             }
          });
       });


    });
 </script>
 <script src="<?= base_url('assets/admin/') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
 <script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
       event.preventDefault();
       $(this).ekkoLightbox({
          alwaysShowClose: true
       });
    });
 </script>