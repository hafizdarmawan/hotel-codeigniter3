<!-- <body style="background-color: white"> -->
<!-- Page Content -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="content">
   <div class="container-fluid">
      <div class="row mb-5">
         <div class="col-md-8 offset-md-2">
            <!-- Login Tab Content -->
            <div class="account-content">
               <div class="row align-items-center justify-content-center">
                  <div class="col-md-7 col-lg-6 login-left">
                     <img src="<?= base_url('assets/img/only/login.jpg') ?>" class="img-fluid" alt="Doccure Login">
                  </div>
                  <div class="col-md-12 col-lg-6 login-right shadow">
                     <div class="login-header">
                        <h3 class="text-uppercase">Login</h3>
                     </div>
                     <form action="<?= base_url('login/aksi') ?>" method="post">
                        <div class="form-group form-focus">
                           <input type="email" class="form-control floating" autocomplete="off" name="email">
                           <label class="focus-label">Email</label>
                        </div>
                        <div class="form-group form-focus">
                           <input type="password" class="form-control floating" name="password">
                           <label class="focus-label">Password</label>
                        </div>
                        <div class="g-recaptcha form-group form-focus mb-5" data-sitekey="6LepilcaAAAAABmgs9137-0_lnsyZVSVs6hcusLe"></div>
                        <button class="btn btn-primary btn-block btn-lg login-btn shadow" type="submit">Masuk</button>
                        <div class="text-center dont-have">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></div>
                        <div class="text-center dont-have mt-2">Lupa Password? <a href="<?= base_url('forgot') ?>">Lupa</a></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>