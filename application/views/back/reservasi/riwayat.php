 <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="container-fluid">
          <div class="row mb-2">
             <div class="col-sm-6">
                <h1><?= $page_title ?></h1>
             </div>
             <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                   <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                   <li class="breadcrumb-item active"><?= $page_title ?></li>
                </ol>
             </div>
          </div>
       </div><!-- /.container-fluid -->
    </section>
    <section class="content">
       <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
             <div class="info-box shadow">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-clipboard-list"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text"><b>TOTAL RESERVASI</b></span>
                   <span class="info-box-number"><?= count($booking_data) ?></span>
                </div>
             </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
             <div class="info-box mb-3 shadow">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text"><b>BERHASIL BAYAR</b></span>
                   <span class="info-box-number"><?= count($berhasil) ?></span>
                </div>
             </div>
          </div>
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
             <div class="info-box mb-3 shadow">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text"><b>PANDDING BAYAR</b></span>
                   <span class="info-box-number"><?= count($pending) ?></span>
                </div>
             </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
             <div class="info-box mb-3 shadow">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text"><b>GAGAL BAYAR</b></span>
                   <span class="info-box-number"><?= count($gagal) ?></span>
                </div>
             </div>
          </div>
       </div>

       <div class="card card-outline card-info shadow">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-striped shadow" id="example1">
                   <thead>
                      <tr style="background-color:#F0FFF0;">
                         <th>#</th>
                         <th>KODE ORDER</th>
                         <th>KAMAR</th>
                         <th>CHECK-IN</th>
                         <th>CHECK-OUT</th>
                         <th>TGL ORDER</th>
                         <th>PEMBAYARAN</th>
                      </tr>
                   </thead>
                   <tbody style="cursor:pointer">
                      <?php if ($booking_data) : ?>
                         <?php $i = 1;
                           foreach ($booking_data as $new) : ?>
                            <tr>
                               <td id="<?= $new->id_order ?>"><?= $i; ?></td>
                               <td id="<?= $new->id_order ?>" class="gc_cell_left"><?= $new->no_order; ?></td>
                               <td id="<?= $new->id_order ?>"><?= $new->judul ?></td>
                               <td id="<?= $new->id_order ?>"><?= tgl_indo($new->check_in) ?></td>
                               <td id="<?= $new->id_order ?>"><?= tgl_indo($new->check_out) ?></td>
                               <td id="<?= $new->id_order ?>"><?= $new->tgl_order; ?></td>
                               <td id="<?= $new->id_order ?>" align=" center"><?= ($new->status_kode == 200) ? '<a href="' . site_url('admin/booking/detail_riwayat/') . $new->id_order . '" class="btn btn-success shadow ">Berhasil</a>' : '' ?> <?= ($new->status_kode == 201) ? '<a href="' . site_url('admin/booking/detail_riwayat/') . $new->id_order . '" class="btn btn-warning shadow ">Pending</a>' : '' ?><?= ($new->status_kode == 0 || $new->status_kode == 202) ? '<a href="' . site_url('admin/booking/detail_riwayat/') . $new->id_order . '" class="btn btn-danger shadow ">Gagal</a>' : ''; ?></td>
                            </tr>
                         <?php $i++;
                           endforeach; ?>
                      <?php endif ?>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </section>

 </div>
 <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <!-- <script type="text/javascript">
    $(function() {
       $('#example1').dataTable({});
       $('.datepicker').datepicker({
          todayHighlight: true,
          autoclose: true,
          format: 'yyyy-mm-dd',
       });
    });
 </script> -->
 <script type="text/javascript">
    $(function() {
       $('#example1').dataTable({});
       $('.datepicker').datepicker({
          todayHighlight: true,
          autoclose: true,
          format: 'yyyy-mm-dd',
       });
    });
    $("#example1 tbody td").on('click', function() {
       var id = $(this).attr('id');
       //alert(id);return false;
       if (id) {
          document.location.href = "<?= site_url('admin/booking/detail_riwayat/') ?>" + id;
       }
    });
 </script>


 <!-- <tbody style="cursor:pointer">

 </tbody>
 </table>
 </div>
 </div>
 </div>
 </section>
 </div>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script type="text/javascript">
    $(function() {
       //$('#example1').dataTable();
    });
    var table;
    $(document).ready(function() {
       //datatables
       table = $('#example1').DataTable({
          // "pagingType": "full_numbers",
          // "responsive": true,
          "processing": true,
          "serverSide": true,
          //  paging: true,

          // "processing": true, //Feature control the processing indicator.
          // "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
             "url": "<?php echo site_url('backend/booking/ajax_list') ?>",
             "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [{
             "targets": [0], //first column / numbering column
             "orderable": false, //set not orderable
          }, ],

       });

    });
 </script> -->