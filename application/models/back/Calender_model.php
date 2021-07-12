<?php
class Calender_model extends CI_Model
{

   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }
   // delete data

   public function delete($table, $where)
   {
      return $this->db->delete($table, $where);
   }
   function get_room_type()
   {
      $this->db->where('id_tipe_kamar', $_POST['id_tipe)_kamar']);
      $this->db->select('kamar.*,count(no_kamar) as total_rooms');
      return  $this->db->get('kamar')->row();
   }

   function get_booking_by_room_type_and_date($date)
   {
      $this->db->where('O.id_tipe_kamar', $_POST['id_tipe_kamar']);
      $this->db->where('R.tanggal', $date);
      $this->db->select('R.*, COUNT(R.id_order) as bookings');
      $this->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
      return   $this->db->get('orders_rel_harga R')->row();
   }

   function get_first_order()
   {
      $this->db->order_by('check_in', 'SC');
      return   $this->db->get('orders')->row();
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
}
