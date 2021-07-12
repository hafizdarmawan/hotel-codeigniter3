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
                   <h3 class="card-title">Ubah Lantai</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                   <form action="<?= base_url('admin/lantai_ubah_aksi') ?>" method="post">
                      <div class="row">
                         <div class="col-md-6">
                            <input type="hidden" name="id_lantai" value="<?= $lantai->id_lantai ?>">
                            <div class="form-group">
                               <label class="col-form-label" for="nama"></i> Nama</label>
                               <input type="text" class="form-control <?= form_error('nama')  ? 'is-invalid' : "" ?>" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama', $lantai->nama) ?>">
                               <?= form_error('nama', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="no_lantai"></i> Nomor Lantai</label>
                               <input type="text" class="form-control <?= form_error('no_lantai')  ? 'is-invalid' : "" ?>" name="no_lantai" id="no_lantai" placeholder="No lantai" value="<?= set_value('no_lantai', $lantai->no_lantai) ?>">
                               <?= form_error('no_lantai', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="deskripsi"></i>Deskripsi</label>
                               <textarea name="deskripsi" rows="5" id="deskripsi" class="form-control <?= form_error('deskripsi')  ? 'is-invalid' : "" ?>"> <?= set_value('deskripsi', $lantai->deskripsi) ?></textarea>
                               <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label class="col-form-label" for="status"></i>Status</label>
                               <select name="status" class="form-control <?= form_error('status')  ? 'is-invalid' : "" ?>" id="status">
                                  <option value="">Pilih Status ......</option>
                                  <option value="1" <?= set_select('status', '1'); ?> <?= ($lantai->status == '1') ? 'selected="selected"' : ''; ?>>Aktif</option>
                                  <option value="0" <?= set_select('status', '0'); ?> <?= ($lantai->status == '0') ? 'selected="selected"' : ''; ?>>Non-aktif</option>
                               </select>
                               <?= form_error('status', '<div class = "text-small text-danger">', '</div>') ?>
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
          </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>