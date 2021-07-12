<?php
$coupon_data   =   $this->session->userdata('coupon_data');
//price & tax calculation
$nights   =   GetDays($_POST['check_in'], $_POST['check_out']) - 1;

$base_price   =   get_price($_POST['check_in'], $_POST['check_out'], $_POST['tipe_kamar'], $_POST['adults'], $_POST['kids']);
print_r($base_price);
// echo '<pre>'; print_r($base_price);die;
if ($nights == 0) {
   $nights = 1;
}
//$amount	=	$room_type->base_price * $_GET['adults'] * $nights;	//old
$amount      =   $base_price['total_price'];
// $taxamount   = get_tax_amount($amount);
$amount      =   rate_exchange($amount);

$taxamount   =   rate_exchange($taxamount);
$total       =   $amount + $taxamount;
if (!empty($_POST['total'])) {
   $total      =   $_POST['total'];
}
?>
<input type="text" name="adults" value="<?= $_POST['adults'] ?>" id="adults" />
<input type="hidden" name="nights" value="<?= $nights ?>" id="nights" />
<input type="hidden" name="total" value="<?= $total; ?>" id="total" />
<div class="form-group">
   <div class="row">
      <div class="col-md-12">
         <?php   // echo '<pre>'; print_r($_POST);echo '</pre>';
         ?>
         <table class="table" border="1">
            <tr>
               <th class="success">Dewasa</th>
               <td class="table-active"><?= @$_POST['adults']; ?></td>
            </tr>
            <tr>
               <th class="success">Anak-anak</th>
               <td class="table-active"><?= @$_POST['kids']; ?></td>
            </tr>
            <tr>
               <th class="success">Malam</th>
               <td class="table-active"><?= $nights; ?></td>
            </tr>
            <tr>
               <th class="success">Biaya Per Malam</th>
               <td class="table-active">
                  <table width="100%" border="0">
                     <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <td align="right"><b>Harga</b></td>
                        <?php if ($base_price['additional_person_amount'] > 0) { ?>
                           <td align="center"><b>Tambah Tamu</b></td>
                           <td><b>Total</b></td>
                        <?php } ?>

                     </tr>
                     <?php $i = 1;
                     foreach ($base_price['price_details'] as $key   => $val) { ?>
                        <tr>
                           <td><?= $i ?>.</td>
                           <td><?= date_convert($key) ?></td>
                           <td align="right">Rp. <?= rate_exchange($val['price']) ?></td>
                           <?php if ($val['add_person'] > 0) { ?>
                              <td align="center"><?= $val['add_person']; ?> &times; Rp. <?= rate_exchange($val['add_person_price']); ?> = <?= rate_exchange($val['add_person_price'] * $val['add_person']); ?></td>
                              <td> Rp. <?= rate_exchange($val['price']   + $val['add_person_price'] * $val['add_person']) ?></td>
                           <?php } ?>

                        </tr>
                     <?php $i++;
                     } ?>
                     <tr>
                        <td></td>
                        <td align=""><b>Total Biaya</b></td>
                        <td align="right"> <b> Rp. <?= rate_exchange($base_price['amount']) ?></b></td>
                        <?php if ($base_price['additional_person_amount'] > 0) { ?>
                           <td align="center"><b>Rp. <?= rate_exchange($base_price['additional_person_amount']) ?></b></td>
                           <td><b>Rp. <?= $amount; ?></b></td>
                        <?php } ?>
                     </tr>
                  </table>

               </td>
            </tr>
           
            <?php if (!empty($layanan)) { ?>
               <tr>
                  <th class="success">Layanan</th>
                  <td class="table-active">
                     <table width="100%">
                        <?php $i = 1;
                        foreach ($layanan as $serv) {
                           $checked = '';
                           if (!empty($_POST['paid_services'])) {
                              $checked   =   '';
                              if (in_array($serv->id, $_POST['paid_services'])) {
                                 $checked   =   'checked="checked"';
                              }
                           }
                        ?>
                           <tr>
                              <td><?= $i ?></td>
                              <td><?= $serv->judul ?></td>
                              <td><input type="checkbox" name="paid_services[]" value="<?= $serv->id_layanan ?>" <?= $checked; ?> class="paid_service" /></td>
                              <td>Rp. <?= rate_exchange($serv->biaya) ?></td>
                              <td><?php
                                    $tipe_biaya   =   '';
                                    if ($serv->tipe_biaya == 1) {
                                       $tipe_biaya   =   'Per Orang';
                                    }
                                    if ($serv->tipe_biaya == 2) {
                                       $tipe_biaya   =   'Per Orang';
                                    }
                                    if ($serv->tipe_biaya == 3) {
                                       $tipe_biaya   =   'Biaya Tetap';
                                    }
                                    echo $tipe_biaya;
                                    ?>
                              </td>
                           </tr>
                           <tr>
                              <td colspan="4" style="height:5px"></td>
                           </tr>
                        <?php $i++;
                        } ?>
                     </table>
                  </td>
               </tr>
            <?php } ?>
            <tr>
               <th class="success">Jumlah Total</th>
               <th class="table-active" id="grand_total">Rp. <?= $total; ?></th>
            </tr>
            <tr class="hide">
               <th class="success">Voucher</th>
               <th class="table-active">
                  <table>
                     <tr>
                        <td><input type="text" name="coupon" id="coupon" placeholder='Voucher' autocomplete="off" class="form-control" style="width:80%" /></td>
                        <td><button type="button" name="coupon_apply" id="coupon_apply" value="coupon_apply" class="btn btn-success">Apply</button></td>
                     </tr>
                  </table>

               </th>
            </tr>

         </table>

      </div>
   </div>
</div>

<script>
   $('.paid_service').on('click', function(event) {
      //alert($(this).val()); // alert value

      var total = $('#total').val();
      var id = $(this).val();
      var nights = $('#nights').val();
      var adults = $('#adults').val();
      var symb = '<?= $this->setting->currency_symbol; ?>';
      if (id) {
         call_loader();
         if (this.checked == true) {
            $.ajax({
               url: '<?= site_url('admin/bookings/add_service_price') ?>',
               type: 'POST',
               data: {
                  id: id,
                  total: total,
                  adults: adults,
                  nights: nights
               },
               success: function(result) {
                  if (result) {
                     $('#total').val(result);
                     $('#grand_total').text('');
                     $('#grand_total').html(symb + '' + result);
                  }
               }
            });

         } else {
            $.ajax({
               url: '<?= site_url('admin/bookings/less_service_price') ?>',
               type: 'POST',
               data: {
                  id: id,
                  total: total,
                  adults: adults,
                  nights: nights
               },
               success: function(result) {

                  if (result) {
                     remove_loader();
                     $('#total').val(result);
                     $('#grand_total').text('');
                     $('#grand_total').html(symb + '' + result);
                  }

               }
            });
         }
         remove_loader();


      }
   });

   $('#coupon_apply').on('click', function(event) {
      var coupon = $('#coupon').val();
      var guest_id = $('#guest_id').val();
      //alert(guest_id);return false;
      if (coupon) {
         call_loader();
         $.ajax({
            url: '<?= site_url('admin/bookings/apply_coupon') ?>',
            type: 'POST',
            //data:{coupon:coupon,guest_id:guest_id},
            data: $('#add_form').serialize(),
            success: function(result) {
               if (result == 1) {
                  remove_loader();
                  get_order_data();
               } else {
                  remove_loader();
                  toastr.error(result);
               }
            }
         });
         remove_loader();
      }
   });
</script>