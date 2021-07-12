<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$setting   =   get_setting();
		$params = array('server_key' => $setting->server_key, 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, "true");
		$no_order = $result['order_id'];
		$data = array( 'status_kode' => $result['status_code']);

		if ($result['status_code'] == 200) {
			$data_order = get_order($no_order);
			$pembayaran = get_pembayaran_by_no($no_order);
			if(empty($pembayaran)){
				$save = array(
					'id_order' 				 => $data_order->id_order,
					'no_order' 				 => $no_order,
					'total' 					 => $result['gross_amount'],
					'metode_pembayaran' 	 => $result['payment_type'],
					'waktu' 					 => $result['transaction_time'],
					'bank'					 => $result['va_numbers'][0]['bank'],
					'nomor_va' 			 	 => $result['va_numbers'][0]['va_number'],
					'pdf_url' 				 => $result['pdf_url'],
					'status_kode' 			 => $result['status_code']
				);
				$this->db->insert('pembayaran', $save);
			}else{
				//  update orders terlebih dahulu
				$this->db->where('no_order', $no_order);
				$this->db->update('orders', $data);
				$order = $this->db->get_where('orders', array('no_order' => $no_order))->row();
				// update pembayaran 
				$this->db->set($data)->where('id_order', $order->id_order)->update('pembayaran');
			}
		}

		if ($result['status_code'] == 202) {
			$data_order = get_order($no_order);
			$pembayaran = get_pembayaran_by_no($no_order);
			if (empty($pembayaran)) {
				$save = array(
					'id_order' 				 => $data_order->id_order,
					'no_order' 				 => $no_order,
					'total' 					 => $result['gross_amount'],
					'metode_pembayaran' 	 => $result['payment_type'],
					'waktu' 					 => $result['transaction_time'],
					'bank'					 => $result['va_numbers'][0]['bank'],
					'nomor_va' 			 	 => $result['va_numbers'][0]['va_number'],
					'pdf_url' 				 => $result['pdf_url'],
					'status_kode' 			 => $result['status_code']
				);
				$this->db->insert('pembayaran', $save);
			} else {
				$this->db->where('no_order', $no_order);
				$this->db->update('orders', $data);
				// panggil order berdasarkan no_order
				$order = $this->db->get_where('orders', array('no_order' => $no_order))->row();
				// update pembayaran 
				$this->db->set($data)->where('id_order', $order->id_order)->update('pembayaran');
			// 			$this->db->where('id_order', $id_order);
			// 			$this->db->update('pembayaran', $data);
			// 			$this->db->update('orders', $data);
			}
		}

		error_log(print_r($result, TRUE));

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/
	}
}
