<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
  public function __construct()
   {
      parent::__construct();
      $this->load->model('back/booking_model');
      belum_login_admin();
      cek_session_resepsionis();
   }

   // menampilkan data booking
   public function index()
   {
      $data['page_title'] = 'Data Reservasi';
      $data['booking_data']    = $this->booking_model->get_all();
      $data['tipe_kamar']      = $this->booking_model->view('tipe_kamar')->result();
      $this->template->load('back/template/template', 'back/reservasi/booking', $data);
   }

   // menampilkan data booking ajax
   function index_booking()
   {
      $data =   $this->booking_model->get_all();
      echo json_encode($data);
   }


   public function ajax_list()
   {
      $list = $this->booking_model->get_semua();
      // $list = $this->booking_model->view_where('orders', "status_kode = '200'")->result();
      // $list = $this->tamu_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $order) {
         if ($order->status_kode == 200) {
            $status_   =   '<a href="' . site_url('admin/booking/detail_riwayat/') . $order->id_order . '" class="btn btn-success shadow ">Berhasil</a>';
         } elseif($order->status_kode == 201) {
            $status_   =  '<a href="' . site_url('admin/booking/detail_riwayat/') . $order->id_order . '" class="btn btn-warning shadow ">Pending</a>';
         } elseif($order->status_kode == 202 || $order->status_kode == 0){
            $status_ =
            '<a href="' . site_url('admin/booking/detail_riwayat/') . $order->id_order . '" class="btn btn-danger shadow ">Gagal</a>';
         }
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = $order->no_order;
         $row[] = $order->judul;
         $row[] = tgl_indo($order->check_in);
         $row[] = tgl_indo($order->check_out);
         $row[] = $order->tgl_order;
         // $row[] = $order->status;
         $options = '<div class="text-center">'.$status_ .'</div>';
         $row[] =   $options;
         $data[] = $row;
      }
      $output = array(
         "draw" => $_POST['draw'],
         "recordsTotal" => $this->booking_model->count_all(),
         "recordsFiltered" => $this->booking_model->count_filtered(),
         "data" => $data,
      );
      echo json_encode($output);
   }



   // menampilkan data booking di riwayat
   public function data_riwayat()
   {
      $data['page_title'] = 'Riwayat Reservasi';
      $data['booking_data'] = $this->booking_model->get_semua();
      $data['berhasil']     = $this->booking_model->view_where('orders', "status_kode = '200'")->result();
      $data['gagal']        = $this->booking_model->get_gagal();
      $data['pending']      = $this->booking_model->get_pending();
      $this->template->load('back/template/template', 'back/reservasi/riwayat', $data);
   }


   // detail booking
   function booking($id){
         $data['page_title']   ='Data Reservasi';
         $data['totalpaid']    =$this->booking_model->get_order_total($id);
         $data['booking']      =$this->booking_model->get($id);
         $data['services']     =$this->booking_model->get_services($id);
         $data['prices']       =$this->booking_model->get_prices($id);
         $data['prices_kamar'] =$this->booking_model->get_prices_kamar($id);
         $data['payments']     =$this->booking_model->get_payment($id);
         $data['rooms']        = banyak_kamar($data['booking']->check_in, $data['booking']->check_out, $data['booking']->id_tipe_kamar);
         $data['order_room']   = $this->booking_model->get_room_of_order($data['booking']->id_order);
         $data['setting']      = get_setting();
         $this->template->load('back/template/template', 'back/reservasi/data_booking', $data);
   }
   
   
   // detail riwayat booking
   function booking_riwayat($id)
   {
      $data['page_title']   = 'Detail Riwayat';
      $data['totalpaid']    = $this->booking_model->get_order_total($id);
      $data['booking']      = $this->booking_model->get($id);
      $data['services']     = $this->booking_model->get_services($id);
      $data['prices']       = $this->booking_model->get_prices($id);
      $data['payments']     = $this->booking_model->get_payment($id);
      $data['rooms']        = banyak_kamar($data['booking']->check_in, $data['booking']->check_out, $data['booking']->id_tipe_kamar);
      $data['order_room']   = $this->booking_model->get_room_of_order($data['booking']->id_order);
      $data['setting']      = get_setting();
      $this->template->load('back/template/template', 'back/reservasi/detail_riwayat', $data);
   }
 
   // menetapkan kamar
   public function alotroom()
   {
      if ($this->input->server('REQUEST_METHOD') === 'POST') {
         $this->form_validation->set_rules('id_kamar', 'Id Kamar', 'required');
         $id_order                  =   $this->input->post('id_order');
         $kode_reservasi            =   $this->input->post('kode_reservasi');
         if ($this->form_validation->run() == true) {
            $save['id_kamar']            = $this->input->post('id_kamar');
            $save['status_reservasi']    = 2; //1 = pendding//2= check-in//3check-out
            $this->booking_model->update_rel_kamar($save, $kode_reservasi);
            $data_order = count($this->booking_model->view_where('orders_rel_harga', "id_order = '$id_order'")->result());
            $data_res   = count(get_orders_rel_harga_dua($id_order));
            $this->booking_model->new_order_viewed($id_order);
            if($data_order == $data_res){
               $this->mail_room($id_order);
            }
            $this->session->set_flashdata('message', 'swal("Berhasil", "Kamar berhasil ditetapkan", "success");');
            redirect('admin/booking/detail/' . $id_order);
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Terdapat kesalahan", "error");');
            redirect('admin/booking/detail/' . $id_order);
         }
      }
   }

   // check-out kamar
   public function checkout(){
      if ($this->input->server('REQUEST_METHOD') === 'POST') {
         $this->form_validation->set_rules('id_order', 'Id Order', 'required');
         $this->form_validation->set_rules('kode_reservasi', 'Kode Reservasi', 'required');
         $id_order       =   $this->input->post('id_order');
         $kode_reservasi =   $this->input->post('kode_reservasi');
         if ($this->form_validation->run() == true) {
            $save['status_reservasi'] = 3;
            $this->booking_model->update_rel_kamar($save, $kode_reservasi);
         
            $data_order = count($this->booking_model->view_where('orders_rel_harga', "id_order = '$id_order'")->result()) ;
            $data_res   = count(get_orders_rel_harga_tiga($id_order));
            if($data_order == $data_res){
               $this->mail_room_($id_order);
            }
            $this->session->set_flashdata('message', 'swal("Berhasil", "Check out kamar berhasil", "success");');
            redirect('admin/booking/detail/' . $id_order);
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Terdapat kesalahan", "error");');
            redirect('admin/booking/detail/' . $id_order);
         }
      }

   }

   // kirim email check-out
   function mail_room_($id_order)
   {
      $data['order']      = $order   =   $this->booking_model->get_order($id_order);
      $data['setting']    = $setting = get_setting();
      $data['kamar']      = get_tipe_kamar_by_id($order->id_tipe_kamar);
      $html = $this->load->view('back/template_email/room_mail_checkout', $data, true);
      $params['recipient'] = $order->email;
      $params['subject']   = $setting->nama;
      $params['message']   = $html;
      $this->_sendEmail($params);
      $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil melakukan check-out kamar", "success");');
      return true;
   }


   // kirim email check-in
   function mail_room($id_order)
   {
      $data['order']      = $order   =   $this->booking_model->get_order($id_order);
      $data['services']   = $this->booking_model->get_services($id_order);
      $data['prices']     = $this->booking_model->get_prices($id_order);
      $data['setting']    = $setting = get_setting();
      $data['kamar']      = get_tipe_kamar_by_id($order->id_tipe_kamar);
      $html = $this->load->view('back/template_email/room_mail', $data, true);
      $params['recipient'] = $order->email;
      $params['subject']   = $setting->nama;
      $params['message']   = $html;
      $this->_sendEmail($params);
      $this->session->set_flashdata('message', 'swal("Berhasil", "Kamar berhasil ditetapkan", "success");');
      return true;
   }

   // setting email
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

   
   // function tambah()
   // {
   //       $data['kamar_tersedia'] = $this->booking_model->get_kamar();
   //       $data['page_title']     = 'Booking Kamar';
   //       $data['tamu']           = $this->booking_model->view('tamu')->result();
   //       $this->template->load('back/template/template', 'back/reservasi/tambah_', $data);
   // }

   // function get_booking_data()
   // {
   //    $this->session->unset_userdata('coupon_data');   //unset old coupons data
   //    $data['pajak']         = $this->booking_model->get_taxes_for_booking();
   //    if (!empty($_POST['tipe_kamar'])) {
   //       $data['layanan']         = $this->booking_model->get_paid_services($_POST['tipe_kamar']);
   //    }
   //    $this->load->view('back/reservasi/data_bayar', $data);
   // }


}
