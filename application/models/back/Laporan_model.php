<?php
class Laporan_model extends CI_Model
{
   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN BY DATE  ///////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function laporan_by_date_keuangan($date_from, $date_to,$status){
      $this->db->where('DATE(P.waktu) >=', $date_from);
      $this->db->where('DATE(P.waktu) <=',$date_to);
      $this->db->select('O.*,P.*,T.*');
      if ($status == 'all') {
         $this->db->where('P.status_kode !=', 201);
      } else if ($status == 'lunas') {
         $this->db->where('P.status_kode', 200);
      } else if ($status == 'gagal') {
         $this->db->where('P.status_kode !=', 200);
         $this->db->where('P.status_kode !=', 201);
      }
      // $this->db->select('SUM(P.total) as total ');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN BY MONTH  ///////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function laporan_by_month_keuangan($month, $year, $status)
   {
      $this->db->where('MONTH(P.waktu)', $month); // Tambahkan where bulan
      $this->db->where('YEAR(P.waktu)', $year); // Tambahkan where tahun
      $this->db->select('O.no_order,P.metode_pembayaran,P.bank,P.waktu,P.total,P.status_kode,T.nama_depan,T.nama_belakang');
      if($status == 'all'){
         $this->db->where('P.status_kode !=', 201);
      }else if($status == 'lunas' ){
         $this->db->where('P.status_kode', 200);
      }else if($status == 'gagal'){
         $this->db->where('P.status_kode !=', 200);
         $this->db->where('P.status_kode !=', 201);
      }
      // $this->db->select('SUM(P.total) as total ');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN BY YEAR  ///////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function laporan_by_year_keuangan($year,$status){
      $this->db->where('YEAR(P.waktu)', $year); // Tambahkan where tahun
      $this->db->select('O.no_order,P.metode_pembayaran,P.bank,P.waktu,P.total,P.status_kode,T.nama_depan,T.nama_belakang');
      if ($status == 'all') {
         $this->db->where('P.status_kode !=', 201);
      } else if ($status == 'lunas') {
         $this->db->where('P.status_kode', 200);
      } else if ($status == 'gagal') {
         $this->db->where('P.status_kode !=', 200);
         $this->db->where('P.status_kode !=', 201);
      }
      // $this->db->select('SUM(P.total) as total ');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN GET ALL  ///////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function laporan_keuangan_get_all(){
      $this->db->select('O.no_order,P.metode_pembayaran,P.bank,P.waktu,P.total,P.status_kode,T.nama_depan,T.nama_belakang');
      $this->db->where('P.status_kode !=', 201);
      // $this->db->select('SUM(P.total) as total ');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      $this->db->join('tamu T','T.id_tamu = O.id_tamu','LEFT');
      return $this->db->get('pembayaran P')->result();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN GET TAHUN //////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   public function option_tahun()
   {
      $this->db->select('YEAR(P.waktu) AS tahun');
      $this->db->where('P.status_kode !=', 201);
      $this->db->order_by('YEAR(P.waktu)');
      $this->db->group_by('YEAR(P.waktu)');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// GRAFIK KEUANGAN DATE //////////////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function get_this_date_financial($date)
   {
      $this->db->group_by(array('MONTH(P.waktu)'));
      $this->db->where('DATE(P.waktu)', $date);
      $this->db->where('O.status_kode', 200);
      $this->db->select('SUM(P.total) as total');
      $this->db->join('orders O', 'P.id_order = O.id_order', 'LEFT');
      return  $this->db->get('pembayaran P')->row();
   }
// -------------------------------------------------------------------------------------------------------- 
/////////////////////////////////////// LAPORAN KEUANGAN DATE YEAR /////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 
   function get_this_year_financial($y, $m)
   {
      $this->db->where('MONTH(P.waktu)', $m);
      $this->db->where('YEAR(P.waktu)', $y);
      $this->db->where('O.status_kode', 200);
      $this->db->select('SUM(P.total) as total');
      $this->db->join('orders O', 'P.id_order = O.id_order', 'LEFT');
      return  $this->db->get('pembayaran P')->row();
   }

   function laporan_by_date_occupancy($date_from, $date_to, $status)
   {
      $this->db->where('DATE(O.tgl_order) >=', $date_from);
      $this->db->where('DATE(O.tgl_order) <=', $date_to);
      $this->db->select('O.*,T.*,TK.*');
      if ($status == 'all') {
         $this->db->where('O.status_kode !=', 201);
      } else if ($status == 'lunas') {
         $this->db->where('O.status_kode', 200);
      } else if ($status == 'gagal') {
         $this->db->where('O.status_kode !=', 200);
         $this->db->where('O.status_kode !=', 201);
      }
      // $this->db->where('O.status_kode', 200);
      // $this->db->select('SUM(O.total_jumlah) as total ');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('Orders O')->result();
   }

   function laporan_by_month_occupancy($month, $year, $status)
   {
      $this->db->where('MONTH(O.tgl_order)', $month); // Tambahkan where bulan
      $this->db->where('YEAR(O.tgl_order)', $year); // Tambahkan where tahun
      $this->db->select('O.*,T.*,TK.*');
      if ($status == 'all') {
         $this->db->where('O.status_kode !=', 201);
      } else if ($status == 'lunas') {
         $this->db->where('O.status_kode', 200);
      } else if ($status == 'gagal') {
         $this->db->where('O.status_kode !=', 200);
         $this->db->where('O.status_kode !=', 201);
      }
      // $this->db->where('O.status_kode', 200);
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar','LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('orders O')->result();
   }

   function laporan_by_year_occupancy($year,$status)
   {
      $this->db->where('YEAR(O.tgl_order)', $year); // Tambahkan where tahun
      $this->db->select('O.*,T.*,TK.*');
      if ($status == 'all') {
         $this->db->where('O.status_kode !=', 201);
      } else if ($status == 'lunas') {
         $this->db->where('O.status_kode', 200);
      } else if ($status == 'gagal') {
         $this->db->where('O.status_kode !=', 200);
         $this->db->where('O.status_kode !=', 201);
      }
      // $this->db->where('O.status_kode', 200);
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('orders O')->result();
   }

   function laporan_occupancy_get_all()
   {
      $this->db->select('O.*,T.*,TK.*');
      $this->db->where('O.status_kode !=', 201);
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('orders O')->result();
   }

   public function option_tahun_occupancy()
   {
      $this->db->where('O.status_kode !=', 201);
      $this->db->select('YEAR(O.tgl_order) AS tahun');
      $this->db->order_by('YEAR(O.tgl_order)');
      $this->db->group_by('YEAR(O.tgl_order)');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      return $this->db->get('orders O')->result();
   }

   function get_this_week_occupancy($date)
   {
      if (!empty($_POST['id_tipe_kamar'])) {
         $this->db->where('O.id_tipe_kamar', $_POST['id_tipe_kamar']);
      }
      $this->db->group_by(array('MONTH(R.tanggal)'));
      $this->db->where('DATE(R.tanggal)', $date);
      $this->db->where('O.status_kode', 200);
      $this->db->select('SUM(O.dewasa)  as total');
      $this->db->join('orders O', 'R.id_order = O.id_order', 'LEFT');
      return  $this->db->get('orders_rel_harga R')->row();
   }

   function get_this_year_occupancy($y, $m)
   {
      if (!empty($_POST['id_tipe_kamar'])) {
         $this->db->where('O.id_tipe_kamar', $_POST['id_tipe_kamar']);
      }
      $this->db->where('MONTH(R.tanggal)', $m);
      $this->db->where('YEAR(R.tanggal)', $y);
      $this->db->where('O.status_kode', 200);
      $this->db->select('SUM(O.dewasa) as total');
      $this->db->join('orders O', 'R.id_order = O.id_order', 'LEFT');
      return  $this->db->get('orders_rel_harga R')->row();
   }


   function get_this_kamar($date_from, $date_to, $status_reservasi){
      $this->db->where('O.status_kode', 200);
      $this->db->where('ORH.tanggal >=',$date_from);
      $this->db->where('ORH.tanggal <=',$date_to);
      $this->db->where('ORH.status_reservasi',$status_reservasi);
      $this->db->where('kamar K','K.id_kamar = ORH.id_kamar','LEFT');
      $this->db->where('tipe_kamar TK','TK.id_tipe_kamar = O.id_tipe_kamar','LEFT');
      $this->db->join('tamu T','T.id_tamu = O.id_tamu','LEFT');
      $this->db->join('orders O','O.id_order = ORH.id_order','LEFT');
     return  $this->db->get('orders_rel_harga ORH')->result();
   }

   // 

   function get_this_kamar_all()
   {
      // $this->db->where('ORH.status_reservasi',2);
      // $this->db->where('TK.id_tipe_kamar',4);
   $this->db->where('O.status_kode', 200);
   $this->db->select('O.no_order,TK.judul,ORH.id_kamar,O.id_tipe_kamar,ORH.tanggal,ORH.status_reservasi,no_kamar, O.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga');
   $this->db->join('orders O','O.id_order = ORH.id_order','LEFT');
   $this->db->join('tamu T','T.id_tamu = O.id_tamu','LEFT');
   $this->db->join('kamar K', 'K.id_kamar = ORH.id_kamar', 'LEFT');
   $this->db->join('tipe_kamar TK','TK.id_tipe_kamar = K.id_tipe_kamar','LEFT');
   $result = $this->db->get('orders_rel_harga ORH');
   return $result->result();
   }

   function get_kamar_status($status,$tipe)
   {
      $this->db->where('O.status_kode', 200);
      $this->db->where('ORH.status_reservasi',$status);
      $this->db->where('TK.id_tipe_kamar',$tipe);
      $this->db->select('O.no_order,TK.judul,O.id_tipe_kamar,ORH.id_kamar,ORH.tanggal,ORH.status_reservasi,no_kamar, O.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga');
      $this->db->join('orders O', 'O.id_order = ORH.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = ORH.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('orders_rel_harga ORH');
      return $result->result();
   }

   function get_kamar_by_date($date_from, $date_to, $status = null, $tipe = null){
      $this->db->where('O.status_kode', 200);
      if($status != ''){
         $this->db->where('ORH.status_reservasi', $status);
      }
      if ($tipe != '') {
         $this->db->where('TK.id_tipe_kamar', $tipe);
      }
      $this->db->where('DATE(ORH.tanggal) >=', $date_from);
      $this->db->where('DATE(ORH.tanggal) <=', $date_to);
      $this->db->select('O.no_order,TK.judul,ORH.id_kamar,O.id_tipe_kamar,ORH.tanggal,ORH.status_reservasi,no_kamar, O.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga');
      $this->db->join('orders O', 'O.id_order = ORH.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = ORH.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('orders_rel_harga ORH');
      return $result->result();
   }

   function get_kamar_by_month($month, $year,$status = null,$tipe = null)
   {
      $this->db->where('O.status_kode', 200);
      if($status != ''){
         $this->db->where('ORH.status_reservasi', $status);
      }

      if($tipe != ''){
         $this->db->where('TK.id_tipe_kamar', $tipe);
      }
      $this->db->where('MONTH(ORH.tanggal)', $month);
      $this->db->where('YEAR(ORH.tanggal)', $year);
      $this->db->select('O.no_order,TK.judul,ORH.id_kamar,O.id_tipe_kamar,ORH.tanggal,ORH.status_reservasi,no_kamar, O.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga');
      $this->db->join('orders O', 'O.id_order = ORH.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = ORH.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('orders_rel_harga ORH');
      return $result->result();
   }

   function get_kamar_by_year($year, $status = null, $tipe = null)
   {
      // $this->db->where('O.status_kode !=', 202);
      // $this->db->where('O.status_kode !=', 0);
      $this->db->where('O.status_kode',200);
      if($tipe != ''){
         $this->db->where('O.id_tipe_kamar', $tipe);
      }
      // print_r($status);
      // die;
      if($status != ''){
      $this->db->where('ORH.status_reservasi', $status);
      }
      $this->db->where('YEAR(ORH.tanggal)', $year);
      $this->db->select('O.no_order,TK.judul,ORH.id_kamar,O.id_tipe_kamar,ORH.tanggal,ORH.status_reservasi,no_kamar, O.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga');
      $this->db->join('orders O', 'O.id_order = ORH.id_order', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = ORH.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('orders_rel_harga ORH');
      return $result->result();
      // echo '<pre>';
      // print_r($result->result());
      // die;
   }

   public function option_tahun_kamar()
   {
      $this->db->select('YEAR(ORH.tanggal) AS tahun');
      $this->db->order_by('YEAR(ORH.tanggal)');
      $this->db->group_by('YEAR(ORH.tanggal)');
      $this->db->join('orders_rel_harga ORH', 'ORH.id_order = O.id_order', 'LEFT');
      return $this->db->get('orders O')->result();
   }


   //    function tampil_kamar(){
// "SELECT orders_rel_harga.id_kamar,kode_reservasi,orders.no_order,no_kamar, orders.id_tamu ,nama_depan,nama_belakang ,id_order_rel_harga 
// FROM tamu,orders,orders_rel_harga 
// LEFT JOIN kamar ON orders_rel_harga.id_kamar=kamar.id_kamar  
// LEFT JOIN tipe_kamar ON kamar.id_tipe_kamar=tipe_kamar.id_tipe_kamar 
// WHERE tamu.id_tamu=orders.id_tamu AND orders.id_order=orders_rel_harga.id_order AND orders_rel_harga.status_reservasi=2"
//    }


// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////////      LAPORAN TAMU           /////////////////////////////////////// 
// -------------------------------------------------------------------------------------------------------- 

   // tamu
   function get_this_date_tamu($date)
   {
      $this->db->group_by(array('MONTH(dibuat)'));
      $this->db->where('DATE(dibuat)', $date);
      $this->db->select('COUNT(id_tamu) as total');
      return  $this->db->get('tamu')->row();
   }


   function get_this_year_tamu($y, $m)
   {
      $this->db->where('MONTH(dibuat)', $m);
      $this->db->where('YEAR(dibuat)', $y);
      $this->db->select('COUNT(id_tamu) as total');
      return  $this->db->get('tamu')->row();
   }

   function laporan_by_date_tamu($date_from,$date_to){
      $this->db->where('DATE(dibuat) >=', $date_from);
      $this->db->where('DATE(dibuat) <=', $date_to);
      // $this->db->where('status','1');
      $this->db->select('*');
      return  $this->db->get('tamu')->result();
   }

   function laporan_by_month_tamu($month, $year){
      $this->db->where('MONTH(dibuat)', $month);
      $this->db->where('YEAR(dibuat)', $year);
      // $this->db->where('status', '1');
      $this->db->select('*');
      return  $this->db->get('tamu')->result();
   }

   function laporan_by_year_tamu($year){
      $this->db->where('YEAR(dibuat)', $year);
      // $this->db->where('status', '1');
      $this->db->select('*');
      return  $this->db->get('tamu')->result();
   }

   function laporan_tamu_all(){
      // $this->db->where('status', '1');
      $this->db->select('*');
      return  $this->db->get('tamu')->result();
   }

   public function option_tahun_tamu()
   {
      $this->db->select('YEAR(dibuat) AS tahun');
      $this->db->order_by('YEAR(dibuat)');
      $this->db->group_by('YEAR(dibuat)');
      return  $this->db->get('tamu')->result();
   }

// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////      LAPORAN AKHIR TAMU         /////////////////////////////////////// 
// --------------------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------------------- 
///////////////////////////////////      LAPORAN VOUCHER TERPAKAI   /////////////////////////////////////// 
// --------------------------------------------------------------------------------------------------------

   function get_this_date_voucher($date)
   {
      if (!empty($_POST['voucher'])) {
         $this->db->where('voucher', $_POST['voucher']);
      }
      $this->db->group_by(array('MONTH(tgl_order)'));
      $this->db->where('DATE(tgl_order)', $date);
      $this->db->where('status_kode', 200);
      $this->db->select('SUM(voucher_diskon) as amount,COUNT(voucher) as coupons');
      return  $this->db->get('orders')->row();
   }

   function get_this_year_voucher($y, $m)
   {
      if (!empty($_POST['voucher'])) {
         $this->db->where('voucher', $_POST['voucher']);
      }
      $this->db->where('MONTH(tgl_order)', $m);
      $this->db->where('YEAR(tgl_order)', $y);
      $this->db->where('status_kode', 200);
      $this->db->select('SUM(voucher_diskon) as amount,COUNT(voucher) as coupons');
      return  $this->db->get('orders')->row();
   }
   // voucher

   function get_voucher()
   {
      return  $this->db->get('voucher')->result();
   }


   function get_voucher_all()
   {
      $this->db->where('O.status_kode', 200);
      $this->db->where('O.voucher !=','');
      $this->db->select('O.no_order,T.nama_depan,T.nama_belakang,O.*');
      $this->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
      return $result = $this->db->get('orders O')->result();
      // return $result->result();
   }

   function get_voucher_by_date($date_from, $date_to)
   {
      $this->db->where('O.status_kode', 200);
      $this->db->where('O.voucher !=', '');
      $this->db->where('DATE(O.tgl_order) >=', $date_from);
      $this->db->where('DATE(O.tgl_order) <=', $date_to);
      $this->db->select('O.no_order,T.nama_depan,T.nama_belakang,O.*');
      $this->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }

   function get_voucher_by_month($month, $year)
   {
      $this->db->where('O.status_kode', 200);
      $this->db->where('O.voucher !=', '');
      $this->db->where('MONTH(O.tgl_order)', $month);
      $this->db->where('YEAR(O.tgl_order)', $year);
      $this->db->select('O.no_order,T.nama_depan,T.nama_belakang,O.*');
      $this->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }

   function get_voucher_by_year($year)
   {
      $this->db->where('O.status_kode', 200);
      $this->db->where('O.voucher !=', '');
      $this->db->where('YEAR(O.tgl_order)', $year);
      $this->db->select('O.no_order,T.nama_depan,T.nama_belakang,O.*');
      $this->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }

   public function option_tahun_voucher()
   {
      $this->db->select('YEAR(O.tgl_order) AS tahun');
      $this->db->order_by('YEAR(O.tgl_order)');
      $this->db->group_by('YEAR(O.tgl_order)');
      $this->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }

   public function view($table)
   {
      return $this->db->get($table);
   }

   public function view_where($table, $data)
   {
      $this->db->where($data);
      return $this->db->get($table);
   }
}
