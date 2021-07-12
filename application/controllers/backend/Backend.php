<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/pengguna_model');
    //   $this->load->model('Back/department_model');
    //   $this->load->model('Back/designation_model');
    //   $this->load->model('Back/location_model');
      
   }

 function index()
   {
      $this->template->load('back/template/template', 'back/dashboard/dashboard');
   }

   function dashboard(){
      $this->index();
   }

   // *****************************************************
   // script akun

   function akun_index(){

   }

   function akun_profile(){
   }

   function akun_cek_username(){

   }

   function akun_cek_username_user(){

   }

   function akun_get_umur(){

   }

   // *********************************************************
   // script pengguna
   function pengguna_index(){
      $data['page_title']   = 'Pengguna';
      // $data['pengguna']   = $this->pengguna_model->get_all();
      //echo '<pre>'; print_r($data['floors']);
    
      $this->template->load('back/template/template', 'back/pengguna/list',$data);
   }

   function pengguna_tambah(){
      $data['page_title']         = 'Form Pengguna';
      $data['departments']        = $this->department_model->get_all();
      $data['designations']       = $this->designation_model->get_all();
      $data['countries']          = $this->location_model->get_countries();
      $this->template->load('back/template/template', 'back/pengguna/form', $data);
   }

  

   function pengguna_delete(){

   }

   function pengguna_cek_username(){

   }

   private function pengguna_set_upload_options(){

   }

   // *********************************************************
   // script customer
   

   // *********************************************************
   // script


   // *********************************************************
   // script

}
