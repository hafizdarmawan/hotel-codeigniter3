<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
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
      $data['setting']           = $setting =  get_setting();
      $this->template->load('front/template/template', 'front/payment/payments', $data);
   }
}
