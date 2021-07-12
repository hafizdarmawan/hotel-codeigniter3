 <?php
   defined('BASEPATH') or exit('No direct script access allowed');

   class Auth_model extends CI_Model
   {
      public function cek_login_admin()
      {
         $username = set_value('username');
         $password = set_value('password');
         
         $result = $this->db
            ->where('username', $username)
            ->where('password', sha1(md5($password)))
            ->where('status_users', '1')
            ->limit(1)
            ->get('users')->row();

         if ($result > 0) {
            $this->db->update('users', array('last_login' => date('Y-m-d H:i:s')),  array('id_user' => $result->id_user));
            return $result;
         } else {
            return FALSE;
         }
      }

      // function reset_password($email)
      // {
      //    $this->load->library('encrypt');
      //    $user = $this->get_user_by_email($email);
      //    if ($user) {
      //       $this->load->helper('string');
      //       // $this->load->library('email');

      //       $new_password       = random_string('alnum', 8);
      //       $data['password']   = sha1(md5($new_password));

      //       $this->db->where('id', $user->id_users);
      //       $this->db->update('users', $data);

      //       $this->email->from($this->config->item('email'), $this->config->item('School Portal'));
      //       $this->email->to($email);
      //       $this->email->subject($this->config->item('School Portal') . ': Password Reset');
      //       $this->email->message('Your password has been reset to <strong>' . $new_password . '</strong>.');
      //       $this->email->send();

      //       return true;
      //    } else {
      //       return false;
      //    }
      // }


      function get_user_by_email($email)
      {
         $result = $this->db->get_where('admin', array('email' => $email));
         return $result->row_array();
      }

      function get_admin_by_code($code)
      {
         $this->db->where("token", $code);
         $this->db->select("email");
         $this->db->limit(1);
         $result = $this->db->get('users')->row();

         if (sizeof($result) > 0) {
            return $result;
         } else {
            $this->session->set_flashdata('error', "Reset Password Failed");
            redirect('admin/login');
         }
      }

      function save_password($save, $email)
      {
         $this->db->where('email', $email);
         $this->db->update('users', $save);
      }

      function save_user_info($save)
      {
         $this->db->insert('users', $save);
      }

      private function get_admin_by_email($email)
      {
         $this->db->select('*');
         $this->db->where('email', $email);
         $this->db->limit(1);
         $result = $this->db->get('users');
         $result = $result->row_array();

         if (sizeof($result) > 0) {
            return $result;
         } else {
            return false;
         }
      }

      // public function view_where($table, $data)
      // {
      //    $this->db->where($data);
      //    return $this->db->get($table);
      // }

      // public function cek_login($username, $password, $table)
      // {
      //    return $this->db->query("SELECT * FROM $table where username='" . $this->db->escape_str($username) . "' AND password='" . $this->db->escape_str($password) . "'");
      // }
   
      // public function emailsend()
      // {

      //    $query = $this->db->query("SELECT email from tb_subs WHERE aktif='1'");
      //    $sendTo = array();
      //    foreach ($query->result() as $row) {
      //       $sendTo[] = $row->email;
      //    }

      //    return $sendTo;
      // }
   }
