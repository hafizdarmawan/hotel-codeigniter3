<!-- <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" /> -->
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<style>
   #weekchart {
      width: 100%;
      height: 500px;
   }

   #monthchart {
      width: 100%;
      height: 500px;
   }

   #yearchart {
      width: 100%;
      height: 500px;
   }

   #customchart {
      width: 100%;
      height: 500px;
   }

   .amcharts-export-menu-top-right {
      top: 10px;
      right: 0;
   }

   .amcharts-chart-div a {
      display: none !important
   }
</style>
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
               <div class="card card-outline card-info shadow">
                  <div class="card-header p-2">
                     <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link shadow ml-2 active" href="#custom" data-toggle="tab">Laporan</a></li>
                        <!-- <li class="nav-item"><a class="nav-link shadow ml-2" href="#mingguan" data-toggle="tab">Grafik Mingguan</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#bulanan" data-toggle="tab">Grafik Bulanan</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#tahunan" data-toggle="tab">Grafik Tahunan</a></li> -->
                     </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                     <div class="tab-content">
                        <div class="active tab-pane" id="custom">
                           <div class="form-group">
                              <form method="get" action="">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Filter Berdasarkan</label><br>
                                       <select class="form-control shadow" name="filter" id="filter">
                                          <option value="">Pilih</option>
                                          <option value="1">Per Tanggal</option>
                                          <option value="2">Per Bulan</option>
                                          <option value="3">Per Tahun</option>
                                       </select>
                                    </div>
                                    <div class="col-md-8">
                                       <div id="form-tanggal">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <label>Dari Tanggal</label><br>
                                                <input type="date" name="date_from" class="form-control input-tanggal shadow" />
                                             </div>
                                             <div class="col-md-6">
                                                <label>Sampai Tanggal</label><br>
                                                <input type="date" name="date_to" class="form-control input-tanggal shadow" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div id="form-bulan">
                                             <label>Bulan</label><br>
                                             <select class="form-control shadow" name="bulan">
                                                <option value="">Pilih</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div id="form-tahun">
                                             <label>Tahun</label><br>
                                             <select class="form-control shadow" name="tahun">
                                                <option value="">Pilih</option>
                                                <?php foreach ($option_tahun as $data) : ?>
                                                   <option value="<?= $data->tahun ?>"><?= $data->tahun ?></option>
                                                <?php endforeach ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="" id="status_reservasi">
                                             <label>Status Booking</label><br>
                                             <select name="status" class="form-control shadow">
                                                <option value="">Semua</option>
                                                <option value="1">Booked</option>
                                                <option value="2">Terisi</option>
                                                <option value="3">Selesai</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="" id="tipe_kamar">
                                             <label>Tipe Kamar</label><br>
                                             <select name="tipe" class="form-control shadow">
                                                <option value="">Semua</option>
                                                <?php foreach ($tipe_kamar as $data) : ?>
                                                   <option value="<?= $data->id_tipe_kamar ?>"><?= $data->judul ?></option>
                                                <?php endforeach ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mt-2">
                                    <button type="submit" class="btn btn-info shadow">Tampilkan</button>
                                    <a href="<?= base_url('admin/laporan/kamar'); ?>" class="btn btn-warning shadow">Reset Filter</a>
                                    <a href="<?= $url_cetak; ?>" class="btn btn-danger shadow">CETAK PDF</a>
                                 </div>
                              </form>
                              <div class="mt-4">
                                 <?php if ($transaksi !== '') : ?>
                                    <table id="example1" class="table table-bordered table-striped table-responsive shadow" width=" 100%" style="text-align: center;">
                                       <thead>
                                          <tr style="background-color:#F0FFF0;">
                                             <th width="20%">KODE ORDER</th>
                                             <th width="20%">NAMA TAMU</th>
                                             <th width="15%">TIPE KAMAR</th>
                                             <th width="15%">NO KAMAR</th>
                                             <th width="20%">TANGGAL</th>
                                             <th width="25%">RESERVASI</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php foreach ($transaksi as $data) { ?>
                                             <?php $layanan = get_layanan_by_id_order($data->id_order) ?>
                                             <?php $data_kamar = get_tipe_kamar_by_id($data->id_tipe_kamar) ?>
                                             <tr>
                                                <td><?= $data->no_order ?></td>
                                                <td><?= $data->nama_depan . ' ' . $data->nama_belakang ?></td>
                                                <td><?= $data_kamar->judul ?></td>
                                                <td>
                                                   <?php if ($data->no_kamar == '') : ?>
                                                      <p>Booked</p>
                                                   <?php else : ?>
                                                      No.<?= $data->no_kamar ?>
                                                   <?php endif ?>
                                                </td>
                                                <td><?= tgl_indo($data->tanggal) ?></td>
                                                <td> <?php if ($data->status_reservasi == 1) : ?>
                                                      <a href="" class="btn btn-sm btn-warning shadow">Booked</a>
                                                   <?php elseif ($data->status_reservasi == 2) : ?>
                                                      <a href="" class="btn btn-sm btn-primary shadow">Terisi</a>
                                                   <?php elseif ($data->status_reservasi == 3) : ?>
                                                      <a href="" class="btn btn-sm btn-success shadow">Selesai</a>
                                                   <?php endif ?>
                                                </td>
                                             </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                 <?php else : ?>
                                    <p>Data Kosong</p>
                                 <?php endif ?>
                              </div>
                              <script>
                                 $(document).ready(function() {
                                    $('#form-tanggal, #form-bulan, #form-tahun').hide();
                                    $('#status_reservasi').hide();
                                    $('#tipe_kamar').hide();
                                    $('#filter').change(function() {
                                       if ($(this).val() == '1') {
                                          $('#form-bulan, #form-tahun').hide();
                                          $('#form-tanggal').show();
                                          $('#status_reservasi').show();
                                          $('#tipe_kamar').show();
                                       } else if ($(this).val() == '2') {
                                          $('#form-tanggal').hide();
                                          $('#form-bulan, #form-tahun').show();
                                          $('#status_reservasi').show();
                                          $('#tipe_kamar').show();
                                       } else {
                                          $('#form-tanggal, #form-bulan').hide();
                                          $('#form-tahun').show();
                                          $('#status_reservasi').show();
                                          $('#tipe_kamar').show();
                                       }
                                       $('#form-tanggal input, #form-bulan select, #form-tahun select').val('');
                                    })
                                 });
                              </script>
                              <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
                              <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                              <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                              <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
                           </div>
                        </div>
                        <div class="tab-pane" id="mingguan">
                           <div id="weekchart" class="shadow"></div>
                        </div>
                        <div class="tab-pane" id="bulanan">
                           <div id="monthchart" class="shadow"></div>
                        </div>

                        <div class="tab-pane" id="tahunan">
                           <div id="yearchart" class="shadow"></div>
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
<!-- <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script> -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<!-- Chart code -->
<script>
   $(function() {
      $('#responsiveTabsDemo').responsiveTabs({
         startCollapsed: 'accordion'
      });
      <?php if (!empty($_POST['from'])) { ?>
         $('#responsiveTabsDemo').responsiveTabs('activate', 3); // This would open the CUSTOM tab
      <?php } ?>
      $('.datepicker').datepicker({
         todayHighlight: true,
         autoclose: true,
         format: 'yyyy-mm-dd',
      });
   });
   var chart = AmCharts.makeChart("weekchart", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": <?php echo json_encode($weekdata) ?>,
      "valueAxes": [{
         "axisAlpha": 0,
         "position": "left",
         "title": "Grafik Pendapatan Per Minggu"
      }],
      "startDuration": 1,
      "graphs": [{
         "balloonText": "<b>[[category]]: [[value]]</b>",
         "fillColorsField": "color",
         "fillAlphas": 0.9,
         "lineAlpha": 0.2,
         "type": "column",
         "valueField": "total"
      }],
      "chartCursor": {
         "categoryBalloonEnabled": false,
         "cursorAlpha": 0,
         "zoomable": false
      },
      "categoryField": "date",
      "categoryAxis": {
         "gridPosition": "start",
         "labelRotation": 45
      },
      "export": {
         "enabled": true
      }

   });

   var chart = AmCharts.makeChart("monthchart", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": <?php echo json_encode($monthdata) ?>,
      "valueAxes": [{
         "axisAlpha": 0,
         "position": "left",
         "title": "Grafik Pendapatan Bulanan"
      }],
      "startDuration": 1,
      "graphs": [{
         "balloonText": "<b>[[category]]: [[value]]</b>",
         "fillColorsField": "color",
         "fillAlphas": 0.9,
         "lineAlpha": 0.2,
         "type": "column",
         "valueField": "total"
      }],
      "chartCursor": {
         "categoryBalloonEnabled": false,
         "cursorAlpha": 0,
         "zoomable": false
      },
      "categoryField": "date",
      "categoryAxis": {
         "gridPosition": "start",
         "labelRotation": 45
      },
      "export": {
         "enabled": true
      }

   });
   var chart = AmCharts.makeChart("yearchart", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": <?php echo json_encode($yeardata) ?>,
      "valueAxes": [{
         "axisAlpha": 0,
         "position": "left",
         "title": "Grafik Pendapatan Tahunan"
      }],
      "startDuration": 1,
      "graphs": [{
         "balloonText": "<b>[[category]]: [[value]]</b>",
         "fillColorsField": "color",
         "fillAlphas": 0.9,
         "lineAlpha": 0.2,
         "type": "column",
         "valueField": "total"
      }],
      "chartCursor": {
         "categoryBalloonEnabled": false,
         "cursorAlpha": 0,
         "zoomable": false
      },
      "categoryField": "date",
      "categoryAxis": {
         "gridPosition": "start",
         "labelRotation": 45
      },
      "export": {
         "enabled": true
      }

   });

   // var chart = AmCharts.makeChart("customchart", {
   //    "type": "serial",
   //    "theme": "light",
   //    "marginRight": 70,
   //    "dataProvider": <?php echo json_encode($customdata) ?>,
   //    "valueAxes": [{
   //       "axisAlpha": 0,
   //       "position": "left",
   //       "title": "Laporan Keuangan"
   //    }],
   //    "startDuration": 1,
   //    "graphs": [{
   //       "balloonText": "<b>[[category]]: [[value]]</b>",
   //       "fillColorsField": "color",
   //       "fillAlphas": 0.9,
   //       "lineAlpha": 0.2,
   //       "type": "column",
   //       "valueField": "total"
   //    }],
   //    "chartCursor": {
   //       "categoryBalloonEnabled": false,
   //       "cursorAlpha": 0,
   //       "zoomable": false
   //    },
   //    "categoryField": "date",
   //    "categoryAxis": {
   //       "gridPosition": "start",
   //       "labelRotation": 45
   //    },
   //    "export": {
   //       "enabled": true
   //    }

   // });
</script>