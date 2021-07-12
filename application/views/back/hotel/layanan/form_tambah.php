  <link type="text/css" href="<?= base_url('assets/admin/plugins/multiselect/css/multi-select.css') ?>" rel="stylesheet" />
  <link type="text/css" href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" />
  <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
  <link type="text/css" href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" />
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
                 <h3 class="card-title">Tambah Layanan</h3>
              </div>
              <div class="card-body">
                 <form action="<?= base_url('admin/service_tambah_aksi') ?>" method="post">
                    <div class="row">
                       <div class="col-md-6">
                          <div class="col-md-12">
                             <div class="form-group">
                                <label class="col-form-label" for="judul"></i> Nama layanan</label>
                                <input type="text" class="form-control <?= form_error('judul')  ? 'is-invalid' : "" ?>" name="judul" id="judul" placeholder="Nama Layanan" value="<?= set_value('judul') ?>">
                                <?= form_error('judul', '<div class = "text-small text-danger">', '</div>') ?>
                             </div>
                          </div>
                          <div class="col-md-12">
                             <div class="form-group">
                                <label class="col-form-label" for="status"></i>Tipe Biaya</label>
                                <select name="tipe_biaya" class="form-control <?= form_error('tipe_biaya')  ? 'is-invalid' : "" ?>" id="tipe_biaya">
                                   <option value="">Pilih Tipe Biaya</option>
                                   <option value="1" <?= set_select('tipe_biaya', '1'); ?>>Per Orang</option>
                                   <option value="2" <?= set_select('tipe_biaya', '2'); ?>>Per Malam</option>
                                   <option value="3" <?= set_select('tipe_biaya', '3'); ?>>Biaya Tetap</option>
                                </select>
                                <?= form_error('tipe_biaya', '<div class = "text-small text-danger">', '</div>') ?>
                             </div>
                          </div>
                          <div class="col-md-12">
                             <div class="form-group">
                                <label class="col-form-label" for="biaya"></i>Biaya</label>
                                <input type="number" class="form-control <?= form_error('biaya')  ? 'is-invalid' : "" ?>" name="biaya" id="biaya" placeholder="Price" value="<?= set_value('biaya') ?>">
                                <?= form_error('biaya', '<div class = "text-small text-danger">', '</div>') ?>
                             </div>
                          </div>
                          <div class="col-md-12">
                             <div class="form-group">
                                <label class="col-form-label" for="status"></i>Status</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="1" <?php echo ($status == 1) ? 'checked="checked"' : '' ?> /> Aktif
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="2" <?php echo ($status == 2) ? 'checked="checked"' : '' ?> /> Tidak Aktif
                                <?= form_error('status', '<div class = "text-small text-danger">', '</div>') ?>
                             </div>
                          </div>
                          <div class="col-md-12">
                             <div class="form-group">
                                <label class="col-form-label" for="deskripsi"></i> Deskripsi</label>
                                <textarea name="deskripsi" rows="5" id="deskripsi" placeholder="Deskripsi" class="form-control redactor <?= form_error('deskripsi')  ? 'is-invalid' : "" ?>"> <?= set_value('deskripsi') ?></textarea>
                                <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="col-md-12">
                             <div class="table-responsive">
                                <div class="form-group">
                                   <label>Tipe kamar</label>
                                   <select name="tipe_kamar[]" class="form-control multiselect" multiple="multiple">
                                      <?php foreach ($tipe_kamar as $new) { ?>
                                         <option value="<?= $new->id_tipe_kamar ?>" <?php echo (in_array($new->id_tipe_kamar, $romm_services)) ? 'selected="selected"' : '' ?>><?php echo $new->judul ?></option>
                                      <?php } ?>
                                   </select>
                                </div>
                             </div>
                          </div>
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
  </section>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.multi-select.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/admin/plugins/multiselect/js/jquery.quicksearch.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/admin/plugins/redactor/redactor.min.js'); ?>" type="text/javascript"></script>
  <script>
     $(document).ready(function() {
        $('input').iCheck({
           checkboxClass: 'icheckbox_square-blue',
           radioClass: 'iradio_square-blue',
           increaseArea: '20%' // optional
        });
        $('.redactor').redactor({
           // formatting: ['p', 'blockquote', 'h2','img'],
           minHeight: 200,
           imageUpload: '<?php echo site_url('/wysiwyg/upload_image'); ?>',
           fileUpload: '<?php echo site_url('/wysiwyg/upload_file'); ?>',
           imageGetJson: '<?php echo site_url('/wysiwyg/get_images'); ?>',
           imageUploadErrorCallback: function(json) {
              alert(json.error);
           },
           fileUploadErrorCallback: function(json) {
              alert(json.error);
           }
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