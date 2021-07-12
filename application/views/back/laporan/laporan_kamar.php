<html lang="en">

<head>
   <!-- <meta charset="utf-8"> -->
   <title>Laporan Kamar Hotel Al Ashri Inn by Urban</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
   <style>
      @page {
         size: A4
      }

      h1 {
         font-weight: bold;
         font-size: 20pt;
         text-align: center;
      }

      table {
         border-collapse: collapse;
         width: 100%;
      }

      .table th {
         padding: 15px 15px;
         border: 1px solid #000000;
         text-align: center;
      }

      .table td {
         padding: 14px 14px;
         border: 1px solid #000000;
      }

      .text-center {
         text-align: center;
      }
   </style>
</head>

<body class="A4">
   <div class="sheet padding-10mm">
      <?php $setting = get_setting() ?>
      <!-- <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" alt="" style="width: 80px;"> -->
      <h3 style="text-align: center; text-transform: uppercase;">LAPORAN KAMAR <?= $setting->nama ?></h3>
      <p style="text-align: center; margin-top: 3px;"><?= $setting->alamat ?></p>
      <br><br>
      <b><?= $ket; ?></b><br /><br>
      <table class="table">
         <thead>
            <tr>
               <th>No</th>
               <th>No Order</th>
               <th>Nama Tamu</th>
               <th>Tipe Kamar</th>
               <th>No Kamar</th>
               <th>Tanggal</th>
               <th>Status Kamar</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1 ?>
            <?php foreach ($transaksi as $data) : ?>
               <?php $data_kamar = get_tipe_kamar_by_id($data->id_tipe_kamar) ?>
               <tr>
                  <td><?= $i ?></td>
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
                        <p href="">Booked</p>
                     <?php elseif ($data->status_reservasi == 2) : ?>
                        <p href="">Terisi</p>
                     <?php elseif ($data->status_reservasi == 3) : ?>
                        <p href="">Selesai</p>
                     <?php endif ?>
                  </td>
               </tr>
               <?php $i++ ?>
            <?php endforeach ?>
         </tbody>
      </table>
      <br>
      <div class="" style="margin-bottom: 40px;">
         <p style="text-align: right;">Tanggal <?= tgl_indo(date('Y-m-d')) ?></p>
         <br><br>
         <p style="text-align: right; margin-bottom: 30px;"><?= $this->session->userdata('nama_depan') ?> <?= $this->session->userdata('nama_belakang') ?></p>
      </div>
   </div>
</body>

</html>