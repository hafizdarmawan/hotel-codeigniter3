<link type="text/css" href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
<link type="text/css" href="<?= base_url('assets/admin/plugins/multiselect/css/multi-select.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
<link type="text/css" href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
<!-- Content Wrapper. Contains page content -->
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
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active"><?= $page_title ?></li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="card shadow">
            <div class="card-header">
               <h3 class="card-title">Ubah Voucher</h3>
            </div>
            <div class="card-body">
               <form action="<?= base_url('admin/coupon_ubah_aksi') ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <!-- <?php print_r($voucher) ?> -->
                     <input type="hidden" name="id_voucher" value="<?= $voucher->id_voucher ?>">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="judul">Nama Voucher</label>
                           <input type="text" name="judul" class="form-control <?= form_error('judul')  ? 'is-invalid' : "" ?>" value="<?= set_value('judul', $voucher->judul) ?>" required>
                           <?= form_error('judul', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <?php if (!empty($voucher->gambar)) : ?>
                           <img src="<?= base_url('assets/img/coupons/small/') . $voucher->gambar ?>" style="width: 150px;" alt="">
                        <?php else : ?>
                        <?php endif ?>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <textarea name="deskripsi" id="" class="form-control redactor <?= form_error('deskripsi' ? 'is-invalid' : '') ?>" required><?= set_value('deskripsi', $voucher->deskripsi) ?></textarea>
                              <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Gambar</label>
                           <div class="custom-file">
                              <input type="file" name="gambar" class="custom-file-input dropify" id="customFile" value="<?= set_value('gambar'); ?>" data-height="220">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                              <?= form_error('gambar', '<div class = "text-small text-danger">', '</div>') ?>
                           </div>
                           <input type="hidden" name="old_image" value="<?= $voucher->gambar ?>" />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Periode Cupon</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-clock-o"></i>
                              </div>
                              <input type="text" name="date" class="form-control <?= form_error('date' ? 'is-invalid' : '') ?>" id="reservationtime" value="<?= set_value('date', $date) ?>" autocomplete='off' required>
                              <?= form_error('date', '<div class = "text-small text-danger">', '</div>') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Kode Voucher</label>
                           <input type="text" name="kode" class="form-control <?= form_error('kode') ? 'is-invalid' : '' ?>" autocomplete="off" required value="<?= set_value('kode', $voucher->kode) ?>">
                           <?= form_error('kode', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Tipe Voucher</label>
                           <select name="tipe" class="form-control <?= form_error('tipe' ? 'is-invalid' : '') ?>" required>
                              <option value="">Pilih Tipe Voucher.....</option>
                              <option value="Persen" <?= ($voucher->tipe == "Persen") ? 'selected="selected"' : '' ?>>Persen (%)</option>
                              <option value="Tetap" <?= ($voucher->tipe == "Tetap") ? 'selected="selected"' : '' ?>>Tetap (Rp.)</option>
                           </select>
                           <?= form_error('tipe', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Nilai Voucher</label>
                           <input type="number" name="nilai" value="<?= set_value('nilai', $voucher->nilai) ?>" class="form-control <?= form_error('nilai' ? 'is-invalid' : '') ?>" />
                           <?= form_error('nilai', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Jumlah Minimal</label>
                           <input type="number" name="min_total" value="<?= set_value('min_total', $voucher->min_total) ?>" class="form-control <?= form_error('min_total' ? 'is-invalid' : '') ?>" />
                           <?= form_error('min_total', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Jumlah Maksimal</label>
                           <input type="number" name="max_total" value="<?= set_value('max_total', $voucher->max_total) ?>" class="form-control <?= form_error('max_total' ? 'is-invalid' : '') ?>" />
                           <?= form_error('max_total', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Include Tamu</label>
                           <select name="include_tamu[]" class="form-control multiselect" multiple="multiple">
                              <?php foreach ($tamu as $new) { ?>
                                 <option value="<?= $new->id_tamu ?>" <?php if (!empty($include_tamu)) {
                                                                           echo (in_array($new->id_tamu, $include_tamu)) ? 'selected="selected"' : '';
                                                                        } ?>><?= $new->nama_depan ?> <?= $new->nama_belakang ?></option>
                              <?php } ?>
                           </select>
                           <?= form_error('include_tamu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Exclude Tamu</label>
                           <select name="exclude_tamu[]" class="form-control multiselect" multiple="multiple">
                              <?php foreach ($tamu as $new) { ?>
                                 <option value="<?= $new->id_tamu ?>" <?php if (!empty($exclude_tamu)) {
                                                                           echo (in_array($new->id_tamu, $exclude_tamu)) ? 'selected="selected"' : '';
                                                                        } ?>><?= $new->nama_depan ?> <?= $new->nama_belakang ?></option>
                              <?php } ?>
                           </select>
                           <?= form_error('exclude_tamu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Include Tipe Kamar</label>
                           <select name="include_tipe_kamar[]" class="form-control multiselect" multiple="multiple">
                              <?php foreach ($tipe_kamar as $new) { ?>
                                 <option value="<?= $new->id_tipe_kamar ?>" <?php if (!empty($include_tipe_kamar)) {
                                                                                 echo (in_array($new->id_tipe_kamar, $include_tipe_kamar)) ? 'selected="selected"' : '';
                                                                              } ?>><?= $new->judul ?></option>
                              <?php } ?>
                           </select>
                           <?= form_error('include_tipe_kamar', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Exclude Tipe Kamar</label>
                           <select name="exclude_tipe_kamar[]" class="form-control multiselect" multiple="multiple">
                              <?php foreach ($tipe_kamar as $new) { ?>
                                 <option value="<?= $new->id_tipe_kamar ?>" <?php if (!empty($exclude_tipe_kamar)) {
                                                                                 echo (in_array($new->id_tipe_kamar, $exclude_tipe_kamar)) ? 'selected="selected"' : '';
                                                                              } ?>><?= $new->judul ?></option>
                              <?php } ?>
                           </select>
                           <?= form_error('exclude_tipe_kamar', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Limit Per Tamu</label>
                           <input type="number" name="limit_per_tamu" value="<?= set_value('limit_per_tamu', $voucher->limit_per_tamu) ?>" class="form-control <?= form_error('limit_per_tamu' ? 'is-invalid' : '') ?>" />
                           <?= form_error('limit_per_tamu', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Limit Per Voucher</label>
                           <input type="number" name="limit_per_voucher" value="<?= set_value('limit_per_voucher', $voucher->limit_per_voucher) ?>" class="form-control <?= form_error('limit_per_voucher' ? 'is-invalid' : '') ?>" />
                           <?= form_error('limit_per_voucher', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info shadow">Simpan</button>
                     <button type="button" class="btn btn-default float-right shadow" onclick="history.back(-1)">Kembali</button>
                  </div>
               </form>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!--/. container-fluid -->
   </section>
   <!-- /.content -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.multi-select.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.quicksearch.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/redactor/redactor.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url('assets/admin') . '/plugins/dropify/js/dropify.js' ?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $('.dropify').dropify({
         messages: {
            default: 'Drag atau drop untuk memilih gambar',
            replace: 'Ganti',
            remove: 'Hapus',
            error: 'error'
         }
      });
   });
</script>
<script>
   $(document).ready(function() {
      //$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD h:mm A'});
      $('.redactor').redactor({
         // formatting: ['p', 'blockquote', 'h2','img'],
         minHeight: 200,
         imageUpload: '<?= site_url('/wysiwyg/upload_image'); ?>',
         fileUpload: '<?= site_url('/wysiwyg/upload_file'); ?>',
         imageGetJson: '<?= site_url('/wysiwyg/get_images'); ?>',
         imageUploadErrorCallback: function(json) {
            alert(json.error);
         },
         fileUploadErrorCallback: function(json) {
            alert(json.error);
         }
      });
      $('#reservationtime').daterangepicker({
         timePicker: true,
         timePickerIncrement: 30,
         locale: {
            format: 'YYYY-MM-DD h:mm A'
         }
      });
      $('input').iCheck({
         checkboxClass: 'icheckbox_square-blue',
         radioClass: 'iradio_square-blue',
         increaseArea: '20%' // optional
      });

      $('.multiselect').multiSelect({
         selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search..'>",
         selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search..'>",
         afterInit: function(ms) {
            var that = this,
               $selectableSearch = that.$selectableUl.prev(),
               $selectionSearch = that.$selectionUl.prev(),
               selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
               selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
               .on('keydown', function(e) {
                  if (e.which === 40) {
                     that.$selectableUl.focus();
                     return false;
                  }
               });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
               .on('keydown', function(e) {
                  if (e.which == 40) {
                     that.$selectionUl.focus();
                     return false;
                  }
               });
         },
         afterSelect: function() {
            this.qs1.cache();
            this.qs2.cache();
         },
         afterDeselect: function() {
            this.qs1.cache();
            this.qs2.cache();
         }
      });

      $('.multiselect').change(function() {
            //var mangle =  $(this).closest('form').find('select.multiselect option:selected').val();
            var tot = 0;
            $.each($(this).closest('form').find('select.multiselect option:selected'), function() {
               var curr_val = parseFloat($(this).data('id'));
               // alert(curr_val);
               tot = tot + curr_val;
               //console.log(tot);
            });
            //var discount = $('#dis_id').val();
            var discount = $(this).closest('form').find('.dis_id').val();
            var gross = tot - discount;
            //$('#add_form').find('[name="sub_total"]').val(tot).end()
            $(this).closest('form').find('[name="sub_total"]').val(tot).end()
            $(this).closest('form').find('[name="total"]').val(Math.round(gross))
            //$('#add_form').find('[name="total"]').val(gross)

         }

      );

   });
</script>