<body style="background-color: white">
   <!-- Preloader -->
   <div id="preloader">
      <div class="loader"></div>
   </div>
   <!-- /Preloader -->
   <header class="header_area">
      <div class="main_menu">
         <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
               <a class="navbar-brand logo_h" href="<?= base_url('') ?>"><img src="<?= base_url('assets/img/logo/') . $this->setting->logo ?>" style="width: 45px;" alt="<?= $this->setting->name ?>"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                  <ul class="nav navbar-nav menu_nav ml-auto mr-4">
                     <li class="nav-item <?= $this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('') ?>">Beranda</a></li>
                     <li class="nav-item submenu dropdown <?= $this->uri->segment(1) == 'rooms' ? 'active' : '' ?>">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kamar</a>
                        <?php $data_type_kamar = get_tipe_kamar() ?>
                        <ul class="dropdown-menu">
                           <?php foreach ($data_type_kamar as $data) : ?>
                              <li class="nav-item"><a class="nav-link" href="<?= base_url('rooms/') . $data->slug ?>"><?= $data->judul ?></a>
                              </li>
                           <?php endforeach; ?>
                        </ul>
                     </li>
                     <li class="nav-item <?= $this->uri->segment(1) == 'galleri' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('galleri') ?>">Galleri</a></li>
                     <li class="nav-item <?= $this->uri->segment(1) == 'tentang' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tentang') ?>">Tentang Hotel</a></li>
                  </ul>
                  <?php if (!empty($this->session->userdata('id_tamu'))) : ?>
                     <?php $image = get_foto_tamu($this->session->userdata('id_tamu')) ?>
                     <ul class="nav navbar-nav menu_nav mr-5 mb-1">
                        <li class="nav-item submenu dropdown">
                           <?php if (!empty($image->image)) : ?>
                              <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('assets/img/guests/') . $image->image ?>" class="rounded-circle shadow" style="width: 35px;" alt=""> <?= $this->session->userdata('nama_depan') ?> <?= $this->session->userdata('nama_belakang') ?></a>
                           <?php else : ?>
                              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('assets/img/guests/guests.png') ?>" class="rounded-circle shadow" style="width: 50px;" alt=""> <?= $this->session->userdata('nama_depan') ?> <?= $this->session->userdata('nama_belakang') ?></a>
                           <?php endif ?>
                           <ul class="dropdown-menu">
                              <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                              <li class="nav-item"><a class="nav-link" href="<?= base_url('profile/setting') ?>">Profile</a>
                              <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#ModalLogout">Logout</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  <?php else : ?>
                     <a href="<?= base_url('login') ?>" class="btn btn-sm btn-nav genric-btn danger arrow shadow">Login/
                        Pendaftaran</a>
                  <?php endif; ?>
               </div>
            </div>
         </nav>
      </div>
   </header>

   <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' || $this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'forgot' || $this->uri->segment(1) == 'reset') : ?>
   <?php else : ?>
      <div class="breadcrumb-bar shadow">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-12 col-12">
                  <nav aria-label="breadcrumb" class="page-breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $page_title ?></li>
                     </ol>
                  </nav>
                  <h2 class="breadcrumb-title"><?= $page_title ?></h2>
               </div>
            </div>
         </div>
      </div>
   <?php endif; ?>