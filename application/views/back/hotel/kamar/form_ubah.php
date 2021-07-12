<link href="<?= base_url('assets/admin/plugins/toastr') ?>/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
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
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Ubah Kamar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form action="<?= base_url('admin/kamar_ubah_aksi') ?>" method="post">
                  <div class="row">
                     <div class="col-md-6">
                        <input type="hidden" name="id_kamar" id="" value="<?= $id_kamar ?>">
                        <div class="form-group">
                           <label>Lantai</label>
                           <!-- <?php print_r($kamar->id_lantai) ?> -->
                           <select name="id_lantai" class="form-control" required>
                              <option value="">Pilih Lantai.....</option>
                              <?php foreach ($lantai as $fl) { ?>
                                 <option value="<?= $fl->id_lantai ?>" <?= $fl->id_lantai == $id_lantai ? 'selected="selected"' : '' ?>> <?= $fl->nama ?> </option>
                              <?php } ?>
                           </select>
                           <?= form_error('id_lantai', '<div class = "text-small text-danger">', '</div>') ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-7">
                        <div class="form-group">
                           <div class="input_fields_wrap">
                              <div class="row ">
                                 <div class="col-md-5">
                                    <label>Tipe Kamar</label>
                                    <select name="id_tipe_kamar" class="form-control" required>
                                       <option value="">Pilih Tipe Kamar.....</option>
                                       <?php foreach ($tipe_kamar as $fl) { ?>
                                          <option value="<?= $fl->id_tipe_kamar ?>" <?php $fl->id_tipe_kamar == $id_tipe_kamar ? 'selected="selected"' : '' ?>><?= $fl->judul ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-4">
                                    <label>Nomor Kamar</label>
                                    <input type="text" name="no_kamar" value="<?= $no_kamar ?>" class="form-control room_number" required />
                                 </div>
                              </div>
                           </div>
                           <?= form_error('room_type', '<div class = "text-small text-danger">', '</div>') ?>
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
<script src="<?= base_url('assets/admin/plugins/toastr') ?>/toastr.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      var max_fields = 1000; //maximum input boxes allowed
      var wrapper = $(".input_fields_wrap"); //Fields wrapper
      var add_button = $(".add_field_button"); //Add button ID

      var x = 1; //initlal text box count
      $(add_button).click(function(e) { //on add input button click
         e.preventDefault();
         if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row"><div class="col-md-5"><label>Room Type</label><select name="room_type_id[]" class="form-control" required><option value="">Pilih Tipe Kamar.....</option><?php foreach ($tipe_kamar as $fl) { ?><option value="<?= $fl->id_tipe_kamar ?>"><?= $fl->judul ?></option><?php } ?></select></div><div class="col-md-4"><label>room_number</label><input type="text" name="room_number[]" value="" class="form-control room_number" required /></div><div class="col-md-2"><div style="padding-top:30px;"><a href="#" class="remove_field btn btn-danger">Remove</a></button></div></div>'); //add input box
            //$('.chzn').chosen({search_contains:true});
            $(".room_number").blur(function(event) {
               var val = $(this).val();
               var id = $('#id').val();
               //alert(val); return false;
               if (val) {
                  call_loader();
                  $.ajax({
                     url: '<?= site_url('backend/hotel/check_room_number') ?>',
                     type: 'POST',
                     data: {
                        value: val,
                        id: id
                     },
                     success: function(result) {
                        //alert(result);return false;
                        remove_loader();
                        if (result == 1) {
                           toastr.error('This Room Number Is Exists!');
                           $(this).val(" ");
                        }

                     }
                  });
               }
            });
         }
      });

      $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
         e.preventDefault();
         $(this).parent('div').parent('div').parent('div').remove();
         x--;
      })
   });
   $(".room_number").blur(function(event) {
      var val = $(this).val();
      var id = $('#id').val();
      //alert(val); return false;
      if (val) {
         call_loader();
         $.ajax({
            url: '<?= site_url('backend/hotel/check_room_number') ?>',
            type: 'POST',
            data: {
               value: val,
               id: id
            },
            success: function(result) {
               //alert(result);return false;
               remove_loader();
               if (result == 1) {
                  toastr.error('No Kamar sudah ada!');
                  // $("#btn").prop("disabled", true);
                  // $('button[type="submit"]').attr('disabled', 'disabled');
                  $(this).val(" ");
               }
               // else {
               //    $('button[type="submit"]').removeAttr('disabled');
               //    $("#btn").removeAttr('disabled');
               // }

            }
         });
      }
   });
</script>