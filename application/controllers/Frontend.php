<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('front/frontend_model');
      $this->load->model('front/login_model');
      $this->load->model('front/account_model');
      $this->setting   =   get_setting();
   }

    function index()
   {
      $data['setting']         = $setting = get_setting();
      $data['page_title']      = 'Home';
      $data['banner']          = $this->frontend_model->view_where('banner', "status = '1'")->result();
      $data['tipe_kamar']      = $this->frontend_model->get_room_types();
      $data['fasilitas']       = $this->frontend_model->view_where('fasilitas',"status = '1'")->result();  
      $data['voucher']         = $this->frontend_model->get_coupons();
      $this->template->load('front/template/template', 'front/Home/home', $data);
   }

   function beranda()
   {
      $this->index();
   }

   function kamar_detail($slug){
      $data['tipe_kamar']         =   $tipe_kamar   =    $this->frontend_model->view_where('tipe_kamar',"slug = '$slug' ")->row();
      $data['fasilitas']          = $this->frontend_model->get_amenities_active($tipe_kamar->id_tipe_kamar);
      $data['tipe_kamar_']        = $this->frontend_model->get_room_types();
      $data['gambar']             = $this->frontend_model->get_images($tipe_kamar->id_tipe_kamar);
      $data['setting']            = get_setting();
      $data['page_title']         = $tipe_kamar->judul;
      $this->template->load('front/template/template', 'front/Home/detail_room', $data);	

   }

   function check()
   {
      $check   =   check_availability_ajax($_POST['date_from'], $_POST['date_to'],$_POST['jml_kamar'], $_POST['tipe_kamar']);
      echo $check;
   }

   function tentang(){
      $data['setting']         = get_setting();
      $data['page_title']      = 'Tentang Hotel';
      $data['tipe_kamar']      = $this->frontend_model->get_room_types();
      $this->template->load('front/template/template', 'front/tentang/about_us',$data);
   }

   function kontak()
   {
      $data['setting']            = get_setting();
      $data['page_title']         = 'Kontak Hotel';
      $this->template->load('front/template/template', 'front/kontak/contact',$data);
   }

   function gallery()
   {
      $data['page_title']         = 'Galleri';
      $data['setting']            = get_setting();
      $data['gallery']            = $this->frontend_model->view('galleri')->result();
      $data['images']             = $this->frontend_model->view('galleri_rel_gambar')->result();
      $this->template->load('front/template/template', 'front/gallery/gallery',$data);
   }

}
