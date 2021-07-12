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

               <!-- Account Content -->
               <div class="account-content">
                  <div class="row align-items-center justify-content-center">
                     <div class="col-md-7 col-lg-6 login-left">
                        <img src="<?= base_url('assets/img/only/lupa.jpg') ?>" class="img-fluid" alt="Login Banner">
                     </div>
                     <div class="col-md-12 col-lg-6 login-right shadow">
                        <div class="login-header">
                           <h3 class="text-bold">Lupa Password</h3>
                           <p class="small text-muted">Masukan email anda untuk reset password</p>
                        </div>
                        <form action="<?= base_url('forgot/aksi') ?>" method="post">
                           <div class="form-group form-focus">
                              <input type="email" class="form-control floating" autocomplete="off" name="email">
                              <label class="focus-label">Email</label>
                           </div>
                           <div class="g-recaptcha form-group form-focus mb-5" data-sitekey="6LepilcaAAAAABmgs9137-0_lnsyZVSVs6hcusLe"></div>
                           <div class="text-right">
                              <a class="forgot-link" href="<?= base_url('login') ?>">Ingat password?</a>
                           </div>
                           <button class="btn btn-primary btn-block btn-lg login-btn shadow" type="submit">Reset
                              Password</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /Page Content -->