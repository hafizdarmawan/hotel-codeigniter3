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
   function get_all()
   {
      $result = $this->db->get('lantai');
      return $result->result();
   }

   public function view($table)
   {
      return $this->db->get($table);
   }

   // *****************************************************************************************************************************************************
   // fungsi get kamar
   // ****************************************************************************************************************************************************
   function get_kamar_aktif(){
      $this->db->select('COUNT(id_kamar) AS jumlah');
      $this->db->where('status',1);
      return $this->db->get('kamar')->row();
   }

   function get_kamar_non(){
      $this->db->select('COUNT(id_kamar) AS jumlah');
      $this->db->where('status',0);
      return $this->db->get('kamar')->row();
   }


   // *****************************************************************************************************************************************************
   // fungsi get bedasarkan  data
   // ****************************************************************************************************************************************************
   function get_images($id)
   {
      $this->db->where('id_tipe_gambar', $id);
      $result = $this->db->get('tipe_kamar_gambar');
      return $result->result();
   }

   public function view_where($table, $data)
   {
      $this->db->where($data);
      return $this->db->get($table);
   }

   function get_harga_spesial($id_tipe_kamar)
   {
      $this->db->order_by('date_from', 'ASC');
      $this->db->where('id_tipe_kamar', $id_tipe_kamar);
      return $this->db->get('harga_spesial')->result();
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
   // insert failitas
   public function insert_fasilitas($save)
   {
      $this->db->insert_batch('tipe_rel_fasilitas', $save);
   }

   // insert gambar
   public function insert_images($save)
   {
      $this->db->insert('tipe_kamar_gambar', $save);
   }

   // insert tipe 
   public function insert_tipe($table, $data)
   {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
   }

   //insert back id 
   public function insert_back_id($table, $data)
   {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
   }

   // insert layanan lebih dari satu
   public function insert_layanan($data){
      $this->db->insert_batch('tipe_rel_layanan', $data);
   }

   // insert biasa
   public function insert($table, $data)
   {
      return $this->db->insert($table, $data);
   }

   // ***************************************************************************************************************************************************
   // update
   // ***************************************************************************************************************************************************
   // edit biasa
   public function edit($table, $data)
   {
      return $this->db->get_where($table, $data);
   }

   // update image
   function update_images($save, $id_tipe_gambar)
   {
      $this->db->where('id_tipe_gambar', $id_tipe_gambar);
      $this->db->update('tipe_kamar_gambar', $save);
   }

   //update biasa 
   public function update($table, $data, $where)
   {
      return $this->db->update($table, $data, $where);
   }

   // ***************************************************************************************************************************************************
   // delete
   // ***************************************************************************************************************************************************
//   delete baiasa
   public function delete($table, $where)
   {
      return $this->db->delete($table, $where);
   }

   // delete kamar
   function delete_kamar($id_tipe_kamar)
   {
      $this->db->where('id_tipe_kamar', $id_tipe_kamar);
      $this->db->delete('tipe_kamar');
   }

   // delete image berdasarkan id
   function delete_image($id)
   {
      $this->db->where('id_tipe_gambar', $id);
      $this->db->delete('tipe_kamar_gambar');
   }

   // delete type room berdasarkan id
   public function delete_roomtype($id)
   {
      $this->db->where('id_tipe_kamar', $id);
      $this->db->delete('tipe_rel_fasilitas');
   }

   // delete layanan berdasarkan id
   public function delete_tipe_layanan($id)
   {
      $this->db->where('id_tipe_kamar', $id);
      $this->db->delete('tipe_rel_layanan');
   }

   // delete biasa
   public function delete_($table, $where)
   {
      return $this->db->delete($table, $where);
   }

   // get total kamar
   function get_states()
   {
      $this->db->select('COUNT(no_kamar) as total_kamar');
      $result = $this->db->get('kamar');
      return $result->row();
   }

   // get berdasarkan no kamar
   function get_by_room_no($no, $id)
   {
      if ($id > 0) {
         $this->db->where('id_kamar !=', $id);
      }
      $this->db->where('no_kamar', $no);
      $result = $this->db->get('kamar');
      return $result->row();
   }

   // ger berdasarkan no kamar 
   function get_by_room_no_($no)
   {
      $this->db->where('no_kamar', $no);
      $result = $this->db->get('kamar');
      return $result->row();
   }

   
   // ***************************************************************************************************************************************************
   // pemanggilan data berdasarkan join
   // *****************************************************************************************************************************************************
   function get($id)
   {
      $this->db->where('TK.id_tipe_kamar', $id);
      $this->db->select('TK.*,GROUP_CONCAT(F.nama) as ams');
      $this->db->join('tipe_rel_fasilitas TRF', 'TK.id_tipe_kamar = TRF.id_tipe_kamar', 'LEFT');
      $this->db->join('fasilitas F', 'F.id_fasilitas = TRF.id_fasilitas', 'LEFT');
      $result = $this->db->get('tipe_kamar TK');
      return $result->row();
   }

   
   function get_all_tipe()
   {
      $this->db->select('H.*,TK.judul');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = H.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('harga H');
      return $result->result();
   }

   function get_customer_all()
   {
      $this->db->select('G.*');
      // $this->db->join('countries C', 'C.id = G.country_id', 'LEFT');
      $result = $this->db->get('tamu G');
      return $result->result();
   }      

      function check_daterange(){
		  if(!empty($_POST['id_harga_spesial'])){
		  	$this->db->where('id_harga_spesial !-', $_POST['id_harga_spesial']);
		  }		
		  $this->db->where('date(date_to) >=', $_POST['start_date']);
		  $this->db->where('date(date_from) <=', $_POST['start_date']);
		  $result = $this->db->get('harga_spesial');
        return $result->row();
   }

   function get_all_tipe_kamar()
   {
      $this->db->select('K.*,L.nama lantai,TK.judul tipe_kamar,L.no_lantai');
      $this->db->join('lantai L', 'L.id_lantai = K.id_lantai', 'LEFT');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $result = $this->db->get('kamar K');
      return $result->result();
   }
   function get_all_housekeeping()
   {
      $this->db->select('H.*,K.no_kamar nokamar,HS.judul status,L.nama lantai,RT.judul tipe_kamar');
      $this->db->join('house_keeping_status HS', 'HS.id_house_keep = H.id_house_keep', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = H.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar RT', 'RT.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $this->db->join('lantai L', 'L.id_lantai = K.id_lantai', 'LEFT');
      $result = $this->db->get('housekeeping H');
      return $result->result();
   }


   function get_housekeeping_by_room($id_kamar){
      $this->db->where('H.id_kamar', $id_kamar);
      $this->db->select('H.*,K.no_kamar nokamar,HS.judul status,L.nama lantai,TP.judul tipe_kamar');
		$this->db->join('house_keeping_status HS', 'HS.id_house_keep = H.id_house_keep', 'LEFT');
		$this->db->join('kamar K', 'K.id_kamar = H.id_kamar', 'LEFT');
		$this->db->join('tipe_kamar TP', 'TP.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
		$this->db->join('lantai L', 'L.id_lantai = K.id_lantai', 'LEFT');
      $result = $this->db->get('housekeeping H');
      return $result->result();
   }

   function get_houseekeeping($id_house_keeping)
   {
      $this->db->where('H.id_house_keeping', $id_house_keeping);
      $this->db->select('H.*,K.no_kamar nokamar,HS.judul status,L.nama lantai,TP.judul tipe_kamar');
      $this->db->join('house_keeping_status HS', 'HS.id_house_keep = H.id_house_keep', 'LEFT');
      $this->db->join('kamar K', 'K.id_kamar = H.id_kamar', 'LEFT');
      $this->db->join('tipe_kamar TP', 'TP.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      $this->db->join('lantai L', 'L.id_lantai = K.id_lantai', 'LEFT');
      $result = $this->db->get('housekeeping H');
      return $result->row();
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
