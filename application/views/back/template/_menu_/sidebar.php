<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <?php $setting = get_setting() ?>
   <a href="<?= base_url('admin/dashboard') ?>" class="brand-link text-center">
      <!-- <img src="<?= base_url('assets/img/logo/') . $setting->logo ?>" alt="<?= $setting->nama ?>" class="" style="opacity: .8; width: 30px;"> -->
      Hotel Al Ashri Inn
   </a>
   <div class="sidebar">
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= $this->uri->segment(2) == 'dashboard' || '' ? ' active' : '' ?> ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'booking' ? 'menu-open' : '' ?>">
               <a href="#" class="nav-link <?= $this->uri->segment(2) == 'booking' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                     Reservasi
                     <i class="right fas fa-angle-left"></i>
                     <!-- <span class="badge badge-info right">1</span> -->
                     <?php $data_order_new = get_order_new() ?>
                     <?php if(count($data_order_new) > 0) :?>
                     <span class="right badge badge-danger">Baru</span>
                     <?php endif ?>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="<?= base_url('admin/booking/data') ?>" class="nav-link <?= $this->uri->segment(3) == 'data' || $this->uri->segment(3) == 'detail'  ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Check In/Out</p>
                        <?php if(count($data_order_new) > 0) :?>
                        <span class="badge badge-info right"><?= count($data_order_new)?></span>
                        <?php endif ?>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= base_url('admin/booking/riwayat') ?>" class="nav-link <?= $this->uri->segment(3) == 'riwayat' || $this->uri->segment(3) == 'detail_riwayat' ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Riwayat Reservasi</p>
                     </a>
                  </li>
               </ul>
            </li>
            <?php if ($this->session->userdata('level_users') == '1') : ?>
               <li class="nav-item">
                  <a href="<?= base_url('admin/customer') ?>" class="nav-link <?= $this->uri->segment(2) == 'customer' ? ' active' : '' ?>">
                     <i class="nav-icon fas fa-users"></i>
                     <p>
                        Data Tamu Hotel
                     </p>
                  </a>
               </li>
            <?php endif ?>
            <li class="nav-item">
               <a href="<?= base_url('admin/calender') ?>" class="nav-link  <?= $this->uri->segment(2) == 'calender' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                     Kalender
                  </p>
               </a>
            </li>
            <?php if ($this->session->userdata('level_users') == '1') : ?>
               <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'lantai' || $this->uri->segment(2) == 'amenities' || $this->uri->segment(2) == 'tipe' || $this->uri->segment(2) == 'service' || $this->uri->segment(2) == 'price' || $this->uri->segment(2) == 'kamar' || $this->uri->segment(2) == 'coupon' || $this->uri->segment(2) == 'housekeep' || $this->uri->segment(2) == 'housekeeping' ? 'menu-open' : '' ?>">
                  <a href="#" class="nav-link <?= $this->uri->segment(2) == 'lantai' || $this->uri->segment(2) == 'amenities' || $this->uri->segment(2) == 'tipe' || $this->uri->segment(2) == 'service' || $this->uri->segment(2) == 'price' || $this->uri->segment(2) == 'kamar' || $this->uri->segment(2) == 'coupon' || $this->uri->segment(2) == 'housekeep' || $this->uri->segment(2) == 'housekeeping'  ? 'active' : '' ?>">
                     <i class="nav-icon fas fa-hotel"></i>
                     <p>
                        Setting Hotel
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item ">
                        <a href="<?= base_url('admin/lantai') ?>" class="nav-link <?= $this->uri->segment(2) == 'lantai' ? ' active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Lantai Hotel</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/tipe') ?>" class="nav-link <?= $this->uri->segment(2) == 'tipe' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipe Kamar</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/kamar') ?>" class="nav-link <?= $this->uri->segment(2) == 'kamar' || $this->uri->segment(2) == 'housekeeping' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Kamar</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/price') ?>" class="nav-link <?= $this->uri->segment(2) == 'price' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Harga</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/amenities') ?>" class="nav-link <?= $this->uri->segment(2) == 'amenities' ? ' active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Fasilitas</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/service') ?>" class="nav-link <?= $this->uri->segment(2) == 'service' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Layanan</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/coupon') ?>" class="nav-link <?= $this->uri->segment(2) == 'coupon' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Voucher</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'laporan' ? 'menu-open' : '' ?>">
                  <a href="#" class="nav-link <?= $this->uri->segment(2) == 'laporan' ? 'active' : '' ?>">
                     <i class="nav-icon fas fa-pager"></i>
                     <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="<?= base_url('admin/laporan/occupancy') ?>" class="nav-link <?= $this->uri->segment(3) == 'occupancy' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Laporan Reservasi</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/laporan/keuangan') ?>" class="nav-link <?= $this->uri->segment(3) == 'keuangan' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Laporan Keuangan</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/laporan/kamar') ?>" class="nav-link <?= $this->uri->segment(3) == 'kamar' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Laporan Kamar</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/laporan/tamu') ?>" class="nav-link <?= $this->uri->segment(3) == 'tamu' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Laporan Tamu</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/laporan/voucher') ?>" class="nav-link <?= $this->uri->segment(3) == 'voucher' ? 'active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Laporan Voucher</p>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'pages' || $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'banners' || $this->uri->segment(2) == 'gallery' || $this->uri->segment(2) == 'tempmail' || $this->uri->segment(2) == 'igallery' ? 'menu-open' : '' ?>">
                  <a href="#" class="nav-link <?= $this->uri->segment(2) == 'pages' || $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'banners' || $this->uri->segment(2) == 'gallery' || $this->uri->segment(2) == 'tempmail' || $this->uri->segment(2) == 'igallery' ? 'active' : '' ?>">
                     <i class="nav-icon fas fa-window-restore"></i>
                     <p>
                        CMS & Setting
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="<?= base_url('admin/banners') ?>" class="nav-link <?= $this->uri->segment(2) == 'banners' ? ' active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Banner</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/gallery') ?>" class="nav-link <?= $this->uri->segment(2) == 'gallery' || $this->uri->segment(2) == 'igallery' ? ' active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Galleri</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url('admin/settings') ?>" class="nav-link <?= $this->uri->segment(2) == 'settings' ? ' active' : '' ?>">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Setting</p>
                        </a>
                     </li>
                     <!-- <li class="nav-item">
                     <a href="<?= base_url('admin/tempmail') ?>" class="nav-link <?= $this->uri->segment(2) == 'tempmail' ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Template Email</p>
                     </a>
                  </li> -->
                  </ul>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url('admin/pengguna') ?>" class="nav-link <?= $this->uri->segment(2) == 'pengguna' ? ' active' : '' ?>">
                     <i class="nav-icon fas fa-users"></i>
                     <p>Pengguna Sistem</p>
                  </a>
               </li>
            <?php endif ?>
            <li class="nav-item">
               <a href="<?= base_url('admin/profile') ?>" class="nav-link <?= $this->uri->segment(2) == 'profile' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                     Profile
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link" data-toggle="modal" data-target="#ModalLogout">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                     Logout
                  </p>
               </a>
            </li>
         </ul>
      </nav>
   </div>
</aside>