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
      width: 150px;
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
      width: 70px;
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
<section class="roberto-blog-area mt-3">
   <div class="container">
      <div class="row">
         <?php foreach ($tipe_kamar as $tk) : ?>
            <?php $tipe_kamar_image = get_room_type_featured_image_medium($tk->id_tipe_kamar);
            $fasilitas   =   $this->reservation_model->get_amenities($tk->id_tipe_kamar);
            ?>
            <!-- Single Post Area -->
            <div class="col-12 col-md-4 shadow mb-5">
               <div class="single-post-area mb-5 wow fadeInUp" data-wow-delay="300ms">
                  <form method="get" action="<?= site_url('search/rooms') ?>">
                     <input type="hidden" name="date_from" value="<?= @$_GET['date_from'] ?>" />
                     <input type="hidden" name="date_to" value="<?= @$_GET['date_to'] ?>" />
                     <!-- <input type="hidden" name="adults" value="<?= @$_GET['adults'] ?>" />
                     <input type="hidden" name="kids" value="<?= @$_GET['kids'] ?>" /> -->
                     <!-- <input type="hidden" name="jml_kamar" id="" value="<?= @$_GET['jml_kamar'] ?>"> -->
                     <!-- <strong>Check In :<?= @$_GET['date_from'] ?>, Check Out <?= @$_GET['date_to'] ?></strong> <br> -->
                     <input type="hidden" name="tipe_kamar" value="<?= $tk->id_tipe_kamar ?>" />
                     <img src="<?= $tipe_kamar_image ?>" alt="" class="img-fluid mt-1" />
                     <h3 class="text-center"><a href="<?= site_url('rooms/' . $tk->slug) ?>"><?= $tk->judul ?></a></h3>
                     <?php $tersedia = get_ketersediaan(@$_GET['date_from'], @$_GET['date_to'], $tk->id_tipe_kamar) ?>
                     <div class="text-center">
                        <strong class="text-center"><?php $harga = ambil_harga_dari($tk->id_tipe_kamar, @$_GET['date_from'], @$_GET['date_to']) ?>
                           Hari ini: Rp <?= rupiah($harga->price) ?>/ <span class="text-danger"> <?= $tersedia == 0 ? 'Kamar Penuh' : 'Tersedia ' . $tersedia . ' kamar' ?></span></strong>
                     </div>
                     <p><?= substr($tk->deskripsi, 0, 150) ?></p>
                     <div class="row mb-2">
                        <div class="col-md-7 col-7">
                           <ul class="items list-inline">
                              <?php foreach ($fasilitas as $am) : ?>
                                 <li style="float: left;padding: 5px;"><img src="<?= base_url('assets/img/amenities/' . $am->gambar) ?>" class="img-responsive gray shadow" width="25" title="<?= $am->nama ?>" data-toggle="tooltip" /></li>
                              <?php endforeach; ?>
                           </ul>
                        </div>
                        <div class="col-md-5 col-5">
                           <ul class="items list-inline">
                              <li style="float: left;"><span>Maks <?= $tk->higher_occupancy ?> Orang</span></li>
                           </ul>
                        </div>
                     </div>
                     <div class="keywords">
                        <div class="row">
                           <div class="col-md-5 col-5">
                              <!-- <label class="label" for="number1">Number:</label> -->
                              <div class="quantity">
                                 <input type="number" name="jml_kamar" class="form-control shadow" min="1" max="<?= $tersedia ?>" step="1" value="1">
                              </div>
                              <!-- <select name="jml_kamar" id="" class="">
                                 <?php for ($i = 0; $i <= $tersedia; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?> Kamar</option>
                                 <?php endfor ?>
                              </select> -->
                           </div>
                           <div class="col-md-7 col-7">
                              <button type="submit" class="btn btn-block genric-btn danger shadow-lg " onclick="this.form.submit">
                                 Pesan Sekarang
                              </button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         <?php endforeach ?>
      </div>
   </div>
</section>

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