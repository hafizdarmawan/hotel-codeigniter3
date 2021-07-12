<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                  <li class="breadcrumb-item active"><a href="admin/dashboard">Dashboard</a></li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-home"></i></i></span>
                  <!-- <?php print_r($this->session->userdata('id_users')) ?> -->
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Kamar</b></span>
                     <span class="info-box-number"> <?= count($kamar) ?></span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text"><b>Tamu</b></span>
                     <span class="info-box-number"> <?= count($tamu) ?></span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box shadow">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clipboard-list"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Reservasi</b></span>
                     <span class="info-box-number">
                        <?= count($orders) ?>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3 shadow">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text"><b>Pendapatan Hari Ini</b></span>
                     <span class="info-box-number">
                        Rp <?= rupiah($trevenue->total) ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-outline card-info shadow">
                  <div class="card-header">
                     <h5 class="card-title"><b>Grafik Pendapatan Satu Minggu </b></h5>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="chart">
                              <canvas id="salesChart" style="height: 80px;" height="80"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-outline card-info shadow">
                  <div class="card-header">
                     <h5 class="card-title"><b>Grafik Pendaftaran Satu Minggu</b></h5>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="chart">
                              <canvas id="oChart" height="80" style="height: 80px;"></canvas>
                           </div>
                        </div>
                     </div>
                     <!-- /.row -->
                  </div>
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <div class="row">
            <div class="col-md-9">
               <div class="card card-outline card-info shadow">
                  <div class="card-header border-transparent">
                     <h3 class="card-title"><strong>10 Order Terakhir</strong></h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body p-0">
                     <div class="table-responsive">
                        <table class="table m-0">
                           <thead>
                              <tr>
                                 <th>No Order</th>
                                 <th>Nama</th>
                                 <th>Tipe Kamar</th>
                                 <th>Jumlah Pesan</th>
                                 <th>Status Pembayaran</th>
                                 <!-- <th>Status Reservasi</th> -->
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($latest_bookings as $data) : ?>
                                 <tr>
                                    <td><a href="<?= base_url('admin/booking/detail/') . $data->id_order ?>"><?= $data->no_order ?></a></td>
                                    <td><?= $data->nama_depan . " " . $data->nama_belakang ?></td>
                                    <?php $kamar = get_tipe_kamar_by_id($data->id_tipe_kamar) ?>
                                    <td><?= $kamar->judul ?></td>
                                    <td><?= $data->jml_kamar ?> Kamar</td>
                                    <td>
                                       <?php if ($data->status_kode == 200) : ?>
                                          <span class="badge badge-success shadow">Berhasil</span>
                                       <?php elseif ($data->status_kode == 201) : ?>
                                          <span class="badge badge-warning shadow">Pending</span>
                                       <?php else : ?>
                                          <span class="badge badge-danger shadow">Gagal</span>
                                       <?php endif; ?>
                                    </td>
                                    <!-- <td>
                                       <?php if ($data->status_booking == 1) : ?>
                                          <span class="badge badge-warning">Pending</span>
                                       <?php elseif ($data->status_booking == 2) : ?>
                                          <span class="badge badge-success">Check-in</span>
                                       <?php elseif ($data->status_booking == 3) : ?>
                                          <span class="badge badge-primary">Check-Out</span>
                                       <?php elseif ($data->status_booking == 0) : ?>
                                          <span class="badge badge-danger">Gagal</span>
                                       <?php endif; ?>
                                    </td> -->
                                 </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card-footer clearfix">
                     <a href="<?= base_url('admin/booking/riwayat') ?>" class="btn btn-sm btn-secondary float-right shadow">Tampil Semua</a>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="info-box mb-3 bg-warning shadow">
                  <span class="info-box-icon"><i class="fas fa-ticket-alt"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">Voucher Aktif</span>
                     <span class="info-box-number"><?= count($voucher) ?></span>
                  </div>
               </div>
               <div class="info-box mb-3 bg-success shadow">
                  <span class="info-box-icon"><i class="fas fa-concierge-bell"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">Layanan</span>
                     <span class="info-box-number"><?= count($layanan) ?></span>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </section>
</div>
<script>
   $(function() {
      var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas);
      var salesChartData = {
         labels: [<?php foreach ($dbchart as $ind   => $val) {
                     echo '"' . tgl_indo($ind) . '",';
                  } ?>],
         //labels: ["January", "February", "March", "April", "May", "June", "July"],
         datasets: [{
               label: "Electronics",
               fillColor: "rgb(210, 214, 222)",
               strokeColor: "rgb(210, 214, 222)",
               pointColor: "rgb(210, 214, 222)",
               pointStrokeColor: "#c1c7d1",
               pointHighlightFill: "#fff",
               pointHighlightStroke: "rgb(220,220,220)",
               data: [<?php foreach ($dbchart as $ind   => $val) {
                           echo (!empty($val->total)) ? $val->total . ',' : '0,';
                        } ?>]
            },
            /*{
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }*/
         ]
      };

      var salesChartOptions = {
         //Boolean - If we should show the scale at all
         showScale: true,
         //Boolean - Whether grid lines are shown across the chart
         scaleShowGridLines: false,
         //String - Colour of the grid lines
         scaleGridLineColor: "rgba(0,0,0,.05)",
         //Number - Width of the grid lines
         scaleGridLineWidth: 1,
         //Boolean - Whether to show horizontal lines (except X axis)
         scaleShowHorizontalLines: true,
         //Boolean - Whether to show vertical lines (except Y axis)
         scaleShowVerticalLines: true,
         //Boolean - Whether the line is curved between points
         bezierCurve: true,
         //Number - Tension of the bezier curve between points
         bezierCurveTension: 0.3,
         //Boolean - Whether to show a dot for each point
         pointDot: false,
         //Number - Radius of each point dot in pixels
         pointDotRadius: 4,
         //Number - Pixel width of point dot stroke
         pointDotStrokeWidth: 1,
         //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
         pointHitDetectionRadius: 20,
         //Boolean - Whether to show a stroke for datasets
         datasetStroke: true,
         //Number - Pixel width of dataset stroke
         datasetStrokeWidth: 2,
         //Boolean - Whether to fill the dataset with a color
         datasetFill: true,
         //String - A legend template
         legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
         //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
         maintainAspectRatio: true,
         //Boolean - whether to make the chart responsive to window resizing
         responsive: true
      };

      //Create the line chart
      salesChart.Line(salesChartData, salesChartOptions);

   });


   //occupancy report

   $(function() {
      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $("#oChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var salesChart = new Chart(salesChartCanvas);

      var salesChartData = {
         labels: [<?php foreach ($weekdata as $ind   => $val) {
                     echo '"' . tgl_indo($val['date']) . '",';
                  } ?>],
         //labels: ["January", "February", "March", "April", "May", "June", "July"],
         datasets: [{
               label: "Digital Goods",
               fillColor: "rgba(60,141,188,0.9)",
               strokeColor: "rgba(60,141,188,0.8)",
               pointColor: "#3b8bba",
               pointStrokeColor: "rgba(60,141,188,1)",
               pointHighlightFill: "#fff",
               pointHighlightStroke: "rgba(60,141,188,1)",
               data: [<?php foreach ($weekdata as $ind   => $val) {
                           echo (!empty($val['total'])) ? $val['total'] . ',' : '0,';
                        } ?>]
            },
            /*{
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }*/
         ]
      };

      var salesChartOptions = {
         //Boolean - If we should show the scale at all
         showScale: true,
         //Boolean - Whether grid lines are shown across the chart
         scaleShowGridLines: false,
         //String - Colour of the grid lines
         scaleGridLineColor: "rgba(0,0,0,.05)",
         //Number - Width of the grid lines
         scaleGridLineWidth: 1,
         //Boolean - Whether to show horizontal lines (except X axis)
         scaleShowHorizontalLines: true,
         //Boolean - Whether to show vertical lines (except Y axis)
         scaleShowVerticalLines: true,
         //Boolean - Whether the line is curved between points
         bezierCurve: true,
         //Number - Tension of the bezier curve between points
         bezierCurveTension: 0.3,
         //Boolean - Whether to show a dot for each point
         pointDot: false,
         //Number - Radius of each point dot in pixels
         pointDotRadius: 4,
         //Number - Pixel width of point dot stroke
         pointDotStrokeWidth: 1,
         //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
         pointHitDetectionRadius: 20,
         //Boolean - Whether to show a stroke for datasets
         datasetStroke: true,
         //Number - Pixel width of dataset stroke
         datasetStrokeWidth: 2,
         //Boolean - Whether to fill the dataset with a color
         datasetFill: true,
         //String - A legend template
         legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
         //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
         maintainAspectRatio: true,
         //Boolean - whether to make the chart responsive to window resizing
         responsive: true
      };

      //Create the line chart
      salesChart.Line(salesChartData, salesChartOptions);

   });
</script>