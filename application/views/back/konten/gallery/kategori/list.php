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
   <section class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="card card-outline card-info">
               <div class="card-header">
                  <h3 class="card-title"><?= $page_title ?></h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/pages/tambah') ?>" class="btn btn-primary">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th style="width: 5%; ">No</th>
                              <th style="text-align: center;">Title</th>
                              <th style="text-align: center;">Slug</th>
                              <th style="text-align: center; width: 25%;"> Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($lantai as $data) : ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td style="text-align: center;"><?= $data->title ?></td>
                                 <td style="text-align: center;"><?= $data->slug ?></td>
                                 <td style="text-align: center;">
                                    <a href="<?= base_url('admin/lantai/ubah/') . $data->id_lantai ?>" class="btn  btn-warning"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a href="<?= base_url('admin/lantai/hapus/') . $data->id_lantai ?>" class="btn  btn-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
                                 </td>
                              </tr>
                           <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
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