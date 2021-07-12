<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark"><?= $page_title ?></h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active"><?= $page_title ?></li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="card card-outline card-info shadow">
               <div class="card-header">
                  <h3 class="card-title"><?= $page_title ?></h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/price/tambah') ?>" class="btn btn-sm btn-primary">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow" style="text-align: center;">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%;">NO</th>
                              <th>TIPE</th>
                              <th style="text-align: center;">SENIN</th>
                              <th style="text-align: center;">SELASA</th>
                              <th style="text-align: center;">RABU</th>
                              <th style="text-align: center;">KAMIS</th>
                              <th style="text-align: center;">JUMAT</th>
                              <th style="text-align: center;">SABTU</th>
                              <th style="text-align: center;">MINGGU</th>
                              <th style="text-align: center;">AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($harga as $data) : ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td><?= $data->judul ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->mon) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->tue) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->wed) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->thu) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->fri) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->sat) ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->sun) ?></td>
                                 <td style="text-align: center;">
                                    <a href="<?= base_url('admin/price/special/') . $data->id_harga ?>" class="btn btn-sm  btn-primary shadow"> <i class="fas fa-plus"></i> Harga Spesial</a>
                                    <a href="<?= base_url('admin/price/ubah/') . $data->id_harga ?>" class="btn btn-sm  btn-warning shadow"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a href="<?= base_url('admin/price/hapus/') . $data->id_harga ?>" class="btn btn-sm  btn-danger tombol-hapus shadow"><i class="fas fa-trash"></i> Hapus</a>
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