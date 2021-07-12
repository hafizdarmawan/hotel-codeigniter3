<link rel="stylesheet" href="<?= base_url('assets/front/') ?>/js/datepicker3.css">
<link href="<?= base_url('assets/admin/plugins/toastr') ?>/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
<style>
   .datepicker table tr td.disabled,
   .datepicker table tr td.disabled:hover {
      background: #CCCCCC;
      color: #444;
      cursor: default;
   }
</style>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark"><?= $page_title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active"><?= $page_title ?></li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-outline card-info shadow">
               <div class="card-header">
                  <h3 class="card-title">
                  </h3>
               </div>
               <div class="card-body pad">
                  <form method="post" enctype="multipart/form-data" id="add_form">
                     <table class="table table-striped ">
                        <tr>
                           <th class="success">Detail</th>
                           <td class="table-active"><?= $booking['room_type'] ?> <?= $booking['nights'] ?> Nights Booking From <?= date('d/m/Y', strtotime($booking['check_in'])) ?> to <?= date('d/m/Y', strtotime($booking['check_out'])); ?></td>
                        </tr>
                        <tr>
                           <th class="success">Jumlah Total</th>
                           <td class="table-active"><b><?= $this->setting->currency_symbol; ?> <?= rate_exchange($booking['totalamount']) ?> </b></td>
                        </tr>

                        <tr>
                           <th class="success">Voucher</th>
                           <th class="table-active">
                              <table>
                                 <tr>
                                    <td><input type="text" name="coupon" id="coupon" placeholder='Voucher' autocomplete="off" class="form-control" style="width:80%" /></td>
                                    <td><button type="submit" name="coupon_apply" id="coupon_apply" value="coupon_apply" class="btn btn-success shadow">Apply</button></td>
                                 </tr>
                              </table>

                           </th>
                        </tr>
                        <?php if (!empty($coupon_data)) { ?>
                           <tr>
                              <th class="success">coupon_applied</th>
                              <td class="table-active"><b>- <?= $this->session->userdata('currency_sybmol'); ?> <?= rate_exchange($coupon_data['discount']) ?> </b></td>
                           </tr>
                           <?php if (!empty($coupon_data['paid_service_applied'])) { ?>
                              <tr>
                                 <th class="success">free_services</th>
                                 <td class="table-active"><b>- <?= $this->session->userdata('currency_sybmol'); ?> <?= rate_exchange($coupon_data['services_total']) ?> (<?= @$coupon_data['services'] ?>)</b></td>
                              </tr>
                           <?php } ?>
                           <tr>
                              <th class="success">amount_payable</th>
                              <td class="table-active"><b><?= $this->session->userdata('currency_sybmol'); ?> <?= rate_exchange($coupon_data['totalamount']) ?> </b></td>
                           </tr>
                        <?php } ?>

                     </table>

                     <div class="class=" box-footer"">
                        <input class="btn btn-primary shadow" type="submit" value="Book" name="book" />
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/admin/plugins/toastr') ?>/toastr.min.js"></script>