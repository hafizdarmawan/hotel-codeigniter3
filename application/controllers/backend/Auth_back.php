<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_back extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('back/auth_model');
   }

   // *catatan
   // get_setting() adalah helper seeting web
   // sudah_login_admin adalah helper session login admin



   // diarahkan ke function login
   function index(){
      $this->login();
   }

   // tampil halaman login
   function login()
   {
      sudah_login_admin();
      $data['setting'] = get_setting();
      $cap             = $this->_captcha();
      $data['cap_img'] = $cap['image'];
      $this->session->set_userdata('kode_captcha', $cap['word']);
      $this->load->view('back/auth/login', $data);
   }

   // login_aksi
   function login_aksi(){
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      if ($this->form_validation->run() === FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Login gagal", "error");');
         $this->login();
      } else {
         $penggunaname = $this->input->post('username');
         $password = sha1(md5($this->input->post('password')));
         $cek = $this->auth_model->cek_login_admin($penggunaname, $password);
         if ($cek == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Akun Tidak ditemukan", "error");');
            redirect(base_url('admin/login'));
         } else {
            $this->form_validation->set_rules('kode_captcha', 'Kode Captcha', 'required|callback_cek_captcha');
            $this->form_validation->set_error_delimiters('<div style="border: 1px solid: #999999; background-color: #ffff99;">', '</div>');
            if ($this->form_validation->run() === FALSE) {
               $cap = $this->_captcha();
               $data['cap_img'] = $cap['image'];
               $this->session->set_userdata('kode_captcha', $cap['word']);
               $this->session->set_flashdata('message', 'swal("Gagal", "Captcha tidak sesuai", "error");');
               redirect(base_url('admin/login'));
            } else {
               $this->session->unset_userdata('kode_captcha');
               $this->session->set_userdata('id_user', $cek->id_user);
               $this->session->set_userdata('level_users',$cek->level_users);
               $this->session->set_userdata('username', $cek->username);
               $this->session->set_userdata('nama_depan', $cek->nama_depan);
               $this->session->set_userdata('nama_belakang', $cek->nama_belakang);
               $this->session->set_userdata('foto', $cek->foto);
               $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Login", "success");');
               redirect(base_url('admin/dashboard'));
            }
         }
      }
   }

   // tampil view lupa password
   function lupa(){
      $data['setting']  =   get_setting();
      $cap              =  $this->_captcha();
      $data['cap_img']  = $cap['image'];
      $this->session->set_userdata('kode_captcha', $cap['word']);
      $this->load->view('back/auth/forgot', $data);
   }

   // lupa password aksi
   function lupa_aksi(){
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      if ($this->form_validation->run() === FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Gagal", "error")');
         $this->lupa();
      } else {
         $email = $this->input->post('email');
         $user = $this->db->get_where('users', ['email' => $email, 'status_users' => '1'])->row_array();
         if ($user == FALSE) {
            $this->session->set_flashdata('message', 'swal("Gagal", "Email Tidak ditemukan", "error")');
           $this->lupa();
         } else {
            $this->form_validation->set_rules('kode_captcha', 'Kode Captcha', 'required|callback_cek_captcha');
            $this->form_validation->set_error_delimiters('<div style="border: 1px solid: #999999; background-color: #ffff99;">', '</div>');
            if ($this->form_validation->run() === FALSE) {
               $cap = $this->_captcha();
               $data['cap_img'] = $cap['image'];
               $this->session->set_userdata('kode_captcha', $cap['word']);
               $this->session->set_flashdata('message', 'swal("Gagal", "Captcha tidak sesuai", "error");');
               $this->lupa();
            } else {
               $this->session->unset_userdata('kode_captcha');
               $token['token'] = time() . sha1(uniqid(mt_rand(), true));
               $res = $this->db->where('id_tempmail', '4')->get('mail_templates');
               $row = $res->row_array();
               $result = $this->db->where('id_setting', '1')->get('settings');
               $settings = $result->row();
               $link = site_url('admin/reset/password/' . $token['token']);
               $row['content'] = str_replace('{password_reset_link}', $link, $row['content']);
               $row['subject'] = str_replace('{site_name}', $settings->name, $row['subject']);
               $row['subject'] = str_replace('{site_name}', $settings->name, $row['subject']);
               $row['content'] = str_replace('{site_name}', $settings->name, $row['content']);
               $row['content'] = str_replace('{customer_name}', $user['nama_depan'], $row['content']);
               $this->db->set('token', $token['token']);
               $this->db->set('create_token', time());
               $this->db->where('email', $user['email']);
               $this->db->update('users');
               $msg                 = html_entity_decode($row['content']);
               $params['recipient'] = $user['email'];
               $params['subject']   = $row['subject'];
               $params['message']   = $msg;
               $this->_sendEmail($params);
               $this->session->set_flashdata('message', 'swal("Berhasil", "Silahkan masuk email untuk reset password", "success");');
               redirect(base_url('admin/login'));
            }
         }
      }
   }
  

   // tampil view reset password
   public function reset_password()
   {
      $code = $this->uri->segment(4);
      $user = $this->auth_model->get_admin_by_code($code);
      if ($user) {
         if ((time() - $user->create_token) > (60 * 60 * 24)) {
            $this->session->set_userdata('reset_email', $user->email);
            $this->changePassword();
         } else {
            $this->session->set_flashdata('message', 'swal("Gagal", "Token reset password kadaluarsa ", "error");');
            redirect(base_url('admin/lupa/login'));
         }
      } else {
         $this->session->set_flashdata('message', 'swal("Gagal", "Email salah ", "error");');
         redirect('admin/login');
      }
   }

   // tampil view ubah password
   function changePassword(){
      $data['setting'] = get_setting();
      $data['title'] = 'Change Password';
      $this->load->view('back/auth/reset', $data);
   }

   // ubah password aksi
   function change_password_aksi(){
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[konfirmasi_pass]');
      $this->form_validation->set_rules('konfirmasi_pass', 'Repeat Password', 'trim|required|min_length[5]|matches[password]');
      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Cek password ", "error");');
         $this->changePassword();
      } else {
         $password = sha1(md5($this->input->post('password')));
         $email = $this->session->userdata('reset_email');
         $this->db->set('token', '');
         $this->db->set('create_token','');
         $this->db->where('email', $email);
         $this->db->update('users');
         $this->db->set('password', $password);
         $this->db->where('email', $email);
         $this->db->update('users');
         $this->session->unset_userdata('reset_email');
         $this->session->set_flashdata('message', 'swal("Berhasil", "Password berhasil di perbarui ", "success");');
         redirect('admin/login');
      }
   }

   // logout
   function logout()
   {
      $this->session->sess_destroy();
      $this->session->set_flashdata('message', "logged Out successfully");
      redirect(base_url('admin/login'));
   }

   // setting kirim email
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
      $this->email->from($settings->smtp_mail, $settings->name);
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

   // setting captcha admin
   private function _captcha(){
      $vals = array(
         'img_path' => 'captcha/',
         'img_url' => base_url() . 'captcha/',
         //            'font_path' => './font/timesbd.ttf',
         'font_path' => FCPATH . 'captcha/font/1.ttf',
         'font_size' => 100,
         'img_width' => '190',
         'img_height' => 40,
         //            'img_width' => '150',
         //            'img_height' => 30,
         'expiration' => 7200
      );
      $cap = create_captcha($vals);
      return $cap;
   }

   // cek captcha
   function cek_captcha($input)
   {
      if ($input === $this->session->userdata('kode_captcha')) {
         return TRUE;
      } else {
         $this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
         return FALSE;
      }
   }	
}
