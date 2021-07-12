<?php
class Hotel_model extends CI_Model
{

   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }

   // fungsi get semua data
   // *****************************************************************************************************************************************************
   public function view($table)
   {
      return $this->db->get($table);
   }
   // *****************************************************************************************************************************************************

   // fungsi get bedasarkan  data
   // ****************************************************************************************************************************************************
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

   public function view_where_ordering($table, $data, $order, $ordering)
   {
      $this->db->where($data);
      $this->db->order_by($order, $ordering);
      $query = $this->db->get($table);
      return $query->result();
   }

   // ***************************************************************************************************************************************************
   // insert data
   // ***************************************************************************************************************************************************
   public function insert($table, $data)
   {
      return $this->db->insert($table, $data);
   }
   // ***************************************************************************************************************************************************
   // update
   // ***************************************************************************************************************************************************
   public function edit($table, $data)
   {
      return $this->db->get_where($table, $data);
   }
   public function update($table, $data, $where)
   {
      return $this->db->update($table, $data, $where);
   }

   // ***************************************************************************************************************************************************
   // delete
   // ***************************************************************************************************************************************************
   public function delete($table, $where)
   {
      return $this->db->delete($table, $where);
   }
   
   // ***************************************************************************************************************************************************
   // pemanggilan data berdasarkan join
   // *****************************************************************************************************************************************************

   public function view_join_one($table1, $table2, $field, $order, $ordering)
   {
      $this->db->select('*');
      $this->db->from($table1);
      $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
      $this->db->order_by($order, $ordering);
      return $this->db->get()->result();
   }

   public function view_join_where($table1, $table2, $field, $where, $order, $ordering)
   {
      $this->db->select('*');
      $this->db->from($table1);
      $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
      $this->db->where($where);
      $this->db->order_by($order, $ordering);
      return $this->db->get()->result();
   }

   public function view_join_rows($table1, $table2, $field, $where, $order, $ordering)
   {
      $this->db->select('*');
      $this->db->from($table1);
      $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
      $this->db->where($where);
      $this->db->order_by($order, $ordering);
      return $this->db->get();
   }

   public function view_join_where_one($table1, $table2, $field, $where)
   {
      $this->db->select('*');
      $this->db->from($table1);
      $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
      $this->db->where($where);
      return $this->db->get();
   }

   public function view_join_where_two($table1, $table2, $table3, $field1, $field2, $field3, $field4, $where)
   {
      $this->db->select('*');
      $this->db->from($table1);
      $this->db->join($table2, $table1 . '.' . $field1 . '=' . $table2 . '.' . $field2);
      $this->db->join($table3, $table2 . '.' . $field3 . '=' . $table3 . '.' . $field4);
      $this->db->where($where);
      return $this->db->get();
   }
}
