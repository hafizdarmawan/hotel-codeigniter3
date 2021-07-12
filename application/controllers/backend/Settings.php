<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/settings_model');
      belum_login_admin();
      cek_session_admin();
   }

   function index()
   {
      $data['page_title']        = 'Setting';
      $data['id_setting']        = '';
      $data['nama']              = '';
      $data['maintenance_mode']  = 0;
      $data['setting']           =   $setting      = $this->settings_model->view_where('settings',"id_setting = 1")->row();

      if (!empty($setting)) {
         $data['id_setting']               = $setting->id_setting;
         $data['nama']                     = $setting->nama;
         $data['maintenance_mode']         = $setting->maintenance_mode;
         $data['room_block_period']        = $setting->room_block_start_date . ' / ' . $setting->room_block_end_date;
      }
      $this->template->load('back/template/template', 'back/administrative/settings/form',$data);
   }

   function ubah_aksi(){
      $id_setting                      =   $this->input->post('id_setting');
      $data = array(
         'nama'                        => $this->input->post('nama'),
         'alamat'                      => $this->input->post('alamat'),
         'map'                         => $this->input->post('map'),
         'email'                       => $this->input->post('email'),
         'no_telepon'                  => $this->input->post('no_telepon'),
         'fax'                         => $this->input->post('fax'),
         'footer_text'                 => $this->input->post('footer_text'),
         'format_tanggal'              => $this->input->post('format_tanggal'),
         'minimum_booking'             => $this->input->post('minimum_booking'),
         'pembayaran_dp'               => $this->input->post('pembayaran_dp'),
         'waktu_check_in'              => $this->input->post('waktu_check_in'),
         'waktu_check_out'             => $this->input->post('waktu_check_out'),
         'format_waktu'                => $this->input->post('format_waktu'),
         'smtp_mail'                   => $this->input->post('smtp_mail'),
         'smtp_host'                   => $this->input->post('smtp_host'),
         'smtp_user'                   => $this->input->post('smtp_user'),
         'smtp_pass'                   => $this->input->post('smtp_pass'),
         'smtp_port'                   => $this->input->post('smtp_port'),
         'invoice'                     => $this->input->post('invoice'),
         'midtrans'                    => $this->input->post('midtrans'),
         'client_key'                  => $this->input->post('client_key'),
         'server_key'                  => $this->input->post('server_key'),
         'marchant_id'                 => $this->input->post('marchant_id'),
         'durasi_bayar'                => $this->input->post('durasi_bayar'),
         'facebook_link'               => $this->input->post('facebook_link'),
         'instagram_link'              => $this->input->post('instagram_link'),
         'twitter_link'                => $this->input->post('twitter_link'),
         'google_plus_link'            => $this->input->post('google_plus_link'),
         'linkedin_link'               => $this->input->post('linkedin_link'),
         'section_judul'               => $this->input->post('section_judul'),
         'section_deskripsi'           => $this->input->post('section_deskripsi'),
         'sort_section_deskripsi'      => $this->input->post('sort_section_deskripsi')      ,
         'meta_description'            => $this->input->post('meta_description'),
         'meta_keywords'               => $this->input->post('meta_keywords'),
      );

      $this->load->library('upload');
      if (!empty($_FILES['logo']['name'])) {
         $_FILES['userfile']['name'] = time() . rand(1, 988) . '.' . substr(strrchr($_FILES['logo']['name'], '.'), 1);
         $_FILES['userfile']['tmp_name'] = $_FILES['logo']['tmp_name'];
         $_FILES['userfile']['type'] = $_FILES['logo']['type'];
         $_FILES['userfile']['error'] = $_FILES['logo']['error'];
         $_FILES['userfile']['size'] = $_FILES['logo']['size'];
         $data['logo'] = $_FILES['userfile']['name'];
         $this->upload->initialize($this->set_upload_options());
         $flag = $this->upload->do_upload();
         $this->upload->data();
         if (file_exists(BASEPATH . '../assets/img/logo' . $this->input->post('old_logo')) && $flag)
         unlink(BASEPATH . '../assets/img/logo' . $this->input->post('old_logo'));
      }
      if (!empty($_FILES['image']['name'])) {
         $_FILES['userfile']['name'] = time() . rand(1, 988) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
         $_FILES['userfile']['tmp_name'] = $_FILES['image']['tmp_name'];
         $_FILES['userfile']['type'] = $_FILES['image']['type'];
         $_FILES['userfile']['error'] = $_FILES['image']['error'];
         $_FILES['userfile']['size'] = $_FILES['image']['size'];
         $data['image'] = $_FILES['userfile']['name'];
         $this->upload->initialize($this->set_upload_options());
         $flag = $this->upload->do_upload();
         $this->upload->data();
         if (file_exists(BASEPATH . '../assets/img/logo' . $this->input->post('old_image')) && $flag)
         unlink(BASEPATH . '../assets/img/logo' . $this->input->post('old_image'));
      }
      $where = array('id_setting' => $id_setting);
      $this->settings_model->update('settings',$data,$where);
      $this->session->set_flashdata('message', 'swal("Berhasil", "Data setting berhasil diubah", "success");');
      redirect(base_url('admin/settings'));
   }
   
   private function set_upload_options()
   {
      $config = array();
      $config['upload_path'] = BASEPATH . '../assets/img/logo';
      $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG';
      $config['max_size'] = '0'; // 0 = no file size limit
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['overwrite'] = TRUE;
      return $config;
   }	
}
