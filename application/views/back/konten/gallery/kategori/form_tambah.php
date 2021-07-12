    <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
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
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active"><?= $page_title ?></li>
                   </ol>
                </div><!-- /.col -->
             </div><!-- /.row -->
          </div><!-- /.container-fluid -->
       </div>
       <!-- /.content-header -->
       <!-- Main content -->
       <section class="content">
          <div class="container-fluid">
             <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Tambah Pengguna Sistem</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                   <form action="<?= base_url('admin/lantai_tambah_aksi') ?>" method="post">
                      <div class="form-group">
                         <label class="col-form-label" for="title"></i> Title</label>
                         <input type="text" class="form-control <?= form_error('title')  ? 'is-invalid' : "" ?>" name="title" id="title" placeholder="Title" value="<?= set_value('title') ?>">
                         <?= form_error('title', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="seo_title"></i> SEO Title</label>
                         <input type="text" class="form-control <?= form_error('seo_title')  ? 'is-invalid' : "" ?>" name="seo_title" id="seo_title" placeholder="SEO Title" value="<?= set_value('seo_title') ?>">
                         <?= form_error('seo_title', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="meta_description"></i> Meta Description</label>
                         <textarea name="meta_description" id="meta_description" class="form-control"></textarea>
                         <?= form_error('meta_description', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="meta_keyword"></i> Meta Keyword</label>
                         <textarea name="meta_keyword" id="meta_keyword" class="form-control"></textarea>
                         <?= form_error('meta_keyword', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="row">
                         <div class="form-group">
                            <label class="col-form-label" for="status"></i>Status</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="1" <?php echo ($status == 1) ? 'checked="checked"' : '' ?> /> active
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="status" value="2" <?php echo ($status == 2) ? 'checked="checked"' : '' ?> /> inactive
                            <?= form_error('status', '<div class = "text-small text-danger">', '</div>') ?>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-8">
                            <div class="form-group">
                               <label for="description">Description</label>'
                               <textarea name="description" required class="form-control redactor" rows="30"><?= $tipe_kamar->description ?></textarea>
                               <?= form_error('description', '<div class = "text-small text-danger">', '</div>') ?>'
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                               <label for="file_foto">File Foto</label>
                               <div class="custom-file">
                                  <input type="file" name="image" class="custom-file-input dropify" id="customFile" value="<?= set_value('image'); ?>" data-height="200" required>
                                  <input type="hidden" name="image_lama" value="">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                  <?= form_error('image', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                      </div>
                </div>
                <div class="card-footer">
                   <button type="submit" class="btn btn-info">Simpan</button>
                   <button type="submit" class="btn btn-default float-right">Batal</button>
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