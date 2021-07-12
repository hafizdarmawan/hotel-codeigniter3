    <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
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
                   <h3 class="card-name">Tambah Banner</h3>
                </div>
                <div class="card-body">
                   <form action="<?= base_url('admin/banners/tambah_aksi') ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                         <label class="col-form-label" for="nama"></i> Nama</label>
                         <input type="text" class="form-control <?= form_error('nama')  ? 'is-invalid' : "" ?>" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama') ?>">
                         <?= form_error('nama', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="judul"></i>Judul</label>
                         <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?= set_value('judul') ?>">
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="deskripsi"></i>Deskripsi</label>
                         <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"><?= set_value('deskripsi') ?></textarea>
                         <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="row">
                         <div class="form-group">
                            <label class="col-form-label" for="status"></i>Status</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="1" /> Aktif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="0" /> Tidak Aktif
                            <?= form_error('status', '<div class = "text-small text-danger">', '</div>') ?>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="file_foto">File Foto</label>
                               <div class="custom-file">
                                  <input type="file" name="gambar" class="custom-file-input dropify" id="customFile" value="<?= set_value('gambar'); ?>" data-height="300" required>
                                  <input type="hidden" name="image_lama" value="">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  <?= form_error('gambar', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <div class="col-md-6">

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
    <script type="text/javascript" src="<?= base_url('assets/admin/plugins/redactor/redactor.min.js'); ?>"></script>
    <script>
       $(function() {
          $('.redactor').redactor({
             // formatting: ['p', 'blockquote', 'h2','img'],
             minHeight: 200,
             imageUpload: '<?php echo site_url('/wysiwyg/upload_image'); ?>',
             fileUpload: '<?php echo site_url('/wysiwyg/upload_file'); ?>',
             imageGetJson: '<?php echo site_url('/wysiwyg/get_images'); ?>',
             imageUploadErrorCallback: function(json) {
                alert(json.error);
             },
             fileUploadErrorCallback: function(json) {
                alert(json.error);
             }
          });
       });
    </script>
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
       $(document).ready(function() {
          $('input').iCheck({
             checkboxClass: 'icheckbox_square-blue',
             radioClass: 'iradio_square-blue',
             increaseArea: '20%' // optional
          });


       });
    </script>