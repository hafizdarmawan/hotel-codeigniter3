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
                  <div class="row"></div>
                  <h3 class="card-title">Voucher</h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/coupon/tambah') ?>" class="btn btn-sm btn-primary shadow">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%;">NO</th>
                              <th style="text-align: center;">NAMA VOUCHER</th>
                              <th style="text-align: center;">BERLAKU VOUCHER</th>
                              <th style="text-align: center;">TOTAL VOUCHER</th>
                              <th style="text-align: center;">AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($voucher as $data) : ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td style="text-align: center;"><?= $data->judul ?></td>
                                 <td style="text-align: center;"><?= tgl_indo($data->date_from) ?> sampai <?= tgl_indo($data->date_to) ?>
                                 </td>
                                 <td style="text-align: center;">
                                    <?php if ($data->tipe == 'Tetap') : ?>
                                       Rp <?= rupiah($data->nilai) ?>
                                    <?php elseif ($data->tipe == 'Persen') : ?>
                                       % <?= rupiah($data->nilai) ?>
                                    <?php endif ?>
                                 </td>
                                 <td style="text-align: center;">
                                    <a href="<?= base_url('admin/coupon/ubah/') . $data->id_voucher ?>" class="btn btn-sm btn-warning shadow"> <i class="fas fa-edit"></i>Ubah</a>
                                    <a href="<?= base_url('admin/coupon/hapus/') . $data->id_voucher ?>" class="btn btn-sm btn-danger shadow tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
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