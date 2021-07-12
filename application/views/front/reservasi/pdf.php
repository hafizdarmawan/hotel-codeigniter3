<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Hotel Al Ashri| Invoice Print</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/adminlte.min.css">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
   <div class="wrapper">
      <section class="invoice">
         <div class="row">
            <div class="col-12">
               <h2 class="page-header">
                  <img src="<?= base_url('assets/img/logo/' . $this->setting->logo) ?>" height="60" width="80" />
                  <small class="float-right">Tanggal:<?= date('d/m/Y') ?></small>
               </h2>
            </div>
         </div>
         <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
               <address>
                  <strong><?= $this->setting->nama; ?></strong><br>
                  <?= $this->setting->alamat; ?><br>
                  No Tlp: <?= $this->setting->no_telepon; ?><br>
                  Email: <?= $this->setting->email; ?>
               </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
               <address>
                  <strong></strong><br>
                  Nama : <?= $order->nama_depan ?> <?= $order->nama_belakang ?> <br>
                  No Tlp : <?= $order->no_telepon ?><br>
                  Email : <?= $order->email ?> <br>
               </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
               <b>Invoice #007612</b><br>
               <b>Kode Order:</b><?= $order->no_order ?><br>
               <b>Tgl Order :</b><?= $order->tgl_order ?><br>
               <b>Check In/Out:</b> <?= tgl_indo($order->check_in) ?> s/d <?= tgl_indo($order->check_out) ?><br>
               <b>Pembayaran :</b>
               <?php if ($order->status_kode == 200) : ?>
                  Lunas
               <?php elseif ($order->status_kode == 201) : ?>
                  Menunggu
               <?php elseif ($order->status_kode == 0 || $order->status_kode == 0) : ?>
                  Gagal
               <?php endif ?>
            </div>
         </div>
         <div class="row">
            <div class="col-12 table-responsive">
               <table class="table table-striped" style="width: 100%;">
                  <thead>
                     <tr>
                        <td style="width: 10%;">#</td>
                        <th style="width: 30%;">Tipe Kamar</th>
                        <th style="width: 30%;">Tanggal</th>
                        <th style="width: 30%;">Subtotal</th>
                     </tr>
                  </thead>
                  <tbody>

                     <?php $i = 1;
                     $total_kamar = 0;
                     ?>
                     <?php foreach ($prices as $new) : ?>
                        <tr>
                           <td><?= $i++ ?></td>
                           <td><?= $order->tipe_kamar ?></td>
                           <td><?= tgl_indo($new->tanggal) ?></td>
                           <!-- <td>Layanan</td> -->
                           <td>Rp <?= rupiah($new->harga) ?></td>
                           <?php $total_kamar = $total_kamar + $new->harga ?>
                        </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
            <?php if (!empty($services)) { ?>
               <div class="col-12 table-responsive">
                  <table class="table table-striped" style="width: 100%;">
                     <thead>
                        <tr>
                           <th style="width: 10%;">#</th>
                           <th style="width: 30%;">Layanan</th>
                           <th style="width: 30%;">Jumlah</th>
                           <th style="width: 30%;">Biaya</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i = 1;
                        $total_layanan = 0;
                        ?>
                        <?php foreach ($services as $serv) {
                           $fs   =   json_decode($booking->free_paid_services);
                           $stl   =   '';
                           if (!empty($fs)) {
                              $stl      =   (in_array($serv->id_layanan, $fs)) ? 'stl' : '';
                           } ?>
                           <tr>
                              <td><?= $i++ ?></td>
                              <td><?= $serv->judul ?></td>
                              <td><?= $order->dewasa ?> Porsi</td>
                              <td>Rp <?= rupiah($serv->total); ?>
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
                                 <?php $total_layanan = $total_layanan+$serv->total  ?>
                              </td>
                           </tr>
                        <?php $i++;
                        } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
         </div>
         <div class="row">
            <!-- <?php print_r($order->metode_pembayaran) ?> -->
            <div class="col-6">
               <!-- <p class="lead">Payment Methods: <?= $order ?> Transfer Bank</p> -->
            </div>
            <div class="col-6">
               <div class="table-responsive">
                  <table class="table">
                     <tr>
                        <th style="width:40%">Subtotal:</th>
                        <td>Rp <?= rupiah($total_layanan+$total_kamar) ?></td>
                     </tr>
                     <?php if (!empty($order->voucher)) : ?>
                        <tr>
                           <th>Diskon:</th>
                           <td>Rp <?= rupiah($order->voucher_diskon) ?></td>
                        </tr>
                        <tr>
                           <th>Total:</th>
                           <td>Rp <?= rupiah($order->total_sudah_voucher) ?></td>
                        </tr>
                     <?php endif ?>
                  </table>
               </div>
            </div>
         </div>
      </section>
   </div>
   <script type="text/javascript">
      window.addEventListener("load", window.print());
   </script>
</body>