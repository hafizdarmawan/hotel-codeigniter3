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
      <div class="container">
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box shadow">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>TOTAL TAMU</b></span>
                     <span class="info-box-number"><?= count($total_tamu) ?></span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>TAMU AKTIF</b></span>
                     <span class="info-box-number"><?= count($tamu_aktif) ?></span>
                  </div>
               </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>TAMU NON-AKTIF</b></span>
                     <span class="info-box-number"><?= count($tamu_tidak) ?></span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-alt"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>RESERVASI HARI INI</b></span>
                     <span class="info-box-number"><?= count($booking_hari_ini) ?> </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="card card-outline card-info shadow">
            <!-- <div class="card-header">
            </div> -->
            <!-- <h3 class="card-title"></h3> -->
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped shadow" id="example1">
                     <thead>
                        <tr style="background-color:#F0FFF0;">
                           <th>#</th>
                           <th>NAMA</th>
                           <th>EMAIL</th>
                           <th class="text-center">AKSI</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- <div class="col-md-12">
         </div> -->
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
         "pagingType": "full_numbers",
         // "responsive": true,
         "processing": true,
         "serverSide": true,
         //  "paging": true,

         // "processing": true, //Feature control the processing indicator.
         // "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source
         "ajax": {
            "url": "<?php echo site_url('backend/tamu/ajax_list') ?>",
            "type": "POST"
         },
         //Set column definition initialisation properties.
         "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
         }, ],

      });

   });
</script>