<link type="text/css" href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<link type="text/css" href="<?= base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?= base_url('assets/admin/plugins/responsivetabs/style.css') ?>" rel="stylesheet" />
<!-- <link type="text/css" href="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" /> -->
<link type="text/css" href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" />
<?php $seg = $this->uri->segment(4); ?>
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
         <div class="card card-primary card-outline shadow">
            <div class="card-header">
               <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Tambah Harga
               </h3>
            </div>
            <div class="card-body">
               <form action="<?= base_url('admin/price_tambah_aksi') ?>" method="post">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label>Tipe kamar</label>
                        <select name="id_tipe_kamar" class="form-control" id="id_tipe_kamar">
                           <option value="">Tipe Kamar.....</option>
                           <?php foreach ($tipe_kamar as $rt) {
                              $sel = "";
                              if (set_select('id_tipe_kamar', $rt->id_tipe_kamar)) $sel = "selected='selected'";
                              if ($id_tipe_kamar == $rt->id_tipe_kamar) $sel = "selected='selected'";
                           ?>
                              <option value="<?= $rt->id_tipe_kamar ?>" <?= $sel ?>><?= $rt->judul ?></option>
                           <?php } ?>
                        </select>
                        <?= form_error('id_tipe_kamar', '<div class = "text-small text-danger">', '</div>') ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-2">
                           <label>Senin</label>
                           <input type="number" name="senin" value="<?= set_value('senin') ?>" id="senin" class="form-control <?= form_error('senin')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('senin', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Selasa</label>
                           <input type="number" name="selasa" value="<?= set_value('selasa') ?>" id="selasa" class="form-control <?= form_error('selasa')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('selasa', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Rabu</label>
                           <input type="number" name="rabu" value="<?= set_value('rabu') ?>" id="rabu" class="form-control <?= form_error('rabu')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('rabu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Kamis</label>
                           <input type="number" name="kamis" value="<?= set_value('kamis') ?>" id="kamis" class="form-control <?= form_error('kamis')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('kamis', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Jumat</label>
                           <input type="number" name="jumat" value="<?= set_value('jumat') ?>" id="jumat" class="form-control <?= form_error('jumat')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('jumat', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Sabtu</label>
                           <input type="number" name="sabtu" value="<?= set_value('sabtu') ?>" id="sabtu" class="form-control <?= form_error('sabtu')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('sabtu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="col-md-2">
                           <label>Minggu</label>
                           <input type="number" name="minggu" value="<?= set_value('minggu') ?>" id="minggu" class="form-control <?= form_error('minggu')  ? 'is-invalid' : "" ?>" step="0.01" />
                           <?= form_error('minggu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info shadow">Simpan</button>
                     <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!-- Main content -->

   <!-- /.content -->
</div>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- <script src="<?= base_url('assets/admin/plugins/datatables/jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js') ?>" type="text/javascript"></script> -->
<script src="<?= base_url('assets/admin/plugins/responsivetabs/jquery.responsiveTabs.min.js') ?>" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script type="text/javascript">
   $(function() {
      $('#example1').dataTable({});
      $('#responsiveTabsDemo').responsiveTabs({
         startCollapsed: 'accordion',
         <?php if ($tab) { ?>
            active: <?= $tab ?>
         <?php } ?>
      });
      $('#reservationtime').daterangepicker({
         timePicker: true,
         timePickerIncrement: 30,
         locale: {
            format: 'YYYY-MM-DD h:mm A'
         }
      });

   });

   $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
      //console.log(picker.startDate.format('YYYY-MM-DD'));
      //console.log(picker.endDate.format('YYYY-MM-DD'));
      var sd = picker.startDate.format('YYYY-MM-DD');
      var ed = picker.endDate.format('YYYY-MM-DD');
      <?php if (!empty($prices->id_tipe_kamar)) { ?>
         var id_tipe_kamar = <?= $prices->id_tipe_kamar ?>;
         var id = '<?= $prices->id_price_manager ?>';
      <?php } else { ?>
         var id_tipe_kamar = $('#id_tipe_kamar').val();
         var id = '';
         if (id == '') {
            alert('First You Select Room Type Must');
            return false;
         }
      <?php } ?>
      if (id) {
         call_loader();
         $.ajax({
            url: '<?= site_url('backend/hotel/check_start_date') ?>',
            type: 'POST',
            data: {
               id_tipe_kamar: id_tipe_kamar,
               start_date: sd,
               end_date: ed,
               id: id
            },
            success: function(result) {
               remove_loader();
               if (result == 1) {
                  alert('Tanggal yang dipilh sudah tersedia, silahkan pilih tanggal yang belum diinput');
               }
               //alert(t['senin']);return false;
            }
         });
      }

   });
</script>