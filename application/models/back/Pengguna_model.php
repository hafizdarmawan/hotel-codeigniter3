<?php
class Pengguna_model extends CI_Model
{
   var $CI;
   function __construct()
   {
      parent::__construct();
      $this->CI = &get_instance();
   }

   // server side mengunakan datatable untuk menampilkan data users

   function get_all_product()
   {
      $this->datatables->select('*');
      $this->datatables->from('users');
      // $this->datatables->join('categories', 'product_category_id=category_id');
      $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info" data-code="$1" data-name="$2" data-price="$3" data-category="$4">Edit</a>  <a href="javascript:void(0);" class="delete_record btn btn-danger" data-code="$1">Delete</a>', 'nama_depan,nama_belakang,level_pengguna,status_pengguna,last_login');
      return $this->datatables->generate();
   } 

   // //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// memanggil semua data
   function get_all()
   {

      $result = $this->db->get('users');
      return $result->result();
   }
// memanggil data berdasarkan id
   function get($id_user)
   {
      $this->db->where('id_user', $id_user);
      $result = $this->db->get('users');
      return $result->row();
   }

   // jika mengunakan id= update jika tidak insert
   function save($save)
   {

      if ($save['id']) {
         $this->db->where('id', $save['id']);
         $this->db->update('users', $save);
         return $save['id'];
      } else {
         $this->db->insert('users', $save);
         return $this->db->insert_id();
      }
   }

   // delete data
   public function delete($table, $where)
   {
      return $this->db->delete($table, $where);
   }

   // check username
   function check_username($username)
   {
      $this->db->where('username', $username);
      $result = $this->db->get('users');
      return $result->row();
   }

   public function view($table)
   {
      return $this->db->get($table);
   }

   public function get_by_id($id)
   {
      $this->db->from('tb_toko_produk');
      $this->db->where('id_produk', $id);
      $query = $this->db->get();

      return $query->row();
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
