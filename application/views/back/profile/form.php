     <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
     <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
     <div class="content-wrapper">
        <section class="content-header">
           <div class="container-fluid">
              <div class="row mb-2">
                 <div class="col-sm-6">
                    <h1>Profile</h1>
                 </div>
                 <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                       <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                       <li class="breadcrumb-item active">Profile</li>
                    </ol>
                 </div>
              </div>
           </div><!-- /.container-fluid -->
        </section>
        <section class="content">
           <div class="container-fluid">
              <div class="row">
                 <div class="col-md-3">
                    <div class="card card-info card-outline shadow">
                       <div class="card-body box-profile">
                          <div class="text-center">
                             <img class="profile-user-img img-fluid img-circle" <?php if (!empty($user->foto)) : ?> src="<?= base_url('assets/img/pengguna/') . $user->foto ?>" <?php else : ?> src="<?= base_url('assets/img/pengguna/user.png') ?>" <?php endif; ?> alt="<?= $user->nama_depan ?>">
                          </div>
                          <h3 class="profile-username text-center"><?= $user->nama_depan ?></h3>
                          <?php if ($user->level_users == '1') : ?>
                             <p class="text-muted text-center">Admin</p>
                          <?php elseif ($user->level_users == '2') : ?>
                             <p class="text-muted text-center">Receptionis</p>
                          <?php endif ?>
                       </div>
                    </div>
                 </div>
                 <div class="col-md-9">
                    <div class="card card-outline card-info shadow">
                       <div class="card-header p-2">
                          <ul class="nav nav-pills">
                             <li class="nav-item"><a class="nav-link active shadow m-1" href="#profile" data-toggle="tab">Profile</a></li>
                             <li class="nav-item"><a class="nav-link shadow m-1" href="#password" data-toggle="tab">Password</a></li>
                          </ul>
                       </div><!-- /.card-header -->
                       <div class="card-body">
                          <div class="tab-content">
                             <div class="active tab-pane" id="profile">
                                <!-- Post -->
                                <div class="post">
                                   <form action="<?= base_url('admin/profile/ubah') ?>" method="POST" enctype="multipart/form-data">
                                      <div class="form-group row">
                                         <input type="hidden" name="id_user" id="id_user" value="<?= $user->id_user ?>">
                                         <label for="inputName" class="col-sm-2 col-form-label">Nama Depan</label>
                                         <div class="col-sm-10">
                                            <input type="text" class="form-control <?= form_error('nama_depan')  ? 'is-invalid' : "" ?>" name="nama_depan" id="nama_depan" placeholder="Nama depan" value="<?= set_value('nama_depan', $user->nama_depan) ?>">
                                            <?= form_error('nama_depan', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputName" class="col-sm-2 col-form-label">Nama Belakang</label>
                                         <div class="col-sm-10">
                                            <input type="text" class="form-control <?= form_error('nama_belakang')  ? 'is-invalid' : "" ?>" name="nama_belakang" id="nama_belakang" placeholder="Nama belakang" value="<?= set_value('nama_belakang', $user->nama_belakang) ?>">
                                            <?= form_error('nama_belakang', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                         <div class="col-sm-10">
                                            <input type="text" class="form-control <?= form_error('username')  ? 'is-invalid' : "" ?>" name="username" id="username" placeholder="Username" value="<?= set_value('username', $user->username) ?>">
                                            <?= form_error('username', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                         <div class="col-sm-10">
                                            <input type="email" class="form-control <?= form_error('email')  ? 'is-invalid' : "" ?>" name="email" id="email" placeholder="@Example.com" value="<?= set_value('email', $user->email) ?>">
                                            <?= form_error('email', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputName2" class="col-sm-2 col-form-label">No Telepon</label>
                                         <div class="col-sm-10">
                                            <input type="text" class="form-control <?= form_error('no_telepon')  ? 'is-invalid' : "" ?>" name="no_telepon" id="no_telepon" placeholder="+62" value="<?= set_value('no_telepon', $user->no_telepon) ?>">
                                            <?= form_error('no_telepon', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputExperience" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                         <div class="col-sm-10">
                                            <select name="jenis_kelamin" class="form-control <?= form_error('jenis_kelamin')  ? 'is-invalid' : "" ?>" id="jenis_kelamin">
                                               <option value="">--<?= 'select jenis_kelamin'; ?>--</option>
                                               <option value="<?= '1' ?>" <?= set_select('jenis_kelamin', '1'); ?> <?= ($user->jenis_kelamin == '1') ? 'selected="selected"' : ''; ?>>Laki-laki</option>
                                               <option value="<?= '0' ?>" <?= set_select('jenis_kelamin', '0'); ?> <?= ($user->jenis_kelamin == '0') ? 'selected="selected"' : ''; ?>>Perempuan</option>
                                               <?= form_error('jenis_kelamin', '<div class = "text-small text-danger">', '</div>') ?>
                                            </select>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputSkills" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                         <div class="col-sm-10">
                                            <input type="text" class="form-control <?= form_error('tempat_lahir')  ? 'is-invalid' : "" ?>" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat lahir" value="<?= set_value('tempat_lahir', $user->tempat_lahir) ?>">
                                            <?= form_error('tempat_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputSkills" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                         <div class="col-sm-10">
                                            <input type="date" class="form-control <?= form_error('tanggal_lahir')  ? 'is-invalid' : "" ?>" name="tanggal_lahir" id="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir', $user->tanggal_lahir) ?>">
                                            <?= form_error('tanggal_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputSkills" class="col-sm-2 col-form-label">Alamat</label>
                                         <div class="col-sm-10">
                                            <textarea name="alamat" id="alamat" class="form-control <?= form_error('alamat')  ? 'is-invalid' : "" ?>"><?= $user->alamat ?> <?= set_value('alamat') ?></textarea>
                                            <?= form_error('alamat', '<div class = "text-small text-danger">', '</div>') ?>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <label for="inputSkills" class="col-sm-2 col-form-label">Photo</label>
                                         <div class="col-sm-10">
                                            <div class="custom-file">
                                               <input type="file" name="foto" class="custom-file-input dropify" id="customFile" value="<?= set_value('foto'); ?>" data-height="300">
                                               <input type="hidden" name="foto_lama" value="<?= $user->foto ?>">
                                               <label class="custom-file-label" for="customFile">Choose file</label>
                                               <?= form_error('foto', '<div class = "text-small text-danger">', '</div>') ?>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                         <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-info shadow">Simpan</button>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                             </div>
                             <div class="tab-pane" id="password">
                                <form method="POST" action="<?= base_url('admin/profile/ubah_password') ?>">
                                   <div class="form-group row">
                                      <label for="inputName" class="col-sm-2 col-form-label">Password Lama</label>
                                      <div class="col-sm-10">
                                         <input type="password" class="form-control <?= form_error('password_old')  ? 'is-invalid' : "" ?>" name="password_old" id="password_old" placeholder="Password" value="<?= set_value('password_old') ?>">
                                         <?= form_error('password_old', '<div class = "text-small text-danger">', '</div>') ?>
                                      </div>
                                   </div>
                                   <div class="form-group row">
                                      <label for="inputEmail" class="col-sm-2 col-form-label">Password Baru</label>
                                      <div class="col-sm-10">
                                         <input type="password" class="form-control <?= form_error('password')  ? 'is-invalid' : "" ?>" name="password" id="password" placeholder="Password" value="<?= set_value('password') ?>">
                                         <?= form_error('password', '<div class = "text-small text-danger">', '</div>') ?>
                                      </div>
                                   </div>
                                   <div class="form-group row">
                                      <label for="inputName2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                      <div class="col-sm-10">
                                         <input type="password" class="form-control <?= form_error('konfirmasi_pass')  ? 'is-invalid' : "" ?>" name="konfirmasi_pass" id="konfirmasi_pass" placeholder="Konfirasi password" value="<?= set_value('konfirmasi_pass') ?>">
                                         <?= form_error('konfirmasi_pass', '<div class = "text-small text-danger">', '</div>') ?>
                                      </div>
                                   </div>
                                   <div class="form-group row">
                                      <div class="offset-sm-2 col-sm-10">
                                         <button type="submit" class="btn btn-info shadow">Simpan</button>
                                      </div>
                                   </div>
                                </form>
                             </div>
                          </div>
                       </div><!-- /.card-body -->
                    </div>
                 </div>
              </div>
           </div><!-- /.container-fluid -->
        </section>
     </div>
     <script type="text/javascript" src="<?= base_url('assets/admin') . '/plugins/dropify/js/dropify.js' ?>"></script>
     <script type="text/javascript">
        $(document).ready(function() {
           $('.dropify').dropify({
              messages: {
                 default: 'Drag atau drop untuk memilih gambar',
                 replace: 'Ganti',
                 remove: 'Hapus',
                 error: 'error'
              }
           });
        });
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
     <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
     <script src="<?= base_url('assets/admin/plugins') ?>/jquery-validation/jquery.validate.min.js"></script>
     <script>
        $(function() {
           $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
           });
           $.validator.setDefaults({
              ignore: ":hidden:not(select)"
           });
           $("#signup_form").validate({
              submitHandler: function(form) {
                 if ($(form).valid())
                    form.submit();
                 return false; // prevent normal form posting
              }
           });

        });

        $('#country_id').change(function() {
           var c_id = $(this).val();
           if (c_id) {
              call_loader();
              $.ajax({
                 url: '<?= site_url('backend/guests/get_states') ?>',
                 type: 'POST',
                 data: {
                    country_id: c_id
                 },
                 success: function(result) {
                    remove_loader();
                    $("#region_id").html('');
                    $("#region_id").html(result);

                 }
              });
           }
        });
        $('#region_id').change(function() {
           var c_id = $(this).val();
           if (c_id) {
              call_loader();
              $.ajax({
                 url: '<?= site_url('backend/guests/get_cities') ?>',
                 type: 'POST',
                 data: {
                    state_id: c_id
                 },
                 success: function(result) {
                    remove_loader();
                    $("#city_id").html('');
                    $("#city_id").html(result);

                 }
              });
           }
        });
        $("#username").on('blur', function() {
           var val = $('#username').val();
           if (val) {
              $.ajax({
                 url: '<?= site_url('backend/user/check_username') ?>',
                 type: 'POST',
                 data: {
                    username: val
                 },
                 success: function(result) {

                    if (result == 1) {
                       $('#username').val('');
                       $('#username').focus();
                       $('#username-error').show();
                       $('#username-error').html('This Username Is Exists Try Again..');
                    }

                 }
              });
           }
        });
     </script>