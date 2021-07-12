<?php
class Account_model extends CI_Model
{

   var $CI;

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }
   // //////////////////////////////////////////////////////////////////////

   function update_images($save, $id_tamu)
   {
      $this->db->where('id_tamu', $id_tamu);
      $this->db->update('tamu', $save);
   }



   function get_data_reservasi($id_tamu)
   {
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->order_by('O.id_order', 'DESC');
      $this->db->select('O.*,R.judul kamar, G.nama_depan,G.nama_belakang,G.alamat as alamat_tamu,G.email email_tamu,P.*');
      $this->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('pembayaran P','P.id_order = O.id_order','LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }


   // public function get_data_reservasi($id_tamu)
   // {
   //    $this->db->where('O.id_tamu', $id_tamu);
   //    $this->db->select('P.*,O.*');
   //    $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
   //    $this->db->order_by('P.id_order', 'DESC');
   //    // return $this->db->get('pembayaran P')->result();
   //    $return =  $this->db->get('pembayaran P')->result();
   //    printf($return);
   //    die;

   // }

   public function get_reservasi_berhasil($id_tamu)
   {
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->where('O.status_kode', 200);
      $this->db->select('O.status_kode');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }

   public function get_reservasi_pending($id_tamu)
   {
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->where('O.status_kode', 201);
      $this->db->select('O.status_kode');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }

   public function get_reservasi_gagal($id_tamu)
   {
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->where('O.status_kode !=', 200);
      $this->db->where('O.status_kode !=', 201);
      $this->db->select('O.status_kode');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      return $this->db->get('pembayaran P')->result();
   }

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
}
