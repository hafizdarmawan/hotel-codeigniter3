<?php
class Galleri_model extends CI_Model
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
   function get_houseekeeping($id_house_keeping)
   {
      $this->db->where('H.id_house_keeping', $id_house_keeping);
      $this->db->select('H.*,K.no_kamar nokamar,HS.title status,L.nama lantai,TP.title tipe_kamar');
      $this->db->join('house_keeping_status HS', 'HS.id_house_keep = H.id_house_keep', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = H.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TP', 'TP.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $this->db->join('lantai L', 'L.id_lantai = K.id_lantai', 'LEFT');
      $result = $this->db->get('housekeeping H');
      return $result->row();
   }

   function get_gallery($id_gallery)
   {
      $this->db->where('GRG.id_galleri', $id_gallery);
      $this->db->select('GRG.*,G.judul judul');
      $this->db->join('galleri G', 'G.id_galleri = GRG.id_galleri', 'LEFT');
      $result = $this->db->get('galleri_rel_gambar GRG');
      return $result->result();
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
}
