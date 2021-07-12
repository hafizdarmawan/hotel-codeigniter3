<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calender extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/calender_model');
      belum_login_admin();
      cek_session_resepsionis();
   }
   // menampilkan view calender
   public function index()
   {
      $data['page_title']   = 'Kalender';
      $data['tipe_kamar']   = $this->calender_model->view('tipe_kamar')->result();
      $data['setting']      = get_setting();
      $order   = $this->calender_model->get_first_order();
      $data['calendar_result']      =   array();
      if (!empty($_POST['id_tipe_kamar'])) {
         if ($order) {
            $room_type   =   $this->calender_model->get_room_type();
            $begin = new DateTime($order->check_in);
            $end = new DateTime(date('Y-m-d', strtotime('+ 120 days')));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            foreach ($period as $dt) {
               $date      =    $dt->format("Y-m-d");
               $dayno      =    $dt->format("N");
               $day      =    $dt->format("D");
               $day      =   strtolower($day);
               $result   =      $this->calender_model->get_booking_by_room_type_and_date($date);
               //$data['result'][$date]['date']			=	$date;
               $data['calendar_result'][$date]['available']     =   $room_type->total_rooms - $result->bookings;
               $data['calendar_result'][$date]['unavailable']   =   $result->bookings;
            }
         }
      }		     
      $this->template->load('back/template/template', 'back/calender/calender', $data);
   }
}
