    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
    <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
    <div class="content-wrapper">
       <div class="content-header">
          <div class="container-fluid">
             <div class="row mb-2">
                <div class="col-sm-6">
                   <h1 class="m-0 text-dark"><?= $page_title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                      <li class="breadcrumb-item active"><?= $page_title ?></li>
                   </ol>
                </div><!-- /.col -->
             </div><!-- /.row -->
          </div><!-- /.container-fluid -->
       </div>
       <section class="content">
          <div class="container-fluid">
             <div class="card shadow">
                <div class="card-header">
                   <h3 class="card-title">Tambah Pengguna Sistem</h3>
                </div>
                <div class="card-body">
                   <form action="<?= base_url('admin/tambah_aksi') ?>" method="post" enctype="multipart/form-data">
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="nama_depan"></i> Nama depan</label>
                               <input type="text" class="form-control <?= form_error('nama_depan')  ? 'is-invalid' : "" ?>" name="nama_depan" id="nama_depan" placeholder="Nama depan" value="<?= set_value('nama_depan') ?>">
                               <?= form_error('nama_depan', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="nama_belakang"></i> Nama belakang</label>
                               <input type="text" class="form-control <?= form_error('nama_belakang')  ? 'is-invalid' : "" ?>" name="nama_belakang" id="nama_belakang" placeholder="Nama belakang" value="<?= set_value('nama_belakang') ?>">
                               <?= form_error('nama_belakang', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="username"></i> Username</label>
                               <input type="text" class="form-control <?= form_error('username')  ? 'is-invalid' : "" ?>" name="username" id="username" placeholder="Username" value="<?= set_value('username') ?>">
                               <?= form_error('username', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="email"></i> Email</label>
                               <input type="email" class="form-control <?= form_error('email')  ? 'is-invalid' : "" ?>" name="email" id="email" placeholder="@Example.com" value="<?= set_value('email') ?>">
                               <?= form_error('email', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="password"></i> Password</label>
                               <input type="password" class="form-control <?= form_error('password')  ? 'is-invalid' : "" ?>" name="password" id="password" placeholder="Password" value="<?= set_value('password') ?>">
                               <?= form_error('password', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="konfirmasi_pass"></i> Konfirmasi password</label>
                               <input type="password" class="form-control <?= form_error('konfirmasi_pass')  ? 'is-invalid' : "" ?>" name="konfirmasi_pass" id="konfirmasi_pass" placeholder="Konfirasi password" value="<?= set_value('konfirmasi_pass') ?>">
                               <?= form_error('konfirmasi_pass', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="jenis_kelamin"></i>Jenis Kelamin</label>
                               <select name="jenis_kelamin" class="form-control <?= form_error('jenis_kelamin')  ? 'is-invalid' : "" ?>" id="jenis_kelamin">
                                  <option value="">Pilih jenis kelamin......</option>
                                  <option value="<?= '1'; ?>" <?= set_select('jenis_kelamin', '1'); ?> <?= ($jenis_kelamin == '1') ? 'selected="selected"' : ''; ?>>Laki-laki</option>
                                  <option value="<?= '0'; ?>" <?= set_select('jenis_kelamin', '0'); ?> <?= ($jenis_kelamin == '0') ? 'selected="selected"' : ''; ?>>Perempuan</option>
                                  <?= form_error('jenis_kelamin', '<div class = "text-small text-danger">', '</div>') ?>
                               </select>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="no_telepon"></i>No Telepon</label>
                               <input type="text" class="form-control <?= form_error('no_telepon')  ? 'is-invalid' : "" ?>" name="no_telepon" id="no_telepon" placeholder="+62" value="<?= set_value('no_telepon') ?>">
                               <?= form_error('no_telepon', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="tempat_lahir"></i> Tempat lahir</label>
                               <input type="text" class="form-control <?= form_error('tempat_lahir')  ? 'is-invalid' : "" ?>" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat lahir" value="<?= set_value('tempat_lahir') ?>">
                               <?= form_error('tempat_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="tanggal_lahir"></i> Tanggal Lahir</label>
                               <input type="date" class="form-control <?= form_error('tanggal_lahir')  ? 'is-invalid' : "" ?>" name="tanggal_lahir" id="tanggal_lahir" placeholder="" value="<?= set_value('tanggal_lahir') ?>">
                               <?= form_error('tanggal_lahir', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="alamat"></i> Alamat</label>
                               <textarea name="alamat" id="alamat" class="form-control <?= form_error('alamat')  ? 'is-invalid' : "" ?>"><?= $address ?> <?= set_value('alamat') ?></textarea>
                               <?= form_error('alamat', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="level_users"></i> Level pengguna</label>
                               <select name="level_users" class="form-control <?= form_error('level_users')  ? 'is-invalid' : "" ?>" id="level_users">
                                  <option value="">Pilih level user......</option>
                                  <option value="1" <?= set_select('level_users', '1'); ?>>Admin</option>
                                  <option value="3" <?= set_select('level_users', '2'); ?>>Resepsionis</option>
                               </select>
                               <?= form_error('level_users', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="status_users"></i> Status pengguna</label>
                               <select name="status_users" class="form-control <?= form_error('status_users')  ? 'is-invalid' : "" ?>" id="status_users">
                                  <option value="">Pilih status user.......</option>
                                  <option value="1" <?= set_select('status_users', '1'); ?>>Aktif</option>
                                  <option value="0" <?= set_select('status_users', '0'); ?>>Non-aktif</option>
                               </select>
                               <?= form_error('status_users', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="file_foto">File Foto</label>
                               <div class="custom-file">
                                  <input type="file" name="foto" class="custom-file-input dropify" id="customFile" value="<?= set_value('foto'); ?>" data-height="300">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  <?= form_error('foto', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="card-footer">
                         <button type="submit" class="btn btn-info shadow">Simpan</button>
                         <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Batal</button>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </section>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/admin') . '/plugins/dropify/js/dropify.js' ?>"></script>
    <script type="text/javascript">
       $(document).ready(function() {
          $('.dropify').dropify({
             messages: {
                default: 'Drag atau drop untuk memilih foto',
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
    </script>