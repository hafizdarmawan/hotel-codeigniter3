 <link type="text/css" href="<?= base_url('assets/admin/plugins/redactor/redactor.css'); ?>" rel="stylesheet" />
 <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
 <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
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
                <h3 class="card-title">Tambah Pengguna Sistem</h3>
             </div>
             <div class="card-body">
                <form action="<?= base_url('admin/tipe_tambah_aksi') ?>" method="post" enctype="multipart/form-data">
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Nama Kamar</label>
                               </div>
                               <div class="col-md-9">
                                  <input type="text" name="judul" class="form-control" required value="<?php echo set_value('judul', $tipe_kamar->judul) ?>" id="judul" />
                                  <?= form_error('judul', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Shortcode</label>
                               </div>
                               <div class="col-md-9">
                                  <input type="text" name="shortcode" class="form-control" required value="<?php echo set_value('shortcode', $tipe_kamar->shortcode) ?>" id="shortcode" />
                                  <?= form_error('shortcode', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Deskripsi</label>
                               </div>
                               <div class="col-md-9">
                                  <textarea name="deskripsi" required class="form-control redactor"><?= $tipe_kamar->deskripsi ?></textarea>
                                  <?= form_error('deskripsi', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Max Dewasa</label>
                               </div>
                               <div class="col-md-9">
                                  <input type="number" required id="higher_occupancy" name="higher_occupancy" class="form-control" value="<?php echo set_value('higher_occupancy', $tipe_kamar->higher_occupancy) ?>" id="higher_occupancy" />
                                  <?= form_error('higher_occupancy', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <!-- <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Kids Occupancy</label>
                               </div>
                               <div class="col-md-9">
                                  <input type="text" name="kids_occupancy" required class="form-control" value="<?php echo set_value('kids_occupancy', $kids_occupancy) ?>" id="kids_occupancy" />
                                  <?= form_error('kids_occupancy', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div> -->
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Fasilitas</label>
                               </div>
                               <div class="col-md-9">
                                  <?php foreach ($fasilitas as $am) { ?>
                                     <b><?= $am->nama ?> </b> &nbsp;&nbsp; <input type="checkbox" name="fasilitas[<?= $am->id_fasilitas ?>]" value="1" <?= set_checkbox('fasilitas', in_array($am->id_fasilitas, $room_amenities)); ?> <?= (in_array($am->id_amenities, $room_amenities)) ? 'checked="checked"' : ''; ?> /> &nbsp;&nbsp;
                                  <?php } ?>
                                  <?= form_error('fasilitas', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="row">
                               <div class="col-md-2">
                                  <label>Tarif Dasar</label>
                               </div>
                               <div class="col-md-9">
                                  <input type="number" name="tarif_dasar" required class="form-control" value="<?php echo set_value('tarif_dasar', $tarif_dasar) ?>" id="tarif_dasar" />
                                  <?= form_error('tarif_dasar', '<div class = "text-small text-danger">', '</div>') ?>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="input_fields_wrap">
                            <div class="row ">
                               <div class="col-md-6">
                                  <label>Gambar</label>
                                  <input type="file" name="image[]" required class="form-control" id="1" onchange="readURL(this,blah1);" />
                               </div>
                               <div class="col-md-4  blah1">
                                  <img class="blah hide" src="#" alt="Gambar" id="blah1" />
                               </div>
                               <div style="padding-top:20px;"><button class="add_field_button btn btn-sm btn-success">Tambah</button>
                               </div>
                            </div>
                            <?= form_error('image[]', '<div class = "text-small text-danger">', '</div>') ?>
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
 <!--/. container-fluid -->
 </section>
 <!-- /.content -->
 </div>
 <script type="text/javascript" src="<?= base_url('assets/admin/plugins/redactor/redactor.min.js'); ?>"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
 <script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
 <script>
    $(function() {
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
    });
    $(function() {
       <?php if ($extra_bed == 1) { ?>
          $('#extra_beds_div').show();
       <?php } else { ?>
          $('#extra_beds_div').hide();
       <?php } ?>
       $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
       });
    });

    $(document).ready(function() {
       var max_fields = 1000; //maximum input boxes allowed
       var wrapper = $(".input_fields_wrap"); //Fields wrapper
       var add_button = $(".add_field_button"); //Add button ID

       var x = 2; //initlal text box count
       $(add_button).click(function(e) { //on add input button click
          e.preventDefault();
          if (x < max_fields) { //max input box allowed
             x++; //text box increment
             $(wrapper).append('<div class="row"><div class="col-md-6"><label>Gambar</label><input type="file" name="image[]" class="form-control" onchange="readURL(this,blah' + x + ');"  /></div><div class="col-md-4  blah' + x + '"  ><img class="blah hide" src="#" alt="Gambar" id="blah' + x + '" /></div><div class="col-md-2"><div style="padding-top:20px;"><a href="#" class="remove_field btn btn-sm btn-danger">Hapus</a></button></div></div>'); //add input box
             //$('.chzn').chosen({search_contains:true});
          }
          $('input').iCheck({
             checkboxClass: 'icheckbox_square-blue',
             radioClass: 'iradio_square-blue',
             increaseArea: '20%' // optional
          });
       });
       $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
          e.preventDefault();
          $(this).parent('div').parent('div').parent('div').remove();
          x--;
       })
    });

    function readURL(input, d) {
       if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
             console.log(d);
             $(d).attr('src', e.target.result).width(100).height(80);
          };

          reader.readAsDataURL(input.files[0]);
          $(d).removeClass('hide');
       }
    }

    <?php if ($id) { ?>
       $(document).on("click", ".remove_fieldedit", function(e) { //user click on remove text
          e.preventDefault();
          var id = event.target.id;
          if (id) {
             if (window.confirm("Are you sure remove this image ?")) {
                call_loader();
                $.ajax({
                   url: '<?php echo site_url('admin/room_types/updateimg') ?>',
                   type: 'POST',
                   data: {
                      id: id
                   },
                   success: function(result) {
                      remove_loader();
                      location.reload();
                      //$(this).parent('div').parent('div').parent('div').remove();
                   }
                });
             }
          }

       });
    <?php } ?>
 </script>