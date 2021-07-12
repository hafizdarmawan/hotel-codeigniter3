<?php
class Booking_model extends CI_Model
{
   var $CI;
   var $table = 'orders';
   var $column_order = array(null, 'no_order', 'judul', 'check_in','check_out','tgl_order'); //set column field database for datatable orderable
   var $column_search = array('no_order', 'judul', 'check_in','check_out','tgl_order'); //set column field database for datatable searchable 
   var $order = array('id' => 'asc'); // default order 

   function __construct()
   {
      parent::__construct();

      $this->CI = &get_instance();
      $this->CI->load->database();
      $this->CI->load->helper('url');
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
         $this->db->like('O.no_order', $_POST['search']['value']);
         // $this->db->like('O.check_in', $_POST['search']['value']);
         // $this->db->like('O.check_out', $_POST['search']['value']);
         $this->db->or_like('TK.judul', $_POST['search']['value']);
      }

      // $this->db->where('O.status_kode !=', '202');
      $this->db->where('O.status_kode !=', '');
      // $this->db->where('ORH.status_reservasi !=', 3);
      // // $this->db->where('O.status', '!=2');
      // $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,TK.judul judul, T.nama_depan,T.nama_belakang');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('orders_rel_harga ORH', 'ORH.id_order = O.id_order', 'LEFT');
      $this->db->group_by('O.id_order');
      $result = $this->db->get('orders O');
      return $result->result();
      // $this->db->select('*');
      // return $query = $this->db->get('tamu')->result();
   }

   function count_filtered()
   {
      return count($this->get_datatables());
   }

   public function count_all()
   {
      $this->db->from('orders');
      return $this->db->count_all_results();
   }


   function get_all()
   {
      if (!empty($_POST['id_tipe_kamar'])) {
         $this->db->where('O.id_tipe_kamar', $_POST['id_tipe_kamar']);
      }
      if (!empty($_POST['check_in'])) {
         $this->db->where('O.check_in >=', $_POST['check_in']);
      }
      if (!empty($_POST['check_out'])) {
         $this->db->where('O.check_out <=', $_POST['check_out']);
      }
      if (isset($_POST['status_pembayaran'])) {
         if ($_POST['status_pembayaran'] == 'F') {
            $this->db->where('O.status_pembayaran', 0);
         }
         if ($_POST['status_pembayaran'] == 'S') {
            $this->db->where('O.status_pembayaran', 1);
         }
         if ($_POST['status_pembayaran'] == 'P') {
            $this->db->where('O.status_pembayaran', 2);
         }
         if ($_POST['status_pembayaran'] == 'PP') {   //partialy paid
            $this->db->where('O.status_pembayaran', 3);
         }
      }
      if (!empty($_POST['tgl_order'])) {
         $this->db->where('date(O.tgl_order)', $_POST['tgl_order']);
      }

      $this->db->where('O.status_kode !=', '202');
      $this->db->where('O.status_kode !=', '');
      $this->db->where('ORH.status_reservasi !=',3);
      // $this->db->where('O.status', '!=2');
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,TK.judul judul, T.nama_depan,T.nama_belakang');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $this->db->join('orders_rel_harga ORH','ORH.id_order = O.id_order','LEFT');
      $this->db->group_by('O.id_order');
      $result = $this->db->get('orders O');
      return $result->result();

   }


   function get_gagal()
   {
      $this->db->where('status_kode !=', 200);
      $this->db->where('status_kode !=', 201);
      $result = $this->db->get('orders');
      return $result->result();
   }

   function get_pending()
   {
      $this->db->where('status_kode =', 201);
      // $this->db->where('status_kode =',0);
      $result = $this->db->get('orders');
      return $result->result();
   }

   function get_semua()
   {
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,R.judul judul, G.nama_depan,G.nama_belakang');
      $this->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }
   
   
   function update_rel_kamar($data, $kode_reservasi)
   {
      $this->db->where('kode_reservasi', $kode_reservasi);
      $this->db->update('orders_rel_harga', $data);
   }

   function update_orders($data, $id_order)
   {
      $this->db->where('id_order', $id_order);
      $this->db->update('orders', $data);
   }

   function get_order($id_order)
   {
      $this->db->where('O.id_order', $id_order);
      $this->db->select('O.*,T.nama_depan,T.nama_belakang,RT.judul tipe_kamar,T.email');
      $this->db->join('tipe_kamar RT', 'RT.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu T', 'T.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->row();
   }


   function get_by_status()
   {

      $this->db->where('O.status', 2);
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,R.judul judul, G.nama_depan,G.nama_belakang');
      $this->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');
      return $result->result();
   }
   function get_room_of_order($id)
   {
      $this->db->where('id_order', $id);
      $result = $this->db->get('orders_rel_harga');
      return $result->row();
   }
   
   function get_order_total($id_order)
   {
      $this->db->where('id_order', $id_order);
      $this->db->select('SUM(total) as total');
      return $this->db->get('pembayaran')->row();
   }


   function get($id)
   {
      $this->db->where('O.id_order', $id);
      $this->db->order_by('O.tgl_order', 'DESC');
      $this->db->select('O.*,R.judul room, G.nama_depan,G.nama_belakang,G.alamat as alamat_tamu,G.email email_tamu');
      $this->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
      $this->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
      $result = $this->db->get('orders O');

      return $result->row();
   }


   function get_services($id)
   {
      $this->db->where('OS.id_order', $id);
      $this->db->select('OS.total,S.judul,S.tipe_biaya,S.id_layanan');
      $this->db->join('layanan S', 'S.id_layanan = OS.id_layanan', 'LEFT');
      $result = $this->db->get('orders_rel_layanan OS');
      return $result->result();
   }

   function get_prices($id)
   {
      $this->db->where('R.id_order', $id);
      $this->db->select('R.*,RM.no_kamar,F.nama floor');
      $this->db->join('kamar RM', 'RM.id_kamar = R.id_kamar', 'LEFT');
      $this->db->join('lantai F', 'F.id_lantai = RM.id_lantai', 'LEFT');
      $result = $this->db->get('orders_rel_harga R');
      return $result->result();
   }

   function get_prices_kamar($id)
   {
      $this->db->where('R.id_order', $id);
      $this->db->select('R.*,RM.no_kamar,F.nama floor');
      $this->db->join('kamar RM', 'RM.id_kamar = R.id_kamar', 'LEFT');
      $this->db->join('lantai F', 'F.id_lantai = RM.id_lantai', 'LEFT');
      $this->db->group_by('R.kode_reservasi');
      $result = $this->db->get('orders_rel_harga R');
      return $result->result();
   }

   function get_payment($id)
   {
      $this->db->where('P.id_order', $id);
      $this->db->order_by('P.waktu', 'DESC');
      $result = $this->db->get('pembayaran P');

      return $result->result();
   }
   function get_paid_services($id)
   {
      $this->db->where('R.id_tipe_kamar', $id);
      $this->db->where('S.status', 1);
      $this->db->join('tipe_rel_layanan R', 'S.id_layanan = R.id_layanan', 'LEFT');
      return $this->db->get('layanan S')->result();
   }

   function get_amenities($id_tipe_kamar)
   {
      $this->db->where('TRA.id_tipe_kamar', $id_tipe_kamar);
      $this->db->select('A.*');
      $this->db->join('fasilitas A', 'A.id_fasilitas = TRA.id_fasilitas', 'LEFT');
      return $this->db->get('tipe_rel_fasilitas TRA')->result();
   }

   function get_kamar()
   {
      // SELECT propinsi, COUNT(propinsi) AS jumlah FROM kota GROUP BY propinsi

      $this->db->where('K.status', '0');
      $this->db->select('TK.*,count(K.status) AS kamar_tersedia');
      $this->db->group_by("TK.judul");
      $this->db->order_by('TK.id_tipe_kamar', 'ASC');
      $this->db->join('tipe_kamar TK', 'TK.id_tipe_kamar = K.id_tipe_kamar', 'LEFT');
      return $this->db->get('kamar K')->result();
   }

   function get_tipe($id)
   {
      $this->db->where('TK.id_tipe_kamar', $id);
      $this->db->select('TK.*,GROUP_CONCAT(L.judul) as ams');
      $this->db->join('tipe_rel_layanan TRL', 'TK.id_tipe_kamar = TRL.id_tipe_kamar', 'LEFT');
      $this->db->join('layanan L', 'L.id_layanan = TRL.id_layanan', 'LEFT');
      $result = $this->db->get('tipe_kamar TK');
      return $result->row();
   }

   function new_order_viewed($id_order)
   {
      $this->db->where('id_order', $id_order);
      $this->db->set('baru', 1);
      $this->db->update('orders');
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
}
