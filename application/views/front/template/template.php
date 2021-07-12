 <?php include '_menu/header.php'; ?>
 <?php include '_menu/navbar.php' ?>
 <!-- Main Content -->
 <div class="main-content">
    <?= $konten ?>
    <script src="<?= base_url('assets/front/assets/js/') ?>sweetalert.min.js"></script>
    <?php echo "<script>" . $this->session->flashdata('message') . "</script>" ?>
    </section>
 </div>
 <?php $this->session->unset_userdata('message') ?>
 <?php include '_menu/footer.php'; ?>