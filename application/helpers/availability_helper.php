<?php	
	function check_availability($check_in,$check_out,$adults,$id_tipe_kamar,$jml_kamar){
		$query		=	'?date_from='.$check_in.'&date_to='.$check_out.'&adults='.$adults. '&jml_kamar=' . $jml_kamar . '&tipe_kamar=';	
		$CI =& get_instance();
					if($check_in==$check_out){
						$check_out	=	date('Y-m-d', strtotime($check_out.'+ 1 day'));
					}
						$CI->db->where('id_setting',1);
						$settings	=	$CI->db->get('settings')->row_array();
							
						$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
						$CI->db->select('tipe_kamar.*,tarif_dasar as price');
						$room_type	=	$CI->db->get('tipe_kamar')->row_array();
						//echo '<pre>'; print_r($room_type);die;


						$CI->db->where('id_tipe_kamar',$id_tipe_kamar);
						$CI->db->where('status', 1);
						$CI->db->select('kamar.*,count(no_kamar) as total_rooms');
						$rooms	  	=	$CI->db->get('kamar')->row_array();
						$total_rooms	=	$rooms['total_rooms'];
						// echo '<pre>'; print_r($total_rooms);die;
						if ($jml_kamar < 1) {
								$CI->session->unset_userdata('booking_data');
								$CI->session->unset_userdata('coupon_data');
								$CI->session->set_flashdata('error', "Maaf.. Silahkan inputkan jumlah kamar yang akan dipesan");
								redirect(site_url('search/rooms' . $query));
						}
						$begin = new DateTime($check_in);
						$end = new DateTime($check_out);
						$interval = DateInterval::createFromDateString('1 day');
						$period = new DatePeriod($begin, $interval, $end);
						foreach($period as $dt){
							$date		=	 $dt->format( "Y-m-d" );	
							$dayno		=	 $dt->format( "N" );
							$day		=	 $dt->format( "D" );
							$day		=	strtolower($day);
							$CI->db->where('O.id_tipe_kamar',$id_tipe_kamar);
							$CI->db->where('R.status_reservasi !=', 0); //1 Pending
							$CI->db->where('R.status_reservasi !=', 3); //2 Check-In
							$CI->db->where('O.status_kode !=', 202);
							$CI->db->where('O.status_kode !=', 0);
							// $CI->db->where('R.tanggal <=', $check_out);
							$CI->db->where('R.tanggal', $date);
							$CI->db->select('R.*,');
							$CI->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
							$orders	  	=	$CI->db->get('orders_rel_harga R')->result_array();
							// echo '<pre>';
							// print_r($orders);
							// die;
							if (count($orders) > $total_rooms) {
								$CI->session->unset_userdata('booking_data');
								$CI->session->unset_userdata('coupon_data');
								$CI->session->set_flashdata('error', "Maaf.. Kamar Penuh, silakan coba dengan tanggal atau kamar lain");
								redirect(site_url('search/rooms' . $query));
								}
							$jumlah_tersedia = $total_rooms - count($orders);
							// echo '<pre>'; print_r($jumlah_tersedia);
							// // echo $total_rooms;
							// die; 
							if($total_rooms > 0){
								//echo count($orders);die;
								if($jml_kamar > $jumlah_tersedia){
									$CI->session->unset_userdata('booking_data');
									$CI->session->unset_userdata('coupon_data');
									$CI->session->set_flashdata('error', "Maaf.. pemesanan melebihi ketersediaan kamar, silakan coba dengan tanggal atau kamar lain");
									redirect(site_url('search/rooms' . $query));
								}else{
								// echo 'error';
								// die;
									continue;	// continue loop
								}
							}else{
									$CI->session->unset_userdata('booking_data');
									$CI->session->unset_userdata('coupon_data');
									$CI->session->set_flashdata('error', "Maaf.. kamar ini tidak tersedia, silakan coba dengan tanggal atau kamar lain");
									redirect(site_url('search/rooms'.$query));
							}
						}
							if ($jml_kamar > $total_rooms) {
								$CI->session->unset_userdata('booking_data');
								$CI->session->unset_userdata('coupon_data');
								$CI->session->set_flashdata('error', "Maaf.. Jumlah Pemesanan Kamar melebihi kapasistas Kamar, silakan coba kamar lain");
								redirect('search/rooms' . $query);
							} 
						
		return;
	}
	
	function check_availability_ajax($check_in,$check_out, $jml_kamar,$tipe_kamar){
					$query		=	'?date_from='.$check_in.'&date_to='.$check_out. '&jml_kamar='. $jml_kamar.'&tipe_kamar='.$tipe_kamar;	
					// print_r($query);
					// die;
					$CI =& get_instance();
					if($check_in==$check_out){
						$check_out	=	date('Y-m-d', strtotime($check_out.'+ 1 day'));
					}
											$CI->db->where('id_setting',1);
						$settings	=	$CI->db->get('settings')->row_array();
						
											$CI->db->where('id_tipe_kamar',$tipe_kamar);
											$CI->db->select('tipe_kamar.*,tarif_dasar as price');
						$room_type	=	$CI->db->get('tipe_kamar')->row_array();
						//echo '<pre>'; print_r($room_type);die;
						
											$CI->db->where('id_tipe_kamar',$tipe_kamar);
											$CI->db->where('status', 1);
											$CI->db->select('kamar.*,count(no_kamar) as total_rooms');
						$rooms	  	=	$CI->db->get('kamar')->row_array();
						$total_rooms	=	$rooms['total_rooms'];
						// echo '<pre>'; print_r($rooms);die;
						$begin = new DateTime($check_in);
						$end = new DateTime($check_out);						
						$interval = DateInterval::createFromDateString('1 day');
						$period = new DatePeriod($begin, $interval, $end);
						foreach($period as $dt){
							$date		 =	 $dt->format( "Y-m-d" );	
							$dayno	 =	 $dt->format( "N" );
							$day		 =	 $dt->format( "D" );
							$day		 =	strtolower($day);
											// $CI->db->where('O.id_tipe_kamar',$tipe_kamar);
											$CI->db->where('O.id_tipe_kamar', $tipe_kamar);
											$CI->db->where('R.status_reservasi !=', 0); //1 Pending
											$CI->db->where('R.status_reservasi !=', 3); //2 Check-In
											$CI->db->where('O.status_kode !=', 202);
											$CI->db->where('O.status_kode !=', 0);
											$CI->db->where('R.tanggal', $date);
											// $CI->db->where('R.tanggal <=', $check_out);
											$CI->db->select('R.*,');
											$CI->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
						$orders	  	=	$CI->db->get('orders_rel_harga R')->result_array();
						// print_r($orders);
						// die;
						$data_order = count($orders);
							//echo $total_rooms;die; 
							if($total_rooms > 0){
								if($data_order >= $total_rooms){
									$CI->session->unset_userdata('booking_data');
									$CI->session->unset_userdata('coupon_data');
									return 'Maaf.. kamar ini tidak tersedia, silakan coba dengan tanggal atau kamar lain';
								}else{
									continue;	// continue loop
								}
							}else{
									$CI->session->unset_userdata('booking_data');
									$CI->session->unset_userdata('coupon_data');
									return 'Maaf.. kamar ini tidak tersedia, silakan coba dengan tanggal atau kamar lain !';
							}
						}
						
		return 1;
	}

function banyak_kamar($check_in, $check_out, $id_tipe_kamar)
{
	//echo $check_in;echo $check_out;
	$CI = &get_instance();
	if ($check_in == $check_out) {
		$check_out	=	date('Y-m-d', strtotime($check_out . '+ 1 day'));
	}
	//$CI->CI->db->where("(status=1 OR status=3)", NULL, FALSE);
	$CI->db->where_in('R.status_reservasi', array(1, 2));	//for check 1 = pending 2 = check-in //check-out
	$CI->db->where('O.id_tipe_kamar', $id_tipe_kamar);
	$CI->db->where('R.tanggal >=', $check_in);
	$CI->db->where('R.tanggal <', $check_out);
	$CI->db->select('R.*');
	$CI->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
	$orders	  		=	$CI->db->get('orders_rel_harga R')->result_array();
	// echo '<pre>'; print_r($orders);die;
	$rids	=	array();
	foreach ($orders as $od) {
		//echo $od['room_id'];
		if ($od['id_kamar'] >  0) {
			$rids[]	=	$od['id_kamar'];
		}
	}
	// echo '<pre>'; print_r($rids);die;
	if (!empty($rids)) {
		$CI->db->where_not_in('R.id_kamar', $rids);
	}
	$CI->db->where('R.id_tipe_kamar', $id_tipe_kamar);
	$CI->db->where('R.status', 1);
	$CI->db->select('R.*,F.nama floor');
	$CI->db->join('lantai F', 'F.id_lantai = R.id_lantai', 'LEFT');
	$rooms	=		$CI->db->get('kamar R')->result();
	// echo '<pre>'; print_r($rooms);die;
	return $rooms;
}					
?>