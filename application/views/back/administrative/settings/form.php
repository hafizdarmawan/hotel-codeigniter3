<link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/multiselect/css/multi-select.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin/plugins/responsivetabs/style.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css" rel="stylesheet">
<link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
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
         <div class="row">
            <div class="col-md-12">
               <div class="card card-outline card-info shadow">
                  <div class="card-header p-2">
                     <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link shadow ml-2 active" href="#home" data-toggle="tab">Detail Hotel</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#informasi" data-toggle="tab">Informasi Hotel</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#global" data-toggle="tab">Setting Global</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#midtrans" data-toggle="tab">Setting Midtrans</a></li>
                        <li class="nav-item"><a class="nav-link shadow ml-2" href="#emaill" data-toggle="tab">Setting Email</a></li>
                     </ul>
                  </div><!-- /.card-header -->
                  <form method="post" action="<?= base_url('admin/settings/ubah') ?>" enctype="multipart/form-data">
                     <input type="hidden" name="id_setting" value="<?= $id_setting ?>" />
                     <div class="card-body">
                        <div class="tab-content">
                           <div class="active tab-pane" id="home">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Nama</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $setting->nama) ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Logo Hotel</b>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="file" name="logo" class="form-control" />
                                       <input type="hidden" name="old_logo" value="<?= @$setting->logo; ?>" />
                                    </div>
                                    <?php if (!empty($setting->logo)) { ?>
                                       <div class="col-md-4">
                                          <img src="<?= base_url('assets/img/logo/' . $setting->logo) ?>" width="90" />
                                       </div>
                                    <?php } ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Alamat</b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="alamat" class="form-control"><?= set_value('alamat', @$setting->alamat) ?></textarea>

                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Map Lokasi</b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="map" class="form-control" rows="5"><?= set_value('map', @$setting->map) ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Email</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email', @$setting->email) ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>No Telepon</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="no_telepon" value="<?= set_value('no_telepon', @$setting->no_telepon) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Fax</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="fax" value="<?= set_value('fax', @$setting->fax) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Footer Text</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="footer_text" value="<?= set_value('footer_text', @$setting->footer_text) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="informasi">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Section Judul</b>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" name="section_judul" class="form-control" value="<?= @$setting->section_judul; ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Meta Description</b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="meta_description" class="form-control"><?= $setting->meta_description ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Meta Keywords </b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="meta_keywords" class="form-control"><?= $setting->meta_keywords ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Section Deskrpsi</b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="section_deskripsi" class="form-control redactor"><?= @$setting->section_deskripsi; ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Sort Section Deskripsi</b>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea name="sort_section_deskripsi" class="form-control redactor"><?= @$setting->sort_section_deskripsi; ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Gambar</b>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="file" name="image" class="form-control" />
                                       <input type="hidden" name="old_image" value="<?= @$setting->image; ?>" />
                                    </div>
                                    <?php if (!empty($setting->image)) { ?>
                                       <div class="col-md-4">
                                          <img src="<?= base_url('assets/img/logo/' . $setting->image) ?>" height="70" width="90" />
                                       </div>
                                    <?php } ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Facebook</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="facebook_link" class="form-control" value="<?= $setting->facebook_link; ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Twitter</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="twitter_link" class="form-control" value="<?= $setting->twitter_link; ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Instagram+</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="instagram_link" class="form-control" value="<?= $setting->instagram_link; ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Google+</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="google_plus_link" class="form-control" value="<?= $setting->google_plus_link; ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Linkedin</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="linkedin_link" class="form-control" value="<?= $setting->linkedin_link; ?>" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="global">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>No Invoice</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="number" name="invoice" value="<?= set_value('invoice', @$setting->invoice) ?>" class="form-control" min='1' />
                                    </div>
                                 </div>
                              </div>
                              <!-- <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Default Tanggal Format</b>
                                    </div>
                                    <div class="col-md-8">
                                       <select name="format_tanggal" class="form-control">
                                          <option value="">Pilih Format Tanggal......</option>
                                          <option value="d/m/Y" <?= (@$setting->format_tanggal == 'd/m/Y') ? 'selected="selected"' : ''; ?>>DD/MM/YYYY</option>
                                          <option value="m/d/Y" <?= (@$setting->format_tanggal == 'm/d/Y') ? 'selected="selected"' : ''; ?>>MM/DD/YYYY</option>
                                          <option value="Y/m/d" <?= (@$setting->format_tanggal == 'Y/m/d') ? 'selected="selected"' : ''; ?>>YYYY/MM/DD</option>
                                       </select>
                                    </div>
                                 </div>
                              </div> -->
                              <!-- <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Minimum Booking</b>
                                    </div>
                                    <div class="col-md-8">
                                       <select name="minimum_booking" class="form-control">
                                          <option value="">Pilih Minimum Booking......</option>
                                          <?php for ($i = 1; $i <= 9; $i++) { ?>
                                             <option value="<?= $i ?>" <?= ($i == @$setting->minimum_booking) ? 'selected="selected"' : ''; ?>><?= $i ?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div> -->

                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Waktu Check-In</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="waktu_check_in" value="<?= set_value('waktu_check_in', @$setting->waktu_check_in) ?>" class="form-control clockpicker" />
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Waktu Check-Out</b>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="waktu_check_out" value="<?= set_value('waktu_check_out', @$setting->waktu_check_out) ?>" class="form-control clockpicker" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <b>Format Waktu</b>
                                    </div>
                                    <div class="col-md-8">
                                       <select name="format_waktu" class="form-control">
                                          <option value="">Pilih Format Waktu.....</option>
                                          <option value="1" <?= (@$setting->format_waktu == 1) ? 'selected="selected"' : ''; ?>>12 Jam</option>
                                          <option value="2" <?= (@$setting->format_waktu == 2) ? 'selected="selected"' : ''; ?>>24 Jam</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="midtrans">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>Marchant ID</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="marchant_id" class="form-control" value="<?= $setting->marchant_id ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>Client Key</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="client_key" class="form-control" value="<?= $setting->client_key ?>" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>Server Key</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="server_key" class="form-control" value="<?= $setting->server_key ?>" placeholder="secret_key" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>Durasi Pembayaran (Menit)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="durasi_bayar" class="form-control" value="<?= $setting->durasi_bayar ?>" placeholder="Durasi Pembayaran" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="emaill">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>SMTP Mail</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="smtp_mail" value="<?= set_value('smtp_mail', @$setting->smtp_mail) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>SMTP Host</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="smtp_host" value="<?= set_value('smtp_host', @$setting->smtp_host) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>SMTP User</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="smtp_user" value="<?= set_value('smtp_user', @$setting->smtp_user) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>SMTP Password</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="password" name="smtp_pass" value="<?= set_value('smtp_pass', @$setting->smtp_pass) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label>SMTP Port</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" name="smtp_port" value="<?= set_value('smtp_port', @$setting->smtp_port) ?>" class="form-control" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="box-footer mt-2 mb-5 align-center">
                           <input class="btn btn-primary shadow" type="submit" value="Simpan" />
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/redactor/redactor.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.multi-select.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.quicksearch.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/responsivetabs/jquery.responsiveTabs.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script>
   $(function() {
      $(".colorpicker").colorpicker();
      $(".colorpicker2").colorpicker();
      $('.clockpicker').clockpicker({
         donetext: 'Done'
      });
      $('#responsiveTabsDemo').responsiveTabs({
         startCollapsed: 'accordion'
      });
      $('#reservationtime').daterangepicker({
         timePicker: true,
         timePickerIncrement: 30,
         locale: {
            format: 'YYYY-MM-DD'
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
   });
</script>