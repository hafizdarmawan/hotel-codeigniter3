<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/dashboard_model');
      belum_login_admin();
   }
   function dashboard()
   {
      $this->index();
   }

   function index()
   {
      // data orders
      $data['orders']         = $this->dashboard_model->get_orders();
      // data tamu
      $data['tamu']           = $this->dashboard_model->get_tamu();
      // data kamar
      $data['kamar']          = $this->dashboard_model->get_kamar();
      // data booking limit 10
      $data['latest_bookings']= $this->dashboard_model->get_latest_bookings($limit = 10);
      // data pendapatan
      $data['trevenue']       = $this->dashboard_model->get_todays_revenue();
      // data voucher
      $data['voucher']        = $this->dashboard_model->get_voucher();
      // data layanan
      $data['layanan']        = $this->dashboard_model->view('layanan')->result();

      // grafik
      $begin = new DateTime(date('Y-m-d', strtotime('- 6 days')));
      $end = new DateTime(date('Y-m-d'));
      $interval = DateInterval::createFromDateString('1 day');
      $period = new DatePeriod($begin, $interval, $end);
      $data['dbchart']   =   array();
      foreach ($period as $dt) {
         $date   =   $dt->format("Y-m-d");
         // data pembayaran
         $data['dbchart'][$date]      =   $this->dashboard_model->get_payment_by_date($date);
      }
      // grafik
      $weekstart   =   date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin = new DateTime($weekstart);
      $wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      $winterval = DateInterval::createFromDateString('1 day');
      $wperiod = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day      =    $dt->format("D");
         $day      =   strtolower($day);
         // data tamu
         $weekdata   =   $this->dashboard_model->get_this_date_tamu($date);
         $data['weekdata'][$i]['date']   =   $date;
         $data['weekdata'][$i]['total']   =   (!empty($weekdata->total)) ? $weekdata->total : '0';
         //$data['weekdata'][$i]['color']	=	$this->colors[$i];
         $i++;
         // print_r($weekdata);
      }
      // echo '<pre>'; print_r($data);die;				
      $data['page_title']   = 'Dashboard';
      $this->template->load('back/template/template', 'back/dashboard/dashboard', $data);
   }
}
