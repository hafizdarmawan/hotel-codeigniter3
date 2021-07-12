<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleri extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/galleri_model');
      belum_login_admin();
      cek_session_admin();
   }

   // galleri ketgori
   function index()
   {
      $data['page_title']   = 'Galleri';
      $data['galleri']   = $this->galleri_model->view('galleri')->result();
      $this->template->load('back/template/template', 'back/konten/gallery/gallery/list', $data);
   }

   // kategori tambah
   function tambah(){
      $data['page_title']   = 'Tambah Galleri';
      $this->template->load('back/template/template', 'back/konten/gallery/gallery/form_tambah', $data);
   }

   // tambah aksi
   function tambah_aksi(){
      $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
         'required' => 'Judul Wajib Di isi.',
      ));
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data galleri tidak tersimpan", "error");');
         $this->tambah();
      } else {
         $data = array(
            'judul'                          => $this->db->escape_str($this->input->post('judul')),
            'id_user'                        => $this->session->userdata('id_user')
         );
         $this->galleri_model->insert('galleri', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data galleri berhasil tersimpan", "success");');
         redirect(base_url('admin/gallery'));
      }
   }

   // kategori ubah
   function ubah($id_galleri = null){
      $data['page_title']   = 'Ubah Galleri';
      $data['gallery']   = $this->galleri_model->view_where('galleri',"id_galleri = '$id_galleri'")->row();
      $this->template->load('back/template/template', 'back/konten/gallery/gallery/form_ubah', $data);
   }

   // kategori ubah aksi
   function ubah_aksi(){
      $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
         'required' => 'Judul Wajib Di isi.',
      ));
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data galleri tidak diubah", "error");');
         $this->ubah();
      } else {
         $data = array(
            'judul'                          => $this->db->escape_str($this->input->post('judul')),
            'id_user'                        => $this->session->userdata('id_user')
         );
         $where = array('id_galleri' => $this->db->escape_str($this->input->post('id_galleri')));
         $this->galleri_model->update('galleri',$data,$where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data galleri berhasil diubah", "success");');
         redirect(base_url('admin/gallery'));
      }
   }

   // hapus
   function hapus($id_galleri){
      $galleri_rel = $this->galleri_model->view_where('galleri_rel_gambar',"id_galleri = '$id_galleri'")->result();
      foreach ($galleri_rel as $img) {
         unlink('/assets/img/gallery/full/' .$img->image);
         unlink('/assets/img/gallery/medium/' . $img->image);
         unlink('/assets/img/gallery/small/' . $img->image);
         unlink('/assets/img/gallery/thumbnails/' . $img->image);
      }
      $where = array('id_galleri' => $id_galleri);
      $this->galleri_model->delete('galleri_rel_gambar',$where);
      $this->galleri_model->delete('galleri', $where);
      $error = $this->db->error();
      if ($error['code'] != 0) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
      } else {
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data galleri berhasil dihapus", "success");');
      }
      redirect(base_url('admin/gallery'));
   }

   // gambar view
   function image_index($id_galleri = null )
   {
      $data['page_title']   = 'Gambar Galleri';
      $data['gallery']  = $this->galleri_model->get_gallery($id_galleri);
      $id_galleri   = $this->galleri_model->view_where('galleri', "id_galleri = '$id_galleri'")->row();
      $data['id_galleri']                = $id_galleri->id_galleri;
      $this->template->load('back/template/template', 'back/konten/gallery/gallery/list_image', $data);
   }

   // gambar tambah
   function image_tambah($id_galleri)
   {
      $data['page_title']   = 'Tambah Gambar';
      $data['id_galleri']   = $id_galleri = $this->uri->segment(4);
      if(empty($id_galleri)){
         $this->session->set_flashdata('message', 'swal("Gagal", "Data galleri tidak ditemukan", "error")');
         redirect(base_url('admin/gallery/').$id_galleri);
      }else{
         $this->template->load('back/template/template', 'back/konten/gallery/gallery/image_tambah', $data);
      }
   }

   // gambar tambah aksi
   function image_tambah_aksi()
   {
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gambar tidak tersimpan", "error");');
         redirect(base_url('admin/igallery/') . $_POST['id_galleri']);
      } else {
         $id_galleri         =   $this->db->escape_str($this->input->post('id_galleri'));
         $caption            =   $this->db->escape_str($this->input->post('caption'));
         $data = array(
            'id_galleri' => $id_galleri,
            'caption'    => $caption
         );
         $img = $_FILES['gambar']['name'];
         if(empty($img)){
            $this->session->set_flashdata('message', 'swal("Gagal", "Gambar tidak ditemukan", "error");');
            redirect(base_url('admin/igallery/') . $_POST['id_galleri']);
         }else{
            $config['upload_path']   = './assets/img/gallery/full/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size']   = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               $data['error'] = $this->upload->display_errors();
                  echo '<pre>';
                  echo 'error disini';
                  print_r($data['error']);
                  die;
            } else {
               $this->load->library('image_lib');
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/full/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/medium/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 600;
               $config['height'] = 500;
               $this->image_lib->initialize($config);
               $data['gambar'] = $image['file_name'];
               $this->image_lib->resize();
               $this->image_lib->clear();
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/medium/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/small/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //cropped thumbnail
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/small/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/thumbnails/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 268;
               $config['height'] = 249;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
            }
         }
         $this->galleri_model->insert('galleri_rel_gambar',$data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data gambar berhasil di simpan", "success");');
            redirect(base_url('admin/igallery/' . $id_galleri));
      }
     
   }

   // gambar ubah
   function image_ubah($id_rel_galleri)
   {
      $data['page_title']        = 'Ubah Gambar';
      $data['image_gallery']     = $this->galleri_model->view_where('galleri_rel_gambar', "id_rel_galleri = '$id_rel_galleri'")->row();
      $this->template->load('back/template/template', 'back/konten/gallery/gallery/image_ubah', $data);
   }

   // ubah aksi
   function image_ubah_aksi()
   {
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gambar gagal diubah", "error");');
         redirect(base_url('admin/igallery/') . $_POST['id_galleri']);
      } else {
         $id_galleri         =   $this->db->escape_str($this->input->post('id_galleri'));
         $id_rel_galleri     =   $this->db->escape_str($this->input->post('id_rel_galleri'));
         $caption            =   $this->db->escape_str($this->input->post('caption'));
         $image_old          =   $this->db->escape_str($this->input->post('image_lama'));
         $data = array(
            'id_galleri' => $id_galleri,
            'caption'    => $caption
         );
         $img = $_FILES['gambar']['name'];
         if ($img) {
            $config['upload_path']   = './assets/img/gallery/full/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size']   = '10000';
            $config['max_width']  = '10000';
            $config['max_height']  = '6000';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               $data['error'] = $this->upload->display_errors();
               echo '<pre>';
               echo 'error disini';
               print_r($data['error']);
               die;
            } else {
               $lokasi1 = './assets/img/gallery/full/';
               $lokasi2 = './assets/img/gallery/medium/';
               $lokasi3 = './assets/img/gallery/small/';
               $lokasi4 = './assets/img/gallery/thumbnails/';
               $this->load->library('image_lib');
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/full/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/medium/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 600;
               $config['height'] = 500;
               $this->image_lib->initialize($config);
               $data['gambar'] = $image['file_name'];
               $this->image_lib->resize();
               $this->image_lib->clear();
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/medium/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/small/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //cropped thumbnail
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/gallery/small/' . $image['file_name'];
               $config['new_image']   = 'assets/img/gallery/thumbnails/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 268;
               $config['height'] = 249;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               unlink($lokasi1 . $image_old);
               unlink($lokasi2 . $image_old);
               unlink($lokasi3 . $image_old);
               unlink($lokasi4 . $image_old);
            }
         }
         $where = array('id_rel_galleri' => $id_rel_galleri);
         $this->galleri_model->update('galleri_rel_gambar', $data,$where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data gambar berhasil diubah", "success");');
         redirect(base_url('admin/igallery/' . $id_galleri));
      }
   }

   // hapus gambar
   function image_hapus($id_rel_galleri)
   {
      $data = $this->galleri_model->view_where('galleri_rel_gambar',"id_rel_galleri = '$id_rel_galleri'")->row();
      $gambar = $data->image;
      $id_galleri = $data->id_galleri;
      unlink('./assets/img/gallery/full/'.$gambar);
      unlink('./assets/img/gallery/medium/' . $gambar);
      unlink('./assets/img/gallery/small/' . $gambar);
      unlink('./assets/img/gallery/thumbnails/' . $gambar);
      $where = array('id_rel_galleri' => $id_rel_galleri);
      $this->galleri_model->delete('galleri_rel_gambar', $where);
      $error = $this->db->error();
      if ($error['code'] != 0) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
      } else {
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data gambar berhasil dihapus", "success");');
      }
      redirect(base_url('admin/igallery/').$id_galleri);
   }

   // vaidation kategori
   function _validation(){
      $this->form_validation->set_rules('caption[]', 'Caption', 'trim|required', array(
         'required' => 'Caption Rate Wajib Di isi.',
      ));
   }
}
