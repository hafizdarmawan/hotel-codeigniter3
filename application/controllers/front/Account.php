<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('front/account_model');
      $this->setting = get_setting();
      belum_login_tamu();
   }

   public function index()
   {
      $id_tamu = $this->session->userdata('id_tamu');
      $data['setting']            = get_setting();
      $data['reservasi']          = $this->account_model->get_data_reservasi($id_tamu);
      $data['berhasil']           = $this->account_model->get_reservasi_berhasil($id_tamu);
      $data['pending']            = $this->account_model->get_reservasi_pending($id_tamu);
      $data['gagal']              = $this->account_model->get_reservasi_gagal($id_tamu);
      $data['page_title']         = 'Dashboard';
      $data['tamu'] = $this->account_model->view_where('tamu', "id_tamu = '$id_tamu'")->row();
      $this->template->load('front/template/template', 'front/account/dashboard', $data);
   }

   function profile()
   {
      $id_tamu = $this->session->userdata('id_tamu');
      $data['setting']            = get_setting();
      $data['page_title']         = 'Dashboard';
      $data['tamu'] = $this->account_model->view_where('tamu', "id_tamu = '$id_tamu'")->row();
      $this->template->load('front/template/template', 'front/account/profile_setting', $data);
   }

   function edit_image($id)
   {
      $tamu   =   $this->account_model->view_where('tamu', "id_tamu = '$id'")->row();
      $files = $_FILES;
      $save_img   =   array();
      if (!empty($files)) {
         $cpt = count($_FILES['image']['name']);
         for ($i = 0; $i < $cpt; $i++) {
            if (!empty($files['image']['name'][$i])) {
               $_FILES['userfile']['name'] =    $file_name   =   time() . rand(1, 988) . '.' . substr(strrchr($files['image']['name'][$i], '.'), 1);
               $_FILES['userfile']['type'] = $files['image']['type'][$i];
               $_FILES['userfile']['tmp_name'] = $files['image']['tmp_name'][$i];
               $_FILES['userfile']['error'] = $files['image']['error'][$i];
               $_FILES['userfile']['size'] = $files['image']['size'][$i];

               //$file_name	= time().rand(1,988).'.jpg';
               $save_img['image']      =   $file_name;
               $config['upload_path'] = 'assets/img/guests/';
               $config['allowed_types'] = 'jpg|png|jpeg';
               $config['max_size']   = '10000';
               $config['max_width']  = '10000';
               $config['max_height']  = '6000';
               //$config['file_name'] = $file_name;
               $this->upload->initialize($config);

               if ($this->upload->do_upload()) {
                  $upload_data   = $this->upload->data();
                  $this->account_model->update_images($save_img, $id);
                  unlink('./assets/img/guests/' . $tamu->image);
               }
               if ($this->upload->display_errors() != '') {
                  $data['error'] = $this->upload->display_errors();
                  //echo '<pre>'; print_r($data['error']);die;
               }
               $this->load->library('image_lib');
               //this is the medium image
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/guests/' . $upload_data['file_name'];
               $config['new_image']   = 'assets/img/guests/' . $upload_data['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
            }
         }
      } //End Files Is Not Empt
   }

   function update_profile()
   {
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
         redirect(base_url('profile/setting'));
         // $this->profile();
      } else {
         $data = array(
            'nama_depan'                => $this->db->escape_str($this->input->post('nama_depan')),
            'nama_belakang'             => $this->db->escape_str($this->input->post('nama_belakang')),
            'tempat_lahir'              => $this->db->escape_str($this->input->post('tempat_lahir')),
            'tanggal_lahir'             => $this->db->escape_str($this->input->post('tanggal_lahir')),
            'jenis_kelamin'             => $this->db->escape_str($this->input->post('jenis_kelamin')),
            // 'email'                     => $this->db->escape_str($this->input->post('email')),
            'no_telepon'                => $this->db->escape_str($this->input->post('no_telepon')),
            'alamat'                    => $this->db->escape_str($this->input->post('alamat')),
            'diubah'                   => date('Y-m-d H:i:s')
         );
         $where = array('id_tamu' => $this->db->escape_str($this->input->post('id_tamu')));
         $this->account_model->update('tamu', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Mengubah Data", "success");');
         redirect(base_url('profile/setting'));
      }
   }

   function _validation()
   {
      $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'trim|required', array(
         'required' => 'Nama Depan Wajib Di isi.',
      ));
      $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'trim|required', array(
         'required' => 'Nama Belakang Wajib Di isi.',
      ));

      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array(
         'required' => 'Tempat Lahir Wajib Di isi.',
      ));
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required', array(
         'required' => 'Tanggal Lahir Wajib Di isi.',
      ));

      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', array(
         'required' => 'Jenis Kelamin Wajib Di isi.',
      ));

      // $this->form_validation->set_rules('email', 'Email', 'trim|required', array(
      //    'required' => 'Email Wajib Di isi.',
      // ));

      $this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim|required', array(
         'required' => 'No Telepon Wajib Di isi.',
      ));
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array(
         'required' => 'Alamat Wajib Di isi.',
      ));
   }

   function update_password()
   {
      $id_tamu      = $this->session->userdata('id_tamu');
      $tamu         = $this->account_model->view_where('tamu', "id_tamu = '$id_tamu'")->row();
      $old_password = sha1(md5($this->db->escape_str($this->input->post('old_password'))));
      if ($tamu->password == $old_password) {
         if (!empty($this->input->post('password') || $this->input->post('konfirmasi_pass'))) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[konfirmasi_pass]', array(
               'required' => 'Password Wajib Di isi.',
               'matches' => 'Password Tidak Sama.',
               'min_length' => 'Minimal 6 Karakter'
            ));
            $this->form_validation->set_rules('konfirmasi_pass', 'Konfirmasi Pass', 'trim|required|matches[password]', array(
               'required' => 'Password Wajib Di isi.',
               'matches' => 'Password Tidak Sama.',
            ));
         }
         if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
            redirect(base_url('profile/setting'));
         } else {
            $data = array(
               'password'                => $this->db->escape_str(sha1(md5($this->input->post('password')))),
               'diubah'                  => date('Y-m-d H:i:s')
            );

            $where = array('id_tamu' => $id_tamu);
            $this->account_model->update('tamu', $data, $where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Password Berhasil diubah", "success");');
            // $this->session->set_flashdata('flash', 'Ditambah');
            redirect(base_url('profile/setting'));
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Password Lama Tidak Sama", "error");');
         redirect(base_url('profile/setting'));
      }
   }

   function pdf()
   {
   }

   function mail_cancel()
   {
   }
}
