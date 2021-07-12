    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/dropify/css/dropify.css">
    <link href="<?= base_url('assets/admin/plugins/iCheck/all.css') ?>" rel="stylesheet" type="text/css" />
    <style>
       .error {
          color: #FF0000;
       }

       #gender-error {
          width: 200px;
          padding-top: 15px;
       }
    </style>
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
                   <h3 class="card-title">Detail Lantai Hotel</h3>
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                      <table class="table">
                         <tbody>
                            <tr>
                               <th style="width:50%">Nama:</th>
                               <td><?= $lantai->nama ?></td>
                            </tr>
                            <tr>
                               <th>No Lantai:</th>
                               <td><?= $lantai->no_lantai ?></td>
                            </tr>
                            <tr>
                               <th>Status:</th>
                               <td><?= $lantai->no_lantai = 1 ? 'Aktif' : 'Non-aktif' ?></td>
                            </tr>
                            <tr>
                               <th>Deskripsi:</th>
                               <td><?= $lantai->deskripsi ?></td>
                            </tr>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </section>
    </div>