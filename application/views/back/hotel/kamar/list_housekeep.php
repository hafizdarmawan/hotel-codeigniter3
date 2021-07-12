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
               <h3 class="card-title"><?= $page_title ?></h3>
               <div class="float-sm-right">
                  <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary">Tambah</a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th style="width: 5%;">No</th>
                           <th style="text-align: center;">Lantai</th>
                           <th style="text-align: center;">Tipe Kamar</th>
                           <th style="text-align: center;">No Kamar</th>
                           <th style="text-align: center;">Housekeeping status</th>
                           <th style="text-align: center;">Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if ($housekeeping) : ?>
                           <?php $no = 1;
                           foreach ($housekeeping as $data) :
                           ?>
                              <tr style="text-align: center;">
                                 <td><?= $no++; ?></td>
                                 <td><?= $data->lantai ?></td>
                                 <td><?= $data->tipe_kamar ?></td>
                                 <td><?= $data->nokamar ?> </td>
                                 <td><?= $data->status ?></td>
                                 <td style="text-align: center;">
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-detail<?= $data->id_house_keep ?>"> <i class="fas fa-eye"></i> Detail</a>
                                    <a href="#" class=" btn btn-warning" data-toggle="modal" data-target="#modal-ubah<?= $data->id_house_keep ?>"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a href="<?= base_url('admin/housekeeping/hapus/') . $data->id_house_keeping ?>" class="btn  btn-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
                                 </td>
                              </tr>
                           <?php endforeach ?>
                        <?php endif; ?>
                     </tbody>
                  </table>
                  <?php if (isset($housekeeping)) : ?>
                     <?php $i = 1;
                     foreach ($housekeeping as $data) : ?>
                        <div class="modal fade" id="modal-detail<?= $data->id_house_keep ?>">
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
                                       <div class="table-responsive">
                                          <table class="table">
                                             <tbody>
                                                <tr>
                                                   <th style="width:50%">Room Number:</th>
                                                   <td><?= $data->nokamar ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Status:</th>
                                                   <td><?= $data->status ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Lantai:</th>
                                                   <td><?= $data->lantai ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Description</th>
                                                   <td><?= $data->remark ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Tipe Kamar</th>
                                                   <td><?= $data->tipe_kamar ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Date:</th>
                                                   <td><?= $data->date ?></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer ml-auto">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                           <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                     <?php endforeach; ?>
                  <?php endif; ?>
                  <?php if (isset($housekeeping)) : ?>
                     <?php $i = 1;
                     foreach ($housekeeping as $data) : ?>
                        <div class="modal fade" id="modal-ubah<?= $data->id_house_keep ?>">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Ubah</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="card-body">
                                       <form action="<?= base_url('admin/housekeeping_ubah_aksi') ?>" method="post">
                                          <input type="hidden" name="id_house_keeping" value="<?= $data->id_house_keeping ?>">
                                          <input type="hidden" name="id_kamar" value="<?= $kamar ?>">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label>House Keeping Status</label>
                                                   <select name="id_house_keep" class="form-control" required>
                                                      <option value="">Pilih Status......</option>
                                                      <?php foreach ($house_keeping_status as $hks) { ?>
                                                         <option value="<?= $hks->id_house_keep ?>" <?= $hks->id_house_keep == $data->id_house_keep ? 'selected="selected"' : '' ?>><?= $hks->judul ?> </option>
                                                      <?php } ?>
                                                   </select>
                                                   <?= form_error('judul', '<div class = "text-small text-danger">', '</div>') ?>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="description"></label>
                                                   <textarea name="description" class="form-control"><?= $data->remark ?></textarea>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="date">Date</label>
                                                   <input type="date" class="form-control" name="date" value="<?= $data->date ?>" required>
                                                   <?= form_error('date', '<div class = "text-small text-danger">', '</div>') ?>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-footer">
                                             <button type="submit" class="btn btn-info">Simpan</button>
                                             <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                     <?php endforeach; ?>
                  <?php endif; ?>

               </div>

               <!-- akhir modal tambah -->
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
                              <form action="<?= base_url('admin/housekeeping_tambah_aksi') ?>" method="post">
                                 <input type="hidden" name="id_kamar" value="<?= $kamar ?>">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label>House Keeping Status</label>
                                          <select name="id_house_keep" class="form-control" required>
                                             <option value="">Pilih Status</option>
                                             <?php foreach ($house_keeping_status as $hks) { ?>
                                                <option value="<?= $hks->id_house_keep ?>"><?= $hks->judul ?> </option>
                                             <?php } ?>
                                          </select>
                                          <?= form_error('title', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="description"></label>
                                          <textarea name="description" class="form-control"></textarea>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="date">Date</label>
                                          <input type="date" class="form-control" name="date" required>
                                          <?= form_error('date', '<div class = "text-small text-danger">', '</div>') ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                    <button type="submit" class="btn btn-default float-right">Batal</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.modal-content -->
               </div>
               <!--  -->



               <!-- akhir modal tambah -->

               <!--  -->
            </div>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
</div>
<!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Control Sidebar -->
<script>
   $(function() {
      $("#example1").DataTable();
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