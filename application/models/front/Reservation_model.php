<?php
class Reservation_model extends CI_Model
{

   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }



   function get_amenities($id_tipe_kamar)
   {
      $this->db->where('TRA.id_tipe_kamar', $id_tipe_kamar);
      $this->db->select('A.*');
      $this->db->join('fasilitas A', 'A.id_fasilitas = TRA.id_fasilitas', 'LEFT');
      return $this->db->get('tipe_rel_fasilitas TRA')->result();
   }

   function get_paid_services($id_tipe_kamar)
   {
      $this->db->where('TRS.id_tipe_kamar', $id_tipe_kamar);
      $this->db->where('S.status', 1);
      $this->db->join('tipe_rel_layanan TRS', 'S.id_layanan = TRS.id_layanan', 'LEFT');
      return $this->db->get('layanan S')->result();
   }

   function save_order($save)
   {

      $this->db->insert('orders', $save);
      return $this->db->insert_id();
   }
   function save_payment($save)
   {
      $this->db->insert('payment', $save);
   }
   function update_order($save, $id_order)
   {
      $this->db->where('id_order', $id_order);
      $this->db->update('orders', $save);
   }

   function save_price($save)
   {
      $this->db->insert_batch('orders_rel_harga', $save);
   }

   function save_service($save)
   {
      $this->db->insert_batch('orders_rel_layanan', $save);
   }

   function get_template($id_tempmail)
   {
      return $this->db->where('id_tempmail', $id_tempmail)->get('mail_template')->row_array();
   }
   function get_order($id_order)
   {
      $this->db->where('O.id_order', $id_order);
      $this->db->select('O.*,T.nama_depan,T.nama_belakang,RT.judul tipe_kamar,T.email');
      $this->db->join('tipe_kamar RT', 'RT.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      // $this->db->join('currency C', 'C.currency_code = O.currency', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->row();
   }

   function get_services($id_order)
   {
      $this->db->where('ORL.id_order', $id_order);
      $this->db->select('ORL.total,L.judul,L.tipe_biaya,L.id_layanan');
      $this->db->join('layanan L', 'L.id_layanan = ORL.id_layanan', 'LEFT');
      $result = $this->db->get('orders_rel_layanan ORL');
      return $result->result();
   }

   function get_prices($id_order)
   {
      $this->db->where('id_order', $id_order);
      $result = $this->db->get('orders_rel_harga');
      return $result->result();
   }

   // 
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

   public function view_where_ordering($table, $data, $order, $ordering)
   {
      $this->db->where($data);
      $this->db->order_by($order, $ordering);
      $query = $this->db->get($table);
      return $query->result();
   }

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
