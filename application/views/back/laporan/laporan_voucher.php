<html lang="en">

<head>
   <!-- <meta charset="utf-8"> -->
   <title>Laporan Penggunaan Voucher Hotel Al Ashri Inn by Urban</title>
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
      <h3 style="text-align: center; text-transform: uppercase;">LAPORAN voucher <?= $setting->nama ?></h3>
      <p style="text-align: center; margin-top: 3px;"><?= $setting->alamat ?></p>
      <br>
      <br>
      <b><?= $ket; ?></b><br /><br>
      <table class="table">
         <thead>
            <tr>
               <th>NO</th>
               <th>KODE ORDER</th>
               <th>TGL ORDER</th>
               <th>NAMA TAMU</th>
               <th>KODE VOUCHER</th>
               <th>NILAI VOUCHER</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1 ?>
            <?php foreach ($transaksi as $data) : ?>
               <tr>
                  <td><?= $i++?></td>
                  <td><?= $data->no_order ?></td>
                  <td><?= $data->tgl_order ?></td>
                  <td><?= $data->nama_depan . ' ' . $data->nama_belakang ?></td>
                  <td><?= $data->voucher ?></td>
                  <td>Rp <?= rupiah($data->voucher_diskon) ?></td>
               </tr>
            <?php endforeach ?>
         </tbody>
      </table>
      <br>
      <p style="text-align: right;">Tanggal <?= tgl_indo(date('Y-m-d')) ?></p>
      <br><br>
      <p style="text-align: right; margin-bottom: 30px;"><?= $this->session->userdata('nama_depan') ?> <?= $this->session->userdata('nama_belakang') ?></p>
   </div>
</body>

</html>