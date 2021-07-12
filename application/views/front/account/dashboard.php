   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
               <div class="profile-sidebar shadow">
                  <div class="widget-profile pro-widget-content">
                     <div class="profile-info-widget">
                        <a href="#" class="booking-doc-img">
                           <?php if (!empty($tamu->image)) : ?>
                              <img src="<?= base_url('assets/img/guests/') . $tamu->image ?>" alt="User Image">
                           <?php else : ?>
                              <img src="<?= base_url('assets/img/guests/guests.png') ?>" alt="User Image">
                           <?php endif; ?>
                        </a>
                        <div class="profile-det-info">
                           <h3><?= $tamu->nama_depan . ' ' . $tamu->nama_belakang ?></h3>
                           <div class="patient-details">
                              <h5><?= $tamu->email ?></h5>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="dashboard-widget">
                     <nav class="dashboard-menu shadow">
                        <ul>
                           <li <?= $this->uri->segment(1) == 'dashboard' ? 'class="active"' : '' ?>>
                              <a href="<?= base_url('dashboard') ?>">
                                 <i class="fas fa-columns"></i>
                                 <span>Dashboard</span>
                              </a>
                           </li>
                           <li <?= $this->uri->segment(1) == 'profile' ? 'class="active"' : '' ?>>
                              <a href="<?= base_url('profile/setting') ?>">
                                 <i class="fas fa-user-cog"></i>
                                 <span>Profile Settings</span>
                              </a>
                           </li>
                           <li>
                              <a href="#" data-toggle="modal" data-target="#ModalLogout">
                                 <i class="fas fa-sign-out-alt"></i>
                                 <span>Logout</span>
                              </a>
                           </li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
            <div class="col-md-7 col-lg-8 col-xl-9 mb-5">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card dash-card shadow">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-lg-4">
                                 <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                       <img src="<?= base_url('assets/img/only/berhasil.png') ?>" style="width: 50px;" class="img-fluid" alt="patient">
                                    </div>
                                    <div class="dash-widget-info">
                                       <h6>Reservasi Berhasil</h6>
                                       <h4><strong><?= count($berhasil) ?></strong></h4>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-lg-4">
                                 <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                       <img src="<?= base_url('assets/img/only/pendding.png') ?>" style="width: 50px;" class="img-fluid" alt="Patient">
                                    </div>
                                    <div class="dash-widget-info">
                                       <h6>Reservasi Pending</h6>
                                       <h4><strong><?= count($pending) ?></strong></h4>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-lg-4">
                                 <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                       <img src="<?= base_url('assets/img/only/gagal.png') ?>" style="width: 50px;" class="img-fluid" alt="Patient">
                                    </div>
                                    <div class="dash-widget-info">
                                       <h6>Reseravasi Gagal</h6>
                                       <h4><strong><?= count($gagal) ?></strong></h4>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card mt-3 shadow">
                        <div class="card-body">
                           <div id="pat_medical_records" class="tab-pane fade show active">
                              <div class="table-responsive">
                                 <table class="table table-bordered table-striped shadow" id="example2" style="text-align: center;">
                                    <thead>
                                       <tr>
                                          <th>Tanggal Order</th>
                                          <!-- <th>Check in/Out </th> -->
                                          <th>Tipe Kamar</th>
                                          <th>Pembayaran</th>
                                          <th>Aksi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($reservasi as $res) : ?>
                                          <?php $layanan = get_layanan_by_id_order($res->id_order) ?>
                                          <tr>
                                             <td><a href="#"><?= $res->tgl_order ?></a></td>
                                             <!-- <td><?= tgl_indo($res->check_in) ?> s/d <?= tgl_indo($res->check_out) ?></td> -->
                                             <td>
                                                <a href="#"> <?php $tipe_kamar =  get_tipe_kamar_by_id($res->id_tipe_kamar) ?>
                                                   <?= $tipe_kamar->judul ?>
                                                </a>
                                             </td>
                                             <td>
                                                <?php if ($res->status_kode == 200) : ?>
                                                   <span href="#" class="badge badge-pill badge-success shadow">
                                                      Terbayar
                                                   </span>
                                                <?php elseif ($res->status_kode == 201) : ?>
                                                   <span href="#" class="badge badge-pill badge-warning shadow">
                                                      Menunggu
                                                   </span>
                                                <?php else : ?>
                                                   <span href="#" class="badge badge-pill badge-danger shadow">
                                                      Gagal
                                                   </span>
                                                <?php endif ?>
                                             </td>
                                             <td class="text-right">
                                                <?php if ($res->status_kode == 200) : ?>
                                                   <div class="table-action">
                                                      <button type="button" class="btn btn-sm btn-secondary shadow" data-toggle="modal" data-target="#appt_details<?= $res->id_order ?>">
                                                         <i class="far fa-eye"></i> Detail
                                                      </button>
                                                      <a href="<?= site_url('account/download/struck/' . $res->id_order) ?>" target="_blank" class="btn btn-sm btn-success shadow">
                                                         <i class="fas fa-print"></i> Invoice
                                                      </a>
                                                   </div>
                                                <?php elseif ($res->status_kode == 201) : ?>
                                                   <div class="table-action">
                                                      <button type="button" class="btn btn-sm btn-secondary shadow" data-toggle="modal" data-target="#appt_details<?= $res->id_order ?>">
                                                         <i class="far fa-eye"></i> Detail
                                                      </button>
                                                      <a href="#" class="btn btn-sm btn-primary shadow">
                                                         <i class="fas fa-money"></i> Bayar
                                                      </a>
                                                   </div>
                                                <?php else : ?>
                                                   <div class="table-action">
                                                      <button type="button" class="btn btn-sm btn-secondary shadow" data-toggle="modal" data-target="#appt_details<?= $res->id_order ?>">
                                                         <i class="far fa-eye"></i> Detail
                                                      </button>
                                                   </div>
                                                <?php endif ?>
                                             </td>
                                          </tr>
                                       <?php endforeach  ?>
                                    </tbody>
                                 </table>

                                 <!-- modals -->
                                 <?php foreach ($reservasi as $res) : ?>
                                    <div class="modal fade custom-modal" id="appt_details<?= $res->id_order ?>">
                                       <div class="modal-dialog modal-dialog-centered modal-lg">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Detail Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <ul class="info-details">
                                                   <li>
                                                      <div class="details-header">
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                               <span class="title"><?= $res->no_order ?></span>
                                                               <span class="text"><?= $res->tgl_order ?></span>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <div class="text-right">
                                                                  <?php if ($res->status_kode == 200) : ?>
                                                                     <button type="button" class="btn btn-success btn-sm" id="topup_status">Terbayar</button>
                                                                  <?php elseif ($res->status_kode == 201) : ?>
                                                                     <button type="button" class="btn btn-warning btn-sm" id="topup_status">Menunggu</button>
                                                                  <?php elseif ($res->status_kode == 0 || $res->status_kode == 202) : ?>
                                                                     <button type="button" class="btn btn-danger btn-sm" id="topup_status">Gagal</button>
                                                                  <?php endif ?>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </li>
                                                   <li>
                                                      <div class="row">
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Nama Pemesan</span>
                                                            <span class="text"><?= $res->nama_depan . ' ' . $res->nama_belakang ?></span>
                                                         </div>
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Reservasi Kamar</span>
                                                            <?php $tipe_kamar =  get_tipe_kamar_by_id($res->id_tipe_kamar) ?>
                                                            <span class="text"><?= $tipe_kamar->judul ?></span>
                                                         </div>
                                                      </div>
                                                   </li>
                                                   <li>
                                                      <div class="row">
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Jumlah Kamar</span>
                                                            <span class="text"><?= $res->jml_kamar ?> Kamar</span>
                                                         </div>
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Check-In & Check-Out</span>
                                                            <span class="text"><?= tgl_indo($res->check_in) ?> s/d <?= tgl_indo($res->check_out) ?></span>
                                                         </div>
                                                      </div>
                                                   </li>
                                                   <li>
                                                      <div class="row">
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Layanan</span>
                                                            <?php $layanan = get_layanan_by_id_order($res->id_order) ?>
                                                            <span class="text"><?= $layanan->judul != '' ? $layanan->judul . '(' . $res->dewasa . ' Orang)' : '-' ?> </span>
                                                         </div>
                                                         <div class="col-md-6 col-6">
                                                            <span class="title">Biaya</span>
                                                            <span class="text">Rp <?= rupiah($res->total_jumlah) ?></span>
                                                         </div>
                                                      </div>
                                                   </li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 <?php endforeach ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
   <!-- /Page Content -->
   <script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="<?= base_url('assets/admin/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <!-- Control Sidebar -->
   <script>
      $(function() {
         $("#example2").DataTable();
         $('#example1').DataTable({
            "paging": true,
            // "lengthChange": false,
            "searching": true,
            // "ordering": true,
            // "info": true,
            // "autoWidth": false,
         });
      });
   </script>