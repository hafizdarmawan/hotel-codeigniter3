<?php
	
	function get_front_user(){
		 $CI =& get_instance();
		return  $front_admin	=	$CI->session->userdata('front_user');
					
	}

function get_admin()
{
		$CI = &get_instance();
		$CI->db->where('id_user', $CI->session->userdata('id_user'));
		$CI->db->select('*');
		return $CI->db->get('users')->row();
}

	function get_setting(){
		$CI =& get_instance();
		$CI->db->where('S.id_setting',1);
		$CI->db->select('*');
		return 	$CI->db->get('settings S')->row();	
	}

function get_tipe_kamar_by_id($id)
{
		$CI = &get_instance();
		$CI->db->where('id_tipe_kamar', $id);
		return $CI->db->get('tipe_kamar')->row();
}


function get_tamu_by_kamar($id_kamar){
		$CI = &get_instance();
		$CI->db->where('O.id_kamar', $id_kamar);
		$CI->db->where('O.status_reservasi', 2);
		$CI->db->select('O.*,T.*');
		$CI->db->join('orders_rel_harga ORH', 'ORH.id_order = O.order','LEFT');
		$CI->db->join('tamu T', 'O.id_tamu = T.id_tamu','LEFT');
		return $CI->db->get('orders O')->row();
}

function get_ketersediaan_hari_ini($id_tipe_kamar){
		$CI = &get_instance();
		// mencari order hari ini
		$date = date('Y-m-d');
		$CI->db->where('O.id_tipe_kamar', $id_tipe_kamar);
		$CI->db->where('R.status_reservasi !=', 0);
		$CI->db->where('R.status_reservasi !=', 3);
		$CI->db->where('O.status_kode !=',202);
		$CI->db->where('O.status_kode !=',0);
	   // $CI->db->where('O.status_kode =',201);
		// $CI->db->where('O.status_booking !=', 4);
		$CI->db->where('R.tanggal', $date);
		$CI->db->select('R.*,');
		$CI->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
		$orders =	$CI->db->get('orders_rel_harga R')->result();
		$jml_order = count($orders);
		// print_r($orders);
		// mencari kamar jumlah kamar
		$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
		$CI->db->where('status',1);
		// $CI->db->where('status_jual', 'online');
		$CI->db->select('kamar.*,count(no_kamar) as total_rooms');
		$rooms	  	=	$CI->db->get('kamar')->row_array();
		$total_rooms	=	$rooms['total_rooms'];
		$jml_tersedia  = 0;
	
		if($jml_order > $total_rooms){
		$jml_tersedia = 0;
	}elseif($jml_order < $total_rooms){
		$jml_tersedia = $total_rooms - $jml_order;
	}
	return $jml_tersedia;
	// return print_r($jml_tersedia);
}

function get_ketersediaan($date_from, $date_to, $id_tipe_kamar)
{
		$CI = &get_instance();
		$CI->db->where('O.id_tipe_kamar', $id_tipe_kamar);
		$CI->db->where('O.status_kode', 200);
		// $CI->db->where('O.status_booking', 1);
		$CI->db->where('R.status_reservasi !=',0);//1 pending
		$CI->db->where('R.status_reservasi !=',3 ); //2 Check In 
		// $CI->db->where('O.status_kode', 201);
		$CI->db->where('R.tanggal >=', $date_from);
		$CI->db->where('R.tanggal <=', $date_to);
		$CI->db->select('R.*,');
		$CI->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
		$orders =	$CI->db->get('orders_rel_harga R')->result();

		$jml_order = count($orders);
		// mencari kamar jumlah kamar
		$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
		$CI->db->where('status',1);
		$CI->db->select('kamar.*,count(no_kamar) as total_rooms');
		$rooms	  	=	$CI->db->get('kamar')->row_array();
		$total_rooms	=	$rooms['total_rooms'];
		$jml_tersedia  = 0;
		if ($jml_order > $total_rooms) {
		$jml_tersedia = 0;
		} elseif ($jml_order < $total_rooms) {
		$jml_tersedia = $total_rooms - $jml_order;
		}
		return $jml_tersedia;
		// return print_r($jml_tersedia);
}

	function get_tamu($id){
		$CI = &get_instance();
		$CI->db->where('id_tamu',$id);
		return $CI->db->get('tamu')->row();
}


function get_invoice($id_order){
		$CI = &get_instance();
		$CI->db->where('O.id_order', $id_order);
		$CI->db->select('O.*,T.*,P.*');
		$CI->db->join('pembayaran P','P.id_order = O.id_order','LEFT');
		$CI->db->join('orders_rel_harga ORH','ORH.id_order = O.id_order','LEFT');
		$CI->db->join('tamu T', 'O.id_tamu = T.id_tamu', 'LEFT');
		return $CI->db->get('orders O')->row();
}

function get_order($no_order){
	$CI = &get_instance();
	$CI->db->where('no_order', $no_order);
	$CI->db->select('id_order');
	return $CI->db->get('orders')->row();
}

function get_pembayaran_by_no($no_order)
{
	$CI = &get_instance();
	$CI->db->where('no_order', $no_order);
	$CI->db->select('*');
	return $CI->db->get('pembayaran')->row();
}

function get_order_new(){
	$CI = &get_instance();
	$CI->db->where('O.baru', 0);
	$CI->db->where('O.status_kode !=',202);
	$CI->db->where('O.status_kode !=',0);
	$CI->db->order_by('O.tgl_order', 'DESC');
	$CI->db->select('O.*,R.judul room, G.nama_depan,G.nama_belakang');
	$CI->db->join('tipe_kamar R', 'R.id_tipe_kamar = O.id_tipe_kamar', 'LEFT');
	$CI->db->join('tamu G', 'G.id_tamu = O.id_tamu', 'LEFT');
	$result = $CI->db->get('orders O');
	return $result->result();
}

function get_kamar_by_id($id)
{
		$CI = &get_instance();
		$CI->db->where('id_tipe_kamar', $id);
		$CI->db->select('*');
		return $CI->db->get('kamar')->result();
}

	function get_foto_tamu($id_tamu){
		$CI =& get_instance();
		$CI->db->where('id_tamu',$id_tamu);
		$CI->db->select('image');
		return $CI->db->get('tamu')->row();
	}

function get_orders_rel_harga_tiga($id_order){
	$CI = &get_instance();
	$CI->db->where('id_order',$id_order);
	$CI->db->where('status_reservasi',3);
	$CI->db->select('*');
	return $CI->db->get('orders_rel_harga')->result();
}

function get_orders_rel_harga_dua($id_order)
{
	$CI = &get_instance();
	$CI->db->where('id_order', $id_order);
	$CI->db->where('status_reservasi',2);
	$CI->db->select('*');
	return $CI->db->get('orders_rel_harga')->result();
}

function get_tipe_kamar()
{
		$CI = &get_instance();
		return $CI->db->get('tipe_kamar')->result();
}

// function get_pages()
// {
// 		$CI = &get_instance();
// 		$CI->db->where('status', '1');
// 		$CI->db->select('*');
// 		return $CI->db->get('halaman')->result();
// }
	
	function get_paid_service_amount($id,$adults,$nights){
		$amount	=	0;
		if($nights == 0){
		$nights	=	1;
		}
		$CI =& get_instance();
		$CI->db->where('id_layanan',$id);
		$result	=	$CI->db->get('layanan')->row();	
			
		if($result->tipe_biaya==1){	//per person
		$amount	=	($result->biaya*$adults)*$nights;
		}
		
		if($result->tipe_biaya==2){ // per night
		$amount	=	($result->biaya*$nights)*$adults;
		}
		
		if($result->tipe_biaya==3){ //fixed biaya
		$amount	=	$result->biaya;
		}
		return $amount;
	}
	
	function get_paid_service_amount_all($paid_services,$adults,$nights){
		$amount	=	0;
		if($nights == 0){
		$nights	=	1;
		}
		$CI =& get_instance();
		$CI->db->where_in('id_layanan',$paid_services);
		$results	=	$CI->db->get('layanan')->result();	
		foreach($results as $result){
		
		if($result->tipe_biaya==1){	//per person
		$amount	+=	($result->biaya*$adults)*$nights;
		}
		
		if($result->tipe_biaya==2){ // per night
		$amount	+=	($result->biaya*$nights)*$adults;
		}
		
		if($result->tipe_biaya==3){ //fixed biaya
		$amount	+=	$result->biaya;
		}
		}	
		return $amount;
	}
	
	function get_room_type_featured_image($id_tipe_kamar){
		$CI =& get_instance();
		$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
		// $CI->db->where('is_featured',1);
		$result	=	$CI->db->get('tipe_kamar_gambar')->row();	
		if(empty($result)){
		$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
		$result	=	$CI->db->get('tipe_kamar_gambar')->row();
		}
		if(empty($result)){
		return base_url('assets/img/kamar/noImageAvailable.jpg'); 
		}else{
		return base_url('assets/img/kamar/small/'.$result->image);
		}
	}

	function get_layanan_by_id($data_layanan){
	$CI = &get_instance();
	$CI->db->where('id_layanan', $data_layanan);
	return $CI->db->get('layanan')->row();
	}

function get_layanan_by_id_order($id_order)
{
	$CI = &get_instance();
	$CI->db->where('ORL.id_order', $id_order);
	$CI->db->Join('layanan L', 'L.id_layanan = ORL.id_layanan','LEFT');
	$CI->db->group_by('ORL.id_order');
	return $CI->db->get('orders_rel_layanan ORL')->row();
}

	
	function get_room_type_featured_image_medium($id_tipe_kamar){
		$CI =& get_instance();
		$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
		$result	=	$CI->db->get('tipe_kamar_gambar')->row();	
		if(empty($result)){
		$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
		$result	=	$CI->db->get('tipe_kamar_gambar')->row();
		}
		
		if(empty($result)){
		return base_url('assets/img/kamar/noImageAvailable.jpg'); 
		}else{
		return base_url('assets/img/kamar/medium/'.$result->image);
		}								
	}
	
	 function GetDays($sStartDate, $sEndDate){  
	  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
	  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));    
	   $begin = new DateTime($sStartDate);
		$end = new DateTime($sEndDate);
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		$i=1;
		foreach ( $period as $dt ){
		$i++;
		}
	  return $i;
	}  
	
	function get_coupon_paid_services($id_voucher){
		$CI =& get_instance();
		$CI->db->where('id_voucher',$id_voucher);
		$voucher	=		$CI->db->get('voucher')->row();
		
		if(empty($voucher)){
		return false;
		}else{
		$id_layanan	=	json_decode($voucher->layanan_berbayar);
		if(empty($id_layanan)){
		return false;
		}else{
		
			$CI->db->where_in('id_layanan',$id_layanan);
		return $CI->db->get('layanan')->result();
		}
			
		}
	}	

	function get_pembayaran_by_order($id_order){
		$CI = &get_instance();
		$CI->db->where('id_order', $id_order);
		$pembayaran	=		$CI->db->get('pembayaran');
		return $pembayaran->row();
	}
	
	function get_invoice_number(){
		$CI =& get_instance();						
		$CI->db->select_max('invoice');
		$payment		=		$CI->db->get('pembayaran')->row();
		//echo '<pre>'; print_r($payment);die;
		if(empty($payment->invoice)){
		$CI->db->where('id_setting',1);
		$settings	=		$CI->db->get('settings')->row();
		$inv		=	$settings->invoice;
		}else{
		$inv		=	$payment->invoice+1;
		}
		return $inv;
	}
