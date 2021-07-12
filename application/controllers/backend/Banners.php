<?php
defined('BASEPATH') or exit('No direct script access allowed');

class banners extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/banner_model');
      belum_login_admin();
      cek_session_admin();
   }

   // tampil view list
   function index()
   {
      $data['page_title']   = 'Banner';
      $data['banners']   = $this->banner_model->view('banner')->result();
      $this->template->load('back/template/template', 'back/konten/banners/list', $data);
   }

// tampil view tambah
   function tambah()
   {
      $data['page_title']   = 'Tambah Banner';
      $this->template->load('back/template/template', 'back/konten/banners/form_tambah', $data);
   }

   // tambah banner aksi
   function tambah_aksi()
   {
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data banner Tidak Tersimpan", "error");');
         $this->tambah();
      } else {
         $data = array(
            'nama'                          => $this->db->escape_str($this->input->post('nama')),
            'judul'                         => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                     => $this->db->escape_str($this->input->post('deskripsi')),
            'status'                        => $this->db->escape_str($this->input->post('status')),
            'id_user'                       => $this->session->userdata('id_user')
         );

         // upload gambar
         $gambar      = $_FILES['gambar']['name'];
         if ($this->input->post('image_lama') != '') {
            $image_lama            = $this->input->post('image_lama');
         }
         $config['upload_path']   = './assets/img/banners/';
         $config['allowed_types'] = 'jpg|png|jpeg|gif';
         $config['encrypt_name']  = TRUE;
         $this->upload->initialize($config);
         if (!$this->upload->do_upload('gambar')) {
            echo "Upload Gagal";
         } else {
            $image = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/banners/' . $image['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '80%';
            // $config['width'] = 600;
            // $config['height'] = 500;
            $config['new_image'] = './assets/img/banners/' . $image['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $image['file_name'];
            $data['gambar'] = $gambar;
            $lokasi_target  = './assets/img/banners/';
            @unlink($lokasi_target . $image_lama);
         }
         // insert
         $this->banner_model->insert('banner', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data banner berhasil tersimpan", "success");');
         redirect(base_url('admin/banners'));
      }
   }

   // tampil view ubah
   function ubah($id_banner = null)
   {
      $data['page_title']   = 'Ubah Banner';
      $data['banners']   = $this->banner_model->view_where('banner',"id_banner = '$id_banner'")->row();
      $this->template->load('back/template/template', 'back/konten/banners/form_ubah', $data);
   }

   // ubah aksi banner
   function ubah_aksi()
   {
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data banner gagal diubah", "error");');
         $this->ubah();
      } else {
         $data = array(
            'nama'                        => $this->db->escape_str($this->input->post('nama')),
            'judul'                       => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                   => $this->db->escape_str($this->input->post('deskripsi')),
            'status'                      => $this->db->escape_str($this->input->post('status')),
            'id_user'                     => $this->session->userdata('id_user')
         );
         // upload gambar
         $gambar      = $_FILES['gambar']['name'];
         if ($gambar) {
            if ($this->input->post('image_lama') != '') {
               $image_lama            = $this->input->post('image_lama');
            }
            $config['upload_path']   = './assets/img/banners/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               echo "Upload Gagal";
            } else {
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/img/banners/' . $image['file_name'];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               $config['quality'] = '80%';
               // $config['width'] = 600;
               // $config['height'] = 500;
               $config['new_image'] = './assets/img/banners/' . $image['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $image['file_name'];
               $data['gambar'] = $gambar;
               $lokasi_target  = './assets/img/banners/';
               unlink($lokasi_target . $image_lama);
            }
         }
         $where = array('id_banner' => $this->db->escape_str($this->input->post('id_banner')));
         $this->banner_model->update('banner', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data banner berhasil diubah", "success");');
         redirect(base_url('admin/banners'));
      }
   }

   // hapus banner
   function hapus($id_banner)
   {
      $lokasi_target  = './assets/img/banners/';
      $banner = $this->banner_model->view_where('banner', "id_banner ='$id_banner'")->row();
      $foto = $banner->image;
      $where = array('id_banner' => $id_banner);
      $this->banner_model->delete('banner', $where);
      $error = $this->db->error();
      if ($error['code'] != 0) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
      } else {
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data banner berhasil dihapus", "success");');
         unlink($lokasi_target . $foto);
      }
      redirect(base_url('admin/banners'));
   }

   // validation banner
   function _validation(){
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required', array(
         'required' => 'Nama Wajib Di isi.',
      ));
      $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
         'required' => 'Judul Wajib Di isi.',
      ));
      $this->form_validation->set_rules('status', 'Status', 'trim|required', array(
         'required' => 'Status Wajib Di isi.',
      ));
   }
}
