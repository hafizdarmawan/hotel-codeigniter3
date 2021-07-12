<html lang="en">

<head>
   <!-- <meta charset="utf-8"> -->
   <title>Laporan Pendapatan Hotel Al Ashri Inn by Urban</title>
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
      <h3 style="text-align: center; text-transform: uppercase;">LAPORAN KEUANGAN <?= $setting->nama ?></h3>
      <p style="text-align: center; margin-top: 3px;"><?= $setting->alamat ?></p>
      <br><br>
      <b><?= $ket; ?></b><br /><br>
      <table class="table">
         <thead>
            <tr>
               <th>No</th>
               <th>No Order</th>
               <th>Nama</th>
               <th>Bank</th>
               <th>Tanggal Bayar</th>
               <th>Status Bayar</th>
               <th>Biaya Tagihan</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1 ?>
            <?php $total = 0 ?>
            <?php foreach ($transaksi as $data) : ?>
               <tr>
                  <td><?= $i ?></td>
                  <td><?= $data->no_order ?></td>
                  <td><?= $data->nama_depan . ' ' . $data->nama_belakang ?></td>
                  <td><?= $data->bank ?></td>
                  <td><?= date_format(date_create($data->waktu), "d-m-Y") ?></td>
                  <td>
                     <?= $data->status_kode == 200 ? 'Lunas' : '' ?>
                     <?= $data->status_kode == 202 || $data->status_kode == 0 ? 'Gagal' : '' ?>
                  </td>
                  <td><?= 'Rp ' . number_format(rate_exchange($data->total)) ?></td>
                  <?php $total = ($total + $data->total) ?>
               </tr>
               <?php $i++ ?>
            <?php endforeach ?>
            <tr>
               <td colspan="6">
                  <p style="text-align: center; font-weight: bold;">Total</p>
               </td>
               <td>
                  <p style="font-weight: bold;">Rp <?= number_format($total) ?></p>
               </td>
            </tr>
         </tbody>
      </table>
      <br>
      <p style="text-align: right;">Tanggal <?= tgl_indo(date('Y-m-d')) ?></p>
      <br><br>
      <p style="text-align: right; margin-bottom: 30px;"><?= $this->session->userdata('nama_depan') ?> <?= $this->session->userdata('nama_belakang') ?></p>
   </div>
</body>

</html>