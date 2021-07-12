<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halaman extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/halaman_model');
      belum_login_admin();
      cek_session_admin();
   }

   function index()
   {
      $data['page_title']   = 'Halaman';
      $data['pages']   = $this->halaman_model->view('halaman')->result();
      $this->template->load('back/template/template', 'back/konten/halaman/list', $data);
   }

   function tambah(){
      $data['page_title']         = 'Tambah Halaman';
      $this->template->load('back/template/template', 'back/konten/halaman/form_tambah', $data);
   }

   function tambah_aksi(){
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data Tidak Tersimpan", "error");');
         $this->tambah();
      } else {
         if (empty($slug) || $slug == '') {
            $slug = $this->db->escape_str($this->input->post('judul'));
         }
         $slug   = url_title($slug);
         $data = array(
            'judul'                          => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                      => $this->db->escape_str($this->input->post('deskripsi')),
            'meta_title'                     => $this->db->escape_str($this->input->post('meta_title')),
            'meta_description'               => $this->db->escape_str($this->input->post('meta_description')),
            'meta_keywords'                  => $this->db->escape_str($this->input->post('meta_keyword')),
            'slug'                           => $slug,
            'status'                         => $this->db->escape_str($this->input->post('status')),
            'id_user'                        => $this->session->userdata('id_user')
         );

         $gambar      = $_FILES['gambar']['name'];
         if ($gambar) {
            if ($this->input->post('image_lama') != '') {
               $image_lama            = $this->input->post('image_lama');
            }
            $config['upload_path']   = './assets/img/pages/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               echo "Upload Gagal";
            } else {
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/img/pages/' . $image['file_name'];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               $config['quality'] = '60%';
               $config['width'] = 600;
               $config['height'] = 500;
               $config['new_image'] = './assets/img/pages/' . $image['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $image['file_name'];
               $data['gambar'] = $gambar;
              
            }
         }

         $this->halaman_model->insert('halaman', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil menambah halaman", "success");');
         redirect(base_url('admin/pages'));
      }
   
   }

   function ubah($id_hal = null){
      $data['page_title']         = 'Ubah Halaman';
      $data['page']              = $this->halaman_model->view_where('halaman',"id_hal = '$id_hal'")->row();
      $this->template->load('back/template/template', 'back/konten/halaman/form_ubah', $data);
   }

   function ubah_aksi(){
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
         $this->ubah();
      } else {
         if (empty($slug) || $slug == '') {
            $slug = $this->db->escape_str($this->input->post('title'));
         }
         $slug   = url_title($slug);
         $data = array(
            'judul'                          => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                      => $this->db->escape_str($this->input->post('deskripsi')),
            'meta_title'                     => $this->db->escape_str($this->input->post('meta_title')),
            'meta_description'               => $this->db->escape_str($this->input->post('meta_description')),
            'meta_keywords'                  => $this->db->escape_str($this->input->post('meta_keyword')),
            'slug'                           => $slug,
            'status'                         => $this->db->escape_str($this->input->post('status')),
            'id_user'                        => $this->session->userdata('id_user')
         );
         $gambar      = $_FILES['gambar']['name'];
         if ($gambar) {
            if ($this->input->post('image_lama') != '') {
               $image_lama            = $this->input->post('image_lama');
            }
            $config['upload_path']   = './assets/img/pages/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               echo "Upload Gagal";
            } else {
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/img/pages/' . $image['file_name'];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               $config['quality'] = '60%';
               $config['width'] = 600;
               $config['height'] = 500;
               $config['new_image'] = './assets/img/pages/' . $image['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $image['file_name'];
               $data['gambar'] = $gambar;
               $lokasi_target  = './assets/img/pages/';
               unlink($lokasi_target . $image_lama);
            }
         }
         $where = array('id_hal' => $this->db->escape_str($this->input->post('id_hal')));
         $this->halaman_model->update('halaman', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data Berhasil diubah", "success");');
         redirect(base_url('admin/pages'));
      }
   
   }

   function hapus($id_hal){
      $lokasi_target  = './assets/img/pages/';
      $page = $this->halaman_model->view_where('halaman', "id_hal ='$id_hal'")->row();
      $foto = $page->image;
      $where = array('id_hal' => $id_hal);
      $this->halaman_model->delete('halaman', $where);
      $error = $this->db->error();
      if ($error['code'] != 0) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
      } else {

         $this->session->set_flashdata('message', 'swal("Berhasil", "Data berhasil dihapus", "success");');
         unlink($lokasi_target . $foto);
      }
      redirect(base_url('admin/pages'));

   }

   function _validation(){
      $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
         'required' => 'Judul Wajib Di isi.',
      ));
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array(
         'required' => 'Deskripsi Wajib Di isi.',
      ));
      $this->form_validation->set_rules('meta_title', 'seo judul', 'trim');
      $this->form_validation->set_rules('meta_description', 'meta description', 'trim');
		
   }

}
