<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

   public function __construct()
   {

      parent::__construct();
      belum_login_admin();
      cek_session_admin();
      $this->load->model('back/laporan_model');
      $this->colors   =   array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01', '#B0DE09', '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74', '#CD5C5C', '#F08080', '#FA8072', '#FFA07A', '#B22222', '#DB7093', '#C71585', '#FF1493', '#FF69B4', '#FFB6C1', '#FFC0CB', '#FF4500', '#FF6347', '#FFA07A', '#FFFF00', '#FFD700', '#F0E68C', '#EE82EE', '#9370DB', '#00FA9A', '#B0C4DE', '#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01', '#B0DE09', '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74', '#CD5C5C', '#F08080', '#FA8072', '#FFA07A', '#B22222', '#DB7093', '#C71585', '#FF1493', '#FF69B4', '#FFB6C1', '#FFC0CB', '#FF4500', '#FF6347', '#FFA07A', '#FFFF00', '#FFD700', '#F0E68C', '#EE82EE', '#9370DB', '#00FA9A', '#B0C4DE', '#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01', '#B0DE09', '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74', '#CD5C5C', '#F08080', '#FA8072', '#FFA07A', '#B22222', '#DB7093', '#C71585', '#FF1493', '#FF69B4', '#FFB6C1', '#FFC0CB', '#FF4500', '#FF6347', '#FFA07A', '#FFFF00', '#FFD700', '#F0E68C', '#EE82EE', '#9370DB', '#00FA9A', '#B0C4DE');
   }

// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////       PENDAFTARAN     //////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function tamu()
   {
      $data['tipe_kamar']   = $this->laporan_model->view('tamu')->result();
      $data['setting']      = get_setting();;
      $data['weekdata']     =   array();
      $data['monthdata']    =   array();
      $data['yeardata']     =   array();
      $data['customdata']   =   array();
      // 7 DAYS Week Chart
      $weekstart            = date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin               = new DateTime($weekstart);
      $wend                 = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $winterval            = DateInterval::createFromDateString('1 day');
      $wperiod              = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date       =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day        =    $dt->format("D");
         $day        =   strtolower($day);
         $weekdata   =   $this->laporan_model->get_this_date_tamu($date);
         $data['weekdata'][$i]['date']   =   date('d M', strtotime($date));
         $data['weekdata'][$i]['total']   =   @$weekdata->total;
         $data['weekdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
      $mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $minterval = DateInterval::createFromDateString('1 day');
      $mperiod = new DatePeriod($mbegin, $minterval, $mend);
      $i = 0;
      foreach ($mperiod as $dt) {
         $date       =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day        =    $dt->format("D");
         $day        =   strtolower($day);
         $monthdata  =   $this->laporan_model->get_this_date_tamu($date);
         // 
         $data['monthdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['monthdata'][$i]['total']   =   @$monthdata->total;
         $data['monthdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $start = $month = strtotime("- 365 days");
      $end   = strtotime('+ 1 day');
      $i     = 0;
      while ($month < $end) {
         $month = strtotime("+1 month", $month);
         $Y     = date('Y', $month);
         $M     = date('m', $month);
         $yeardata   =   $this->laporan_model->get_this_year_tamu($Y, $M);
         $data['yeardata'][$i]['date']    =   date('M', $month) . " " . date('Y', $month);
         $data['yeardata'][$i]['total']   =   @$yeardata->total;
         $data['yeardata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      if (!empty($_POST['from']) && !empty($_POST['to'])) {
         $from   = $this->input->post('from');
         $to     = $this->input->post('to');
         $cbegin = new DateTime($from);
         $cend   = new DateTime($to);

         $cinterval = DateInterval::createFromDateString('1 day');
         $cperiod   = new DatePeriod($cbegin, $cinterval, $cend);
         $cnt       = 1;
         foreach ($cperiod as $dt) {
            $cnt++;
         }
         // echo '<pre>'; print_r($this->colors);die;	
         // echo '<pre>';
         // print_r($_POST);
         // die;	
         $data['custom'] =  'active';
         $i = 0;
         foreach ($cperiod as $dt) {
            $customdata   =   $this->laporan_model->get_this_date_tamu($dt->format("Y-m-d"));
            $data['customdata'][$i]['date']    =   $dt->format("d M Y");
            $data['customdata'][$i]['total']   =   @$customdata->total;
            $data['customdata'][$i]['color']   =   @$this->colors[$i];
            $i++;
         }
      }
      // -------------------------------------------------------------------------------------------------------- 
      ///////////////////////////////////////     LAPORAN  PENDAFTARAN      //////////////////////////////////////// 
      // -------------------------------------------------------------------------------------------------------- 
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $ket       = 'Data Pendaftaran Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to));
            $url_cetak = 'laporan/cetak_tamu?filter=1&date_from=' . $date_from . '&date_to=' . $date_to;
            $transaksi = $this->laporan_model->laporan_by_date_tamu($date_from, $date_to);
         } else if ($filter == '2') {
            $bulan      = $_GET['bulan'];
            $tahun      = $_GET['tahun'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Data Pendaftaran Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun ;
            $url_cetak  = 'laporan/cetak_tamu?filter=2&bulan=' . $bulan . '&tahun=' . $tahun ;
            $transaksi  = $this->laporan_model->laporan_by_month_tamu($bulan, $tahun);
         } else {
            $tahun     = $_GET['tahun'];
            $ket       = 'Data Pendaftaran Tahun ' . $tahun;
            $url_cetak = 'laporan/cetak_tamu?filter=3&tahun=' . $tahun;
            $transaksi = $this->laporan_model->laporan_by_year_tamu($tahun);
         }
      } else {
         $ket       = 'Semua Data Transaksi';
         $url_cetak = 'laporan/cetak_tamu';
         $transaksi = $this->laporan_model->laporan_tamu_all();
      }
      $data['ket']          = $ket;
      $data['url_cetak']    = base_url('backend/' . $url_cetak);
      $data['option_tahun'] = $this->laporan_model->option_tahun_tamu();
      $data['transaksi']    = $transaksi;
      $data['page_title']   = 'Laporan Pendaftaran';
      $this->template->load('back/template/template', 'back/laporan/tamu', $data);
   }
 
   public function cetak_tamu()
   {
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $ket       = 'Pendaftaran : ' . tgl_indo($date_from) . ' Sampai ' . tgl_indo($date_to);
            $transaksi = $this->laporan_model->laporan_by_date_tamu($date_from, $date_to);
         } else if ($filter == '2') {
            $bulan      = $_GET['bulan'];
            $tahun      = $_GET['tahun'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Data Pendaftaran Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
            $transaksi  = $this->laporan_model->laporan_by_month_tamu($bulan, $tahun);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $ket       = 'Data Transaksi Tahun ' . $tahun;
            $transaksi = $this->laporan_model->laporan_by_year_tamu($tahun);
         }
      } else {
         $ket       = 'Semua Data Pendaftaran';
         $transaksi = $this->laporan_model->laporan_tamu_get_all();
      }
      $data['ket']  = $ket;
      $data['transaksi'] = $transaksi;
      ob_start();
      $this->load->view('back/laporan/laporan_tamu', $data);
      $html = ob_get_contents();
      // print_r($html);
      // die;
      ob_end_clean();
      require_once('./assets/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en');
      ob_end_clean();
      $pdf->WriteHTML($html);
      $pdf->Output('Laporan_Pendaftaran-' . DATE('d-m-Y'). '.pdf', 'I');
   }
// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////       AKHIR PENDAFTARAN     //////////////////////////////////////
// -------------------------------------------------------------------------------------------------------- 


// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////       LAPORAN RESERVASI     //////////////////////////////////////
// -------------------------------------------------------------------------------------------------------- 
   function occupancy()
   {
      $data['room_types']     = $this->laporan_model->view('tipe_kamar')->result();
      $data['setting']        = get_setting();
      $data['weekdata']       = array();
      $data['monthdata']      = array();
      $data['yeardata']       = array();
      $data['customdata']     = array();
      // 7 DAYS Week Chart
      $weekstart   = date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin      = new DateTime($weekstart);
      $wend        = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $winterval = DateInterval::createFromDateString('1 day');
      $wperiod = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date       =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day        =    $dt->format("D");
         $day        =   strtolower($day);
         $weekdata   =   $this->laporan_model->get_this_week_occupancy($date);
         $data['weekdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['weekdata'][$i]['total']   =   @$weekdata->total;
         $data['weekdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
      $mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $minterval = DateInterval::createFromDateString('1 day');
      $mperiod = new DatePeriod($mbegin, $minterval, $mend);
      $i = 0;
      foreach ($mperiod as $dt) {
         $date       =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day        =    $dt->format("D");
         $day        =   strtolower($day);
         $monthdata  =   $this->laporan_model->get_this_week_occupancy($date);
         // 
         $data['monthdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['monthdata'][$i]['total']   =   @$monthdata->total;
         $data['monthdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $start = $month = strtotime("- 365 days");
      $end = strtotime('+ 1 day');
      $i = 0;
      while ($month < $end) {
         $month = strtotime("+1 month", $month);
         $Y     = date('Y', $month);
         $M     = date('m', $month);
         $yeardata   =   $this->laporan_model->get_this_year_occupancy($Y, $M);
         // 
         $data['yeardata'][$i]['date']    =   date('M', $month) . " " . date('Y', $month);
         $data['yeardata'][$i]['total']   =   @$yeardata->total;
         $data['yeardata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      if (!empty($_POST['from']) && !empty($_POST['to'])) {
         // 
         $from = $this->input->post('from');
         $to   = $this->input->post('to');
         $cbegin = new DateTime($from);
         $cend   = new DateTime($to);
         // 
         $cinterval = DateInterval::createFromDateString('1 day');
         $cperiod = new DatePeriod($cbegin, $cinterval, $cend);
         $cnt = 1;
         foreach ($cperiod as $dt) {
            $cnt++;
         }
         //echo '<pre>'; print_r($this->colors);die;	
         $i = 0;
         foreach ($cperiod as $dt) {
            $customdata   =   $this->laporan_model->get_this_week_occupancy($dt->format("Y-m-d"));
            $data['customdata'][$i]['date']      =   $dt->format("d M Y");
            $data['customdata'][$i]['total']   =   @$customdata->total;
            $data['customdata'][$i]['color']   =   @$this->colors[$i];
            $i++;
         }
      }

      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status    = $_GET['status'];
            $ket       = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to) .'Status =' .$status);
            $url_cetak = 'laporan/cetak_occupancy?filter=1&date_from=' . $date_from . '&date_to=' . $date_to .'&status='.$status;
            $transaksi = $this->laporan_model->laporan_by_date_occupancy($date_from, $date_to, $status);
         } else if ($filter == '2') {
            $bulan  = $_GET['bulan'];
            $tahun  = $_GET['tahun'];
            $status = $_GET['status'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun .' Status =' .$status;
            $url_cetak  = 'laporan/cetak_occupancy?filter=2&bulan=' . $bulan . '&tahun=' .$tahun.'&status='.$status;
            $transaksi  = $this->laporan_model->laporan_by_month_occupancy($bulan, $tahun, $status);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $ket       = 'Data Transaksi Tahun ' . $tahun .' Status = '. $status;
            $url_cetak = 'laporan/cetak_occupancy?filter=3&tahun=' . $tahun.'&status='.$status;
            $transaksi = $this->laporan_model->laporan_by_year_occupancy($tahun, $status);
         }
      } else {
         $ket       = 'Semua Data Transaksi';
         $url_cetak = 'laporan/cetak_occupancy';
         $transaksi = $this->laporan_model->laporan_occupancy_get_all();
      }
      $data['ket']       = $ket;
      $data['url_cetak'] = base_url('backend/' . $url_cetak);
      $data['option_tahun'] = $this->laporan_model->option_tahun();
      $data['transaksi']    = $transaksi;
      $data['page_title']   = 'Laporan Reservasi';
      // $this->render_admin('reports/occupancy', $data);
      $this->template->load('back/template/template', 'back/laporan/occupancy', $data);
   }

   public function cetak_occupancy()
   {
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status    = $_GET['status'];
            $ket       = 'Transaksi : ' . tgl_indo($date_from) . ' Sampai ' . tgl_indo($date_to) .' Status ='.$status;
            $transaksi = $this->laporan_model->laporan_by_date_occupancy($date_from, $date_to, $status);
         } else if ($filter == '2') {
            $bulan      = $_GET['bulan'];
            $tahun      = $_GET['tahun'];
            $status     = $_GET['status'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun.' Status ='.$status;
            $transaksi  = $this->laporan_model->laporan_by_month_occupancy($bulan, $tahun, $status);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $ket       = 'Data Transaksi Tahun ' . $tahun.' Status ='.$status;
            $transaksi = $this->laporan_model->laporan_by_year_occupancy($tahun,$status);
         }
      } else {
         $ket       = 'Semua Data Transaksi';
         $transaksi = $this->laporan_model->laporan_occupancy_get_all();
      }

      $data['ket']       = $ket;
      $data['transaksi'] = $transaksi;
      ob_start();
      $this->load->view('back/laporan/laporan_occupancy', $data);
      $html = ob_get_contents();
      // print_r($html);
      // die;
      ob_end_clean();
      require_once('./assets/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en');
      ob_end_clean();
      $pdf->WriteHTML($html);
      $pdf->Output('Laporan_Reservasi-'.DATE('d-m-Y').'('.$status.')'.'.pdf', 'I');
   }
// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////       AKHIR RESERVASI     ///////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 


   // -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////       KEUANGAN     //////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function keuangan()
   {
      $data['weekdata']    =   array();
      $data['monthdata']   =   array();
      $data['yeardata']    =   array();
      $data['customdata']  =   array();
      // 7 DAYS Week Chart
      $weekstart   =   date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin      = new DateTime($weekstart);
      $wend        = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $winterval = DateInterval::createFromDateString('1 day');
      $wperiod   = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno     =    $dt->format("N");
         $day       =    $dt->format("D");
         $day       =   strtolower($day);
         $weekdata  =   $this->laporan_model->get_this_date_financial($date);
         $data['weekdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['weekdata'][$i]['total']   =   @$weekdata->total;
         $data['weekdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
      $mend   = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $minterval = DateInterval::createFromDateString('1 day');
      $mperiod   = new DatePeriod($mbegin, $minterval, $mend);
      $i = 0;
      foreach ($mperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno     =    $dt->format("N");
         $day       =    $dt->format("D");
         $day       =   strtolower($day);
         $monthdata =   $this->laporan_model->get_this_date_financial($date);
         // 
         $data['monthdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['monthdata'][$i]['total']   =   @$monthdata->total;
         $data['monthdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      $start = $month = strtotime("- 365 days");
      $end   = strtotime('+ 1 day');
      $i = 0;
      while ($month < $end) {
         $month = strtotime("+1 month", $month);
         $Y     = date('Y', $month);
         $M     = date('m', $month);
         $yeardata   =   $this->laporan_model->get_this_year_financial($Y, $M);
         // 
         $data['yeardata'][$i]['date']    =   date('M', $month) . " " . date('Y', $month);
         $data['yeardata'][$i]['total']   =   @$yeardata->total;
         $data['yeardata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }

      if (!empty($_POST['from']) && !empty($_POST['to'])) {
         // 
         $from   = $this->input->post('from');
         $to     = $this->input->post('to');
         $cbegin = new DateTime($from);
         $cend   = new DateTime($to);
         // 
         $cinterval = DateInterval::createFromDateString('1 day');
         $cperiod   = new DatePeriod($cbegin, $cinterval, $cend);
         $cnt = 1;
         foreach ($cperiod as $dt) {
            $cnt++;
         }
         $i = 0;
         foreach ($cperiod as $dt) {
            $customdata   =   $this->laporan_model->get_this_date_financial($dt->format("Y-m-d"));
            $data['customdata'][$i]['date']    =   $dt->format("d M Y");
            $data['customdata'][$i]['total']   =   @$customdata->total;
            $data['customdata'][$i]['color']   =   @$this->colors[$i];
            $i++;
         }
      }
      //echo json_encode($data['weekdata']);			
      // echo '<pre>'; print_r($data['customdata']);die;
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status = $_GET['status'];
            $ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to));
            $url_cetak = 'laporan/cetak_keuangan?filter=1&date_from=' . $date_from . '&date_to=' . $date_to. '&status=' .$status;
            $transaksi = $this->laporan_model->laporan_by_date_keuangan($date_from, $date_to, $status);
         } else if ($filter == '2') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $status = $_GET['status'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun .'Status '.$status;
            $url_cetak = 'laporan/cetak_keuangan?filter=2&bulan=' . $bulan . '&tahun=' . $tahun .'&status=' .$status;
            $transaksi = $this->laporan_model->laporan_by_month_keuangan($bulan, $tahun, $status);
         } else {
            $tahun = $_GET['tahun'];
            $status = $_GET['status'];
            $ket = 'Data Transaksi Tahun ' . $tahun;
            $url_cetak = 'laporan/cetak_keuangan?filter=3&tahun=' . $tahun .'&status=' .$status;
            $transaksi = $this->laporan_model->laporan_by_year_keuangan($tahun, $status);
         }
      } else {
         $ket = 'Semua Data Transaksi';
         $url_cetak = 'laporan/cetak_keuangan';
         $transaksi = $this->laporan_model->laporan_keuangan_get_all();
      }
      $data['ket'] = $ket;
      $data['url_cetak'] = base_url('backend/' . $url_cetak);
      $data['option_tahun'] = $this->laporan_model->option_tahun();
      $data['transaksi'] = $transaksi;
      $data['page_title']   = 'Laporan Keuangan';
      $this->template->load('back/template/template', 'back/laporan/keuangan', $data);
   }

   public function cetak_keuangan()
   {
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status    = $_GET['status'];
            $ket       = 'Transaksi : ' . tgl_indo($date_from) . ' Sampai ' . tgl_indo($date_to) . 'Status =' .$status;
            $transaksi = $this->laporan_model->laporan_by_date_keuangan($date_from, $date_to, $status);
         } else if ($filter == '2') {
            $bulan   = $_GET['bulan'];
            $tahun   = $_GET['tahun'];
            $status  = $_GET['status'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun. ' Status = '.$status;
            $transaksi  = $this->laporan_model->laporan_by_month_keuangan($bulan, $tahun, $status);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $ket       = 'Data Transaksi Tahun ' . $tahun.' Status = '. $status;
            $transaksi = $this->laporan_model->laporan_by_year_keuangan($tahun, $status);
         }
      } else {
         $ket       = 'Semua Data Transaksi';
         $transaksi = $this->laporan_model->laporan_keuangan_get_all();
      }
      $data['ket']       = $ket;
      $data['transaksi'] = $transaksi;
      ob_start();
      $this->load->view('back/laporan/laporan_keuangan',$data);
      $html = ob_get_contents();
      ob_end_clean();
      require_once('./assets/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en');
      ob_end_clean();
      $pdf->WriteHTML($html);
      $pdf->Output('Laporan_Keuangan-'.$status.'-'.date('d-m-Y').'.pdf', 'I');
   }
// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////   AKHIR KEUANGAN   //////////////////////////////////////////////
// --------------------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////   LAPORAN VOUCHER   //////////////////////////////////////////////
// --------------------------------------------------------------------------------------------------------
   function voucher()
   {
      $data['coupons']    =   $this->laporan_model->get_voucher();
      $data['weekdata']   =   array();
      $data['monthdata']  =   array();
      $data['yeardata']   =   array();
      $data['customdata'] =   array();
      // 7 DAYS Week Chart
      $weekstart =   date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin    = new DateTime($weekstart);
      $wend      = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $winterval = DateInterval::createFromDateString('1 day');
      $wperiod   = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno     =    $dt->format("N");
         $day       =    $dt->format("D");
         $day       =   strtolower($day);
         $weekdata  =   $this->laporan_model->get_this_date_voucher($date);
         $data['weekdata'][$i]['date']      =   date('d M', strtotime($date));
         $data['weekdata'][$i]['amount']    =   @$weekdata->amount;
         $data['weekdata'][$i]['coupons']   =   @$weekdata->coupons;
         $i++;
      }
      $mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
      $mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $minterval = DateInterval::createFromDateString('1 day');
      $mperiod = new DatePeriod($mbegin, $minterval, $mend);
      $i = 0;
      foreach ($mperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno     =    $dt->format("N");
         $day       =    $dt->format("D");
         $day       =   strtolower($day);
         $monthdata =   $this->laporan_model->get_this_date_voucher($date);
         // 
         $data['monthdata'][$i]['date']    =   date('d M', strtotime($date));
         $data['monthdata'][$i]['amount']  =   @$monthdata->amount;
         $data['monthdata'][$i]['coupons'] =   @$monthdata->coupons;
         $i++;
      }
      // 
      $start = $month = strtotime("- 365 days");
      $end = strtotime('+ 1 day');
      $i = 0;
      while ($month < $end) {
         $month = strtotime("+1 month", $month);
         $Y     = date('Y', $month);
         $M     = date('m', $month);
         $yeardata   =   $this->laporan_model->get_this_year_voucher($Y, $M);

         $data['yeardata'][$i]['date']      =   date('M', $month) . " " . date('Y', $month);
         $data['yeardata'][$i]['amount']    =   @$yeardata->amount;
         $data['yeardata'][$i]['coupons']   =   @$yeardata->coupons;
         $i++;
      }

      if (!empty($_POST['from']) && !empty($_POST['to'])) {
         // 
         $from   = $this->input->post('from');
         $to     = $this->input->post('to');
         $cbegin = new DateTime($from);
         $cend   = new DateTime($to);
         // 
         $cinterval = DateInterval::createFromDateString('1 day');
         $cperiod = new DatePeriod($cbegin, $cinterval, $cend);
         $cnt = 1;
         foreach ($cperiod as $dt) {
            $cnt++;
         }
         //echo '<pre>'; print_r($this->colors);die;	
         $i = 0;
         foreach ($cperiod as $dt) {
            $customdata   =   $this->laporan_model->get_this_date_voucher($dt->format("Y-m-d"));
            $data['customdata'][$i]['date']      =   $dt->format("d M Y");
            $data['customdata'][$i]['amount']   =   @$customdata->amount;
            $data['customdata'][$i]['coupons']   =   @$customdata->coupons;
            $i++;
         }
      }

      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to));
            $url_cetak = 'laporan/cetak_voucher?filter=1&date_from=' . $date_from . '&date_to=' . $date_to;
            $transaksi = $this->laporan_model->get_voucher_by_date($date_from, $date_to);
         } else if ($filter == '2') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
            $url_cetak = 'laporan/cetak_voucher?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
            $transaksi = $this->laporan_model->get_voucher_by_month($bulan, $tahun);
         } else {
            $tahun = $_GET['tahun'];
            $ket = 'Data Transaksi Tahun ' . $tahun;
            $url_cetak = 'laporan/cetak_voucher?filter=3&tahun=' . $tahun;
            $transaksi = $this->laporan_model->get_voucher_by_year($tahun);
         }
      } else {
         $ket = 'Semua Data Transaksi';
         $url_cetak = 'laporan/cetak_voucher';
         $transaksi = $this->laporan_model->get_voucher_all();
      }
      $data['ket'] = $ket;
      $data['url_cetak'] = base_url('backend/' . $url_cetak);
      $data['option_tahun'] = $this->laporan_model->option_tahun_voucher();
      $data['transaksi'] = $transaksi;
      //echo json_encode($data['weekdata']);			
      //echo '<pre>'; print_r($data['weekdata']);die;
      $data['page_title']   = 'Laporan Voucher';
      $this->template->load('back/template/template', 'back/laporan/voucher', $data);
   }


   public function cetak_voucher()
   {
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $ket       = 'Penggunaan voucher : ' . tgl_indo($date_from) . ' Sampai ' . tgl_indo($date_to);
            $transaksi = $this->laporan_model->get_voucher_by_date($date_from, $date_to);
         } else if ($filter == '2') {
            $bulan   = $_GET['bulan'];
            $tahun   = $_GET['tahun'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket        = 'Penggunaan voucher Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
            $transaksi  = $this->laporan_model->get_voucher_by_month($bulan, $tahun);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $ket       = 'Penggunaan voucher Tahun ' . $tahun;
            $transaksi = $this->laporan_model->get_voucher_by_year($tahun, $status);
         }
      } else {
         $ket       = 'Semua Penggunaan voucher';
         $transaksi = $this->laporan_model->get_voucher_all();
      }
      $data['ket']       = $ket;
      $data['transaksi'] = $transaksi;
      ob_start();
      $this->load->view('back/laporan/laporan_voucher', $data);
      $html = ob_get_contents();
      // print_r($html);
      // die;
      ob_end_clean();
      require_once('./assets/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en');
      ob_end_clean();
      $pdf->WriteHTML($html);
      $pdf->Output('Laporan_voucher-' . $status . '-' . date('d-m-Y') . '.pdf', 'I');
   }
// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////   AKHIR VOUCHER   //////////////////////////////////////////////
// --------------------------------------------------------------------------------------------------------


// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////   LAPORAN KAMAR   //////////////////////////////////////////////
// --------------------------------------------------------------------------------------------------------

   function kamar()
   {
      $data['weekdata']   =   array();
      $data['monthdata']   =   array();
      $data['yeardata']   =   array();
      $data['customdata']   =   array();
      // 7 DAYS Week Chart
      $weekstart   =   date("Y-m-d", strtotime("- 6 DAYS"));
      $wbegin = new DateTime($weekstart);
      $wend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $winterval = DateInterval::createFromDateString('1 day');
      $wperiod = new DatePeriod($wbegin, $winterval, $wend);
      $i = 0;
      foreach ($wperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day      =    $dt->format("D");
         $day      =   strtolower($day);
         $weekdata   =   $this->laporan_model->get_this_date_financial($date);
         $data['weekdata'][$i]['date']   =   date('d M', strtotime($date));
         $data['weekdata'][$i]['total']   =   @$weekdata->total;
         $data['weekdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $mbegin = new DateTime(date("Y-m-d", strtotime("- 30 DAYS")));
      $mend = new DateTime(date('Y-m-d', strtotime("+ 1 DAYS")));
      // 
      $minterval = DateInterval::createFromDateString('1 day');
      $mperiod = new DatePeriod($mbegin, $minterval, $mend);
      $i = 0;
      foreach ($mperiod as $dt) {
         $date      =    $dt->format("Y-m-d");
         $dayno      =    $dt->format("N");
         $day      =    $dt->format("D");
         $day      =   strtolower($day);
         $monthdata   =   $this->laporan_model->get_this_date_financial($date);
         // 
         $data['monthdata'][$i]['date']   =   date('d M', strtotime($date));
         $data['monthdata'][$i]['total']   =   @$monthdata->total;
         $data['monthdata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      $start = $month = strtotime("- 365 days");
      $end = strtotime('+ 1 day');
      $i = 0;
      while ($month < $end) {
         $month = strtotime("+1 month", $month);
         $Y   = date('Y', $month);
         $M   = date('m', $month);
         $yeardata   =   $this->laporan_model->get_this_year_financial($Y, $M);
         // 
         $data['yeardata'][$i]['date']   =   date('M', $month) . " " . date('Y', $month);
         $data['yeardata'][$i]['total']   =   @$yeardata->total;
         $data['yeardata'][$i]['color']   =   $this->colors[$i];
         $i++;
      }
      // 
      if (!empty($_POST['from']) && !empty($_POST['to'])) {
         // 
         $from = $this->input->post('from');
         $to = $this->input->post('to');
         $cbegin = new DateTime($from);
         $cend = new DateTime($to);
         // 
         $cinterval = DateInterval::createFromDateString('1 day');
         $cperiod = new DatePeriod($cbegin, $cinterval, $cend);
         $cnt = 1;
         foreach ($cperiod as $dt) {
            $cnt++;
         }
         //echo '<pre>'; print_r($this->colors);die;	
         $i = 0;
         foreach ($cperiod as $dt) {
            $customdata   =   $this->laporan_model->get_this_date_financial($dt->format("Y-m-d"));
            $data['customdata'][$i]['date']      =   $dt->format("d M Y");
            $data['customdata'][$i]['total']   =   @$customdata->total;
            $data['customdata'][$i]['color']   =   @$this->colors[$i];
            $i++;
         }
      }
      // kamar
      //echo json_encode($data['weekdata']);			
      // echo '<pre>'; print_r($data['customdata']);die;
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $ket = 'Data Kamar Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to) .'Tipe Kamar = '.$tipe .'Status = '.$status);
            $url_cetak = 'laporan/cetak_kamar?filter=1&date_from=' . $date_from . '&date_to=' . $date_to . '&status=' . $status . '&tipe=' . $tipe;
            $transaksi = $this->laporan_model->get_kamar_by_date($date_from, $date_to, $status,$tipe);
         } else if ($filter == '2') {
            $bulan     = $_GET['bulan'];
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $nama_bulan= array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket       = 'Data Kamar/Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun . 'Status= ' . $status. 'Tipe = '.$tipe;
            $url_cetak = 'laporan/cetak_kamar?filter=2&bulan=' . $bulan . '&tahun=' . $tahun . '&status=' . $status . '&tipe=' . $tipe;
            $transaksi = $this->laporan_model->get_kamar_by_month($bulan, $tahun, $status, $tipe);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $ket       = 'Data Kamar/Tahun ' . $tahun. 'Status = ' . $status. 'Tipe = '.$tipe;
            $url_cetak = 'laporan/cetak_kamar?filter=3&tahun=' . $tahun . '&status=' . $status . '&tipe=' . $tipe;
            $transaksi = $this->laporan_model->get_kamar_by_year($tahun, $status, $tipe);
         }
      } else {
         $ket = 'Semua Data Kamar';
         $url_cetak = 'laporan/cetak_kamar';
         $transaksi = $this->laporan_model->get_this_kamar_all();
      }

      $data['ket'] = $ket;
      $data['url_cetak'] = base_url('backend/' . $url_cetak);
      $data['option_tahun'] = $this->laporan_model->option_tahun_kamar();
      $data['tipe_kamar'] = $this->laporan_model->view('tipe_kamar')->result();
      $data['transaksi'] = $transaksi;
      $data['page_title']   = 'Laporan Kamar';
      $this->template->load('back/template/template', 'back/laporan/kamar', $data);
      //echo json_encode($data['weekdata']);			
      // echo '<pre>'; print_r($data['customdata']);die;
   }

   public function cetak_kamar()
   {
      if (isset($_GET['filter']) && !empty($_GET['filter'])) {
         $filter = $_GET['filter'];
         if ($filter == '1') {
            $date_from = $_GET['date_from'];
            $date_to   = $_GET['date_to'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $ket = 'Data Kamar Tanggal ' . date('d-m-y', strtotime($date_from))  . '-' . date('d-m-y', strtotime($date_to) . 'Tipe Kamar = ' . $tipe . 'Status = ' . $status);
            $transaksi = $this->laporan_model->get_kamar_by_date($date_from, $date_to, $status, $tipe);
         } else if ($filter == '2') {
            $bulan     = $_GET['bulan'];
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $ket       = 'Data Kamar/Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun . 'Status= ' . $status . 'Tipe = ' . $tipe;
            $transaksi = $this->laporan_model->get_kamar_by_month($bulan, $tahun, $status, $tipe);
         } else {
            $tahun     = $_GET['tahun'];
            $status    = $_GET['status'];
            $tipe      = $_GET['tipe'];
            $ket       = 'Data Kamar/Tahun ' . $tahun . 'Status = ' . $status . 'Tipe = ' . $tipe;
            $transaksi = $this->laporan_model->get_kamar_by_year($tahun, $status, $tipe);
         }
      } else {
         $ket = 'Semua Data Kamar';
         $transaksi = $this->laporan_model->get_this_kamar_all();
      }

      $data['ket'] = $ket;
      $data['transaksi'] = $transaksi;
      ob_start();
      $this->load->view('back/laporan/laporan_kamar', $data);
      $html = ob_get_contents();
      // print_r($html);
      // die;
      ob_end_clean();
      require_once('./assets/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en');
      ob_end_clean();
      $pdf->WriteHTML($html);
      $pdf->Output('Laporan_Kamar-' . $status . '-' . date('d-m-Y') . '.pdf', 'I');
   }

// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////   AKHIR KAMAR   //////////////////////////////////////////////
// --------------------------------------------------------------------------------------------------------
}
