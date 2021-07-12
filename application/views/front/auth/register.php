<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
   .error {
      color: red;
   }
</style>

<body style="background-color: white">
   <div class="content">
      <div class="container-fluid">
         <div class="row mb-5">
            <div class="col-md-8 offset-md-2">
               <div class="account-content">
                  <div class="row align-items-center justify-content-center">
                     <div class="col-md-7 col-lg-6 login-left">
                        <img src="<?= base_url('assets/img/only/register.jpg') ?>" class="img-fluid" alt="Doccure Register">
                     </div>
                     <div class="col-md-12 col-lg-6 login-right shadow">
                        <div class="login-header">
                           <h3 class="text-uppercase">Pendaftaran</h3>
                        </div>
                        <form action="<?= base_url('register/aksi') ?>" method="post">
                           <div class="form-group form-focus">
                              <input type="text" autocomplete="off" class="form-control floating <?= form_error('nama_depan')  ? 'is-invalid' : "" ?>" name="nama_depan" value="<?= set_value('nama_depan') ?>">
                              <label class="focus-label">Nama Depan</label>
                              <!-- <?= form_error('nama_depan', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>
                           <div class="form-group form-focus">
                              <input type="text" autocomplete="off" class="form-control floating <?= form_error('nama_belakang')  ? 'is-invalid' : "" ?>" name="nama_belakang" value="<?= set_value('nama_belakang') ?>">
                              <label class="focus-label">Nama Belakang</label>
                              <!-- <?= form_error('nama_belakang', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>

                           <div class="form-group form-focus">
                              <input type="email" autocomplete="off" class="form-control floating <?= form_error('email')  ? 'is-invalid' : "" ?>" name="email" value="<?= set_value('email') ?>">
                              <label class="focus-label">Email</label>
                              <!-- <?= form_error('email', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>


                           <div class="form-group form-focus">
                              <input type="number" autocomplete="off" class="form-control floating <?= form_error('no_telepon')  ? 'is-invalid' : "" ?>" name="no_telepon" value="<?= set_value('no_telepon') ?>">
                              <label class="focus-label">No Telepon</label>
                              <!-- <?= form_error('no_telepon', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>

                           <div class="form-group form-focus">
                              <input type="password" class="form-control floating <?= form_error('password')  ? 'is-invalid' : "" ?>" name="password" value="<?= set_value('password') ?>">
                              <label class="focus-label">Password</label>
                              <!-- <?= form_error('password', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>

                           <div class="form-group form-focus">
                              <input type="password" class="form-control floating <?= form_error('konfirmasi_pass')  ? 'is-invalid' : "" ?>" name="konfirmasi_pass" value="<?= set_value('konfirmasi_pass') ?>">
                              <label class="focus-label">Password Confirm</label>
                              <!-- <?= form_error('konfirmasi_pass', '<div class = "text-small text-danger mb-3">', '</div>') ?> -->
                           </div>
                           <div class="g-recaptcha form-group form-focus mb-5" data-sitekey="6LepilcaAAAAABmgs9137-0_lnsyZVSVs6hcusLe"></div>
                           <div class="text-right">
                              <a class="forgot-link" href="<?= base_url('login') ?>">Sudah Punya akun?</a>
                           </div>
                           <button class="btn btn-primary btn-block btn-lg login-btn shadow" type="submit">Daftar</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>