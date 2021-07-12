<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/pengguna_model');
      belum_login_admin();
      cek_session_admin();
   }

   // *********************************************************
   //tampil list pengguna
function index()
{
      $data['page_title']   = 'Pengguna';
      $data['pengguna']   = $this->pengguna_model->get_all();
      $this->template->load('back/template/template', 'back/pengguna/list', $data);
}
  
   // view tambah pengguna
   function tambah()
   {
      $data['page_title']         = 'Tambah Pengguna';
      $this->template->load('back/template/template', 'back/pengguna/form_tambah', $data);
   }

   // view ubah pengguna
   function ubah($id_user =null){
      $data['page_title']         = 'Form Pengguna';
      $data['pengguna']           = $this->pengguna_model->get($id_user);
      $this->template->load('back/template/template', 'back/pengguna/form_ubah', $data);
   }

   // tambah aksi pengguna
   function tambah_aksi(){
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[12]|is_unique[users.username]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data pengguna Tidak Tersimpan", "error");');
         $this->tambah();
      } else {
         $data = array(
            'nama_depan'                => $this->db->escape_str($this->input->post('nama_depan')),
            'nama_belakang'             => $this->db->escape_str($this->input->post('nama_belakang')),
            'username'                  => $this->db->escape_str($this->input->post('username')),
            'email'                     => $this->db->escape_str($this->input->post('email')),
            'password'                  => $this->db->escape_str(sha1(md5($this->input->post('password')))),
            'no_telepon'                => $this->db->escape_str($this->input->post('no_telepon')),
            'jenis_kelamin'             => $this->db->escape_str($this->input->post('jenis_kelamin')),
            'tempat_lahir'              => $this->db->escape_str($this->input->post('tempat_lahir')),
            'tanggal_lahir'             => $this->db->escape_str($this->input->post('tanggal_lahir')),
            'alamat'                    => $this->db->escape_str($this->input->post('alamat')),
            'level_users'               => $this->db->escape_str($this->input->post('level_users')),
            'status_users'              => $this->db->escape_str($this->input->post('status_users')),
         );

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
               $config['quality'] = '60%';
               $config['width'] = 600;
               $config['height'] = 500;
               $config['new_image'] = './assets/img/pengguna/' . $foto['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $foto['file_name'];
               $data['foto'] = $gambar;
            }
         }
         $this->pengguna_model->insert('users', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data pengguna berhasil tersimpan", "success");');
         redirect(base_url('admin/pengguna'));
      }
   }

   // ubah aksi pengguna
   function ubah_aksi(){
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]', array(
            'required' => 'Username Wajib Di isi.',
            'min_length' => 'Minimal 6 Karakter'
         ));
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      if( !empty($this->input->post('password') || $this->input->post('konfirmasi_pass'))){
         $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[konfirmasi_pass]', array(
            'required' => 'Password Wajib Di isi.',
            'matches' => 'Password Tidak Sama.',
            'min_length' => 'Minimal 6 Karakter'
         ));
         $this->form_validation->set_rules('konfirmasi_pass', 'Konfirmasi Pass', 'trim|required|matches[password]', array(
            'required' => 'Password Wajib Di isi.',
         ));
      }

      $this->_validation();
        if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data pengguna gagal diubah", "error");');
            $this->ubah();
        } else {
            $data = array(
            'nama_depan'                => $this->db->escape_str($this->input->post('nama_depan')),
            'nama_belakang'             => $this->db->escape_str($this->input->post('nama_belakang')),
            'username'                  => $this->db->escape_str($this->input->post('username')),
            'email'                     => $this->db->escape_str($this->input->post('email')),
            // 'password'                  => $this->db->escape_str(sha1(md5($this->input->post('password')))),
            'no_telepon'                => $this->db->escape_str($this->input->post('no_telepon')),
            'jenis_kelamin'             => $this->db->escape_str($this->input->post('jenis_kelamin')),
            'tempat_lahir'              => $this->db->escape_str($this->input->post('tempat_lahir')),
            'tanggal_lahir'             => $this->db->escape_str($this->input->post('tanggal_lahir')),
            'alamat'                    => $this->db->escape_str($this->input->post('alamat')),
            'level_users'               => $this->db->escape_str($this->input->post('level_users')),
            'status_users'              => $this->db->escape_str($this->input->post('status_users')),
            'tgl_diubah'                    => date('Y-m-d H:i:s')
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
                    $config['quality'] = '60%';
                    $config['width'] = 600;
                    $config['height'] = 500;
                    $config['new_image'] = './assets/img/pengguna/' . $foto['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar = $foto['file_name'];
                    $data['foto'] = $gambar;
                    $lokasi_target  = './assets/img/pengguna/';
                    @unlink($lokasi_target . $foto_lama);
                }
            }

            $password             = $this->db->escape_str($this->input->post('password'));
            if ($password) {
                $data['password'] = $this->db->escape_str(sha1(md5($this->input->post('password'))));
            }
            $where = array('id_user' => $this->db->escape_str($this->input->post('id_user')));
            $this->pengguna_model->update('users', $data, $where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data pengguna berhasil diubah", "success");');
         redirect(base_url('admin/pengguna'));
      }
   }

   // hapus pengguna
   function hapus($id_user)
   {
      $lokasi_target  = './assets/img/pengguna/';
      $users = $this->pengguna_model->view_where('users', "id_user='$id_user'")->row();
      $foto = $users->foto;
      unlink($lokasi_target . $foto);
      $where = array('id_user' => $id_user);
      $this->pengguna_model->delete('users', $where);
      $this->session->set_flashdata('message', 'swal("Berhasil", "Data pengguna berhasil dihapus", "success");');
      redirect(base_url('admin/pengguna'));
   }

   // validasi pengguna
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
      $this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim|required', array(
         'required' => 'No Telepon Wajib Di isi.',
      ));
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', array(
         'required' => 'Jenis Kelamin Wajib Di isi.',
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
      $this->form_validation->set_rules('level_users', 'Level pengguna', 'trim|required', array(
         'required' => 'Level pengguna Wajib Di isi.',
      ));
      $this->form_validation->set_rules('status_users', 'Status pengguna', 'trim|required', array(
         'required' => 'Status pengguna Wajib Di isi.',
      ));
   }

}
