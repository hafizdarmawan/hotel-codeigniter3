 <link rel="stylesheet" href="<?= base_url('assets/front/assets/plugins/datepicker/') ?>datepicker3.css" />
 <!-- <section class="content-header"> -->
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
                   <li class="breadcrumb-item active"><?= $page_title ?></li>
                </ol>
             </div>
          </div>
       </div><!-- /.container-fluid -->
    </section>
    <section class="content">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-outline card-info shadow">
                <!-- <div class="card-header">
                      <h3 class="card-title">
                   </div> -->
                <!-- <div class="card-body pad">
                      <form method="post">
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2"></div>
                               <div class="col-md-4">
                                  <select name="id_tipe_kamar" class="form-control" onchange="this.form.submit();">
                                     <option value="">Filter Tipe Kamar</option>
                                     <?php foreach ($tipe_kamar as $rt) { ?>
                                        <option value="<?= $rt->id_tipe_kamar ?>" <?= ($rt->id_tipe_kamar == @$_POST['id_tipe_kamar']) ? 'selected="selected"' : '' ?>><?= $rt->judul ?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-2">
                                  <input type="date" name="check_in" value="<?= @$_POST['check_in'] ?>" class="form-control" placeholder='Check In' autocomplete="off" />
                               </div>
                               <div class="col-md-2">
                                  <input type="date" name="check_out" value="<?= @$_POST['check_out'] ?>" class="form-control" onchange="this.form.submit();" placeholder='Check Out'' autocomplete="off" />
                                </div>
                            </div>
                         </div>
                      </form>
                   </div> -->
                <div class="card-body">
                   <div class="table-responsive">
                      <table class="table table-bordered table-striped shadow" id="example1" style="text-align: center;">
                         <thead>
                            <tr style="background-color:#F0FFF0;">
                               <th>KODE ORDER</th>
                               <th>KAMAR</th>
                               <th>CHECK-IN</th>
                               <th>CHECK-OUT</th>
                               <th>PEMBAYARAN</th>
                               <th>AKSI</th>
                            </tr>
                         </thead>
                         <tbody id="show_data">
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
 </div>
 </section>
 <script src="<?= base_url('assets/front/assets/') ?>plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script type="text/javascript">
    $(function() {
       $('#example1').dataTable({});
       $('.datepicker').datepicker({
          todayHighlight: true,
          autoclose: true,
          format: 'yyyy-mm-dd',
       });
    });
 </script>
 <script type="text/javascript">
    $(document).ready(function() {
       tampil_data_barang(); //pemanggilan fungsi tampil barang.
       $('#mydata').dataTable();
       //fungsi tampil barang
       function tampil_data_barang() {
          $.ajax({
             type: 'ajax',
             url: '<?php echo base_url() ?>backend/booking/index_booking',
             async: false,
             dataType: 'json',
             success: function(data) {
                var html = '';
                var i;
                var link_detail = '<?= base_url('admin/booking/detail/') ?>'
                for (i = 0; i < data.length; i++) {
                   if (data[i].status_code == 200) {
                      $data = '<a class="btn btn-sm btn-success shadow">Berhasil</a>'
                      $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'

                   } else if (data[i].status_kode == 202 || data[i].status_kode == 0) {
                      $data = '<a class="btn btn-sm btn-danger shadow">Gagal</a>'
                      $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'
                   } else if (data[i].status_kode == 201) {
                      $data = '<a class="btn btn-sm btn-warning shadow">Pendding</a>'
                      $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'
                   }
                   html += '<tr>' +
                      '<td>' + data[i].no_order + '</td>' +
                      '<td>' + data[i].judul + '</td>' +
                      '<td>' + data[i].check_in + '</td>' +
                      '<td>' + data[i].check_out + '</td>' +
                      '<td>' + $data + '</td>' +
                      '<td>' + $btn_detail + '</td>'
                   '</tr>';
                }
                $('#show_data').html(html);
             }
          });
       }
    });
 </script>

 <script type="text/javascript">
    var refInterval = window.setInterval('tampil_data_barang()', 2000); // 30 seconds
    tampil_data_barang(); //pemanggilan fungsi tampil barang.
    $('#mydata').dataTable();

    function tampil_data_barang() {
       $.ajax({
          type: 'ajax',
          url: '<?php echo base_url() ?>backend/booking/index_booking',
          async: false,
          dataType: 'json',
          success: function(data) {
             var html = '';
             var i;
             var link_detail = '<?= base_url('admin/booking/detail/') ?>'
             for (i = 0; i < data.length; i++) {
                if (data[i].status_kode == 200) {
                   $data = '<a class="btn btn-sm btn-success shadow">Berhasil</a>'
                   $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'
                } else if (data[i].status_kode == 202 || data[i].status_kode == 0) {
                   $data = '<a class="btn btn-sm btn-danger">Gagal</a>'
                   $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'
                } else if (data[i].status_kode == 201) {
                   $data = '<a class="btn btn-sm btn-warning">Pendding</a>'
                   $btn_detail = '<a href="' + link_detail + data[i].id_order + '" class="btn btn-primary shadow">Detail Order</a>'
                }

                html += '<tr>' +
                   //  '<td>' + i + '</td>' +
                   '<td>' + data[i].no_order + '</td>' +
                   '<td>' + data[i].judul + '</td>' +
                   '<td>' + data[i].check_in + '</td>' +
                   '<td>' + data[i].check_out + '</td>' +
                   '<td>' + $data + '</td>' +
                   '<td>' + $btn_detail + '</td>'
                '</tr>';
             }
             $('#show_data').html(html);
          }
       });
    }
 </script>