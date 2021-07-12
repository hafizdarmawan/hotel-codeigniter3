<section class="contact_area section_gap">
   <div class="container">
      <div class="mb-2">
         <h3><?= $setting->nama ?></h3>
      </div>
      <div class="row">
         <div class="col-lg-3 mb-4">
            <div class="contact_info">
               <div class="info_item">
                  <i class="lnr lnr-home text-danger"></i>
                  <h7><?= $setting->alamat ?></h7><br>
               </div>
               <div class="info_item mt-2 mb-2">
                  <i class="lnr lnr-phone-handset text-danger"></i>
                  <h7><?= $setting->no_telepon ?></h7>
               </div>
               <div class="info_item">
                  <i class="lnr lnr-envelope text-danger"></i>
                  <h7><?= $setting->email ?></a></h7>
               </div>
            </div>
         </div>
         <div class="col-lg-9">
            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
               <div class="col-md-6">
                  <div class="form-group">
                     <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama">
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukan Subjek">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <textarea class="form-control" name="message" id="message" rows="1" placeholder="Masukan Pesan"></textarea>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button type="submit" value="submit" class="btn genric-btn danger arrows">Kirim</button>
               </div>
            </form>
         </div>
      </div>
      <div class="mt-5">
         <?= $setting->map ?>
      </div>

   </div>
</section>
<!-- Footer -->