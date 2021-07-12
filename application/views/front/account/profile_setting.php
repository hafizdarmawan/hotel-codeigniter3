<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
            <div class="profile-sidebar shadow">
               <div class="widget-profile pro-widget-content">
                  <div class="profile-info-widget">
                     <a href="#" class="booking-doc-img">
                        <?php if (!empty($tamu->image)) : ?>
                           <img src="<?= base_url('assets/img/guests/') . $tamu->image ?>" alt="<?= $tamu->nama_depan ?>">
                        <?php else : ?>
                           <img src="<?= base_url('assets/img/guests/guests.png') ?>" alt="User Image">
                        <?php endif; ?>
                     </a>
                     <div class="profile-det-info">
                        <h3><?= $tamu->nama_depan . ' ' . $tamu->nama_belakang ?></h3>
                        <div class="patient-details">
                           <h5><?= $tamu->email ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="dashboard-widget">
                  <nav class="dashboard-menu">
                     <ul>
                        <li <?= $this->uri->segment(1) == 'dashboard' ? 'class="active"' : '' ?>>
                           <a href="<?= base_url('dashboard') ?>">
                              <i class="fas fa-columns"></i>
                              <span>Dashboard</span>
                           </a>
                        </li>
                        <li <?= $this->uri->segment(1) == 'profile' ? 'class="active"' : '' ?>>
                           <a href="<?= base_url('profile/setting') ?>">
                              <i class="fas fa-user-cog"></i>
                              <span>Setting Profil</span>
                           </a>
                        </li>
                        <li>
                           <a href="#" data-toggle="modal" data-target="#ModalLogout">
                              <i class="fas fa-sign-out-alt"></i>
                              <span>Logout</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
         <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card shadow mb-5">
               <div class="card-body">
                  <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                     <li class="nav-item"><a class="nav-link shadow ml-2 active" href="#bottom-justified-tab1" data-toggle="tab">Data Pribadi <i class="fas fa-user"></i></a></li>
                     <li class="nav-item"><a class="nav-link shadow ml-2" href="#bottom-justified-tab2" data-toggle="tab">Password <i class="fas fa-lock"></i></a></li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane show active" id="bottom-justified-tab1">
                        <div class="">
                           <div class="card-body">
                              <form method="post" action="<?= base_url('profile/setting/aksi') ?>">
                                 <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                       <div class="form-group">
                                          <div class="change-avatar">
                                             <div class="upload-img">
                                                <div class="change-photo-btn shadow">
                                                   <span><i class="fa fa-upload"></i> Upload
                                                      Foto</span>
                                                   <?php $i = 0; ?>
                                                   <!-- <?php print_r($this->session->userdata('id_tamu')) ?> -->
                                                   <input type="file" class=" imgchange upload" id="<?= $this->session->userdata('id_tamu') ?>" name="image[]">
                                                </div>
                                                <small class=" form-text text-muted">JPG, GIF or
                                                   PNG. Maximal Ukuran
                                                   size of 2MB</small>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Nama Depan </label>
                                          <input type="hidden" name="id_tamu" value="<?= $this->session->userdata('id_tamu') ?>">
                                          <input type="text" class="form-control <?= form_error('nama_depan')  ? 'is-invalid' : "" ?>" placeholder="Nama Depan" name="nama_depan" value="<?= set_value('nama_depan', $tamu->nama_depan) ?>">
                                          <?= form_error('nama_depan', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Nama Belakang </label>
                                          <input type="text" placeholder="Nama Belakang" class="form-control <?= form_error('nama_belakang')  ? 'is-invalid' : "" ?>" name="nama_belakang" value="<?= set_value('nama_belakang', $tamu->nama_belakang) ?>">
                                          <?= form_error('nama_belakang', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Tempat Lahir </label>
                                          <input type="text" placeholder="Tempat Lahir" name="tempat_lahir" class="form-control <?= form_error('tempat_lahir')  ? 'is-invalid' : "" ?>" name="tempat_lahir" value="<?= set_value('tempat_lahir', $tamu->tempat_lahir) ?>">
                                          <?= form_error('tempat_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Tanggal Lahir </label>
                                          <input type="date" placeholder="Tanggal Lahir" class="form-control <?= form_error('tanggal_lahir')  ? 'is-invalid' : "" ?>" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $tamu->tanggal_lahir) ?>">
                                          <?= form_error('tanggal_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Jenis Kelamin </label>
                                          <select class="form-control wide <?= form_error('jenis_kelamin')  ? 'is-invalid' : "" ?>" name="jenis_kelamin">
                                             <option value="">Pilih Jenis Kelamin.....</option>
                                             <option value="<?= '1'; ?>" <?= set_select('jenis_kelamin', '1'); ?> <?= ($tamu->jenis_kelamin == '1') ? 'selected="selected"' : ''; ?>>Laki-laki</option>
                                             <option value="<?= '0'; ?>" <?= set_select('jenis_kelamin', '0'); ?> <?= ($tamu->jenis_kelamin == '0') ? 'selected="selected"' : ''; ?>>Perempuan</option>
                                          </select>
                                          <?= form_error('jenis_kelamin', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Email </label>
                                          <input type="email" placeholder="example@Email.com" class="form-control <?= form_error('email')  ? 'is-invalid' : "" ?>" name="email" value="<?= set_value('email', $tamu->email) ?>" readonly>
                                          <?= form_error('email', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>No Telepon </label>
                                          <input type="text" placeholder="+62" value="<?= set_value('no_telepon', $tamu->no_telepon) ?>" name="no_telepon" class="form-control <?= form_error('no_telepon')  ? 'is-invalid' : "" ?>">
                                          <?= form_error('no_telepon', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                       <div class="form-group">
                                          <label>Alamat </label>
                                          <textarea name="alamat" placeholder="Alamat" class="form-control <?= form_error('alamat')  ? 'is-invalid' : "" ?>" name="alamat" id="" cols="30" rows="5"><?= set_value('alamat', $tamu->alamat) ?></textarea>
                                          <?= form_error('alamat', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn shadow">Ubah Profile</button>
                                 </div>
                              </form>
                           </div>
                        </div>

                        <!-- /Profile Settings Form -->
                     </div>
                     <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-lg-6">
                                    <!-- Change Password Form -->
                                    <form method="post" action="<?= base_url('profile/setting_password/aksi') ?>">
                                       <div class="form-group">
                                          <label>Password Lama</label>
                                          <input type="password" class="form-control" name="old_password">
                                       </div>
                                       <div class="form-group">
                                          <label>Password Baru</label>
                                          <input type="password" class="form-control" name="password">
                                       </div>
                                       <div class="form-group">
                                          <label>Konfirmasi Password</label>
                                          <input type="password" class="form-control" name="konfirmasi_pass">
                                       </div>
                                       <div class="submit-section">
                                          <button type="submit" class="btn btn-primary submit-btn shadow">Ubah Password</button>
                                       </div>
                                    </form>
                                    <!-- /Change Password Form -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Page Content -->
<script>
   // function readURL(input, d) {
   //    if (input.files && input.files[0]) {
   //       var reader = new FileReader();
   //       reader.onload = function(e) {
   //          console.log(d);
   //          $(d).attr('src', e.target.result).width(100).height(80);
   //       };

   //       reader.readAsDataURL(input.files[0]);
   //       $(d).removeClass('hide');
   //    }
   // }
   $(document).on("change", ".imgchange", function(e) { //user click on remove text
      e.preventDefault();
      var id = event.target.id;
      var formData = new FormData($(this).parents('form')[0]);
      // alert(formData);return false;
      if (id) {
         call_loader();
         $.ajax({
            url: '<?php echo site_url('front/account/edit_image'); ?>/' + id,
            type: 'POST',
            xhr: function() {
               var myXhr = $.ajaxSettings.xhr();
               return myXhr;
            },
            success: function(data) {
               // alert("Data Uploaded: "+data);
               toastr.success('Berhasil mengubah foto');
               remove_loader();
               location.reload();
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
         });
      }
   });
</script>