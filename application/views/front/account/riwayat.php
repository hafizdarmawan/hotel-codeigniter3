      <!-- Page Content -->
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <!-- Profile Sidebar -->
               <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                  <div class="profile-sidebar">
                     <div class="widget-profile pro-widget-content">
                        <div class="profile-info-widget">
                           <a href="#" class="booking-doc-img">
                              <?php if (!empty($guest->image)) : ?>
                                 <img src="<?= base_url('assets/img/guests/') . $guest->image ?>" alt="User Image">
                              <?php else : ?>
                                 <img src="<?= base_url('assets/img/guests/guests.png') ?>" alt="User Image">
                              <?php endif; ?>
                           </a>
                           <div class="profile-det-info">
                              <h3><?= $guest->nama_depan . ' ' . $guest->nama_belakang ?></h3>
                              <div class="patient-details">
                                 <h5><?= $guest->email ?></h5>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="dashboard-widget">
                        <nav class="dashboard-menu">
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
                                    <span>Riwayat Pemesanan</span>
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
               <!-- / Profile Sidebar -->

               <div class="col-md-7 col-lg-8 col-xl-9">
                  <!-- <div class="row">
                     <div class="col-md-12">
                        <div class="card dash-card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-lg-4">
                                    <div class="dash-widget dct-border-rht">
                                       <div class="circle-bar circle-bar1">
                                          <img src="assets/img/icon-01.png" class="img-fluid" alt="patient">
                                       </div>
                                       <div class="dash-widget-info">
                                          <h5>Standard Room</h5>
                                          <h6>Kamar</h6>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-md-12 col-lg-4">
                                    <div class="dash-widget dct-border-rht">
                                       <div class="circle-bar circle-bar2">
                                          <img src="assets/img/icon-02.png" class="img-fluid" alt="Patient">
                                       </div>
                                       <div class="dash-widget-info">
                                          <h5>Waktu Pembayaran</h5>
                                          <h6>16.00</h6>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-md-12 col-lg-4">
                                    <div class="appointment-action mt-4">
                                       <a href="#" class="btn btn-sm bg-info-light" data-toggle="modal"
                                                            data-target="#appt_details">
                                                            <i class="far fa-eye"></i> View
                                                        </a>
                                       <a href="javascript:void(0);" class="btn btn-block bg-success-light">
                                          <i class="fas fa-check"></i> Bayar
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->

                  <div class="card">
                     <div class="card-body pt-0">

                        <!-- Tab Menu -->
                        <nav class="user-tabs mb-4">
                           <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                              <li class="nav-item">
                                 <a class="nav-link active" href="#pat_medical_records" data-toggle="tab"><span class="med-records">Riwayat Reservasi</span></a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#pat_billing" data-toggle="tab">Riwayat
                                    Pembayaran</a>
                              </li>
                           </ul>
                        </nav>
                        <!-- /Tab Menu -->
                        <!-- Tab Content -->
                        <div class="tab-content pt-0">
                           <!-- Medical Records Tab -->
                           <div id="pat_medical_records" class="tab-pane fade show active">
                              <div class="card card-table mb-0">
                                 <div class="card-body">
                                    <div class="table-responsive">
                                       <table class="table table-hover table-center mb-0">
                                          <thead>
                                             <tr>
                                                <th>ID</th>
                                                <th>Reservasi</th>
                                                <th>Check in </th>
                                                <th>Check out</th>
                                                <th>Status</th>
                                                <th></th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td><a href="javascript:void(0);">#MR-0010</a></td>
                                                <td>
                                                   <h2 class="table-avatar">
                                                      <a href="doctor-profile.html">Standard Room
                                                         <span>Kamar</span></a>
                                                   </h2>
                                                </td>
                                                <td>14 Nov 2019</td>
                                                <td>15 Nov 2019</td>
                                                <td> <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                                      Berhasil
                                                   </a></td>

                                                <td class="text-right">
                                                   <div class="table-action">
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                         <i class="far fa-eye"></i> View
                                                      </a>
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                         <i class="fas fa-print"></i> Print
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td><a href="javascript:void(0);">#MR-0008</a></td>
                                                <td>
                                                   <h2 class="table-avatar">
                                                      <a href="doctor-profile.html">Meeting
                                                         <span>Paket</span></a>
                                                   </h2>
                                                </td>
                                                <td>12 Nov 2019</td>
                                                <td>15 Nov 2019</td>
                                                <td> <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                                      dibatalkan
                                                   </a></td>
                                                <td class="text-right">
                                                   <div class="table-action">
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                         <i class="far fa-eye"></i> View
                                                      </a>
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                         <i class="fas fa-print"></i> Print
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>

                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /Medical Records Tab -->

                           <!-- Billing Tab -->
                           <div id="pat_billing" class="tab-pane fade">
                              <div class="card card-table mb-0">
                                 <div class="card-body">
                                    <div class="table-responsive">
                                       <table class="table table-hover table-center mb-0">
                                          <thead>
                                             <tr>
                                                <th>Invoice No</th>
                                                <th>Reservasi</th>
                                                <th>Biaya</th>
                                                <th>Diskon</th>
                                                <th>Bayar</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th></th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>
                                                   <a href="invoice-view.html">#INV-0010</a>
                                                </td>
                                                <td>
                                                   <h2 class="table-avatar">
                                                      <a href="doctor-profile.html">Standard Room
                                                         <span>Kamar</span></a>
                                                   </h2>
                                                </td>
                                                <td>Rp.450.000</td>
                                                <td>Rp.50.000</td>
                                                <td>Rp.400.000</td>
                                                <td>14 Nov 2019</td>
                                                <td> <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                                      Berhasil
                                                   </a>
                                                </td>
                                                <td class="text-right">
                                                   <div class="table-action">
                                                      <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                         <i class="far fa-eye"></i> View
                                                      </a>
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                         <i class="fas fa-print"></i> Print
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <a href="invoice-view.html">#INV-0010</a>
                                                </td>
                                                <td>
                                                   <h2 class="table-avatar">
                                                      <a href="doctor-profile.html">Standard Room
                                                         <span>Kamar</span></a>
                                                   </h2>
                                                </td>
                                                <td>Rp.450.000</td>
                                                <td>Rp.50.000</td>
                                                <td>Rp.400.000</td>
                                                <td>14 Nov 2019</td>
                                                <td> <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                                      Berhasil
                                                   </a>
                                                </td>
                                                <td class="text-right">
                                                   <div class="table-action">
                                                      <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                         <i class="far fa-eye"></i> View
                                                      </a>
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                         <i class="fas fa-print"></i> Print
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <a href="invoice-view.html">#INV-0010</a>
                                                </td>
                                                <td>
                                                   <h2 class="table-avatar">
                                                      <a href="doctor-profile.html">Standard Room
                                                         <span>Kamar</span></a>
                                                   </h2>
                                                </td>
                                                <td>Rp.450.000</td>
                                                <td>Rp.50.000</td>
                                                <td>Rp.400.000</td>
                                                <td>14 Nov 2019</td>
                                                <td> <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                                      Gagal
                                                   </a>
                                                </td>
                                                <td class="text-right">
                                                   <div class="table-action">
                                                      <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                         <i class="far fa-eye"></i> View
                                                      </a>
                                                      <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                         <i class="fas fa-print"></i> Print
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- /Billing Tab -->

                        </div>
                        <!-- Tab Content -->

                     </div>
                  </div>
               </div>
            </div>

         </div>

      </div>
      <!-- /Page Content -->