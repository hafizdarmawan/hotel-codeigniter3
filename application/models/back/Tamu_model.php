<?php
class Tamu_model extends CI_Model
{

   var $CI;
   var $table = 'tamu';
   var $column_order = array(null, 'nama_depan', 'nama_belakang', 'email'); //set column field database for datatable orderable
   var $column_search = array('nama_depan', 'nama_belakang', 'email'); //set column field database for datatable searchable 
   var $order = array('id' => 'asc'); // default order 

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
   }

   function get_all()
   {
      $this->db->select('T.*');
      $result = $this->db->get('tamu T');
      return $result->result();
   }


   function get($id_tamu)
   {
      $this->db->where('T.id_tamu', $id_tamu);
      $this->db->select('T.*');
      $result = $this->db->get('tamu T');
      return $result->row();
   }
   // function get($id_tamu){
   //    $this->db->where('G.id_tamu',$id_tamu);
   //    $this->db->select('G.*,C.name country, S.name state, CT.name city');
   //    $this->db->join('countries C', 'C.id = G.country_id','LEFT');
   //    $this->db->join('cities CT','CT.id = G.city_id','LEFT');
   //    $this->db->join('states S','S.id = G.state_id','LEFT');
   //    $result = $this->db->get('guests G');
   //    return $result->row();


   //    $this->db->where('T.id_tamu', $id_tamu);
   //    $result = $this->db->get('guests T');
   //    return $result->row();
   // }


   function get_orders()
   {
      $result = $this->db->get('orders');
      return $result->result();
   }


   function get_booking_hari_ini()
   {
      $date = date('Y-m-d');
      $this->db->where('DATE(tgl_order)', $date);
      $result = $this->db->get('orders');
      return $result->result();
   }


   function get_total_income()
   {
      $this->db->select_sum('total');
      $this->db->where('status_kode', 200);
      return $this->db->get('pembayaran')->row();
   }


   function save($save)
   {
      if ($save['id_tamu']) {
         $this->db->where('id_tamu', $save['id_tamu']);
         $this->db->update('tamu', $save);
         return $save['id_tamu'];
      } else {
         $this->db->insert('tamu', $save);
         return $this->db->insert_id();
      }
   }

   // function delete($id)
   // {
   //    $this->db->where('id', $id);
   //    $this->db->delete('guests');
   // }


   private function _get_datatables_query()
   {
      /*$this->db->get($this->table);
		//$this->db->select('guests.*,countries.name as country');
		$this->db->join('countries', 'countries.id = guests.country_id', 'LEFT');
		$i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }*/
   }

   function get_datatables()
   {
      // $this->_get_datatables_query();
      // echo '<pre>'; print_r($_POST);die;
      if (isset($_POST['order'])) // here order processing
      {
         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }

      if ($_POST['length'] != -1) {
         $this->db->limit($_POST['length'], $_POST['start']);
      }
      if (!empty($_POST['search']['value'])) // if datatable send POST for search
      {
         $this->db->like('nama_depan', $_POST['search']['value']);
         $this->db->or_like('nama_belakang', $_POST['search']['value']);
      }
      $this->db->select('*');
      return $query = $this->db->get('tamu')->result();
   }

   function count_filtered()
   {
      
      return count($this->get_datatables());
   }

   public function count_all()
   {
      $this->db->from('tamu');
      return $this->db->count_all_results();
   }

   function get_bookings($id_tamu)
   {
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,R.judul kamar, G.nama_depan,G.nama_belakang,G.alamat as alamat_tamu,G.email email_tamu');
      $this->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }

   function get_payments($id_tamu)
   {
      $this->db->group_by('P.id_pembayaran');
      $this->db->where('O.id_tamu', $id_tamu);
      $this->db->select('P.*,G.nama_depan,G.nama_belakang,G.alamat as alamat_tamu,G.email email_tamu');
      $this->db->join('orders O', 'O.id_order = P.id_order', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('pembayaran P');
      return $result->result();
   }

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
