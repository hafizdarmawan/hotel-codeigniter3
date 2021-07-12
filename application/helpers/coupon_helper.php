
<?php
		function apply_coupon($code)
		{	
			$CI =& get_instance();			
			// melakukan unset data voucher
			$CI->session->unset_userdata('coupon_data');
			// inisialisasi userdata(id_tamu)
			$front_user	=	$CI->session->userdata('id_tamu');
			// inisialisasi userdata (boking data)
			$booking_data	=	$CI->session->userdata('booking_data');
			// deklaraisasi layanan
			$layanan_applied	=	0;
			$pdservices				= 	array();
				// query pencarian data coupon berdasarkan tanggal
			$CI->db->where('kode',$code);
			$CI->db->where('date_from <=',date('Y-m-d H:i:s'));
			$CI->db->where('date_to >=',date('Y-m-d H:i:s'));
			$result	=	$CI->db->get('voucher')->row();		
			// jika tidak ditemukan redirect ke booking/payment
			if(empty($result)){
			$CI->session->set_flashdata('error', 'swal("Gagal","Voucher tidak ditemukan", "error");');;
			redirect('booking/payment'); }	
			// jika tersedia 
			// inisialisasi include tamu
			$include_tamu	=	json_decode($result->include_tamu);
			// exclude tamu
			$exclude_tamu	=	json_decode($result->exclude_tamu);
			// inisialisasi tipe kamar 
			$include_tipe_kamar	=	json_decode($result->include_tipe_kamar);
			// exclude tipe kamar
			$exclude_tipe_kamar	=	json_decode($result->exclude_tipe_kamar);
			// inisialisasi layanan
			$layanan		=	json_decode($result->layanan);		
			//echo '<pre>--->1'; print_r($booking_data);
			//echo '<pre>--->2'; print_r($exclude_user);
			//echo '<pre>--->3'; print_r($result);die;
			// jika data tidak kosong next =1
			// jika data = 0 redirect (muncul pesan error)
			if(!empty($result)){	//Date Validate
					$next	=	1;
				}else{
					$next	=	0;
					$CI->session->set_flashdata('error', 'swal("Gagal","Voucher Kadaluarsa/ Expired", "error");');
			// echo 'error2';die;
				redirect('booking/payment');
				}
			// jika next 1

			if($next==1){
			// jika totalmount < min total  = tidak memenuhi sarat 
				if($booking_data['totalamount']	<	$result->min_total){
					$CI->session->set_flashdata('error', "Kode Kupon Tidak Ini Memenuhi Syarat Untuk Jumlah Minimum".rate_exchange($result->min_total));
					redirect('booking/payment');
				}
			}

			if($next==1){ //check include user/exclude user
			// jika include_tamu dan exclude tamu == 0 next=1
				if(empty($include_tamu) && empty($exclude_tamu)){
					$next = 1;
				}else{
			// jika include tamu != 0
					if(!empty($include_tamu)){
					// jika sesion login == include tamu next=1
						if(in_array($front_user,$include_tamu)){	// check include user if yes then eligible
							$next	=	1;
						}
					}
				// jika exclude != 0
					if(!empty($exclude_tamu)){
					// jika exclude tamu == session login
						if(in_array($front_user,$exclude_tamu)){
					// next = 0 error
							$next	=	0;
							$CI->session->set_flashdata('error', "Anda tidak mendapatkan voucher ini.");
					// echo 'error3';
					// die;
						redirect('booking/payment');
						}
					}	
				}
			}


				if($next==1){	
				// check include /exclude room type
					if(empty($include_tipe_kamar) && empty($exclude_tipe_kamar)){
						$next = 1;
					}else{
						if(!empty($include_tipe_kamar)){
							if(in_array($booking_data['id_tipe_kamar'],$include_tipe_kamar)){	// periksa termasuk jenis kamar jika ya maka memenuhi syarat
								$next	=	1;
							}
						}
						
						if(!empty($exclude_tipe_kamar)){
							if(in_array($booking_data['id_tipe_kamar'],$exclude_tipe_kamar)){	// periksa termasuk jenis kamar jika ya maka memenuhi syarat
								$next	=	0;
								$CI->session->set_flashdata('error', "Voucher tidak tersedia untuk jenis tipe kamar ini.");
								// echo 'error4'; die;
								redirect('booking/payment');
							}
						}
					}
				}

				if($next==1){	//limit per user
				// query order berdasarkan id tamu dan voucher
					$CI->db->where('voucher',$code);
					$CI->db->where('id_tamu', $front_user);
					$orders = $CI->db->get('orders')->result();		
					// jika order order lebih banyak dari limit tamu
						if(count($orders) > $result->limit_per_tamu){
							$next	=	0;
							$CI->session->set_flashdata('error', "Voucher Ini Habis.");
								// echo 'error5'; die;
							redirect('booking/payment');
						}else{
							$next	=	1;
						}		
					}

					if($next==1){	//limit per coupon
						$CI->db->where('voucher',$code);
						$orders		=	$CI->db->get('orders')->result();	
					// jika orders lebih banyak dari limit voucher
						if(count($orders) > $result->limit_per_voucher){
							$next	=	0;
							$CI->session->set_flashdata('error', "Voucher Ini Habis.");
							// echo 'error6';die;

							redirect('booking/payment');
						}else{
							$next	=	1;
						}		
					}
					
					// layanan
				if($next==1){	//Paid Services	
					if(!empty($layanan)){
				// jika booking_data['layanan tidak kodsong']
					if(!empty($booking_data['layanan'])){
						$next	=	1;
						$layanan_applied	=	1;
				// perulanagan dari booking_data->layanan
						foreach($booking_data['layanan'] as $new){
							if(in_array($new,$layanan)){
								$pdservices[]	= $new;
								}		
						}
					}
				}
			}
			
			if($next==1){	//coupon value less in main amount  
				$servicesless	=	0;
				if($layanan_applied==1){	//paid service will be free
					$pdservices;
					if(!empty($pdservices)){
						$CI->db->where_in('id_layanan',$pdservices);
						$CI->db->select('layanan.*,GROUP_CONCAT(judul) as titles');
						$CI->db->select('SUM(biaya) as total');
						$services	=	$CI->db->get('layanan')->row();	
						//echo '<pre>'; print_r($services);die;							
						$servicesless 	+=	$services->total;
					}
				}
				
				$less	=	0;
				// if jika result tipe= persen 
				if($result->tipe=='Persen'){
					$less	+=	$result->nilai/100*$booking_data['totalamount'];
				}
				// jika result tipe = tetap
				if($result->tipe=='Tetap'){
					$less	+=	$result->nilai;
				}
					$amount	=	$booking_data['totalamount']	-	$less;	// less coupon
					$amount	=	$amount-$servicesless;		// less free services price
				if($amount	< 0){
					$amount	=	0;
				}
				
				$coupon_data =	array(
					'active'						   => 1,
					'kode'						 	=>	$code,
					'totalamount'					=>	$amount,
					'discount'						=>	$less,
					'paid_service_applied'		=>	$pdservices,
					'services'						=>	@$services->titles,
					'services_total'				=>	@$services->total,
				);
				
				// set userdata
				$CI->session->set_userdata('coupon_data',$coupon_data);				
				$CI->session->set_flashdata('message', "Voucher Diterapkan.");
				// echo '<pre>';
				// print_r ($coupon_data);
				// die;
				redirect('booking/payment');
			}					
			return;
		}			
?>