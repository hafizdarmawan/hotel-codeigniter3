<link type="text/css" href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<link type="text/css" href="<?= base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?= base_url('assets/admin/plugins/responsivetabs/style.css') ?>" rel="stylesheet" />
<!-- <link type="text/css" href="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" /> -->
<link type="text/css" href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">
<link href="<?= base_url('assets/admin/plugins/toastr') ?>/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
<?php $seg = $this->uri->segment(4); ?>
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
      <div class="container-fluid">
         <?php
         if ($booking->status_kode == 200) {
            $status_pembayaran   =   '<a href ="" class="btn btn-sm btn-success shadow"><strong>Lunas</strong></a>';
         }
         if ($booking->status_kode == 201) {
            $status_pembayaran   =   '<a href ="" class="btn btn-sm btn-warning shadow"><strong>Panding</strong></a>';
         }
         if ($booking->status_kode == 202 || $booking->status_kode == 0) {
            $status_pembayaran   =   '<a href ="" class="btn btn-sm btn-danger shadow"><strong>Gagal</strong></a>';
         }
         ?>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-outline card-info shadow">
                     <div class="card-header p-2">
                        <ul class="nav nav-pills">
                           <li class="nav-item"><a class="nav-link shadow ml-2 active" href="#detail" data-toggle="tab">Detail Riwayat</a></li>
                        </ul>
                     </div><!-- /.card-header -->
                     <div class="card-body">
                        <div class="tab-content">
                           <div class="active tab-pane" id="detail">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <h2 class="page-header">
                                       <img src="<?= base_url('assets/img/logo/' . $setting->logo) ?>" width="70" /></i>
                                       <!-- <small class="pull-right"><?= 'Tanggal Booking' ?>: <?= date_time_convert($booking->tgl_order); ?></small> -->
                                    </h2>
                                 </div><!-- /.col -->
                              </div>
                              <div class="row invoice-info">
                                 <div class="col-sm-4 invoice-col">
                                    <p class="text-bold">Detail Hotel</p>
                                    <address>
                                       <strong><?= $setting->nama ?></strong><br>
                                       <?= wordwrap($setting->alamat, 50, "<br>\n"); ?><br>
                                       <?= 'phone' ?>: <?= $setting->no_telepon ?><br />
                                       <?= 'email' ?>: <?= $setting->email ?>
                                    </address>
                                 </div>
                                 <div class="col-sm-4 invoice-col">
                                    <p class="text-bold">Detail Tamu Hotel</p>
                                    <address>
                                       <table>
                                          <tr>
                                             <th>Nama</th>
                                             <td>:</td>
                                             <td><?= $booking->nama_depan ?> <?= $booking->nama_belakang ?></td>
                                          </tr>
                                          <tr>
                                             <th>Email</th>
                                             <td>:</td>
                                             <td><?= $booking->email_tamu ?></td>
                                          </tr>
                                          <tr>
                                             <th>No Telepon</th>
                                             <td>:</td>
                                             <td><?= $booking->no_telepon == '' ? '-' : $booking->no_telepon ?></td>
                                          </tr>
                                          <tr>
                                             <th>Alamat</th>
                                             <td>:</td>
                                             <td><?= $booking->alamat_tamu == '' ? '-' : $booking->alamat_tamu ?></td>
                                          </tr>
                                       </table>
                                    </address>
                                 </div><!-- /.col -->
                                 <div class="col-sm-4 invoice-col">
                                    <table width="100%">
                                       <tr>
                                          <th><b>No Order</b></th>
                                          <th>:</th>
                                          <td><?= $booking->no_order ?></td>
                                       </tr>

                                       <tr>
                                          <th><b>Tgl Order</b></th>
                                          <th>:</th>
                                          <td><?= tgl_indo($booking->tgl_order) . date_time_convert($booking->tgl_order); ?></td>
                                       </tr>
                                       <tr>
                                          <th><b>Tipe Kamar</b></th>
                                          <th>:</th>
                                          <td><?= $booking->room ?></td>
                                       </tr>
                                       <tr>
                                          <th><b>Jml Kamar</b></th>
                                          <th>:</th>
                                          <td><?= $booking->jml_kamar ?></td>
                                       </tr>
                                       <tr>
                                          <th><b>Check-In</b></th>
                                          <th>:</th>
                                          <td><?= tgl_indo($booking->check_in); ?></td>
                                       </tr>
                                       <tr>
                                          <th><b>Check-Out</b></th>
                                          <th>:</th>
                                          <td><?= tgl_indo($booking->check_out); ?></td>
                                       </tr>
                                       <!-- <tr>
                                       <th><b>Dewasa</b></th>
                                       <th>:</th>
                                       <td><?= $booking->dewasa ?></td>
                                    </tr> -->
                                       <tr>
                                          <th><b>Durasi</b></th>
                                          <th>:</th>
                                          <td><?= $booking->malam ?> Malam</td>
                                       </tr>
                                       <tr>
                                          <th><b>Status Pembayaran</b></th>
                                          <th>:</th>
                                          <td><?= $status_pembayaran; ?></td>
                                       </tr>
                                    </table>
                                 </div><!-- /.col -->
                              </div><!-- /.row -->
                              <div class="row mt-3">
                                 <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Kode Reservasi</th>
                                             <th>Tanggal</th>
                                             <td align="right"><b>Biaya</b></td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i = 1;
                                          foreach ($prices as $new) { ?>
                                             <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $new->kode_reservasi ?></td>
                                                <td><?= tgl_indo($new->tanggal) ?></td>
                                                <td align="right">Rp.<?= rupiah($new->harga) ?></td>
                                             </tr>
                                          <?php $i++;
                                          } ?>

                                       </tbody>
                                    </table>
                                 </div><!-- /.col -->
                              </div><!-- /.row -->
                              <?php if (!empty($services)) { ?>
                                 <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                       <table class="table table-striped">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Layanan Berbayar</th>
                                                <td align="right"><b>Biaya</b></td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php $i = 1;
                                             foreach ($services as $serv) {
                                                $fs   =   json_decode($booking->free_paid_services);
                                                $stl   =   '';
                                                if (!empty($fs)) {
                                                   $stl      =   (in_array($serv->id_layanan, $fs)) ? 'stl' : '';
                                                } ?>
                                                <tr>
                                                   <td><?= $i ?></td>
                                                   <td><?= $serv->judul ?> (<?= $booking->dewasa ?> Porsi)</td>
                                                   <td align="right">Rp.<?= rate_exchange_order($serv->total, $booking->biaya_unit); ?>
                                                      <?php
                                                      $price_type   =   '';
                                                      if ($serv->price_type == 1) {
                                                         $price_type   =   'Per Orang';
                                                      }
                                                      if ($serv->price_type == 2) {
                                                         $price_type   =   'Per Malam';
                                                      }
                                                      if ($serv->price_type == 3) {
                                                         $price_type   =   'Biaya Tetap';
                                                      }
                                                      echo $price_type;
                                                      ?>
                                                   </td>
                                                </tr>
                                             <?php $i++;
                                             } ?>
                                             <!-- <tr>
                                             <td></td>
                                             <td align=""><b></b></td>
                                             <td align="right"><b>Rp. <?= rate_exchange_order($booking->jumlah_layanan, $booking->biaya_unit); ?></b></td>
                                          </tr> -->
                                          </tbody>
                                       </table>
                                    </div><!-- /.col -->
                                 </div><!-- /.row -->
                              <?php } ?>
                              <div class="row">
                                 <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                       <tbody>
                                          <?php if (!empty($booking->voucher)) { ?>
                                             </tr>
                                             <td></td>
                                             <td align=""><b>Voucher</b></td>
                                             <td align="right"><b>-Rp. <?= rate_exchange_order($booking->voucher_diskon, $booking->biaya_unit); ?> (<?= strtoupper($booking->voucher) ?>)</b></td>
                                             </tr>
                                          <?php } ?>
                                          </tr>
                                          <td></td>
                                          <td align=""><b>Total Pembayaran</b></td>
                                          <td align="right"><b>Rp. <?= rate_exchange_order($booking->total_jumlah, $booking->biaya_unit); ?></b></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <?php if ($booking->status_kode = 200 || $booking->status_kode = 201) : ?>
                                 <div class="row">
                                    <div class="row no-print">
                                       <div class="col-xs-12">
                                          <a href="<?= site_url('account/download/struck/' . $booking->id_order) ?>" target="_bank" class="btn btn-primary shadow"><i class="fa fa-print"></i> Print Data</a>
                                       </div>
                                    </div>
                                 </div>
                              <?php endif ?>
                           </div>
                        </div>
                     </div><!-- /.card-body -->
                  </div>
               </div>
            </div>
         </div><!-- /.container-fluid -->
   </section>
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