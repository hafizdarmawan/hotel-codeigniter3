<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_front extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('front/login_model');
      $this->setting   =   get_setting();
   }

   function login()
   {
      sudah_login_tamu();
      $data['setting']            = get_setting();
      $data['page_title']         = 'Login';
      $this->template->load('front/template/template', 'front/auth/login',$data);
   }
   function login_aksi(){
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      // jika form_vaidation salah tampilkan pesan
      if ($this->form_validation->run() === FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Login gagal", "error");');
         redirect(base_url('login'));
      } else {
         // jika form_vallid benar jalankan ini
         $email = $this->db->escape_str($this->input->post('email'));
         $password = $this->db->escape_str(sha1(md5($this->input->post('password'))));
         // pengecekan username password
         $cek = $this->login_model->cek_login($email, $password);
         // jika tidak ditemukan jalankan ini
         if ($cek == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Akun Tidak ditemukan", "error");');
            redirect(base_url('login'));
         } else {
            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
            $userIp = $this->input->ip_address();
            $secret = '6LepilcaAAAAAENAjwoM9IGeT6FKWMqdPTqmYwbF'; // ini adalah Secret key yang didapat dari google, silahkan disesuaikan
            $credential = array(
               'secret' => $secret,
               'response' => $this->input->post('g-recaptcha-response')
            );
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            $status = json_decode($response, true);
            if ($status['success']) {
                     $this->session->set_userdata('id_tamu', $cek->id_tamu);
                     $this->session->set_userdata('nama_depan', $cek->nama_depan);
                     $this->session->set_userdata('nama_belakang', $cek->nama_belakang);
                     $this->session->set_flashdata('message', 'swal("Berhasil", "Login Berhasil", "success");');
                     redirect(base_url(''));
            } else {
               $this->session->set_flashdata('message', 'swal("Gagal", "Maaf Google Recaptcha gagal", "error");');
               redirect(base_url('login'));
            }
         }
      }
   }

   function logout()
   {
      $this->session->sess_destroy();
      $this->session->set_flashdata('message', 'swal("Berhasil", "Logout Berhasil", "success");');
      redirect(base_url(''));
   }

   function register()
   {
      sudah_login_tamu();
      $data['page_title']         = 'Pendaftaran';
      $data['setting']            = get_setting();
      $this->template->load('front/template/template', 'front/auth/register',$data);
   }

   function register_aksi(){
      $this->_validation_register();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Cek Data Registrasi", "info");');
         $this->register();
      } else {
         $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
         $userIp = $this->input->ip_address();
         $secret = '6LepilcaAAAAAENAjwoM9IGeT6FKWMqdPTqmYwbF'; // ini adalah Secret key yang didapat dari google, silahkan disesuaikan
         $credential = array(
            'secret' => $secret,
            'response' => $this->input->post('g-recaptcha-response')
         );
         $verify = curl_init();
         curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
         curl_setopt($verify, CURLOPT_POST, true);
         curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
         curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($verify);
         $status = json_decode($response, true);
         if ($status['success']) {
            $token = time() . sha1(uniqid(mt_rand(), true));
            $email = $this->db->escape_str($this->input->post('email'));
            $nama_depan = $this->db->escape_str($this->input->post('nama_depan'));
            $nama_belakang = $this->db->escape_str($this->input->post('nama_belakang'));
            $no_telepon = $this->db->escape_str($this->input->post('no_telepon'));
            $data = array(
               'nama_depan'                     => $nama_depan,
               'nama_belakang'                  => $nama_belakang,
               'email'                          => $email,
               'no_telepon'                     => $no_telepon,
               'password'                       => sha1(md5($this->db->escape_str($this->input->post('password')))),
               'token'                          => $token,
               'dibuat'                         => date('Y-m-d H:i:s'),
               'create_token'                   => time()
            );
            $this->login_model->insert('tamu', $data);
            $result = $this->db->where('id_setting', '1')->get('settings');
            $email_data['setting'] = $settings = $result->row();
            //echo '<pre>'; print_r($settings->nama);die;
            $email_data['link'] =  $link = site_url('register/activation/' . $email . '/' . $token);
            $email_data['nama_depan'] = $nama_depan;
            $email_data['nama_belakang'] = $nama_belakang;
            $html = $this->load->view('front/template_mail/register', $email_data, true);
            $params['recipient'] = $email;
            $params['subject']   = $settings->nama;
            $params['message']   = $html;
            $this->_sendEmail($params);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Melakukan Pendaftaran, Silahkan aktifasi email", "success");');
            redirect(base_url('login'));
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Maaf Google Recaptcha gagal", "error");');
            $this->register();
         }
      }
   }


   function _validation_register(){
      $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required', array(
         'required' => 'Nama Depan Wajib Di isi.',
      ));
      $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|required', array(
         'required' => 'Nama Belakang Wajib Di isi.',
      ));
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tamu.email]', array(
         'required' => 'Email Wajib Di isi.',
         'valid_email' => 'Email tidak Valid.',
         'is_unique' => 'Email sudah digunakan'
      ));
      $this->form_validation->set_rules('no_telepon', 'no_telepon', 'trim|required|is_unique[tamu.no_telepon]', array(
         'required' => 'No Telepon Wajib Di isi.',
         'is_unique' => 'No Telepon sudah digunakan'
      ));
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[konfirmasi_pass]', array(
         'required' => 'Password Wajib Di isi.',
         'matches' => 'Password Tidak Sama.',
         'min_length' => 'Minimal 6 Karakter'
      ));
      $this->form_validation->set_rules('konfirmasi_pass', 'Konfirmasi Pass', 'trim|required|matches[password]', array(
         'required' => 'Password Wajib Di isi.',
         'matches' => 'Password Tidak Sama.',
         'min_length' => 'Minimal 6 Karakter'
      ));
   }

   function register_activation(){
      $email = $this->uri->segment(3);
      $token = $this->uri->segment(4);
      $tamu = $this->login_model->view_where_where('tamu',"email = '$email'","token = '$token'")->row();
      if(!empty($tamu)){
         if(time() - $tamu->create_token < (60*60*24)){
            $this->db->set('status','1');
            $this->db->where('email',$email);
            $this->db->update('tamu');
            $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Melakukan Aktivasi akun", "success");');
            redirect(base_url('login'));
         }else{
            $this->db->delete('tamu', ['email' => $email]);
            $this->session->set_flashdata('message', 'swal("Gagal", "Aktivasi akun Gagal! Token expired", "error");');
            redirect(base_url('login'));
         }
      }else{
         $this->session->set_flashdata('message', 'swal("Gagal", "Aktivasi akun Gagal! Token Salah.", "error");');
         redirect('login');
      }
   }


   function forgot()
   {
      sudah_login_tamu();
      $data['page_title']         = 'Lupa Password';
      $data['setting']            = get_setting();
      $this->template->load('front/template/template', 'front/auth/forgot',$data);
   }

   function forgot_aksi(){
      $this->form_validation->set_rules('email', 'Email', 'required');
      if ($this->form_validation->run() === FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Forgot Password Gagal", "error");');
         $this->forgot();
      } else {
         $email = $this->db->escape_str($this->input->post('email'));
         $tamu = $this->login_model->view_where('tamu', "email = '$email'")->row();
         if (empty($tamu)) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Email tidak ditemukan", "error");');
            $this->forgot();
         }elseif($tamu->status != 1){
            $this->session->set_flashdata('message', 'swal("Gagal", "Akun belum aktif", "error");');
            $this->forgot();
         } else {

            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
            $userIp = $this->input->ip_address();
            $secret = '6LepilcaAAAAAENAjwoM9IGeT6FKWMqdPTqmYwbF'; // ini adalah Secret key yang didapat dari google, silahkan disesuaikan
            $credential = array(
               'secret' => $secret,
               'response' => $this->input->post('g-recaptcha-response')
            );
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            $status = json_decode($response, true);
            if ($status['success']) {
               $token['token'] = time() . sha1(uniqid(mt_rand(), true));
               $result = $this->db->where('id_setting', '1')->get('settings');
               $email_data['setting'] = $settings = $result->row();
               $email_data['link'] = $link = site_url('reset/password/' . $token['token']);
               $email_data['nama_depan'] = $tamu->nama_depan;
               $email_data['nama_belakang'] = $tamu->nama_belakang;
               $html = $this->load->view('front/template_mail/forgot', $email_data, true);
               $this->db->set('token', $token['token']);
               $this->db->set('create_token', time());
               $this->db->where('email', $tamu->email);
               $this->db->update('tamu');
               $params['recipient'] = $tamu->email;
               $params['subject']   = $settings->nama;
               $params['message']   = $html;
               $this->_sendEmail($params);
               $this->session->set_flashdata('message', 'swal("Berhasil", "Silahkan masuk email untuk reset password", "success");');
               redirect(base_url('login'));             
            } else {
               $this->session->set_flashdata('message', 'swal("Gagal", "Maaf google Recaptcha gagal", "error");');
               $this->forgot();
            }
         }
      }
   }


   function reset(){
      $code = $this->uri->segment(3);
      $tamu = $this->login_model->view_where('tamu',"token = '$code'")->row();
      if ($tamu) {
         if ((time() - $tamu->create_token) < (60 * 60 * 24)) {
            $this->session->set_userdata('reset_email', $tamu->email);
            $this->changePassword();
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Token reset password expired ", "error");');
            redirect(base_url('login'));
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Token Salah ", "error");');
         redirect('login');
      }
   }

   function changePassword()
   {
      sudah_login_tamu();
      $data['setting']            = get_setting();
      $data['page_title']         = 'Perbarui Password';
      $data['meta_description']   = $this->setting->meta_description;
      $data['meta_keywords']      = $this->setting->meta_keywords;
      $this->template->load('front/template/template', 'front/auth/recover', $data);
   }

   function reset_aksi(){
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[konfirmasi_pass]');
      $this->form_validation->set_rules('konfirmasi_pass', 'Repeat Password', 'trim|required|min_length[5]|matches[password]');

      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Cek password ", "error");');
         $this->changePassword();
      } else {
         $password = sha1(md5($this->input->post('password')));
         $email = $this->session->userdata('reset_email');
         $this->db->set('token', '');
         $this->db->set('create_token', '');
         $this->db->set('password', $password);
         $this->db->where('email', $email);
         $this->db->update('tamu');
         $this->session->unset_userdata('reset_email');
         $this->session->set_flashdata('message', 'swal("Berhasil", "Password berhasil di perbarui ", "success");');
         redirect('login');
      }
   }


   private function _sendEmail($params)
   {
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
      // Load library email dan konfigurasinya
      $this->load->library('email', $config);
      // Email dan nama pengirim
      $this->email->from($settings->smtp_mail, $settings->nama);
      // Email penerima
      $this->email->to($params['recipient']); // Ganti dengan email tujuan anda
      // Lampiran email, isi dengan url/path file
      if ($params['attached_file']) {
         $this->email->attach($params['attached_file']);
      }
      // Subject email
      $this->email->subject($params['subject']);

      $this->email->message($params['message']);
      $this->email->send();
   }
}
