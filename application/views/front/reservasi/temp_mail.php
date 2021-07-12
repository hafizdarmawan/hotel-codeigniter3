<table class="table" border="1" id="printbooking" width="100%">
   <tr class="success">
      <td colspan="4">
         <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
               <td align="center">
                  <img src="<?= base_url('assets/img/logo/' . $this->setting->logo) ?>" height="60" width="102" />
               </td>
            </tr>
            <tr>
               <td align="center">
                  <b style="font-size:24px"><?= $this->setting->name; ?></b>
               </td>
            </tr>
            <tr>
               <td align="center">
                  <b style="font-size:16px"><?= $this->setting->address; ?></b>
               </td>
            </tr>
         </table>
      </td>
   </tr>
   <tr>
      <th class="success col-md-2 col-sm-4 col-xs-4">No Order</th>
      <td class="table-active col-md-4 col-sm-4 col-xs-4"><?= $order->order_no ?></td>
      <th class="success col-md-2 col-sm-4 col-xs-4">Waktu Pemesanan</th>
      <td class="table-active col-md-4 col-sm-4 col-xs-4"><?= date_time_convert($order->ordered_on) ?></td>

   </tr>

   <tr>
      <th class="success">Nama Depan</th>
      <td class="table-active"><?= $order->nama_depan ?> <?= $order->nama_belakang ?></td>
   </tr>
   <tr>
      <th class="success">Check-In</th>
      <td class="table-active"><?= tgl_indo($order->check_in) ?></td>
      <th class="success">Check-Out</th>
      <td class="table-active"><?= tgl_indo($order->check_out); ?></td>
   </tr>

   <tr>
      <th class="success">Dewasa</th>
      <td class="table-active"><?= $order->adults ?></td>
      <th class="success">Anak-anak</th>
      <td class="table-active"><?= $order->kids ?></td>
   </tr>
   <tr>
      <th class="success">Tipe Kamar</th>
      <td class="table-active"><?= $order->tipe_kamar ?></td>
      <th class="success">Jumlah/ Malam</th>
      <td class="table-active"><?= $order->nights ?></td>
   </tr>
   <tr>
      <th class="success">Status Pemesanan</th>
      <td class="table-active"><?= ($order->status == 1) ? 'Success' : '' ?> <?= ($order->status == 2) ? 'Canceled' : '' ?><?= ($order->status == 0) ? 'Pending' : ''; ?></td>
      <th class="success">Status Pembayaran</th>
      <td class="table-active">
         <?= ($order->payment_status == 1) ? 'Success' : '' ?> <?= ($order->payment_status == 2) ? 'Pending' : '' ?><?= ($order->payment_status == 0) ? 'Failed' : ''; ?> <?= ($order->payment_status == 3) ? 'Partialy paid' : ''; ?>
      </td>
   </tr>
   <tr>
      <th class="success">Biaya Permalam</th>
      <td class="table-active" colspan="3">
         <?php if ($order->additional_person > 0) {
            $width   =   '100%';
         } else {
            $width   =   '40%';
         }
         ?>
         <table width="<?= $width ?>" border="0">
            <tr>
               <th align="left"><b>#</b></th>
               <td align="center"><b>Tanggal</b></td>
               <td align="right"><b>Biaya</b></td>
            </tr>
            <?php $i = 1;
            foreach ($prices as $new) { ?>
               <tr>
                  <td><?= $i ?>.</td>
                  <td align="center"><?= date_convert($new->date) ?></td>
                  <td align="right"><?= $order->cs ?> <?= rate_exchange_order($new->price, $order->currency_unit) ?></td>
               </tr>
            <?php $i++;
            } ?>
            <tr>
               <td></td>
               <td align="center"><b>Total Biaya</b></td>
               <td align="right"> <b> <?= $order->cs ?> <?= rate_exchange_order($order->amount   -    $order->additional_person_amount, $order->currency_unit) ?></b></td>
               <?php if ($order->additional_person > 0) { ?>
                  <td align="center"><b> <?= $order->cs ?> <?= rate_exchange_order($order->additional_person_amount, $order->currency_unit) ?></b></td>
                  <td><b><?= $order->cs ?> <?= rate_exchange_order($order->amount, $order->currency_unit); ?></b></td>
               <?php } ?>
            </tr>
         </table>
      </td>
   </tr>
   <tr>
      <th class="success">Jumlah</th>
      <td class="table-active" colspan="3">
         <p style="text-align: right;margin-right: 135px; font-weight: bold;""><?= $order->cs ?> <?= rate_exchange_order($order->amount, $order->currency_unit); ?></b></td>
   </tr>
   <tr>
      <th class=" success">Pajak</th>
      <td class="table-active" colspan="3">

         <table width="100%" border="0">
            <?php $i = 1;
            foreach ($taxes as $t) { ?>
               <tr>
                  <td><?= $i ?>.</td>
                  <td><?= $t->name ?></td>
                  <td><?= ($t->type == 'Fixed') ? '$' : '' ?><?= $t->rate ?> <?= ($t->type == 'Percentage') ? '%' : '' ?></td>
                  <td><?= $order->cs ?> <?= rate_exchange_order($t->amount, $order->currency_unit); ?></td>
               </tr>
            <?php $i++;
            } ?>
            <tr>
               <td></td>
               <td colspan="2" align=""><b>Total Pajak</b></td>
               <td><b><?= $order->cs ?> <?= rate_exchange_order($order->taxamount, $order->currency_unit); ?></b></td>
            </tr>
         </table>
      </td>
   </tr>
   <?php if (!empty($services)) { ?>
      <tr>
         <th class="success">Layanan Berbayar</th>
         <td class="table-active" colspan="3">
            <table width="100%">
               <?php $i = 1;
               foreach ($services as $serv) {
                  $fs   =   json_decode($order->free_paid_services);
                  $stl   =   '';
                  if (!empty($fs)) {
                     $stl      =   (in_array($serv->id_service, $fs)) ? 'stl' : '';
                  }
               ?>
                  <tr>
                     <td><?= $i; ?></td>
                     <td><?= $serv->title ?></td>
                     <td class="<?= $stl ?>">&nbsp; <?= $order->cs ?> <?= rate_exchange_order($serv->amount, $order->currency_unit); ?></td>
                     <td><?php
                           $price_type   =   '';
                           if ($serv->price_type == 1) {
                              $price_type   =  'Per Orang';
                           }
                           if ($serv->price_type == 2) {
                              $price_type   =  'Per Malam';
                           }
                           if ($serv->price_type == 3) {
                              $price_type   =  'Biaya Tetap';
                           }
                           echo $price_type;
                           ?>
                     </td>
                  </tr>

               <?php $i++;
               } ?>
               <tr>
                  <td></td>
                  <td colspan="1" align=""><b>Total Layanan</b> <span class="pull-right"></span> </td>
                  <?php if ($order->free_paid_services_amount > 0) { ?>
                     <td> <b> &nbsp; <?= $order->cs ?> <?= rate_exchange_order($order->paid_service_amount - $order->free_paid_services_amount, $order->currency_unit); ?></b></td>
                  <?php } else { ?>
                     <td> <b> &nbsp; <?= $order->cs ?> <?= rate_exchange_order($order->paid_service_amount, $order->currency_unit); ?></b></td>
                  <?php } ?>
               </tr>
            </table>
         </td>
      </tr>
   <?php } ?>
   <?php if (!empty($order->coupon)) { ?>
      <tr>
         <th class="success">coupon</th>
         <th class="table-active" id="grand_total" colspan="3">-<?= $order->cs ?> <?= rate_exchange_order($order->coupon_discount, $order->currency_unit); ?></th>
      </tr>
   <?php } ?>
   <?php if ($order->free_paid_services_amount > 0) { ?>
      <tr>
         <th class="success">free_services</th>
         <td class="table-active" colspan="3"> <b>-<?= $order->cs ?> <?= rate_exchange_order($order->free_paid_services_amount, $order->currency_unit) ?> (<?= @$order->free_paid_services_title ?>)</b></td>
      </tr>
   <?php } ?>
   <tr>
      <th class="success">Jumlah Bayar</th>
      <th class="table-active" id="grand_total" colspan="3">
         <p style="text-align: right;margin-right: 135px; font-weight: bold;"> <?= $order->cs ?> <?= rate_exchange_order($order->totalamount, $order->currency_unit); ?></p>
      </th>
   </tr>

</table>
<div class="pull-right">
   <button type="submit" id="print" class="btn btn-primary">Print</button>
   <a href="<?= site_url('account/download/struck/' . $order->id_order) ?>" class="btn btn-primary"> <i class="fa fa-download"></i> Download</a>
</div>