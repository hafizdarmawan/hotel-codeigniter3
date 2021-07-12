<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('front/home_model');
      $this->load->model('front/login_model');
      $this->load->model('front/account_model');
      $this->setting = get_setting();
   }

   function index()
   {
      $data['setting']      = $setting =  get_setting();      
      $data['page_title']   = 'Home';
      $data['banners']      = $this->home_model->view_where('banners',"status = 1")->result(); 
      // $data['testimonials']   = $this->home_model->get_testimonials();   // get 6 testimonials
      $data['room_types']      = $this->home_model->get_room_types();
      $data['coupons']      = $this->home_model->get_coupons();
      $this->template->load('front/template/template', 'front/Home/home',$data);
   }

}
