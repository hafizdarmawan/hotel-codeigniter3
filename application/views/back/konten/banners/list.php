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
         <div class="col-md-12">
            <div class="card card-outline card-info shadow">
               <div class="card-header">
                  <h3 class="card-title"><?= $page_title ?></h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/banners/tambah') ?>" class="btn btn-sm shadow btn-primary shadow">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%; ">NO</th>
                              <th style="text-align: center;">NAMA BANNER</th>
                              <th style="text-align: center;">DESKRIPSI BANNER</th>
                              <th style="text-align: center; width: 25%;">AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($banners as $data) : ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td style="text-align: center;"><?= $data->nama ?></td>
                                 <td style="text-align: center;"><?= $data->deskripsi ?></td>
                                 <td style="text-align: center;">
                                    <button type="button" class="btn btn-default btn-sm shadow" data-toggle="modal" data-target="#modal-default<?= $data->id_banner ?>">
                                       <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <a href="<?= base_url('admin/banners/ubah/') . $data->id_banner ?>" class="btn btn-sm shadow btn-warning"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a href="<?= base_url('admin/banners/hapus/') . $data->id_banner ?>" class="btn btn-sm shadow btn-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
                                 </td>
                              </tr>
                           <?php endforeach ?>
                        </tbody>
                     </table>
                     <?php foreach ($banners as $data) : ?>
                        <div class="modal fade" id="modal-default<?= $data->id_banner ?>">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title"><?= $page_title ?></h4>
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
                                                   <th style="width:50%">Nama:</th>
                                                   <td><?= $data->nama ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Heading:</th>
                                                   <td><?= $data->judul ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Deskripsi:</th>
                                                   <td><?= $data->deskripsi ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Status:</th>
                                                   <td><?= $data->status = 1 ? 'Aktif' : 'Non-aktif' ?></td>
                                                </tr>
                                                <tr>
                                                   <th>Image:</th>
                                                   <td><img class="fluid-img" style="width: 300px;" src="<?= base_url('assets/img/banners/') . $data->gambar ?>" alt=""></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer ml-auto">
                                    <button type="button" class="btn btn-default shadow" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
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