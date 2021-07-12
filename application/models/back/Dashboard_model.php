<?php
class Dashboard_model extends CI_Model
{

   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }
   function get_voucher()
   {
      $this->db->where('date_from <=', date('Y-m-d H:i:s'));
      $this->db->where('date_to >=', date('Y-m-d H:i:s'));
      return    $this->db->get('voucher')->result();
   }


   function get_latest_bookings($limit)
   {
      $this->db->limit($limit);
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,TK.judul Judul, T.nama_depan,T.nama_belakang');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }


   function get_this_date_tamu($date)
   {
      $this->db->group_by(array('MONTH(dibuat)'));
      $this->db->where('DATE(dibuat)', $date);
      $this->db->select('COUNT(id_tamu) as total');
      return  $this->db->get('tamu')->row();
   }


   function get_todays_revenue()
   {
      $tgl = date('Y-m-d');
      $this->db->where('DATE(waktu)', $tgl);
      $this->db->select_sum('total');
      return $this->db->get('pembayaran')->row();
   }

   function get_total_income()
   {
      $this->db->select_sum('total');
      return $this->db->get('pembayaran')->row();
   }
   function get_payment_by_date($date)
   {
      $this->db->where('DATE(waktu)', $date);
      $this->db->where('status_kode', 200);
      $this->db->select_sum('total');
      return $this->db->get('pembayaran')->row();
   }


   function get_orders()
   {
      $result = $this->db->get('orders');
      return $result->result();
   }

   // function get_latest_bookings($limit)
   // {
   //    $this->db->limit($limit);
   //    $this->db->order_by('O.ordered_on', 'DESC');
   //    $this->db->select('O.*,R.title room, G.firstname,G.lastname');
   //    $this->db->join('room_types R', 'R.id = O.room_type_id', 'LEFT');
   //    $this->db->join('guests G', 'G.id = O.guest_id', 'LEFT');
   //    $result = $this->db->get('orders O');
   //    return $result->result();
   // }

   function get_kamar()
   {
      $result = $this->db->get('kamar');
      return $result->result();
   }

   function get_tamu()
   {
      $result = $this->db->get('tamu');
      return $result->result();
   }

   // function get_todays_revenue()
   // {
   //    $this->db->where('DATE(waktu)', date('Y-m-d'));
   //    $this->db->select_sum('amount');
   //    return $this->db->get('payment')->row();
   // }


   // function get_total_income()
   // {
   //    $this->db->select_sum('amount');
   //    return $this->db->get('payment')->row();
   // }


   // function get_payment_by_date($date)
   // {
   //    $this->db->where('DATE(waktu)', $date);
   //    $this->db->select_sum('amount');
   //    return $this->db->get('payment')->row();
   // }
   // delete data
   public function delete($table, $where)
   {
      return $this->db->delete($table, $where);
   }

   public function view($table)
   {
      return $this->db->get($table);
   }

   public function insert($table, $data)
   {
      return $this->db->insert($table, $data);
   }

   public function edit($table, $data)
   {
      return $this->db->get_where($table, $data);
   }

   public function update($table, $data, $where)
   {
      return $this->db->update($table, $data, $where);
   }

   public function delete_($table, $where)
   {
      return $this->db->delete($table, $where);
   }

   public function view_where($table, $data)
   {
      $this->db->where($data);
      return $this->db->get($table);
   }

   public function view_ordering_limit($table, $order, $ordering, $baris)
   {
      $this->db->select('*');
      $this->db->order_by($order, $ordering);
      $this->db->limit($baris);
      return $this->db->get($table);
   }

   public function view_where_ordering_limit($table, $data, $order, $ordering, $baris)
   {
      $this->db->select('*');
      $this->db->where($data);
      $this->db->order_by($order, $ordering);
      $this->db->limit($baris);
      return $this->db->get($table);
   }

   public function view_ordering($table, $order, $ordering)
   {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->order_by($order, $ordering);
      return $this->db->get();
   }
}
