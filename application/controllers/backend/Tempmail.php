<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tempmail extends CI_Controller
{

   public function __construct()
   {

      parent::__construct();
      belum_login_admin();
      $this->load->model('back/tempmail_model');
   }

   // ------------------------------------------------------------------------------------------------------------------------------------------------
   // 1, function gallery
   // ------------------------------------------------------------------------------------------------------------------------------------------------
   function index()
   {
      $data['page_title']   = 'Templates Email';
      $data['tempmail']   = $this->tempmail_model->view('mail_template')->result();
      // $this->template->load('back/template/template', 'back/dashboard/dashboard');
      $this->template->load('back/template/template', 'back/konten/tempmail/list',$data);
   }

   function tambah(){
      $data['page_title']   = 'Templates Email';
      $this->template->load('back/template/template', 'back/konten/tempmail/form_tambah', $data);
   }

   function tambah_aksi(){
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
         $this->ubah();
      } else {
         $data = array(
            'nama'                          => $this->db->escape_str($this->input->post('nama')),
            'subject'                       => $this->db->escape_str($this->input->post('subject')),
            'content'                       => $this->db->escape_str($this->input->post('content')),
            'id_user'                       => $this->session->userdata('id_user')
         );
         $this->tempmail_model->insert('mail_template', $data);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data Berhasil diubah", "success");');
         redirect(base_url('admin/tempmail'));
      }
   }

   function ubah($id_tempmail = null){
      $data['page_title']   = 'Templates Email';
      $data['tempmail']   = $this->tempmail_model->view_where('mail_template',"id_tempmail = '$id_tempmail'")->row();
      $this->template->load('back/template/template', 'back/konten/tempmail/form_ubah', $data);
   }

   function ubah_aksi(){
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data gagal di Ubah", "error");');
         $this->ubah();
      } else {
         $data = array(
            'nama'                          => $this->db->escape_str($this->input->post('nama')),
            'subject'                       => $this->db->escape_str($this->input->post('subject')),
            'content'                       => $this->db->escape_str($this->input->post('content')),
            'id_user'                       => $this->session->userdata('id_user')
         );
         $where = array('id_tempmail' => $this->db->escape_str($this->input->post('id_tempmail')));
         $this->tempmail_model->update('mail_template', $data, $where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data Berhasil diubah", "success");');
         redirect(base_url('admin/tempmail'));
      }
   }

   function hapus(){

   }

   function _validation()
   {
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required', array(
         'required' => 'Nama Wajib Di isi.',
      ));
      $this->form_validation->set_rules('subject', 'Subject', 'trim|required', array(
         'required' => 'Subject Wajib Di isi.',
      ));
      $this->form_validation->set_rules('content', 'Content', 'trim|required', array(
         'required' => 'Content Wajib Di isi.',
      ));
   }
}
