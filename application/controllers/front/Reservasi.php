<?php
class Reservasi extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model('front/reservation_model');
      $this->load->model('front/login_model');
      $this->setting = get_setting();
      
   }


   function index()
   {
      $this->session->unset_userdata('booking_data');
      $this->session->unset_userdata('coupon_data');
      $data['page_title']      = 'Kamar';
      $data['setting']         = get_setting();
      $data['tipe_kamar']         = $this->reservation_model->view('tipe_kamar')->result();
      if (!empty($_GET['tipe_kamar'])) {
         $data['services']         = $this->reservation_model->get_paid_services($_GET['tipe_kamar']);
      }
      if (empty($_GET['tipe_kamar'])) {
         $data['date_from'] = $_GET['date_from'];
         $data['date_to']   = $_GET['date_to'];
         $this->template->load('front/template/template', 'front/reservasi/tipe_kamar', $data);
      } else {
         // print_r($_GET['jml_kamar']);
         // die;
         check_availability($_GET['date_from'], $_GET['date_to'], $_GET['adults'],$_GET['tipe_kamar'],$_GET['jml_kamar']);
         $id_tipe_kamar = $_GET['tipe_kamar'];
         $data['tipe_kamar']     = $this->reservation_model->view_where('tipe_kamar',"id_tipe_kamar = '$id_tipe_kamar'")->row();
         $data['page_title']     = 'Booking Kamar';
         $data['setting']        = get_setting();
         $tamu                   = $this->session->userdata('id_tamu');
         $data['tamu']           =$this->reservation_model->view_where('tamu', "id_tamu = '$tamu'")->row(); 
         $this->load->view('front/reservasi/view',$data);
         // $this->template->load('front/template/template', 'front/reservasi/view', $data);
      }
   }



   function step()
   {
      $_tipe_kamar     =    $this->input->post('tipe_kamar');
      $_date_from      =    $this->input->post('date_from');
      $_date_to        =    $this->input->post('date_to');
      $_adults         =    $this->input->post('adults');
      $_kids           =    $this->input->post('kids');
      $_jml_kamar      =    $this->input->post('jml_kamar');
      if($_tipe_kamar !== '' && $_date_from !== '' && $_date_to !== '') {
         $tipe_kamar      =    $this->reservation_model->view_where('tipe_kamar', "id_tipe_kamar = '$_tipe_kamar'")->row();
         $layanan   =   $this->input->post('layanan');
         $tipe_kamar      =    $this->reservation_model->view_where('tipe_kamar', "id_tipe_kamar = '$_tipe_kamar'")->row();
         $nights   =   GetDays($_date_from, $_date_to) - 1;
         if ($nights == 0) {
            $nights = 1;
         }
         $base_price   =  get_price($_date_from, $_date_to, $_tipe_kamar, $_adults, $_jml_kamar);
         $amount      =   $base_price['total_price'];
         $total      =   $amount;
         if (!empty($layanan)) {
            $booking_data['paid_service_amount']      =   get_paid_service_amount_all($layanan, $_adults, $nights);
            $total   =   $total + $booking_data['paid_service_amount'];
         }
         $booking_data['order_no']      = 'OR'.time() . $this->session->userdata('id_tamu');
         $booking_data['check_in']      = $_date_from;
         $booking_data['check_out']     = $_date_to;
         $booking_data['id_tamu']       = $this->session->userdata('id_tamu');
         $booking_data['adults']        = $_adults;
         // $booking_data['kids']          = $_kids;
         $booking_data['id_tipe_kamar'] = $_tipe_kamar;
         $booking_data['jml_kamar']     = $_jml_kamar;
         $booking_data['ordered_on']    = date('Y-m-d H:i:s');
         $booking_data['tarif_dasar']   = $tipe_kamar->tarif_dasar;
         $booking_data['additional_person_amount']   =   $base_price['additional_person_amount'];
         $booking_data['additional_person']          =   $base_price['additional_person'];
         $booking_data['amount']        = round($amount, 2);
         $booking_data['totalamount']   = round($total, 2);
         $booking_data['nights']        = $nights;
         $booking_data['currency_unit'] = get_currency_unit();
         $booking_data['layanan']       = $layanan;
         $booking_data['tipe_kamar']    = $tipe_kamar->judul;;
         $booking_data['base_price_details'] = $base_price;     
         // echo '<pre>';
         // print_r($booking_data);
         // die;
         $this->session->set_userdata('booking_data', $booking_data);
         redirect(base_url('booking/payment'));
      } else {
         $this->session->unset_userdata('booking_data');
         $this->session->set_flashdata('message', 'swal("Gagal", "Terjadi Kesalahan, Silahkan Coba Lagi", "error");');
         redirect('');
      }
   }


   function payment()
   {
      if ($this->input->server('REQUEST_METHOD') === 'POST') {
         $voucher_apply   =   $this->input->post('voucher_apply');
         $voucher   =   strtolower($this->input->post('voucher'));   
         if ($voucher_apply !== '') {
            if ($voucher !== '') {
               apply_coupon($voucher);
            }
         }

         $pay   =   strtolower($this->input->post('pay'));
         if (!empty($pay)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('payment_gateway', 'payment_method', 'required');
            if ($this->form_validation->run() == true) {
               $coupon_data   =   $this->session->userdata('coupon_data');
               $booking_data   =   $this->session->userdata('booking_data');
               $discount                =   0;
               $freeservice_amount      =   0;
               $count = $booking_data['jml_kamar'];
                  if (!empty($coupon_data['discount'])) {
                     $discount   =   $coupon_data['discount'];
                  }
                  if (!empty($coupon_data['services_total'])) {
                     $freeservice_amount           =   $coupon_data['services_total'];
                  }
                  $save['no_order']                =   $booking_data['order_no'];
                  $save['check_in']                =   $booking_data['check_in'];
                  $save['check_out']               =   $booking_data['check_out'];
                  $save['id_tamu']                 =   $booking_data['id_tamu'];
                  $save['dewasa']                  =   $booking_data['adults'];
                  // $save['anak']                    =   $booking_data['kids'];
                  $save['id_tipe_kamar']           =   $booking_data['id_tipe_kamar'];
                  $save['tgl_order']               =   date('Y-m-d H:i:s');
                  $save['jml_kamar']               =   $booking_data['jml_kamar'];
                  $save['tarif_dasar']             =   $booking_data['tarif_dasar'];
                  $save['total']                   =   $booking_data['amount'];
                  $save['jumlah_layanan']          =   @$booking_data['paid_service_amount'];
                  $save['malam']                   =   $booking_data['nights'];
                  $layanan                         =   @$booking_data['layanan'];
                  if (!empty($coupon_data)) {
                     $save['voucher']              =   @$coupon_data['kode'];
                     $save['total_jumlah']         =   $booking_data['totalamount']   -   $discount   -   $freeservice_amount;
                     $save['voucher_diskon']       =   @$coupon_data['discount'];
                     $save['total_sudah_voucher']  =   @$coupon_data['totalamount'];
                  } else {
                     $save['total_jumlah']   =   $booking_data['totalamount'];
                  }
                  $p_key   =   $this->reservation_model->save_order($save);  
                  $save['tipe_kamar']        =   @$booking_data['tipe_kamar'];
                  $save['id_order']          =   $p_key;
                  $save['payment_gateway']   =   $_POST['payment_gateway'];
                  $save['details']     =   $booking_data['base_price_details']['price_details'];
                  for ($i = 0; $i < $booking_data['jml_kamar'] ; $i++) {
                     $s=0;
                  foreach ($save['details'] as $ind   => $val) {
                     $data = json_decode(json_encode($ind), true);
                     $save_price[$s]['id_order']         = $p_key;
                     $save_price[$s]['kode_reservasi']   = 'R' . time() . $this->session->userdata('id_tamu') . 'S' . $i;
                     $save_price[$s]['tanggal']          = $data;
                     $save_price[$s]['harga']            = $val['price'];
                     // $save_price[$s]['status_reservasi'] = 2;
                     $this->reservation_model->save_price($save_price);
                  }
               }

                  $this->session->unset_userdata('booking_data');
                  $this->session->unset_userdata('coupon_data');
                  $this->session->set_userdata('booking_data', $save); //set session
                  if (!empty($layanan)) {
                     $i = 0;
                     foreach ($layanan as $new) {
                        $save_service[$i]['id_order']      = $p_key;;
                        $save_service[$i]['id_layanan']    = $new;
                        $save_service[$i]['total']        = get_paid_service_amount($new, $save['dewasa'], $save['malam']);
                        $i++;
                     }
                     $this->reservation_model->save_service($save_service);
                  }
               }
               redirect('booking/pay');
               // $data['setting']     = $setting = get_setting();
               // $this->template->load('front/template/template', 'front/reservasi/midtrans',$booking_data);
            }         
      }
      $data['page_title']   = 'Pembayaran';
      $data['booking']      =   $this->session->userdata('booking_data');
      $data['coupon_data']  =   $this->session->userdata('coupon_data');
      $data['setting']      = get_setting();
      $this->load->view('front/reservasi/payment', $data);
   }



   function pay()
   {
      $data['setting']     = $setting = get_setting();
      $booking_data   =   $this->session->userdata('booking_data');
      $data['booking_data'] = $booking_data = $this->session->userdata('booking_data');
      if ($booking_data['payment_gateway'] == 1) {
         $id_order         = $booking_data['id_order'];
         $data['order']    =   $order  =  $this->reservation_model->get_order($id_order);
         $data['services'] =   $this->reservation_model->get_services($id_order);
         $data['prices']   =   $this->reservation_model->get_prices($id_order);
         $html = $this->load->view('front/template_mail/booking', $data, true);
         $params['recipient'] = $order->email;
         $params['subject']   = $setting->nama;
         $params['message']   = $html;
         $this->_sendEmail($params);
         $this->load->view('front/reservasi/midtrans', $data);
      }
   
   }


   private function _sendEmail($params)
   {
      $data['setting']     = $setting = get_setting();
      $result = $this->db->where('id_setting', '1')->get('settings');
      $settings = $result->row();
      $config = [
         'mailtype'    => 'html',
         'charset'     => 'utf-8',
         'protocol'    => 'smtp',
         'smtp_host'   => $settings->smtp_host,
         'smtp_user'   => $settings->smtp_user,
         'smtp_pass'   => $settings->smtp_pass,
         'smtp_port'   => $settings->smtp_port,
         'smtp_crypto' => 'ssl',
         'crlf'        => "\r\n",
         'newline'     => "\r\n"
      ];
      $this->load->library('email', $config);
      $this->email->from($settings->smtp_mail, $settings->name);
      $this->email->to($params['recipient']); // Ganti dengan email tujuan anda
      if ($params['attached_file']) {
         $this->email->attach($params['attached_file']);
      }
      $this->email->subject($params['subject']);
      $this->email->message($params['message']);
      $this->email->send();
   }

   function pdf($id_order)
   {
      // $this->load->helper('dompdf_helper');
      // $this->load->helper('download');
      $data['order']   =   $this->reservation_model->get_order($id_order);
      $data['services']   =   $this->reservation_model->get_services($id_order);
      $data['prices']   =   $this->reservation_model->get_prices($id_order);
      $this->load->view('front/reservasi/pdf', $data);
      // pdf_create($html, 'Order_' . $data['order']->no_order);  
   }


   function login_()
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email','trim|required|max_length[32]', array(
         'required' => 'Email Wajib Di isi.',
         'max_length' => 'Maksimal 32 Karakter'
      ));
      $this->form_validation->set_rules('password', 'Password','required|min_length[6]', array(
         'required' => 'Password Wajib Di isi.',
         'min_length' => 'Password Minimal 6 Karakter'
      ));

      if ($this->form_validation->run() == TRUE) {
         $email      =   $this->input->post('email');
         $password   =   $this->input->post('password');
         $return    =   $this->login_model->auth($email, $password, '', '');
         if ($return) {
            echo 1;
            die;
         } else {
            echo 'Email dan Password anda salah';
         }
      } else {
         echo validation_errors();
      }
   }

   // function info()
   // {
   //    $data['setting']     = $setting = get_setting();
   //    $this->load->view('front/reservasi/finish', $data);
   // }


   function add_service_price()
   {
      // echo '<pre>'; print_r($_POST);die;
      $id      =   $_POST['id'];
      $nights   =  $_POST['nights'];
      $adults   =  $_POST['adults'];
      $total   =   $_POST['total'];
      $service_amount   =   get_paid_service_amount($id, $adults, $nights);
      $service_amount   =   rate_exchange($service_amount);
      echo rupiah($total + $service_amount);
   }

   function less_service_price()
   {
      $id      =   $_POST['id'];
      $nights  =   $_POST['nights'];
      $adults  =   $_POST['adults'];
      $total   =   $_POST['total'];
      $service_amount   =   get_paid_service_amount($id, $adults, $nights);
      $service_amount   =   rate_exchange($service_amount);
      echo rupiah ($total - $service_amount);
      exit;
   }


   function ketersediaan(){
      $date_from = $_POST['date_from'];
      $date_to   = $_POST['date_to'];
      $id_tipe_kamar = $_POST['id_tipe_kamar'];

		$this->db->where('O.id_tipe_kamar', $id_tipe_kamar);
		// $this->db->where('O.status_kode', 200);
		// $this->db->where('O.status_booking', 1);
		$this->db->where('R.status_reservasi !=',0);//1 pending
		$this->db->where('R.status_reservasi !=',3 ); //2 Check In 
		// $this->db->where('O.status_kode', 201);
		$this->db->where('R.tanggal >=', $date_from);
		$this->db->where('R.tanggal <=', $date_to);
		$this->db->select('R.*,');
		$this->db->join('orders O', 'O.id_order = R.id_order', 'LEFT');
		$orders =	$this->db->get('orders_rel_harga R')->result();
		$jml_order = count($orders);
		// mencari kamar jumlah kamar
		$this->db->where('id_tipe_kamar', $id_tipe_kamar);
		// $this->db->where('status_kondisi', 'tersedia');
		// $this->db->where('status_jual', 'online');
		$this->db->select('kamar.*,count(no_kamar) as total_rooms');
		$rooms	  	=	$this->db->get('kamar')->row_array();
      $total_rooms	=	$rooms['total_rooms'];
		$jml_tersedia  = 0;
		if ($jml_order > $total_rooms) {
		$jml_tersedia = 0;
		} elseif ($jml_order < $total_rooms) {
		$jml_tersedia = $total_rooms - $jml_order;
      }
      echo $jml_tersedia;
      // echo json_encode($jml_tersedia);
		// return $jml_tersedia;
		// return print_r($jml_tersedia);
}
}
