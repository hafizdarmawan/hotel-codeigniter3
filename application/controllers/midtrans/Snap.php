<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$setting   =   get_setting();
		$params = array('server_key' => $setting->server_key, 'production' => false);
		$this->load->library('midtrans');
		// $this->load->model('pembayaran_model');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function spp()
	{
		$data['pembayaran'] = $this->db->get('pembayaran')->result();

		$this->load->view('pembayaran_spp', $data);
	}

	public function data_pembayaran()
	{
		$data = $this->pembayaran_model->pembayaran();
		echo json_encode($data);
	}

	public function token()
	{
		$setting   =   get_setting();
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$no_telepon = $this->input->post('no_telepon');
		$no_order = $this->input->post('no_order');
		$jml_kamar = $this->input->post('jml_kamar');
		$tipe_kamar = $this->input->post('tipe_kamar');
		$durasi = $this->input->post('durasi');
		$total_biaya = $this->input->post('total_biaya');
		// Required
		$transaction_details = array(
			'order_id' => $no_order,
			'gross_amount' => $total_biaya, // no decimal allowed for creditcard
		);
		// Optional
		$item1_details = array(
			//   'id' => 'a1',
			'price' => $total_biaya,
			'quantity' => 1,
			'name' => $jml_kamar . " " . $tipe_kamar . "(" . $durasi . " malam)",
		);
		// Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );
		// Optional
		$item_details = array($item1_details);

		// Optional
		// $billing_address = array(
		//   'first_name'    => "Andri",
		//   'last_name'     => "Litani",
		//   'address'       => "Mangga 20",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16602",
		//   'phone'         => "081122334455",
		//   'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		//   'first_name'    => "Obet",
		//   'last_name'     => "Supriadi",
		//   'address'       => "Manggis 90",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16601",
		//   'phone'         => "08113366345",
		//   'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
			'first_name'    => $nama,
			// 'last_name'     => "Litani",
			'email'         => $email,
			'phone'         => $no_telepon,
			// 'billing_address'  => $billing_address,
			// 'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => $setting->durasi_bayar
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		$id_order = $this->input->post('id_order');
		$no_order = $this->input->post('no_order');
		$data = array(
			'id_order' 				 => $id_order,
			'no_order' 				 => $no_order,
			'total' 					 => $result['gross_amount'],
			'metode_pembayaran' 	 => $result['payment_type'],
			'waktu' 					 => $result['transaction_time'],
			'bank'					 => $result['va_numbers'][0]['bank'],
			'nomor_va' 			 	 => $result['va_numbers'][0]['va_number'],
			'pdf_url' 				 => $result['pdf_url'],
			'status_kode' 			 => $result['status_code']
		);
		$simpan = $this->db->insert('pembayaran', $data);
		
		$where = array('id_order' => $id_order);
		$data = array(
			'status_kode' => $result['status_code'],
		);

		$this->db->where($where);
		$this->db->update('orders', $data);
		//
		$data_detail = array(
			'status_reservasi' => 1
		);
		$this->db->update('orders_rel_harga', $data_detail, $where);
		if ($simpan) {
			$this->session->set_flashdata('message', 'swal("Informasi", "Selesaikan proses pembayaran", "info");');
			redirect(base_url('dashboard'));
		} else {
			echo "Pembayaran Gagal";
		}
	}
}