<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/profile_model');
      $this->load->model('back/pengguna_model');
      belum_login_admin();
      cek_session_resepsionis();
   }

   // view profil
   function index()
   {
      $data['page_title']  = 'Profile';
      $id_user             = $this->session->userdata('id_user');
      $data['user']        = $this->profile_model->view_where('users',"id_user = '$id_user'")->row();
      $this->template->load('back/template/template', 'back/profile/form',$data);
   }

   // ubah aksi profil
   function ubah_aksi(){
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data profil gagal diubah", "error");');
         $this->index();
      } else {
         $data = array(
            'nama_depan'                => $this->db->escape_str($this->input->post('nama_depan')),
            'nama_belakang'             => $this->db->escape_str($this->input->post('nama_belakang')),
            'username'                  => $this->db->escape_str($this->input->post('username')),
            'email'                     => $this->db->escape_str($this->input->post('email')),
            'no_telepon'                => $this->db->escape_str($this->input->post('no_telepon')),
            'jenis_kelamin'             => $this->db->escape_str($this->input->post('jenis_kelamin')),
            'tempat_lahir'              => $this->db->escape_str($this->input->post('tempat_lahir')),
            'tanggal_lahir'             => $this->db->escape_str($this->input->post('tanggal_lahir')),
            'alamat'                    => $this->db->escape_str($this->input->post('alamat')),
            'tgl_diubah'                => date('Y-m-d H:i:s')
         );

         if ($this->input->post('foto_lama') != '') {
            $foto_lama            = $this->input->post('foto_lama');
         }
         $gambar      = $_FILES['foto']['name'];
         if ($gambar) {
            $config['upload_path']   = './assets/img/pengguna/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
               echo "Upload Gagal";
            } else {
               $foto = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/img/pengguna/' . $foto['file_name'];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               $config['quality'] = '70%';
               $config['width'] = 600;
               $config['height'] = 600;
               $config['new_image'] = './assets/img/pengguna/' . $foto['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $foto['file_name'];
               $data['foto'] = $gambar;
               $lokasi_target  = './assets/img/pengguna/';
               unlink($lokasi_target . $foto_lama);
            }
         }
         $password             = $this->db->escape_str($this->input->post('password'));
         if ($password) {
            $data['password'] = $this->db->escape_str(sha1(md5($this->input->post('password'))));
         }
         $where = array('id_user' => $this->db->escape_str($this->input->post('id_user')));
         $this->pengguna_model->update('users', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data profil berhasil diubah", "success");');
         redirect(base_url('admin/profile'));
      }
   }

   // validasi
   function _validation(){
      $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'trim|required|max_length[50]', array(
         'required' => 'Nama Depan Wajib Di isi.',
         'max_length' => 'Maksimal 50 huruf'
      ));
      $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'trim|required|max_length[50]', array(
         'required' => 'Nama Belakang Wajib Di isi.',
         'is_unique' => 'Maksimal 50 huruf'
      ));
      // $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[50]', array(
      //    'required' => 'Username Wajib Di isi.',
      //    'max_length' => 'Maksimal 50 huruf',
      //    'is_unique' => 'Username Sudah Di Gunakan'
      // ));
      // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array(
      //    'required' => 'Email Wajib Di isi.',
      //    'is_unique' => 'Email Sudah Di Gunakan'
      // ));
      $this->form_validation->set_rules('no_telepon', 'Phone', 'trim|required', array(
         'required' => 'Phone Wajib Di isi.',
      ));
      $this->form_validation->set_rules('jenis_kelamin', 'Gender', 'trim|required', array(
         'required' => 'Gender Wajib Di isi.',
      ));
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array(
         'required' => 'Tempat lahir Wajib Di isi.',
      ));
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required', array(
         'required' => 'Tanggal Lahir Wajib Di isi.',
      ));
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array(
         'required' => 'Alamat Wajib Di isi.',
      ));
   }

   // ubah password
   function ubah_password(){
      $id_user      = $this->session->userdata('id_user');
      $user         = $this->profile_model->view_where('users',"id_user = '$id_user'")->row();
      $password_old = sha1(md5($this->db->escape_str($this->input->post('password_old'))));
      if($user->password == $password_old){
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
            $this->session->set_flashdata('message', 'swal("Gagal", "Data password gagal diubah", "error");');
            $this->index();
         } else {
            $data = array(
               'password'                => $this->db->escape_str(sha1(md5($this->input->post('password')))),
               'tgl_diubah'                    => date('Y-m-d H:i:s')
            );
           
            $where = array('id_user' => $id_user);
            $this->pengguna_model->update('users', $data, $where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data password berhasil diubah", "success");');
            // $this->session->set_flashdata('flash', 'Ditambah');
            redirect(base_url('admin/profile'));
         }
      }
      else{
         $this->session->set_flashdata('message', 'swal("Gagal", "Data password lama tidak sesuai", "error");');
         redirect(base_url('admin/profile'));
      }
   }
}
