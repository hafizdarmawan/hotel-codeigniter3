  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
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
           <div class="col-md-12">
              <div class="card card-outline card-info shadow">
                 <div class="card-header">
                    <h3 class="card-title"><?= $page_title ?></h3>
                    <div class="float-sm-right">
                       <a href="<?= base_url('admin/igallery/tambah/') . $id_galleri ?>" class="btn btn-primary">Tambah</a>
                    </div>
                 </div>
                 <div class="card-body">
                    <div class="table-responsive">
                       <table id="example2" class="table table-bordered table-striped shadow">
                          <thead>
                             <tr style="background-color:#F0FFF0;">
                                <th style="width: 5%; ">NO</th>
                                <th style="text-align: center;">NAMA GAMBAR</th>
                                <th style="text-align: center;">GAMBAR</th>
                                <th style="text-align: center; width: 40%;">AKSI</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1 ?>
                             <?php foreach ($gallery as $data) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td style="text-align: center;"><?= $data->caption ?></td>
                                   <td style="text-align: center;">
                                      <a href="<?= base_url('assets/img/gallery/full/') . $data->gambar ?>" data-toggle="lightbox" data-title="<?= $data->caption ?>" data-gallery="gallery">
                                         <img src="<?= base_url('assets/img/gallery/thumbnails/') . $data->gambar ?>" class="img-fluid mb-2" style="width: 130px;" alt="<?= $data->caption ?>" />
                                      </a>
                                   </td>
                                   <td style="text-align: center;">
                                      <a href="<?= base_url('admin/igallery/ubah/') . $data->id_rel_galleri ?>" class="btn btn-warning shadow"> <i class="fas fa-edit"></i> Ubah</a>
                                      <a href="<?= base_url('admin/igallery/hapus/') . $data->id_rel_galleri ?>" class="btn btn-danger tombol-hapus shadow"><i class="fas fa-trash"></i> Hapus</a>
                                   </td>
                                </tr>
                             <?php endforeach ?>
                          </tbody>
                       </table>
                       <div class="modal fade" id="modal-tambah">
                          <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                                <div class="modal-header">
                                   <h4 class="modal-title">Tambah</h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                   </button>
                                </div>
                                <div class="modal-body">
                                   <div class="card-body">
                                      <form action="<?= site_url('admin/igallery/tambah') ?>" method="POST" enctype="multipart/form-data">
                                         <input type="text" name="id_galleri" value="<?= $id_galleri ?>">
                                         <div class="form-group">
                                            <label for="caption">Nama Gambar</label>
                                            <input type="text" name="caption" value="<?= set_value('caption') ?>" class="form-control">
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
                                         </div>
                                         <div class="card-footer">
                                            <button type="submit" class="btn btn-info shadow">Simpan</button>
                                            <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                                         </div>
                                      </form>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
  </div>
  <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/admin/') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- Control Sidebar -->
  <script>
     $(function() {
        $('#example2').DataTable({
           "paging": true,
           "lengthChange": false,
           "searching": false,
           "ordering": true,
           "info": true,
           "autoWidth": false,
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
     $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
           alwaysShowClose: true
        });
     });
  </script>