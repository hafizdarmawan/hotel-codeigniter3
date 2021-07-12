         <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
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
                        <!-- <h3 class="card-name">Ubah Tamu</h3> -->
                     </div>
                     <div class="card-body">
                        <form action="<?= base_url('admin/customer/ubah_aksi') ?>" method="post">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="nama_depan">Nama Depan <small class="text-danger">*</small></label>
                                    <input type="hidden" name="id_tamu" value="<?= $tamu->id_tamu ?>">
                                    <input type="text" name="nama_depan" id="nama_depan" class="form-control <?= form_error('nama_depan')  ? 'is-invalid' : "" ?>" value="<?= set_value('nama_depan', $tamu->nama_depan) ?>">
                                    <?= form_error('nama_depan', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="nama_belaang">Nama Belakang <small class="text-danger">*</small></label>
                                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control <?= form_error('nama_belakang')  ? 'is-invalid' : "" ?>" value="<?= set_value('nama_belakang', $tamu->nama_belakang) ?>">
                                    <?= form_error('nama_belakang', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                                    <select name="jenis_kelamin" class="form-control <?= form_error('jenis_kelamin')  ? 'is-invalid' : "" ?>" id="jenis_kelamin">
                                       <option value="">Pilih Jenis Kelamin.....</option>
                                       <option value="<?= '1'; ?>" <?= set_select('jenis_kelamin', '1'); ?> <?= ($tamu->jenis_kelamin == '1') ? 'selected="selected"' : ''; ?>>Laki-laki</option>
                                       <option value="<?= '0'; ?>" <?= set_select('jenis_kelamin', '0'); ?> <?= ($tamu->jenis_kelamin == '0') ? 'selected="selected"' : ''; ?>>Perempuan</option>
                                    </select>
                                    <?= form_error('jenis_kelamin', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', $tamu->tempat_lahir) ?>">
                                 </div>
                              </div>
                           </div>


                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', $tamu->tanggal_lahir) ?>">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="email">Email <small class="text-danger">*</small></label>
                                    <input type="text" name="email" id="email" class="form-control <?= form_error('email')  ? 'is-invalid' : "" ?>" value="<?= set_value('email', $tamu->email) ?>">
                                    <input type="hidden" name="old_email" value="<?= $tamu->email ?>">
                                    <?= form_error('email', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="no_telepon">No Telepon <small class="text-danger">*</small></label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control <?= form_error('no_telepon')  ? 'is-invalid' : "" ?>" value="<?= set_value('no_telepon', $tamu->no_telepon) ?>">
                                    <input type="hidden" name="old_phone" value="<?= $tamu->no_telepon ?>">
                                    <?= form_error('no_telepon', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Alamat <small class="text-danger">*</small></label>
                                    <textarea name="alamat" placeholder="Address" class="form-control <?= form_error('alamat')  ? 'is-invalid' : "" ?>" name="alamat" id="" cols="30" rows="5"><?= set_value('alamat', $tamu->alamat) ?></textarea>
                                    <?= form_error('alamat', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>

                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="password">Password </label>
                                    <input type="password" name="password" id="password" class="form-control <?= form_error('password')  ? 'is-invalid' : "" ?>" value="<?= set_value('password') ?>">
                                    <?= form_error('password', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="konfirmasi_pass">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_pass" id="konfirmasi_pass" class="form-control <?= form_error('konfirmasi_pass')  ? 'is-invalid' : "" ?>" value="<?= set_value('konfirmasi_pass') ?>">
                                    <?= form_error('konfirmasi_pass', '<div class = "text-small text-danger">', '</div>') ?>
                                 </div>
                              </div>
                           </div>
                           <div class="card-footer">
                              <button type="submit" class="btn btn-info shadow"> <i class="fas fa-save"></i> Simpan</button>
                              <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                           </div>
                        </form>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
               <!--/. container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
         <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
         <script type="text/javascript">
            $(document).ready(function() {
               $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' // optional
               });


            });
         </script>