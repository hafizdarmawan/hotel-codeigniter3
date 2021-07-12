<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/laporan_model');
      $this->load->model('back/hotel_model');
      $this->load->model('back/booking_model');
   }


   function index()
   {
      $data = get_order_new();
      echo '<pre>';
      print_r($data);

      //   $data = $this->laporan_model->get_this_kamar_all();
      //   echo '<pre>';
      // //   echo 'aktif';
      //   print_r($data);
      // //   echo '<br>';
      // //    $data = $this->hotel_model->get_kamar_aktif();
      // //    $data1 = $this->hotel_model->get_kamar_non();
      // //    echo '<pre>';
      // //    echo 'non';
      // //    print_r($data1);
      
   }


   function review(){
      $this->load->view('front/reservasi/checkout_review');
   }
   function bayar()
   {
      $this->load->view('front/reservasi/checkout_bayar');
   }

   function ketersediaan(){
      $id_tipe_kamar = 1;
      $data = get_ketersediaan_hari_ini($id_tipe_kamar);
      print_r($data);
   }

   function ketersedian_semua($date_from = '2021-01-10', $date_to = '2021-01-10', $id_tipe_kamar = 1)
   {
      $data = get_ketersediaan($date_from,$date_to,$id_tipe_kamar);
      print_r($data);
      die;
      echo '<pre>';
      print_r($date_from);
   }


   function coba_laporan_keuangan($bulan = 1, $tahun =2021, $status = 'gagal'){
      $transaksi = $this->laporan_model->laporan_by_month_keuangan($bulan, $tahun,$status);
      echo '<pre>';
      print_r($transaksi);
   }

   function coba_laporan_keuangan_tahun($tahun = 2021, $status = 'gagal')
   {
      $transaksi = $this->laporan_model->laporan_by_year_keuangan($tahun, $status);
      echo '<pre>';
      print_r($transaksi);
   }
}
