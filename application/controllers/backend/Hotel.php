<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/hotel_model');
      belum_login_admin();
      cek_session_admin();
   }

 // 1. Lantai
function index_lantai(){ 
   $data['page_title']   = 'Data Lantai';
   $data['lantai']       = $this->hotel_model->get_all();
   $this->template->load('back/template/template', 'back/hotel/lantai/list', $data);
}

// tambah_lantai
   function lantai_tambah(){
      $data['page_title']         = 'Tambah Lantai';
      $this->template->load('back/template/template', 'back/hotel/lantai/form_tambah', $data);
   }

// tambah_lantai_aksi
   function lantai_tambah_aksi(){
     $this->_validation_lantai();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data lantai gagal tersimpan", "error");');
         $this->lantai_tambah();
      } else {
         $data = array(
            'nama'                       => $this->db->escape_str($this->input->post('nama')),
            'no_lantai'                  => $this->db->escape_str($this->input->post('no_lantai')),
            'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
            'status'                     => $this->db->escape_str($this->input->post('status')),
         );
         $this->hotel_model->insert('lantai', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data lantai berhasil tersimpan", "success");');
         // $this->session->set_flashdata('flash', 'Ditambah');
         redirect(base_url('admin/lantai'));
         }
   }

   // ubah lantai
   function lantai_ubah($id_lantai = null){
      $data['page_title']   = 'Ubah Lantai';
      $data['lantai']       = $this->hotel_model->view_where('lantai', "id_lantai='$id_lantai'")->row();
      $this->template->load('back/template/template', 'back/hotel/lantai/form_ubah', $data);
   }

   // ubah_lantai_aksi
   function lantai_ubah_aksi(){
      $this->_validation_lantai();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data lantai gagal diubah", "error");');
         $this->lantai_ubah();
      } else {
         $data = array(
            'nama'                       => $this->db->escape_str($this->input->post('nama')),
            'no_lantai'                  => $this->db->escape_str($this->input->post('no_lantai')),
            'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
            'status'                     => $this->db->escape_str($this->input->post('status')),
         );
         $where = array('id_lantai' => $this->db->escape_str($this->input->post('id_lantai')));
         $this->hotel_model->update('lantai', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data lantai berhasil diubah", "success");');
         redirect(base_url('admin/lantai'));
      }
   }

   // detail_detail
   function lantai_detail($id_lantai){
      $data['page_title']   = 'Lantai Hotel';
      $data['lantai']       = $this->hotel_model->view_where('lantai', "id_lantai='$id_lantai'")->row();
      $this->template->load('back/template/template', 'back/hotel/lantai/detail', $data);
   }

   // lantai_hapus
   function lantai_hapus($id_lantai){
      $where = array('id_lantai' => $id_lantai);
      $this->hotel_model->delete('lantai', $where);
      $error = $this->db->error();
      if ($error['code'] != 0) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
      } else {
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data lantai berhasil dihapus", "success");');
      }
      redirect(base_url('admin/lantai'));
   }

   // validation_lantai
   function _validation_lantai(){
      $this->form_validation->set_rules('nama', 'Nama Lantai','trim|required', array(
         'required' => 'nama Wajib Di isi.',
      ));
      $this->form_validation->set_rules('no_lantai', 'No lantai','trim|required', array(
         'required' => 'No lantai Wajib Di isi.',
      ));
      $this->form_validation->set_rules('status', 'Status','trim|required', array(
         'required' => 'Status Wajib Di isi.',
      ));
   }

   //lantai_status
   function lantai_status($id_lantai)
   {
      $tipe = $this->hotel_model->view_where('lantai', "id_lantai = '$id_lantai'")->row();
      if ($tipe->status == 1) {
         $save = array(
            'status' => '0'
         );
         $this->session->set_flashdata('message', 'swal("Info", "Lantai di Non-aktifkan", "warning");');
      } elseif ($tipe->status == 0) {
         $save = array(
            'status' => '1'
         );
         $this->session->set_flashdata('message', 'swal("info", "Lantai di Aktif", "warning");');
      }
      $where = array('id_lantai' => $id_lantai);
      if (!empty($save)) {
         $this->db->update('lantai', $save, $where);
      }
      redirect(base_url('admin/lantai'));
   } 


//****************************************************************************************************************************************************/
// 2. Tipe kamar
// tipe_kamar
function index_tipe(){
         $data['page_title']   = 'Tipe Kamar';
         $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
         $this->template->load('back/template/template', 'back/hotel/tipe_kamar/list', $data);
}

// tipe_tambah
   function tipe_tambah(){
         $data['page_title']  = 'Tambah Tipe Kamar';
         $data['fasilitas']   = $this->hotel_model->view_where('fasilitas','only_kamar = 1')->result();
         $this->template->load('back/template/template', 'back/hotel/tipe_kamar/form_tambah', $data);
   }

   // tipe_tambah_aksi
   function tipe_tambah_aksi(){
         $this->_validation_tipe();
         if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data tipe kamar gagal disimpan", "error");');
            $this->tipe_tambah();
         } else {
            $slug = $this->db->escape_str($this->input->post('slug'));
            if (empty($slug) || $slug == '') {
               $slug = $this->db->escape_str($this->input->post('judul'));
            }
            $slug   = url_title($slug);
            $data = array(
               'judul'                      => $this->db->escape_str($this->input->post('judul')),
               'slug'                       => $slug,
               'shortcode'                  => $this->db->escape_str($this->input->post('shortcode')),
               'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
               'higher_occupancy'           => $this->db->escape_str($this->input->post('higher_occupancy')),
               'tarif_dasar'                => $this->db->escape_str($this->input->post('tarif_dasar')),
            );
            $amenities   =  $this->db->escape_str($this->input->post('fasilitas'));
            $p_key   = $this->hotel_model->insert_tipe('tipe_kamar', $data);
            $amenities   = $this->input->post('fasilitas');
            if (!empty($amenities)) {
               $i = 0;
               foreach ($amenities as $ind => $val) {
                  $save_amenity[$i]['id_fasilitas']   =   $ind;
                  $save_amenity[$i]['id_tipe_kamar']      =   $p_key;
                  $i++;
               }
               $this->hotel_model->insert_fasilitas($save_amenity);
            }
            $upload_data   =    array();
            $files         =    $_FILES;
            $save_img      =    array();
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
                     $save_img['id_tipe_kamar']   =   $p_key;
                     $save_img['image']      =   $file_name;
                     $this->hotel_model->insert_images($save_img);
                     $config['upload_path'] = 'assets/img/kamar/full';
                     $config['allowed_types'] = 'jpg|png|jpeg';
                     $config['max_size']   = '10000';
                     $config['max_width']  = '10000';
                     $config['max_height']  = '6000';
                     //$config['file_name'] = $file_name;
                     $this->upload->initialize($config);
                     if ($this->upload->do_upload()) {
                        $upload_data   = $this->upload->data();
                     }
                     if ($this->upload->display_errors() != '') {
                        $data['error'] = $this->upload->display_errors();
                     }
                     $this->load->library('image_lib');
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/full/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/medium/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 600;
                     $config['height'] = 500;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                     //small image
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/medium/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/small/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 235;
                     $config['height'] = 235;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                     //cropped thumbnail
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/small/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/thumbnails/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 268;
                     $config['height'] = 249;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                  }
               }
            }
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data tipe kamar berhasil disimpan", "success");');
            redirect(base_url('admin/tipe'));
         }
   }

   // tipe_ubah
   function tipe_ubah($id_tipe_kamar = null){
         $data['page_title']     = 'Ubah Tipe Kamar';
         $data['tipe_kamar']     = $tipe_kamar= $this->hotel_model->view_where('tipe_kamar',"id_tipe_kamar = '$id_tipe_kamar'")->row();
         $data['fasilitas']      = $this->hotel_model->view_where('fasilitas','only_kamar = 1')->result();
         $fasilitas              = $this->hotel_model->view_where('tipe_rel_fasilitas',"id_tipe_kamar ='$id_tipe_kamar'")->result();
         $data['image']          = $this->hotel_model->view_where('tipe_kamar_gambar', "id_tipe_kamar ='$id_tipe_kamar'")->result();
         foreach ($fasilitas as $am) {
            $data['tipe_fasilitas'][]   =   $am->id_fasilitas;
         }
         $this->template->load('back/template/template', 'back/hotel/tipe_kamar/form_ubah', $data);
   }

   // tipe_ubah_aksi
   function tipe_ubah_aksi(){
         $this->_validation_tipe();
         if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
            $this->tipe_ubah();
         } else {
            $slug = $this->db->escape_str($this->input->post('slug'));
            if (empty($slug) || $slug == '') {
               $slug = $this->db->escape_str($this->input->post('judul'));
            }
            $slug   = url_title($slug);
            $data = array(
               'judul'                      => $this->db->escape_str($this->input->post('judul')),
               'slug'                       => $slug,
               'shortcode'                  => $this->db->escape_str($this->input->post('shortcode')),
               'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
               'higher_occupancy'           => $this->db->escape_str($this->input->post('higher_occupancy')),
               'tarif_dasar'                => $this->db->escape_str($this->input->post('tarif_dasar')),
            );
            $fasilitas   =  $this->db->escape_str($this->input->post('fasilitas'));
            $where = array('id_tipe_kamar' => $this->db->escape_str($this->input->post('id_tipe_kamar')));
            $id_tipe_kamar = $this->db->escape_str($this->input->post('id_tipe_kamar'));
            $this->hotel_model->update('tipe_kamar', $data, $where);
            $fasilitas   = $this->input->post('fasilitas');
            $this->hotel_model->delete_roomtype($id_tipe_kamar);
            if (!empty($fasilitas)) {
               $i = 0;
               foreach ($fasilitas as $ind => $val) {
                  $save_amenity[$i]['id_fasilitas']   =   $ind;
                  $save_amenity[$i]['id_tipe_kamar']      =   $id_tipe_kamar;
                  $i++;
               }
               $this->hotel_model->insert_fasilitas($save_amenity);
            }
            $upload_data   =    array();
            $files         =    $_FILES;
            $save_img      =    array();
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
                     $save_img['id_tipe_kamar']   =   $id_tipe_kamar;
                     $save_img['image']      =   $file_name;
                     $this->hotel_model->insert_images($save_img);
                     $config['upload_path'] = 'assets/img/kamar/full';
                     $config['allowed_types'] = 'jpg|png|jpeg';
                     $config['max_size']   = '10000';
                     $config['max_width']  = '10000';
                     $config['max_height']  = '6000';
                     //$config['file_name'] = $file_name;
                     $this->upload->initialize($config);
                     if ($this->upload->do_upload()) {
                        $upload_data   = $this->upload->data();
                     }
                     if ($this->upload->display_errors() != '') {
                        $data['error'] = $this->upload->display_errors();
                        echo '<pre>';
                        echo 'error disini';
                        print_r($data['error']);
                        die;
                     }
                     $this->load->library('image_lib');
                     //this is the medium image
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/full/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/medium/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 600;
                     $config['height'] = 500;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                     //small image
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/medium/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/small/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 235;
                     $config['height'] = 235;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                     //cropped thumbnail
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = 'assets/img/kamar/small/' . $upload_data['file_name'];
                     $config['new_image']   = 'assets/img/kamar/thumbnails/' . $upload_data['file_name'];
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 268;
                     $config['height'] = 249;
                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();
                     $this->image_lib->clear();
                  }
               }
            }
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data tipe kamar berhasil diubah", "success");');
            redirect(base_url('admin/tipe'));
         }
      }

   function _validation_tipe(){
            $this->form_validation->set_rules('judul', 'Judul', 'trim|required', array(
               'required' => 'Nama Tipe Kamar Wajib Di isi.',
            ));
            $this->form_validation->set_rules('shortcode', 'Shortcode', 'trim|required', array(
               'required' => 'Shortcode Wajib Di isi.',
            ));
            // $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array(
            //    'required' => 'Deskripsi Wajib Di isi.',
            // ));
            $this->form_validation->set_rules('higher_occupancy', 'Higher Occupancy', 'trim|required', array(
               'required' => 'Higher Occupancy Wajib Di isi.',
            ));
            $this->form_validation->set_rules('fasilitas[]', 'Fasilitas', 'trim|required', array(
               'required' => 'Fasilitas Wajib Di isi.',
            ));
            $this->form_validation->set_rules('tarif_dasar', 'Tarif Dasar', 'trim|required', array(
               'required' => 'Base Price Wajib Di isi.',
            ));
   }

   // tipe_hapus
   function tipe_hapus($id_tipe_kamar = null){
         if ($id_tipe_kamar) {
         $tipe_kamar   = $this->hotel_model->view_where('tipe_kamar',"id_tipe_kamar = '$id_tipe_kamar'")->row();
         $images = $this->hotel_model->view_where('tipe_kamar_gambar', "id_tipe_kamar = '$tipe_kamar->id_tipe_kamar'")->result();
         if (!$tipe_kamar) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Kamar Tidak Ditemukan", "error");');
            redirect('admin/tipe');
         } else {
               foreach ($images as $img) {
               // $this->hotel_model->delete_image($img->id_tipe_kamar);
               $this->hotel_model->delete_tipe_layanan($id_tipe_kamar);
               $where_tipe_kamar = array('id_tipe_kamar' => $id_tipe_kamar);
               $this->hotel_model->delete('harga', $where_tipe_kamar);
               $where_special_price = array('id_tipe_kamar' => $id_tipe_kamar);
               $this->hotel_model->delete('harga_spesial', $where_special_price);
               $this->hotel_model->delete_kamar($id_tipe_kamar);
               $this->hotel_model->delete_roomtype($id_tipe_kamar);
               $error = $this->db->error();
               if ($error['code'] != 0
               ) {
                  $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
               } else {
                  
                  $full       = BASEPATH . '../assets/img/kamar/full/' . $img->image;
                  $medium    = BASEPATH . '../assets/img/kamar/medium/' . $img->image;
                  $small       = BASEPATH . '../assets/img/kamar/small/' . $img->image;
                  $thumbnails = BASEPATH . '../assets/img/kamar/thumbnails/' . $img->image;

                  if (file_exists($full)) {
                     unlink($full);
                  }
                  if (file_exists($medium)) {
                     unlink($medium);
                  }
                  if (file_exists($small)) {
                     unlink($small);
                  }
                  if (file_exists($thumbnails)) {
                     unlink($thumbnails);
                  }
               }
               $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil menghapus Kamar", "success");');
               redirect('admin/tipe');
            }
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Kamar Tidak Ditemukan", "error");');
         redirect('admin/tipe');
      }
   }

   // tipe_update_image
   function updateimg(){
      $id         =   $_POST['id'];
      $gallery    =   $this->hotel_model->view_where('tipe_kamar_gambar',"id_tipe_gambar='$id'");
      $lokasi_target1  = './assets/img/kamar/full/';
      $lokasi_target2  = './assets/img/kamar/medium/';
      $lokasi_target3  = './assets/img/kamar/small/';
      $lokasi_target4  = './assets/img/kamar/thumbnails/';
      @unlink($lokasi_target1 . $gallery->image);
      @unlink($lokasi_target2 . $gallery->image);
      @unlink($lokasi_target3 . $gallery->image);
      @unlink($lokasi_target4 . $gallery->image);
      $this->hotel_model->delete_image($id);
   }

   // tipe_edit_image
   function edit_image($id){
      $gallery   =   $this->hotel_model->get_images($id);
      $full       = BASEPATH . '../assets/img/kamar/full/' . $gallery->image;
      $medium    = BASEPATH . '../assets/img/kamar/medium/' . $gallery->image;
      $small       = BASEPATH . '../assets/img/kamar/small/' . $gallery->image;
      $thumbnails = BASEPATH . '../assets/img/kamar/thumbnails/' . $gallery->image;
      if (file_exists($full)) {
         unlink($full);
      }
      if (file_exists($medium)) {
         unlink($medium);
      }
      if (file_exists($small)) {
         unlink($small);
      }
      if (file_exists($thumbnails)) {
         unlink($thumbnails);
      }

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
               $this->hotel_model->update_images($save_img, $id);
               $config['upload_path'] = 'assets/img/kamar/full';
               $config['allowed_types'] = 'jpg|png|jpeg';
               $config['max_size']   = '10000';
               $config['max_width']  = '10000';
               $config['max_height']  = '6000';
               //$config['file_name'] = $file_name;
               $this->upload->initialize($config);
               if ($this->upload->do_upload()) {
                  $upload_data   = $this->upload->data();
               }
               if ($this->upload->display_errors() != '') {
                  $data['error'] = $this->upload->display_errors();
                  //echo '<pre>'; print_r($data['error']);die;
               }
               $this->load->library('image_lib');
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/kamar/full/' . $upload_data['file_name'];
               $config['new_image']   = 'assets/img/kamar/medium/' . $upload_data['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 600;
               $config['height'] = 500;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/kamar/medium/' . $upload_data['file_name'];
               $config['new_image']   = 'assets/img/kamar/small/' . $upload_data['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //cropped thumbnail
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/kamar/small/' . $upload_data['file_name'];
               $config['new_image']   = 'assets/img/kamar/thumbnails/' . $upload_data['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 268;
               $config['height'] = 249;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               $this->session->set_flashdata('message', 'swal("Berhasil", "Gambar telah diubah", "success");');
            }
         }
      }
   }

// status tipe kamar
   function tipe_status($id_tipe_kamar){ 
         $tipe = $this->hotel_model->view_where('tipe_kamar', "id_tipe_kamar = '$id_tipe_kamar'")->row();
         if ($tipe->status == 1) {
            $save = array(
               'status' => 0
            );
            $this->session->set_flashdata('message', 'swal("Info", "Tipe kamar di Non-aktifkan", "warning");');
         } elseif ($tipe->status == 0) {
            $save = array(
               'status' => 1
            );
            $this->session->set_flashdata('message', 'swal("info", "Kamar di Aktif", "warning");');
         }
         $where = array('id_tipe_kamar' => $id_tipe_kamar);
         if (!empty($save)) {
            $this->db->update('tipe_kamar', $save, $where);
         }
         redirect(base_url('admin/tipe'));
      } 

// akhir tipe kamar

// ***************************************************************************************************************************************************/
// 3. Amenities / kelengkapan kamar

// index
function amenities_index(){
      $data['page_title']   = 'Data Fasilitas';
      $data['fasilitas']    = $this->hotel_model->view('fasilitas')->result();
      $this->template->load('back/template/template', 'back/hotel/amenities/list', $data);
}  

// tambah_fasilitas
   function amenities_tambah(){
         $data['page_title']         = 'Tambah Fasilitas';
         $this->template->load('back/template/template', 'back/hotel/amenities/form_tambah', $data);
   }

   // tambah_fasilitas_aksi
   function amenities_tambah_aksi(){
            $this->_validation_amenities();
         if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data fasilitas gagal disimpan", "error");');
            $this->amenities_tambah();
         } else {
            $data = array(
               'nama'                       => $this->db->escape_str($this->input->post('nama')),
               'status'                     => $this->db->escape_str($this->input->post('status')),
               'only_kamar'                 => $this->db->escape_str($this->input->post('only_kamar')),
               'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
            );
            $gambar      = $_FILES['gambar']['name'];
            if ($this->input->post('image_lama') != '') {
               $image_lama            = $this->input->post('image_lama');
            }
            $config['upload_path']   = './assets/img/amenities/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
               echo "Upload Gagal";
            } else {
               $image = $this->upload->data();
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/img/amenities/' . $image['file_name'];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               $config['quality'] = '60%';
               $config['width'] = 600;
               $config['height'] = 500;
               $config['new_image'] = './assets/img/amenities/' . $image['file_name'];
               $this->load->library('image_lib', $config);
               $this->image_lib->resize();
               $gambar = $image['file_name'];
               $data['gambar'] = $gambar;
               $lokasi_target  = './assets/img/amenities/';
               @unlink($lokasi_target . $image_lama);
            }
            $this->hotel_model->insert('fasilitas', $data);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data fasilitas berhasil disimpan", "success");');
            redirect(base_url('admin/amenities'));
         }
   }

   // ubah_fasilitas
   function amenities_ubah($id_fasilitas = null){
         $data['page_title']   = 'Ubah Fasilitas';
         $data['fasilitas']    = $this->hotel_model->view_where('fasilitas', "id_fasilitas='$id_fasilitas'")->row();
         $this->template->load('back/template/template', 'back/hotel/amenities/form_ubah', $data);
   }
   
   // ubah_fasilitas_aksi
   function amenities_ubah_aksi(){
         $this->_validation_amenities();
         if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data fasilitas gagal diubah", "error");');
            $this->amenities_ubah();
         } else {
            $data = array(
               'nama'                       => $this->db->escape_str($this->input->post('nama')),
               'status'                     => $this->db->escape_str($this->input->post('status')),
               'only_kamar'                  => $this->db->escape_str($this->input->post('only_kamar')),
               'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
            );
            if ($this->input->post('image_lama') != '') {
               $image_lama            = $this->input->post('image_lama');
            }
            
            $gambar      = $_FILES['gambar']['name'];
            if ($gambar) {
               $config['upload_path']   = './assets/img/amenities/';
               $config['allowed_types'] = 'jpg|png|jpeg|gif';
               $config['encrypt_name']  = TRUE;
               $this->upload->initialize($config);
               if (!$this->upload->do_upload('gambar')) {
                  echo "Upload Gagal";
               } else {
                  $image = $this->upload->data();
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = './assets/img/amenities/' . $image['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['quality'] = '60%';
                  $config['width'] = 600;
                  $config['height'] = 500;
                  $config['new_image'] = './assets/img/amenities/' . $image['file_name'];
                  $this->load->library('image_lib', $config);
                  $this->image_lib->resize();
                  $gambar = $image['file_name'];
                  $data['gambar'] = $gambar;
                  $lokasi_target  = './assets/img/amenities/';
                  unlink($lokasi_target . $image_lama);
               }
            }
            $where = array('id_fasilitas' => $this->db->escape_str($this->input->post('id_fasilitas')));
            $this->hotel_model->update('fasilitas', $data, $where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data fasilitas berhasil diubah", "success");');
            redirect(base_url('admin/amenities'));
         }
   }

   function amenities_hapus($id_fasilitas){
         $lokasi_target  = './assets/img/amenities/';
         $amenities = $this->hotel_model->view_where('fasilitas', "id_fasilitas='$id_fasilitas'")->row();
         $foto = $amenities->image;
         $where = array('id_fasilitas' => $id_fasilitas);
         $this->hotel_model->delete('fasilitas', $where);
         $error = $this->db->error();
         if ($error['code'] != 0) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
         } else {
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data fasilitas berhasil dihapus", "success");');
            unlink($lokasi_target . $foto);
         }
         redirect(base_url('admin/amenities'));
   }

   function _validation_amenities(){
         $this->form_validation->set_rules('nama', 'Nama Amenities', 'trim|required', array(
            'required' => 'nama Wajib Di isi.',
         ));
         // $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array(
         //    'required' => 'Deskripsi Wajib Di isi.',
         // ));
         $this->form_validation->set_rules('status', 'Status', 'trim|required', array(
            'required' => 'Status Wajib Di isi.',
         ));
   }

   //status fasilitas
   function amenities_status($id_fasilitas)
   {
      $tipe = $this->hotel_model->view_where('fasilitas', "id_fasilitas = '$id_fasilitas'")->row();
      if ($tipe->status == 1) {
         $save = array(
            'status' => '0'
         );
         $this->session->set_flashdata('message', 'swal("Info", "Fasilitas di Non-aktifkan", "warning");');
      } elseif ($tipe->status == 0) {
         $save = array(
            'status' => '1'
         );
         $this->session->set_flashdata('message', 'swal("info", "Fasilitas di Aktif", "warning");');
      }
      $where = array('id_fasilitas' => $id_fasilitas);
      if (!empty($save)) {
         $this->db->update('fasilitas', $save, $where);
      }
      redirect(base_url('admin/amenities'));
   } 


// ***************************************************************************************************************************************************/
// 4. service/ service yang ditawarkan
   function service_index(){
      $data['page_title']   = 'Layanan';
      $data['layanan']      = $this->hotel_model->view('layanan')->result();
      $this->template->load('back/template/template', 'back/hotel/layanan/list', $data);
   }
   // tambah layanan
   function service_tambah(){
      $data['page_title']   = 'Tambah Layanan';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $this->template->load('back/template/template', 'back/hotel/layanan/form_tambah', $data);
   }

   // tambah_layanana_aksi
   function service_tambah_aksi(){
      $this->_validation_service();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data layanan tidak tersimpan", "error");');
         $this->service_tambah();
      } else {
         $data = array(
            'judul'                  => $this->db->escape_str($this->input->post('judul')),
            'tipe_biaya'             => $this->db->escape_str($this->input->post('tipe_biaya')),
            'biaya'                  => $this->db->escape_str($this->input->post('biaya')),
            'status'                 => $this->db->escape_str($this->input->post('status')),
            'deskripsi'              => $this->db->escape_str($this->input->post('deskripsi')),
            // 'tipe_kamar'             => $this->db->escape_str($this->input->post('tipe_kamar')),
         );
         $id_layanan   =   $this->hotel_model->insert_back_id('layanan',$data);
         $tipe_kamar   =   $_POST['tipe_kamar'];
         $where = array('id_layanan' => $id_layanan);
         $this->hotel_model->delete('tipe_rel_layanan', $where);
         if (!empty($tipe_kamar)) {
            $i = 0;
            foreach ($tipe_kamar as $rt) {
               $save_rt[$i]['id_layanan']   =   $id_layanan;
               $save_rt[$i]['id_tipe_kamar']   =   $rt;
               $i++;
            }
            $this->hotel_model->insert_layanan($save_rt);
         }
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data layanan berhasil disimpan", "success");');
         redirect(base_url('admin/service'));
      }
   }

   //layanan ubah
   function service_ubah($id_layanan = null){
      $data['page_title']   = 'Ubah Layanan';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $data['layanan']      =   $service      = $this->hotel_model->view_where('layanan', "id_layanan = '$id_layanan'")->row();
      $kamar_service        =   $this->hotel_model->view_where('tipe_rel_layanan',"id_layanan = '$id_layanan'")->result();
      foreach ($kamar_service as $r) {
         $data['kamar_service'][]   =   $r->id_tipe_kamar;
      }
      if (!$service) {
         $this->session->set_flashdata('message', 'swal("Error", "Data layanan tidak ditemukan", "error");');
         redirect(base_url('admin/service'));
      }
      $this->template->load('back/template/template', 'back/hotel/layanan/form_ubah', $data);
   }

   // layanan ubah aksi
   function service_ubah_aksi(){
      $this->_validation_service();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data layanan gagal diubah", "error");');
         $this->service_ubah();
      } else {
         $data = array(
            'judul'                  => $this->db->escape_str($this->input->post('judul')),
            'tipe_biaya'             => $this->db->escape_str($this->input->post('tipe_biaya')),
            'biaya'                  => $this->db->escape_str($this->input->post('biaya')),
            'status'                 => $this->db->escape_str($this->input->post('status')),
            'deskripsi'              => $this->db->escape_str($this->input->post('deskripsi')),
            // 'tipe_kamar'             => $this->db->escape_str($this->input->post('tipe_kamar')),
         );
         $where = array('id_layanan' => $this->db->escape_str($this->input->post('id_layanan')));
         $id_layanan = $this->db->escape_str($this->input->post('id_layanan'));
         $this->hotel_model->update('layanan', $data, $where);
         $tipe_kamar   =   $_POST['tipe_kamar'];
         $where = array('id_layanan' => $id_layanan);
         $this->hotel_model->delete('tipe_rel_layanan', $where);
         if (!empty($tipe_kamar)) {
            $i = 0;
            foreach ($tipe_kamar as $rt) {
               $save_rt[$i]['id_layanan']   =   $id_layanan;
               $save_rt[$i]['id_tipe_kamar']   =   $rt;
               $i++;
            }
            $this->hotel_model->insert_layanan($save_rt);
         }
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data layanan berhasil diubah", "success");');
         redirect(base_url('admin/service'));
      }
   }

   // layanan hapus
   function service_hapus($id_layanan){
      if ($id_layanan) {
         $service   = $this->hotel_model->view_where('layanan', "id_layanan = '$id_layanan'")->row();
         if (!$service) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data layanan tidak ditemukan", "error");');
            redirect('admin/service');
         } else {
            $where = array('id_layanan' => $id_layanan);
            $this->hotel_model->delete('tipe_rel_layanan', $where);
            $where = array('id_layanan' => $id_layanan);
            $this->hotel_model->delete('layanan', $where);
            $error = $this->db->error();
            if ($error['code'] != 0) {
               $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
            } else {
               $this->session->set_flashdata('message', 'swal("Berhasil", "Data layanan berhasil dihapus", "success");');
            }
            redirect('admin/service');
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data layanan tidak ditemukan", "error");');
         redirect('admin/service');
      }      
   }

   // validasi layanan
   function _validation_service(){
      $this->form_validation->set_rules('judul', 'Nama Service', 'trim|required', array(
         'required' => 'Judul Wajib Di isi.',
      ));
      // $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array(
      //    'required' => 'Deskripsi Wajib Di isi.',
      // ));
      $this->form_validation->set_rules('status', 'Status', 'trim|required', array(
         'required' => 'Status Wajib Di isi.',
      ));
      $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required', array(
         'required' => 'Biaya Wajib Di isi.',
      ));      
      $this->form_validation->set_rules('tipe_biaya', 'Tipe Biaya', 'trim|required', array(
         'required' => 'Tipe Biaya Wajib Di isi.',
      ));
      // $this->form_validation->set_rules('tipe_kamar[]', 'Tipe kamar', 'trim|required', array(
      //    'required' => 'Tipe kamar Price Wajib Di isi.',
      // ));
   }

   // status layanan
   function service_status($id_layanan)
   {
      $tipe = $this->hotel_model->view_where('layanan', "id_layanan = '$id_layanan'")->row();
      if ($tipe->status == 1) {
         $save = array(
            'status' => '0'
         );
         $this->session->set_flashdata('message', 'swal("Info", "Layanan di Non-aktifkan", "warning");');
      } elseif ($tipe->status == 0) {
         $save = array(
            'status' => '1'
         );
         $this->session->set_flashdata('message', 'swal("info", "Layanan di Aktif", "warning");');
      }
      $where = array('id_layanan' => $id_layanan);
      if (!empty($save)) {
         $this->db->update('layanan', $save, $where);
      }
      redirect(base_url('admin/service'));
   } 
// akhir amenities


// ***************************************************************************************************************************************************/
// 5. Price/ biaya
   // tampilan harga
   function price_index(){
      $data['page_title']   = 'Harga';
      $data['harga']        = $this->hotel_model->get_all_tipe();
      $this->template->load('back/template/template', 'back/hotel/price/list', $data);
   }

   // view tambah harga
   function price_tambah(){
      $data['page_title']   = 'Price Tambah';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $data['id_harga']     = '';
      $data['name']         = '';
      $data['spl_prices']   =   array();
      $this->template->load('back/template/template', 'back/hotel/price/form_tambah', $data);
   }

   //tambah aksi harga
   function price_tambah_aksi(){
      $this->_validation_price();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Harga Kamar gagal ditentukan", "error");');
         $this->price_tambah();
      } else {
         $data = array(
            'id_tipe_kamar'           => $this->db->escape_str($this->input->post('id_tipe_kamar')),
            'mon'                     => $this->db->escape_str($this->input->post('senin')),
            'tue'                     => $this->db->escape_str($this->input->post('selasa')),
            'wed'                     => $this->db->escape_str($this->input->post('rabu')),
            'thu'                     => $this->db->escape_str($this->input->post('kamis')),
            'fri'                     => $this->db->escape_str($this->input->post('jumat')),
            'sat'                     => $this->db->escape_str($this->input->post('sabtu')),
            'sun'                     => $this->db->escape_str($this->input->post('minggu')),
         );
         $id_tipe_kamar = $this->db->escape_str($this->input->post('id_tipe_kamar'));
         $cek_data = $this->hotel_model->view_where('harga',"id_tipe_kamar = '$id_tipe_kamar'")->row();
         if(!empty($cek_data)){
            $this->session->set_flashdata('message', 'swal("Gagal", "Harga tipe kamar sudah ditetapkan", "error");');
            redirect(base_url('admin/price'));;
         }
         $this->hotel_model->insert('harga',$data);
         $this->session->set_flashdata('message', 'swal("Berhasil", Harga tipe kamar berhasil ditetapkan", "success");');
         redirect(base_url('admin/price'));
      }
       
   }

   //harga ubah
   function price_ubah($id_harga = null){
      $data['page_title']   = 'Ubah Harga';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $data['harga']        = $harga= $this->hotel_model->view_where('harga',"id_harga = '$id_harga'")->row();
      if (!$harga) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data tidak ditemukan", "warning");');
         redirect('admin/price');
      }
      $data['spesial_harga']   =   $this->hotel_model->get_harga_spesial($harga->id_tipe_kamar);
      $this->template->load('back/template/template', 'back/hotel/price/form_ubah', $data);
   }

   // harga ubah aksi
   function price_ubah_aksi(){
      $this->_validation_price();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Harga tipe kamar gagal diubah", "error");');
         $this->price_ubah();
      } else {
         $data = array(
            'id_tipe_kamar'        => $this->db->escape_str($this->input->post('id_tipe_kamar')),
            'mon'                  => $this->db->escape_str($this->input->post('senin')),
            'tue'                  => $this->db->escape_str($this->input->post('selasa')),
            'wed'                  => $this->db->escape_str($this->input->post('rabu')),
            'thu'                  => $this->db->escape_str($this->input->post('kamis')),
            'fri'                  => $this->db->escape_str($this->input->post('jumat')),
            'sat'                  => $this->db->escape_str($this->input->post('sabtu')),
            'sun'                  => $this->db->escape_str($this->input->post('minggu')),
         );
         $where = array('id_harga' => $this->db->escape_str($this->input->post('id_harga')));
         $this->hotel_model->update('harga', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Harga tipe kamar berhasil diubah", "success");');
         redirect(base_url('admin/price'));
      }
   }


   // hapus harga
   function price_hapus($id_harga)
   {
      if ($id_harga) {
         $harga   = $this->hotel_model->view_where('harga', "id_harga = '$id_harga'")->row();
         $id_tipe_kamar = $harga->id_tipe_kamar;
         if (!$harga) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Harga tipe  kamar tidak ditemukan", "error");');
            redirect('admin/price');
         } else {
            $where1 = array('id_harga' => $id_harga);
            $this->hotel_model->delete('harga', $where1);

            $where2 = array('id_tipe_kamar' => $id_tipe_kamar);
            $this->hotel_model->delete('harga_spesial', $where2);
            $error = $this->db->error();
            if ($error['code'] != 0) {
               $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
            } else {
               $this->session->set_flashdata('message', 'swal("Berhasil", "Harga tipe kamar berhasil dihapus", "success");');
            }
            redirect('admin/price');
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Harga tipe kamar tidak ditemukan", "error");');
         redirect('admin/price');
      }
   }

   // validasi harga
   function _validation_price()
   {
      $this->form_validation->set_rules('id_tipe_kamar', 'Id Tipe Kamar', 'trim|required', array(
         'required' => 'Tipe Kamar Wajib Di isi.',
      ));
      $this->form_validation->set_rules('senin', 'Senin', 'trim|required', array(
         'required' => 'Senin Wajib Di isi.',
      ));
      $this->form_validation->set_rules('selasa', 'Selasa', 'trim|required', array(
         'required' => 'Selasa Wajib Di isi.',
      ));
      $this->form_validation->set_rules('rabu', 'Rabu', 'trim|required', array(
         'required' => 'Rabu Wajib Di isi.',
      ));
      $this->form_validation->set_rules('kamis', 'Kamis', 'trim|required', array(
         'required' => 'Kamis Wajib Di isi.',
      ));
      $this->form_validation->set_rules('jumat', 'Jumat', 'trim|required', array(
         'required' => 'Jumat Wajib Di isi.',
      ));
      $this->form_validation->set_rules('sabtu', 'Sabtu', 'trim|required', array(
         'required' => 'Sabtu Wajib Di isi.',
      ));
      $this->form_validation->set_rules('minggu', 'Minggu', 'trim|required', array(
         'required' => 'Minggu Wajib Di isi.',
      ));
   }

   // harga spesial
   function price_special($id_harga = null){
      $data['page_title']    = 'Harga Spesial';
      $data['tipe_kamar']    = $this->hotel_model->view('tipe_kamar')->result();
      $data['harga']         = $harga= $this->hotel_model->view_where('harga', "id_harga = '$id_harga'")->row();
      $data['harga_spesial'] = $this->hotel_model->get_harga_spesial($harga->id_tipe_kamar);
      $data['spesial']       = $this->hotel_model->view_where('harga_spesial',"id_tipe_kamar = '$harga->id_tipe_kamar'")->row();
      $this->template->load('back/template/template', 'back/hotel/price/form_special', $data);
   }

   // tambah aksi harga spesial
   function price_special_aksi(){
      $this->_validation_special();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Harga spesial gagal di simpan", "error");');
         $this->price_special();
      } else {
         if (!empty($_POST['judul'])) {
            $date   =   explode('/', $_POST['date']);
            $save_spl['id_tipe_kamar'] = $this->input->post('id_tipe_kamar');
            $save_spl['judul']       = $this->input->post('judul');
            $save_spl['date_from']   = date('Y-m-d H:i:s', strtotime($date[0]));
            $save_spl['date_to']     = date('Y-m-d H:i:s', strtotime($date[1]));
            $save_spl['mon']         = $this->input->post('spl_senin');
            $save_spl['tue']         = $this->input->post('spl_selasa');
            $save_spl['wed']         = $this->input->post('spl_rabu');
            $save_spl['thu']         = $this->input->post('spl_kamis');
            $save_spl['fri']         = $this->input->post('spl_jumat');
            $save_spl['sat']         = $this->input->post('spl_sabtu');
            $save_spl['sun']         = $this->input->post('spl_minggu');
            $this->hotel_model->insert('harga_spesial', $save_spl);
         }
         $this->session->set_flashdata('message', 'swal("Berhasil", "Harga spesial berhasil tersimpan", "success");');
         redirect(base_url('admin/price/special/' . $_POST['id_harga']));
      }
   }

   // delete harga spesial
   function delete_spl_price($id_harga_spesial)
   {
      if ($id_harga_spesial) {
         $where = array('id_harga_spesial' => $id_harga_spesial);
         $this->hotel_model->delete('harga_spesial', $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Harga special berhasil dihapus", "success");');
         redirect('admin/price');
      }
   }

   // get data tipe kamar
   function get_room_type_data()
   {
      $id_tipe_kamar   =   $_POST['id_tipe_kamar'];
      $harga   = $this->hotel_model->view_where('harga',"id_tipe_kamar = '$id_tipe_kamar'")->row();
      //echo '<pre>'; print_r($price);die;
      if (!empty($harga)) {
         $price_array   =    array(
            'mon'  => $harga->mon,
            'tue'  => $harga->tue,
            'wed'  => $harga->wed,
            'thu'  => $harga->thu,
            'fri'  => $harga->fri,
            'sat'  => $harga->sat,
            'sun'  => $harga->sun,
         );
      } else {
         $harga   = $this->hotel_model->get($id_tipe_kamar);
         $price_array   = array(
            'mon'  => $harga->base_price,
            'tue'  => $harga->base_price,
            'wed'  => $harga->base_price,
            'thu'  => $harga->base_price,
            'fri'  => $harga->base_price,
            'sat'  => $harga->base_price,
            'sun'  => $harga->base_price,
         );
      }
      echo json_encode($price_array);
   }

   function check_start_date()
   {
      $price   = $this->hotel_model->check_daterange();
      if (empty($price)) {
         echo 0;
         die;
      } else {
         echo 1;
         die;
      }
   }

   // validasi harga spesail
   function _validation_special(){

      $this->form_validation->set_rules('judul', 'Judul', '');
      $this->form_validation->set_rules('spl_senin', 'Senin', 'trim|required', array(
         'required' => 'Senin Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_selasa', 'Selasa', 'trim|required', array(
         'required' => 'Selasa Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_rabu', 'Rabu', 'trim|required', array(
         'required' => 'Rabu Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_kamis', 'Kamis', 'trim|required', array(
         'required' => 'Kamis Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_jumat', 'Jumat', 'trim|required', array(
         'required' => 'Jumat Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_sabtu', 'Sabtu', 'trim|required', array(
         'required' => 'Sabtu Wajib Di isi.',
      ));
      $this->form_validation->set_rules('spl_minggu', 'Minggu', 'trim|required', array(
         'required' => 'Minggu Wajib Di isi.',
      ));
				
   }
// akhir price

// ***************************************************************************************************************************************************/
// 6. Kamar/ room

   // list data kamar
   function kamar_index(){
      $data['page_title']     = 'Kamar';
      $data['lantai']         = $this->hotel_model->view('lantai')->result();
      $data['tipe_kamar']     = $this->hotel_model->view('tipe_kamar')->result();
      $data['kamar_aktif']    = $this->hotel_model->get_kamar_aktif();
      $data['kamar_non']      = $this->hotel_model->get_kamar_non();
      $data['kamar']          = $this->hotel_model->get_all_tipe_kamar();
      $data['states']         = $this->hotel_model->get_states();
      $this->template->load('back/template/template', 'back/hotel/kamar/list', $data);
}

// view tambah kamar
  function kamar_tambah(){
      $data['page_title']   = 'Tambah Kamar';
      $data['lantai']       = $this->hotel_model->view('lantai')->result();
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $this->template->load('back/template/template', 'back/hotel/kamar/form_tambah', $data);
  }

//   tambah aksi kamar
  function kamar_tambah_aksi(){
      if ($this->input->server('REQUEST_METHOD') === 'POST') {
         $no_kamar           = $this->db->escape_str($this->input->post('no_kamar'));
         $id_lantai          = $this->db->escape_str($this->input->post('id_lantai'));
         $id_tipe_kamar      = $this->db->escape_str($this->input->post('id_tipe_kamar'));
         }
         if (!empty($no_kamar)) {
            $i = 0;
            foreach ($no_kamar as $new) {
               foreach($id_tipe_kamar as $tp){
               $room   = $this->hotel_model->get_by_room_no($new,$tp);
               }
               if (empty($room)) {
                  $save['no_kamar']           = $new;
                  $save['id_lantai']          = $id_lantai;
                  $save['id_tipe_kamar']      = $id_tipe_kamar[$i];          
                  $p_key   =   $this->hotel_model->insert('kamar',$save);
               }
               $i++;
               if(empty($room)){
               $this->session->set_flashdata('message', 'swal("Berhasil", "Data kamar berhasil disimpan", "success");');
               }else{
               $this->session->set_flashdata('message', 'swal("Gagal", "Nomor kamar sudah tersedia", "warning");');
               }
            }
         }
         redirect('admin/kamar');
   }	

   // view ubah kamar
   function kamar_ubah($id_kamar){
      $data['page_title']   = 'Ubah Kamar';
      $data['lantai']            = $this->hotel_model->view('lantai')->result();
      $data['tipe_kamar']        = $this->hotel_model->view('tipe_kamar')->result();
      $kamar = $this->hotel_model->view_where('kamar',"id_kamar = '$id_kamar'")->row();
      $data['id_kamar']          = $kamar->id_kamar;
      $data['id_lantai']         = $kamar->id_lantai;
      $data['id_tipe_kamar']     = $kamar->id_tipe_kamar;
      $data['no_kamar']          = $kamar->no_kamar;
      $this->template->load('back/template/template', 'back/hotel/kamar/form_ubah', $data);
   }

   // view ubah aksu kamar
   function kamar_ubah_aksi(){
         $no_kamar       =   $this->db->escape_str($this->input->post('no_kamar'));
         $id_lantai      =   $this->db->escape_str($this->input->post('id_lantai'));
         $id_tipe_kamar  =   $this->db->escape_str($this->input->post('id_tipe_kamar'));
      $room   = $this->hotel_model->get_by_room_no_($no_kamar);
      if (empty($room)) {
         $data = array(
            'no_kamar'           => $no_kamar,
            'id_lantai'          => $id_lantai,
            'id_tipe_kamar'      => $id_tipe_kamar
            );
            $where = array('id_kamar' => $this->input->post('id_kamar'));
            $this->hotel_model->update('kamar',$data,$where);
            }
      if (empty($room)) {
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data kamar berhasil diubah", "success");');
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Nomor kamar sudah tersedia", "warning");');
         }
       redirect('admin/kamar');
   }

   // hapus kamar
   function kamar_hapus($id_kamar){
      if (!$id_kamar) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data kamar tidak ditemukan", "error");');
         redirect('admin/kamar');
      } else {
         $where = array('id_kamar' => $id_kamar);
         $this->hotel_model->delete('kamar', $where);
         $error = $this->db->error();
         if ($error['code'] != 0) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data terelasi tidak dapat dihapus", "warning");');
         } else {
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data kamar berhasil dihapus", "success");');
         }
         redirect('admin/kamar');
      }
   }

   //status ubah kamar
   function status_ubah($id_kamar)
   {
      $kamar = $this->hotel_model->view_where('kamar', "id_kamar = '$id_kamar'")->row();
      if ($kamar->status == 1) {
         $save['status']    =  '0';
         // $save['id_kamar']   =  $id_kamar;
         $this->session->set_flashdata('message', 'swal("info", "Kamar di Non-aktifkan", "warning");');
      }
      if ($kamar->status == 0) {
         $save['status']   = '1';
         // $save['id_kamar']  =   $id_kamar;
         $this->session->set_flashdata('message', 'swal("info", "Kamar di Aktif", "warning");');
      }

      $where = array('id_kamar' => $id_kamar);
      if (!empty($save)) {
         $this->hotel_model->update('kamar',$save,$where);
      }
      redirect('admin/kamar');
   }

   // melakukan check no kamar
   function check_room_number()
   {
      if (!empty($_POST['id_tipe_kamar'])) {
         $id   =   $_POST['id_tipe_kamar'];
         $room   = $this->hotel_model->get_by_room_no($_POST['value'], $id);
         if (!empty($room)) {
            echo 1;
            exit;
         }
      } else {
         $id = 0;
         $room   = $this->hotel_model->get_by_room_no($_POST['value'], $id);
         if (!empty($room)) {
            echo 1;
            exit;
         }
      }
   }

// akhir kamar
// ***************************************************************************************************************************************************/
// 7. coupon/ voucher
//list voucher
function coupon_index(){
   $data['page_title']   = 'Data Voucher';
   $data['voucher']      = $this->hotel_model->view('voucher')->result();
   $this->template->load('back/template/template', 'back/hotel/voucher/list', $data);
}
  

//tambah_voucher
function coupon_tambah(){
      $data['page_title']   = 'Tambah Voucher';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $data['tamu']         = $this->hotel_model->get_customer_all();
      $data['layanan']      = $this->hotel_model->view('layanan')->result();
      $this->template->load('back/template/template', 'back/hotel/voucher/form_tambah', $data);
   }

   // tambah voucher aksi
   function coupon_tambah_aksi(){
      $this->_validation_coupon();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data voucher gagal disimpan", "error");');
         $this->coupon_tambah();
      } else {
         $date   =   explode('/', $_POST['date']);
         $data = array(
            'judul'                       => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                   => $this->db->escape_str($this->input->post('deskripsi')),
            'kode'                        => strtolower($this->db->escape_str($this->input->post('kode'))),
            'tipe'                        => $this->db->escape_str($this->input->post('tipe')),
            'nilai'                       => $this->db->escape_str($this->input->post('nilai')),
            'date_from'                   => date('Y-m-d H:i:s', strtotime($date[0])),
            'date_to'                     => date('Y-m-d H:i:s', strtotime($date[1])),
            'min_total'                   => $this->db->escape_str($this->input->post('min_total')),
            'max_total'                   => $this->db->escape_str($this->input->post('max_total')),
            'include_tamu'                => json_encode($this->input->post('include_tamu')),
            'exclude_tamu'                => json_encode($this->input->post('exclude_tamu')),
            'include_tipe_kamar'          => json_encode($this->input->post('include_tipe_kamar')),
            'exclude_tipe_kamar'          => json_encode($this->input->post('exclude_tipe_kamar')),
            'limit_per_tamu'              => $this->db->escape_str($this->input->post('limit_per_tamu')),
            'limit_per_voucher'           => $this->db->escape_str($this->input->post('limit_per_voucher')),
         );
         $img = $_FILES['gambar']['name'];
         if ($img) {
            $config['upload_path']   = './assets/img/coupons/full/';
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
               $config['source_image'] = 'assets/img/coupons/full/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/medium/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 600;
               $config['height'] = 500;
               $this->image_lib->initialize($config);
               $data['gambar'] = $image['file_name'];
               $this->image_lib->resize();
               $this->image_lib->clear();
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/coupons/medium/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/small/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //cropped thumbnail
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/coupons/small/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/thumbnails/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 268;
               $config['height'] = 249;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
         } 
      }
      // insert
         $this->hotel_model->insert('voucher',$data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data voucher berhasil disimpan", "success");');
         redirect(base_url('admin/coupon'));
      }
   }

   //view ubah voucher
   function coupon_ubah($id_voucher = null){
      $data['page_title']   = 'Ubah Voucher';
      $data['tipe_kamar']   = $this->hotel_model->view('tipe_kamar')->result();
      $data['tamu']         = $this->hotel_model->get_customer_all();
      $data['layanan']      = $this->hotel_model->view('layanan')->result();
      $data['voucher']      = $voucher =$this->hotel_model->view_where('voucher',"id_voucher = '$id_voucher'")->row();
      $data['date']                 = $voucher->date_from . ' / ' . $voucher->date_to;
      $data['include_tamu']         = json_decode($voucher->include_tamu);
      $data['exclude_tamu']         = json_decode($voucher->exclude_tamu);
      $data['include_tipe_kamar']   = json_decode($voucher->include_tipe_kamar);
      $data['exclude_tipe_kamar']   = json_decode($voucher->exclude_tipe_kamar);
      $this->template->load('back/template/template', 'back/hotel/voucher/form_ubah', $data);
   }

   // voucher ubah aksi
   function coupon_ubah_aksi(){
      $this->_validation_coupon();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data voucher gagal diubah", "error");');
         $this->coupon_ubah();
      } else {
         $date       =   explode('/', $_POST['date']);
         $id_voucher = $this->db->escape_str($this->input->post('id_voucher'));
         $data = array(
            'judul'                      => $this->db->escape_str($this->input->post('judul')),
            'deskripsi'                  => $this->db->escape_str($this->input->post('deskripsi')),
            'kode'                       => strtolower($this->db->escape_str($this->input->post('kode'))),
            'tipe'                       => $this->db->escape_str($this->input->post('tipe')),
            'nilai'                      => $this->db->escape_str($this->input->post('nilai')),
            'date_from'                  => date('Y-m-d H:i:s', strtotime($date[0])),
            'date_to'                    => date('Y-m-d H:i:s', strtotime($date[1])),
            'min_total'                  => $this->db->escape_str($this->input->post('min_total')),
            'max_total'                  => $this->db->escape_str($this->input->post('max_total')),
            'include_tamu'               => json_encode($this->input->post('include_tamu')),
            'exclude_tamu'               => json_encode($this->input->post('exclude_tamu')),
            'include_tipe_kamar'         => json_encode($this->input->post('include_tipe_kamar')),
            'exclude_tipe_kamar'         => json_encode($this->input->post('exclude_tipe_kamar')),
            'limit_per_tamu'             => $this->db->escape_str($this->input->post('limit_per_tamu')),
            'limit_per_voucher'          => $this->db->escape_str($this->input->post('limit_per_voucher'))
         );

         $img = $_FILES['gambar']['name'];
         if ($img) {
            $config['upload_path']   = './assets/img/coupons/full/';
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
               $config['source_image'] = 'assets/img/coupons/full/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/medium/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 600;
               $config['height'] = 500;
               $this->image_lib->initialize($config);
               $data['gambar'] = $image['file_name'];
               $this->image_lib->resize();
               $this->image_lib->clear();
               //small image
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/coupons/medium/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/small/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 235;
               $config['height'] = 235;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
               //cropped thumbnail
               $config['image_library'] = 'gd2';
               $config['source_image'] = 'assets/img/coupons/small/' . $image['file_name'];
               $config['new_image']   = 'assets/img/coupons/thumbnails/' . $image['file_name'];
               $config['maintain_ratio'] = FALSE;
               $config['width'] = 268;
               $config['height'] = 249;
               $this->image_lib->initialize($config);
               $this->image_lib->resize();
               $this->image_lib->clear();
            }
         }
        
         $where = array('id_voucher' => $id_voucher);
         $this->hotel_model->update('voucher',$data,$where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data voucher berhasil diubah", "success");');
         redirect(base_url('admin/coupon'));
      }
   }

   // voucher hapus
   function coupon_hapus($id_voucher){
      if ($id_voucher) {
         $voucher   = $this->hotel_model->view_where('voucher',"id_voucher = '$id_voucher'")->row();
         if (!$voucher) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Data voucher tidak ditemukan", "error");');
            redirect('admin/coupon');
         } else {
            $file = BASEPATH . '../assets/img/coupons/' . $voucher->gambar;
            if (file_exists($file)) {
               unlink($file);
            }
            $where = array('id_voucher' => $id_voucher);
            $this->hotel_model->delete('voucher', $where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data voucher berhasil dihapus", "success");');
            redirect('admin/coupon');
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data voucher tidak ditemukan", "error");');
         redirect('admin/coupon');
      }
   }

   // validasi voucher
   function _validation_coupon(){
      $this->form_validation->set_rules('judul', 'Nama Coupon', 'trim|required', array(
         'required' => 'Nama Coupon Wajib Di isi.',
      ));
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array(
         'required' => 'Deskripsi Wajib Di isi.',
      ));
      $this->form_validation->set_rules('kode', 'Code Coupon', 'trim|required', array(
         'required' => 'Code Coupon Wajib Di isi.',
      ));
      $this->form_validation->set_rules('tipe', 'Tipe Coupon', 'trim|required', array(
         'required' => 'Type Coupon Wajib Di isi.',
      ));
      $this->form_validation->set_rules('nilai', 'Value', 'trim|required', array(
         'required' => 'Value Wajib Di isi.',
      ));
      $this->form_validation->set_rules('date', 'Date From', 'trim|required', array(
         'required' => 'Date Coupon Wajib Di isi.',
      ));
   }
}
