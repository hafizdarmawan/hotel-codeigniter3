<link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10 col-lg-10">
            <div class="card">
               <div class="card-header">
                  <h3>Step 2</h3>
               </div>
               <div class="card-body">
                  <form method="post">
                     <table class="table table-striped table-hover">
                        <tr>
                           <th>Tipe Kamar</th>
                           <td><?= $booking['tipe_kamar'] ?> </td>
                        </tr>
                        <tr>
                           <th>Tanggal Booking</th>
                           <td> Booking dari <?= tgl_indo($booking['check_in']) ?> --sampai-- <?= tgl_indo($booking['check_out']); ?></td>
                        </tr>
                        <tr>
                           <th>Jumlah/ Malam</th>
                           <td><?= $booking['nights'] ?> Malam</td>
                        </tr>
                        <tr>
                           <th>Total Pembayaran</th>
                           <td>
                              <?php if (!empty($voucher_data)) : ?>
                                 <strike>
                                    <p style="font-weight: bold;">Rp. <?= rate_exchange($booking['totalamount']) ?> </p>
                                 </strike>
                              <?php else : ?>
                                 <p style="font-weight: bold;">Rp. <?= rate_exchange($booking['totalamount']) ?> </p>
                              <?php endif ?>
                           </td>
                        </tr>
                        <?php if (!empty($coupon_data)) { ?>
                           <tr>
                              <th>Voucher</th>
                              <td>
                                 <p style="font-weight: bold;">- Rp. <?= rate_exchange($coupon_data['discount']) ?> </p>
                              </td>
                           </tr>
                           <?php if (!empty($coupon_data['paid_service_applied'])) { ?>
                              <tr>
                                 <th>Gratis layanan</th>
                                 <td>
                                    <p style="font-weight: bold;">- Rp. <?= rate_exchange($coupon_data['services_total']) ?> (<?= @$coupon_data['services'] ?>)</p>
                                 </td>
                              </tr>
                           <?php } ?>
                           <tr>
                              <th>Total</th>
                              <td>
                                 <p style="font-weight: bold;">Rp. <?= rate_exchange($coupon_data['totalamount']) ?> </p>
                              </td>
                           </tr>
                        <?php } ?>
                        <tr>
                           <th>Uang Muka - <?= $this->setting->pembayaran_dp ?>%</th>
                           <td>

                           </td>
                        </tr>
                        <?php
                        $tgl1 = new DateTime($booking['check_in']);
                        echo $tgl1;
                        $tgl2 = new DateTime(date("Y-m-d"));
                        $d = $tgl2->diff($tgl1)->days;
                        ?>
                        <tr>
                           <th>Metode Pembayaran</th>
                           <td>
                              <?php if ($this->setting->midtrans == 1) { ?>
                                 <input type="radio" name="payment_gateway" value="1" <?= $this->setting->pay_on_arrival == '' || $d >= 1 ? 'checked="checked"' : '' ?> /> Midtrans
                              <?php } ?>
                              <?php if ($d <= 1) { ?>
                                 <?php if ($this->setting->pay_on_arrival == 1) { ?>
                                    <input type="radio" name="payment_gateway" value="2" /> Bayar di hotel
                                 <?php } ?>
                              <?php } ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Voucher</th>
                           <td>
                              <div class="col-md-5 input-group">
                                 <input type="text" name="voucher" id="voucher" class="form-control" placeholder='KODE VOUCHER' autocomplete="off" />
                                 <span class="input-group-btn" >
                                    <button class="btn btn-primary btn-block" type="submit" name="voucher_apply" value="apply">Apply</button>
                                 </span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <th></th>
                           <td>
                              <div class="pull-right">
                                 <input type="submit" name="pay" value="Bayar" class="btn btn-primary" />
                              </div>
                           </td>
                        </tr>
                     </table>
                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script>
   $(document).ready(function() {
      $('input[type="radio"],input[type="checkbox"]').iCheck({
         checkboxClass: 'icheckbox_square-blue',
         radioClass: 'iradio_square-blue',
         increaseArea: '20%' // optional
      });
   });
</script>

<script>
   
</script>