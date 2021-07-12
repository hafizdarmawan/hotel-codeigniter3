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
                  <h3 class="card-title"><?= $page_title ?> Sistem</h3>
                  <div class="float-sm-right">
                     <a href="<?= base_url('admin/pengguna/tambah') ?>" class="btn btn-primary btn-sm">Tambah</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped shadow" style="text-align: center;">
                        <thead>
                           <tr style="background-color:#F0FFF0;">
                              <th style="width: 5%;">NO</th>
                              <th>NAMA PENGGUNA</th>
                              <th>LEVEL PENGGUNA</th>
                              <th>STATUS PENGGUNA</th>
                              <th>TERAKHIR LOGIN</th>
                              <th>AKSI</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1 ?>
                           <?php foreach ($pengguna as $data) : ?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td><?= $data->nama_depan . ' ' . $data->nama_belakang ?></td>
                                 <td>
                                    <?php if ($data->level_users == '1') : ?>
                                       <a href="" class="btn btn-sm btn-success shadow">Admin</a>
                                    <?php elseif ($data->level_users == '2') : ?>
                                       <a href="" class="btn btn-sm btn-warning shadow">Resepsionis</a>
                                    <?php endif; ?>
                                 </td>
                                 <td>
                                 <?= $data->status_users == 1 ? '<a href="" class="btn btn-sm btn-success shadow"><i class="fas fa-check"></i> Aktif</a>' : '<a href="" class="btn btn-sm shadow btn-danger"><i class="fas fa-times"></i> Non-aktif</a>' ?>
                                 </td>
                                 <td><?= $data->last_login ?></td>
                                 <td>
                                    <a href="<?= base_url('admin/pengguna/ubah/') . $data->id_user ?>" class="btn btn-sm btn-warning shadow"> <i class="fas fa-edit"></i>Ubah</a>
                                    <?php if ($data->level_users != '1') : ?>
                                       <a href="<?= base_url('admin/pengguna/hapus/') . $data->id_user ?>" class="btn btn-sm  btn-danger tombol-hapus shadow"><i class="fas fa-trash"></i> Hapus</a>
                                    <?php endif ?>
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