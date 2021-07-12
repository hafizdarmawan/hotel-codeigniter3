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
                   <h3 class="card-title">Ubah Galleri</h3>
                </div>
                <div class="card-body">
                   <form action="<?= base_url('admin/gallery/ubah_aksi') ?>" method="post">
                      <div class="form-group">
                         <label class="col-form-label" for="title"></i>Judul</label>
                         <input type="hidden" name="id_galleri" value="<?= $gallery->id_galleri ?>">
                         <input type="text" class="form-control <?= form_error('judul')  ? 'is-invalid' : "" ?>" name="judul" id="judul" placeholder="Title" value="<?= set_value('judul', $gallery->judul) ?>">
                         <?= form_error('judul', '<div class = "text-small text-danger">', '</div>') ?>
                      </div>
                </div>
                <div class="card-footer">
                   <button type="submit" class="btn btn-info shadow">Simpan</button>
                   <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                </div>
                </form>
             </div>
          </div>
    </div>
    </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>