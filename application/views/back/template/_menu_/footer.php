    <div class="modal fade" id="ModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h2 class="bold">Logout</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <h6 class="">Apakah anda akan keluar dari sistem ?</h6>
             </div>
             <div class="modal-footer">
                <a href="<?= base_url('admin/logout') ?>" class="btn btn-danger">Iya</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
             </div>
          </div>
       </div>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
       <!-- Control sidebar content goes here -->
    </aside>
    <footer class="main-footer shadow">
       <div class="text-center">
          <strong class="text-center">Copyright &copy; <?= date('Y') ?> <a href="http://adminlte.io"><?= $setting->footer_text ?></a>.</strong>
       </div>
    </footer>
    </div>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/admin/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/admin/') ?>dist/js/adminlte.js"></script>
    <!-- OPTIONAL SCRIPTS -->
    <!-- <script src="<?= base_url('assets/admin/') ?>dist/js/demo.js"></script> -->
    <!-- jQuery Mapael -->
    <script src="<?= base_url('assets/admin/') ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url('assets/admin/') ?>plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
    
    <script src="<?= base_url('assets/admin/') ?>plugins/alert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>plugins/alert/myscript.js"></script>
    <script src="<?= base_url('assets/front/') ?>assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url('assets/admin') ?>/plugins/chartjs/Chart.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= "<script>" . $this->session->flashdata('message') . "</script>" ?>
    <!-- ChartJS -->
    <!-- <script src="<?= base_url('assets/admin/') ?>plugins/chart.js/Chart.min.js"></script> -->
    <!-- PAGE SCRIPTS -->
    <script src="<?= base_url('assets/admin/') ?>dist/js/pages/dashboard2.js"></script>
    <!-- <script src="<?= base_url('assets/admin/') ?>dist/js/script.js"></script> -->

    <script>
       function remove_loader() {
          $('#overlay1').remove();
       }

       function call_loader() {
          if ($('#overlay1').length == 0) {
             var over = '<div id="overlay1">' +
                '<img  style="padding-top:300px; margin: 0 auto; " class="img-responsive " id="loading" src="<?= base_url('assets/img/loader/ajax-loader.gif') ?>"></div>';
             $(over).appendTo('body');
          }
       }
    </script>
    <?php unset($_SESSION['message']) ?>
    </body>

    </html>