<?php	
	function get_price($check_in,$check_out,$tipe_kamar,$adults,$jml_kamar){
			$CI =& get_instance();
			$prices	=	array();
			$CI->db->where('id_tipe_kamar',$tipe_kamar);
			$CI->db->select('tipe_kamar.*,tarif_dasar as price');
			$room_type	=	$CI->db->get('tipe_kamar')->row_array();
			if($check_in==$check_out){
			$check_out	=	date('Y-m-d', strtotime($check_out.'+ 1 day'));
			}
						$banyak = $room_type['higher_occupancy'];

						// if($jml_kamar > $room_type['higher_occupancy']){
						// $room_type['higher_occupancy'] = $room_type['higher_occupancy'] * $jml_kamar;

						// if ($adults	>	$room_type['higher_occupancy']) {
						// 		unset($_GET['tipe_kamar']);
						// 		unset($_GET['search']);
						// 		$CI->session->set_flashdata('error', "Maaf.. 1 Kamar hanya untuk " . $banyak . " Orang Dewasa");
						// 		redirect(current_url() . '?' . http_build_query($_GET));
						// 	}
						
						// } else if($adults > $jml_kamar){
						// 	$coba = ($jml_kamar * $room_type['higher_occupancy']) / $adults; 

						// 	if ($coba < 1 ) {
						// 			unset($_GET['tipe_kamar']);
						// 			unset($_GET['search']);
						// 			$CI->session->set_flashdata('error', "Maaf.. 1 Kamar hanya untuk " . $room_type['higher_occupancy'] . " Orang Dewasa");
						// 			redirect(current_url() . '?' . http_build_query($_GET));
						// 		}
						// }						
						// 	if($kids	>	$room_type['kids_occupancy']){
						// 		unset($_GET['tipe_kamar']);
						// 		unset($_GET['search']);
						// 		$CI->session->set_flashdata('error', "Tamu 1 Anak Lebih banyak dari ketentuan Tipe kamar ".$room_type['kids_occupancy'] ." Kamar");
						// 		redirect(current_url().'?'.http_build_query($_GET)); 
						// 	}


			$additional_person			=	0;
			$additional_person_price	=	0;
			$amount							=	0;
			$additional_price_amount	=	0;
			$price_manager					=	array();
			$begin 							= new DateTime($check_in);
			$end	 							= new DateTime($check_out);

			$interval 	= DateInterval::createFromDateString('1 day');
			$period 		= new DatePeriod($begin, $interval, $end);
			foreach ( $period as $dt ){
			$date		=	 $dt->format( "Y-m-d" );	
			$dayno	=	 $dt->format( "N" );
			$day		=	 $dt->format( "D" );
			$day		=	strtolower($day);
			//check for special date	
			$CI->db->where('date_from <=',$date);
			$CI->db->where('date_to >=',$date);
			$CI->db->where('id_tipe_kamar', $tipe_kamar);
			$CI->db->select(''.$day.' as price');
			$harga_spesial	=	$CI->db->get('harga_spesial')->row_array();

			if(!empty($harga_spesial)){
			$amount								+= $harga_spesial['price'] * $jml_kamar;
			$prices[$date]						= $harga_spesial;	
			$prices[$date]['type']			=	'Tarif Spesial';
			continue;

			}else{
			$CI->db->where('id_tipe_kamar',$tipe_kamar);
			$CI->db->select(''.$day.' as price');
			$price_manager	=	$CI->db->get('harga')->row_array();
			}

			if(!empty($price_manager)){
			$amount									+= $price_manager['price'] * $jml_kamar;
			$prices[$date]							=	$price_manager;
			$prices[$date]['type']				=	'Tarif Reguler';
			continue;

			}else{				
			$amount									+=  $room_type['price'] * $jml_kamar;
			$prices[$date]							=	$room_type;
			$prices[$date]['type']				=	'Tarif Dasar';
			continue;	
			}
			}
	// $booking_price = array('amount' => $amount, 'additional_person_amount' => $additional_price_amount * $additional_person, 'total_price' => $amount + $additional_price_amount * $additional_person, 'price_details' => $prices, 'additional_person' => $additional_person);
	// // echo '<pre>'; print_r($booking_price);die;
	// 	// $amount	=	$amount	+	$additional_price_amount*$additional_person
	return $booking_price = array('amount' => $amount, 'additional_person_amount' => $additional_price_amount * $additional_person, 'total_price' => $amount + $additional_price_amount * $additional_person, 'price_details' => $prices, 'additional_person' => $additional_person, 'jml_kamar' => $jml_kamar);
	}
	
	function ambil_harga_sekarang($id_tipe_kamar)
	{
			$CI = &get_instance();
			$day  = date('D');
			$date = date('Y-m-d');
			$CI->db->where('date_from <=', $date);
			$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
			$CI->db->select('' . $day . ' as price');
			$harga_spesial = $CI->db->get('harga_spesial')->row();

			if (!empty($harga_spesial)) {
			$prices = $harga_spesial;
			return $prices;
	
		} else {
			$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
			$CI->db->select('' . $day . ' as price');
			$price_manager = $CI->db->get('harga')->row();
		}
	
		if (!empty($price_manager)) {
			$prices = $price_manager;
		
		}else {
			$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
			$CI->db->select('tarif_dasar as price');
			$room_type = $CI->db->get('tipe_kamar')->row();
			$prices = $room_type;
		}

	return $prices;
	}

function ambil_harga_dari($id_tipe_kamar, $date_from, $dateto)
{
		$CI = &get_instance();
		$day  = date('D');
		$CI->db->where('date_from <=', $date_from);
		$CI->db->where('date_to >=', $dateto);
		$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
		$CI->db->select('' . $day . ' as price');
		$harga_spesial = $CI->db->get('harga_spesial')->row();

		if (!empty($harga_spesial)) {
		$prices = $harga_spesial;
		return $prices;

		} else {
		$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
		$CI->db->select('' . $day . ' as price');
		$price_manager = $CI->db->get('harga')->row();
		}

		if (!empty($price_manager)) {
		$prices = $price_manager;
	
		} else {
		$CI->db->where('id_tipe_kamar', $id_tipe_kamar);
		$CI->db->select('tarif_dasar as price');
		$room_type = $CI->db->get('tipe_kamar')->row();
		$prices = $room_type;
		}

		return $prices;
}
?>