    <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
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
                   <form action="<?= base_url('admin/tempmail/tambah_aksi') ?>" method="post">
                      <div class="form-group">
                         <label class="col-form-label" for="name"></i> Name</label>
                         <input type="text" class="form-control <?= form_error('name')  ? 'is-invalid' : "" ?>" name="name" id="name" placeholder="Name" value="<?= set_value('name') ?>">
                         <?= form_error('name', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="form-group">
                         <label class="col-form-label" for="subject"></i> Subject</label>
                         <input type="text" name="subject" class="form-control <?= form_error('subject')  ? 'is-invalid' : "" ?>" id="subject" placeholder="Subject" value="<?= set_value('subject') ?>">
                         <?= form_error('subject', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                      <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                               <label for="content">Content</label>'
                               <textarea name="content" required class="form-control redactor" rows="30" placeholder="Content"></textarea>
                               <?= form_error('description', '<div class = "text-small text-danger">', '</div>') ?>'
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
