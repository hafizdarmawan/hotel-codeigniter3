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
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="card card-outline card-info shadow">
               <div class="card-header">
                  <h3 class="card-title"><?= $page_title ?></h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/tipe/tambah') ?>" class="btn btn-sm btn-primary shadow">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%;">NO</th>
                              <th style="text-align: center;">TIPE KAMAR</th>
                              <th style="text-align: center;">MAX TAMU/ KAMAR</th>
                              <th style="text-align: center;">FASILITAS KAMAR</th>
                              <th style="text-align: center;">TARIF DASAR</th>
                              <th style="text-align: center;">AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($tipe_kamar as $data) : ?>
                              <?php $tipe_kamar = $this->hotel_model->get($data->id_tipe_kamar); ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td style="text-align: center;"><?= $data->judul ?></td>
                                 <td style="text-align: center;"><?= $data->higher_occupancy ?> Orang</td>
                                 <td style="text-align: center;"><?= $tipe_kamar->ams ?></td>
                                 <td style="text-align: center;">Rp <?= rupiah($data->tarif_dasar) ?></td>
                                 <td style="text-align: center;">
                                    <a href="<?= base_url('admin/tipe/ubah/') . $data->id_tipe_kamar ?>" class="btn btn-sm btn-warning shadow"><i class="fas fa-edit"></i> Ubah</a>
                                    <?php if ($data->status == 1) : ?>
                                       <a href="<?= base_url('admin/tipe/status/') . $data->id_tipe_kamar ?>" class="btn btn-sm btn-success shadow"><i class="fas fa-check"></i> Aktif</a>
                                    <?php elseif ($data->status == 0) : ?>
                                       <a href="<?= base_url('admin/tipe/status/') . $data->id_tipe_kamar ?>" class="btn btn-sm btn-danger shadow"><i class="fas fa-times"></i> Non-aktif</a>
                                    <?php endif ?>
                                    <!-- <i class="fas fa-check"></i> -->
                                    <!-- <i class="fas fa-times"></i> -->
                                    <!-- <a href="<?= base_url('admin/tipe/hapus/') . $data->id_tipe_kamar ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a> -->
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