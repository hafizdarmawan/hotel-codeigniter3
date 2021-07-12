<!-- <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" /> -->
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1><?= $page_title ?></h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active">Laporan</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card shadow">
                  <div class="card-header p-2">
                     <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link shadow ml-2 active" href="#detail" data-toggle="tab">Detail Tamu</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#pemesanan" data-toggle="tab">Pemesanan</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#pembayaran" data-toggle="tab">Pembayaran</a></li>
                     </ul>
                  </div>
                  <div class="card-body">
                     <div class="tab-content">
                        <div class="active tab-pane" id="detail">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Nama</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= $tamu->nama_depan ?> <?= $tamu->nama_belakang ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Email</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= $tamu->email; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>No Telepon</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= $tamu->no_telepon; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Jenis Kelamin</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= ($tamu->jenis_kelamin == '1') ? 'Laki-laki' : ''; ?> <?= ($tamu->jenis_kelamin == '0') ? 'Perempuan' : ''; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Tempat & Tgl Lahir</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= $tamu->tempat_lahir !== '' ? $tamu->tempat_lahir : '-'; ?>

                                    <?= $tamu->tanggal_lahir == '0000-00-00' ? '-' : ', ' . tgl_indo($tamu->tanggal_lahir); ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Alamat</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= $tamu->alamat !== '' ? $tamu->alamat : '-'; ?>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-2">
                                    <label>Status Akun</label>
                                 </div>
                                 <div class="col-md-6">
                                    <?= ($tamu->status == 1) ? 'Aktif' : ''; ?> <?= ($tamu->status == 0) ? 'Blokir' : ''; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane" id="pemesanan">
                           <legend>Pemesanan</legend>
                           <div class="table-responsive">
                              <table class="table table-striped shadow" id="example1" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th style="text-align: center;">Nomor Order</th>
                                       <th style="text-align: center;">Tgl Order</th>
                                       <th style="text-align: center;">Check In/Out</th>
                                       <th style="text-align: center;">Kamar</th>
                                       <th style="text-align: center;">Layanan</th>
                                       <th style="text-align: center;">Total Biaya</th>
                                    </tr>
                                 </thead>
                                 <tbody style="cursor:pointer">
                                    <?php if ($bookings) : ?>
                                       <?php $i = 1;
                                       foreach ($bookings as $new) : ?>
                                          <?php $order_layanan = get_layanan_by_id_order($new->id_order) ?>
                                          <tr>
                                             <td style="text-align: center;" id="<?= $new->id ?>"><?= $i; ?></td>
                                             <td style="text-align: center;" id="<?= $new->id ?>" class="gc_cell_left"><?= $new->no_order; ?></td>
                                             <td style="text-align: center;" id="<?= $new->id ?>"><?= date_time_convert($new->tgl_order); ?></td>
                                             <td style="text-align: center;" id="<?= $new->id ?>"><?= tgl_indo($new->check_in) ?> s/d <?= tgl_indo($new->check_out) ?></td>
                                             <td style="text-align: center;" id="<?= $new->id ?>"><?= $new->kamar ?> (<?= $new->jml_kamar ?> Kamar)</td>
                                             <td id="<?= $new->id ?>"><?= $order_layanan->judul != '' ? $order_layanan->judul . '(' . $new->dewasa . ' orang)' : '-'  ?></td>
                                             <td style="text-align: center;" id="<?= $new->id ?>" align="center">Rp <?= rupiah($new->total_jumlah) ?></td>
                                          </tr>
                                       <?php $i++;
                                       endforeach; ?>
                                    <?php endif ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane" id="pembayaran">
                           <legend>Pembayaran</legend>
                           <div class="table-responsive">
                              <table class="table table-striped shadow" id="example1" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Nomor Order</th>
                                       <th>Check In/Out</th>
                                       <th>Kamar</th>
                                       <th>Layanan</th>
                                       <th>Total Biaya</th>
                                       <th>Status Pembayaran</th>
                                    </tr>
                                 </thead>
                                 <tbody style="cursor:pointer">
                                    <?php if ($bookings) : ?>
                                       <?php $i = 1;
                                       foreach ($bookings as $new) : ?>
                                          <?php $order_layanan = get_layanan_by_id_order($new->id_order) ?>
                                          <tr>
                                             <td id="<?= $new->id ?>"><?= $i; ?></td>
                                             <td id="<?= $new->id ?>" class="gc_cell_left"><?= $new->no_order; ?></td>
                                             <td id="<?= $new->id ?>"><?= tgl_indo($new->check_in) ?> s/d <?= tgl_indo($new->check_out) ?></td>
                                             <td id="<?= $new->id ?>"><?= $new->kamar ?> (<?= $new->jml_kamar ?> Kamar)</td>
                                             <td id="<?= $new->id ?>"><?= $order_layanan->judul != '' ? $order_layanan->judul . '(' . $new->dewasa . ' orang)' : '-'  ?></td>
                                             <td id="<?= $new->id ?>">Rp <?= rupiah($new->total_jumlah) ?></td>
                                             <td id="<?= $new->id ?>" align="center"><?= ($new->status_kode == '200') ? '<a href="" class="btn btn-primary shadow ">Berhasil</a>' : '' ?> <?= ($new->status_kode == '201') ? '<a href="" class="btn shadow btn-warning ">Pending</a>' : '' ?><?= ($new->status_kode == '' || $new->status_kode == '202') ? '<a href="" class="btn shadow btn-danger ">Gagal</a>' : ''; ?></td>
                                          </tr>
                                       <?php $i++;
                                       endforeach; ?>
                                    <?php endif ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div><!-- /.card-body -->
                  </div>
               </div>
            </div>
         </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>



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
      $('#example2').dataTable({});
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
   $(document).on('change', '#id_tipe_kamar', function() {
      //alert(12);
      vch = $(this).val();
      if (vch) {
         call_loader();
         $.ajax({
            url: '<?= site_url('backend/hotel/get_room_type_data') ?>',
            type: 'POST',
            data: {
               id: vch
            },
            success: function(result) {
               remove_loader();
               var t = JSON.parse(result);
               $('#mon').val(t['mon']);
               $('#tue').val(t['tue']);
               $('#wed').val(t['wed']);
               $('#thu').val(t['thu']);
               $('#fri').val(t['fri']);
               $('#sat').val(t['sat']);
               $('#sun').val(t['sun']);
               //alert(t['mon']);return false;
            }
         });
      } else {
         $('#mon').val('');
         $('#tue').val('');
         $('#wed').val('');
         $('#thu').val('');
         $('#fri').val('');
         $('#sat').val('');
         $('#sun').val('');
      }
   });

   $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
      //console.log(picker.startDate.format('YYYY-MM-DD'));
      //console.log(picker.endDate.format('YYYY-MM-DD'));
      var sd = picker.startDate.format('YYYY-MM-DD');
      var ed = picker.endDate.format('YYYY-MM-DD');
      <?php if (!empty($prices->id_tipe_kamar)) { ?>
         var id_tipe_kamar = <?= $prices->id_tipe_kamar ?>;
         var id = '<?= $spl->id_special_price ?>';
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
               //alert(t['mon']);return false;
            }
         });
      }

   });
</script>