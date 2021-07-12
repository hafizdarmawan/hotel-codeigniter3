<?php
class Frontend_model extends CI_Model
{

   var $CI;

   //  $data['setting']           = $setting = get_setting();
   //    $data['page_title']      = 'Home';
   //    $data['banner']          = $this->frontend_model->view_where('banner', "status = '1'")->result();
   //    $data['tipe_kamar']      = $this->frontend_model->get_room_types();
   //    $data['fasilitas']       = $this->frontend_model->view_where('fasilitas',"status = '1'")->result();  
   //    $data['voucher']         = $this->frontend_model->get_coupons();

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }

   function get_room_types()
   {
      $this->db->where('status',1);
      $this->db->order_by('id_tipe_kamar', 'RANDOM');
      return $this->db->get('tipe_kamar', 4)->result();
   }

   function get_coupons()
   {
      $this->db->where('date_from <=', date('Y-m-d H:i:s'));
      $this->db->where('date_to >=', date('Y-m-d H:i:s'));
      return    $this->db->get('voucher')->result();
   }
   function get_amenities_active($id_tipe_kamar)
   {
      $this->db->where('TRF.id_tipe_kamar', $id_tipe_kamar);
      $this->db->where('F.status', '1');
      $this->db->select('F.*');
      $this->db->join('fasilitas F', 'F.id_fasilitas = TRF.id_fasilitas', 'LEFT');
      return $this->db->get('tipe_rel_fasilitas TRF')->result();
   }

   function get_images($id_tipe_kamar)
   {
      $this->db->where('id_tipe_kamar', $id_tipe_kamar);
      // $this->db->order_by('is_featured', 'DESC');
      $result = $this->db->get('tipe_kamar_gambar');
      return $result->result();
   }
   // //////////////////////////////////////////////////////////////////////
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

   public function view_where_where($table, $data,$data2)
   {
      $this->db->where($data);
      $this->db->where($data2);
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
