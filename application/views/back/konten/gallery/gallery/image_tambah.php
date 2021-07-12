    <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
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
                   <h3 class="card-title">Tambah Gambar Galleri </h3>
                </div>
                <div class="card-body">
                   <form action="<?= base_url('backend/galleri/image_tambah_aksi') ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                         <div class="input_fields_wrap">
                            <div class="row ">
                               <div class="col-md-5">
                                  <div class="form-group">
                                     <label>Caption</label>
                                     <input type="hidden" name="id_galleri" id="" value="<?= $id_galleri ?>">
                                     <input type="text" name="caption" value="<?= set_value('caption') ?>" class="form-control caption" required />
                                  </div>
                               </div>
                               <div class="col-md-7">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
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