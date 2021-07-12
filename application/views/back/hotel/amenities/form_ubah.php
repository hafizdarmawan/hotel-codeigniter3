    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
    <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
    <style>
       .error {
          color: #FF0000;
       }

       #gender-error {
          width: 200px;
          padding-top: 15px;
       }
    </style>
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
                   <h3 class="card-title">Tambah Pengguna Sistem</h3>
                </div>
                <div class="card-body">
                   <form action="<?= base_url('admin/amenities_ubah_aksi') ?>" method="post" enctype="multipart/form-data">
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <input type="hidden" name="id_fasilitas" value="<?= $fasilitas->id_fasilitas ?>">
                               <label class="col-form-label" for="nama"></i> Nama</label>
                               <input type="text" class="form-control <?= form_error('nama')  ? 'is-invalid' : "" ?>" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $fasilitas->nama) ?>">
                               <?= form_error('nama', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <label class="col-form-label" for="status"></i> Status</label>
                               <select name="status" class="form-control <?= form_error('status')  ? 'is-invalid' : "" ?>" id="status">
                                  <option value="">Pilih Status.....</option>
                                  <option value="1" <?= set_select('status', '1'); ?> <?= ($fasilitas->status == '1') ? 'selected="selected"' : ''; ?>>Aktif</option>
                                  <option value="0" <?= set_select('status', '0'); ?> <?= ($fasilitas->status == '0') ? 'selected="selected"' : ''; ?>>Non-aktif</option>
                               </select>
                               <?= form_error('status', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-3">
                            <div class="form-group row">
                               <div class="offset-sm-2 col-sm-10">
                                  <div class="checkbox mt-5">
                                     <label>
                                        Hanya Kamar! <input type="checkbox" name="only_kamar" class="form-control" value="1" <?php echo ($fasilitas->only_kamar == 1) ? 'checked="checked"' : '' ?> />
                                     </label>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="deskripsi"></i> Deskripsi</label>
                               <textarea name="deskripsi" rows="5" id="deskripsi" class="form-control <?= form_error('deskripsi')  ? 'is-invalid' : "" ?>"> <?= set_value('deskripsi', $fasilitas->deskripsi) ?></textarea>
                               <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="file_foto">File Foto</label>
                               <div class="custom-file">
                                  <input type="file" name="gambar" class="custom-file-input dropify" id="customFile" value="<?= set_value('gambar'); ?>" data-height="200">
                                  <input type="hidden" name="image_lama" value="<?= $fasilitas->gambar ?>">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  <?= form_error('gambar', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                      </div>
                </div>
                <div class="card-footer">
                   <button type="submit" class="btn btn-info shadow">Simpan</button>
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
    <script>
       $(document).ready(function() {
          $('input').iCheck({
             checkboxClass: 'icheckbox_square-blue',
             radioClass: 'iradio_square-blue',
             increaseArea: '20%' // optional
          });


       });
    </script>