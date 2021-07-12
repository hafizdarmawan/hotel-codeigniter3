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
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-person-booth"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Tipe Kamar</b></span>
                     <span class="info-box-number"><?= count($tipe_kamar) ?></span>
                  </div>
               </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-door-open"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Jumlah Kamar</b></span>
                     <span class="info-box-number"><?= $states->total_kamar ?> </span>
                  </div>
               </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bed"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Kamar Aktif</b></span>
                     <span class="info-box-number"><?= $kamar_aktif->jumlah ?></span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bed"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Kamar Non-Aktif</b></span>
                     <span class="info-box-number"><?= $kamar_non->jumlah ?></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 ">
            <div class="card card-outline card-info shadow">
               <div class="card-header">
                  <h3 class="card-title"><?= $page_title ?></h3>
                  <div class="float-right">
                     <a href="<?= base_url('admin/kamar/tambah') ?>" class="btn btn-sm shadow btn-primary">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%;">NO</th>
                              <th style="text-align: center;">NOMOR LANTAI</th>
                              <th style="text-align: center;">TIPE KAMAR</th>
                              <th style="text-align: center;">NOMOR KAMAR</th>
                              <th style="text-align: center;">STATUS KAMAR</th>
                              <th style="text-align: center;">AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if ($kamar) : ?>
                              <?php $no = 1;
                              foreach ($kamar as $data) : ?>
                                 <tr style="text-align: center;">
                                    <td><?= $no++; ?></td>
                                    <td><?= $data->no_lantai ?> - <?= $data->lantai ?> </td>
                                    <td><?= $data->tipe_kamar ?></td>
                                    <td><?= $data->no_kamar ?></td>
                                    <td>
                                       <?php if ($data->status == 1) : ?>
                                          <a href="<?= base_url('admin/kamar/status/') . $data->id_kamar ?>" class="btn btn-sm btn-success shadow"><i class="fas fa-check"></i> Aktif</a>
                                       <?php elseif ($data->status == 0) : ?>
                                          <a href="<?= base_url('admin/kamar/status/') . $data->id_kamar ?>" class="btn btn-sm btn-danger shadow"><i class="fas fa-times"></i> Non-Aktif</a>
                                    </td>
                                 <?php endif ?>
                                 <td style="text-align: center;">
                                    <a href="<?= base_url('admin/kamar/ubah/') . $data->id_kamar ?>" class="btn btn-sm shadow  btn-warning"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a href="<?= base_url('admin/kamar/hapus/') . $data->id_kamar ?>" class="btn btn-sm shadow  btn-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
                                 </td>
                                 </tr>
                              <?php endforeach ?>
                           <?php endif; ?>
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