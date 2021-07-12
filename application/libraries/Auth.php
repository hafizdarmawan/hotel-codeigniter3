<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }
    
	function check_session()
	{
        $admin = $this->CI->session->userdata('admin');
        if(!$admin)
        {
            redirect('admin/login');
        }
	}
    function check_access($access, $default_redirect=false, $redirect = false)
    {
        /*
        we could store this in the session, but by accessing it this way
        if an admin's access level gets changed while they're logged in
        the system will act accordingly.
        */
        
        $admin = $this->CI->session->userdata('admin');
        
        $this->CI->db->select('access_id');
        $this->CI->db->where('id_users', $admin['id_users']);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('users');
        $result = $result->row();
        //result should be an object I was getting odd errors in relation to the object.
        //if $result is an array then the problem is present.
        if(!$result || is_array($result))
        {
            $this->logout();
            return false;
        }
    //  echo $result->access;
        if ($access)
        {
       
			if ($access == $result->access_id)
            {
             	return true;
            }
            else
            {	if ($redirect)
                {
                    redirect($redirect);
                }
                else{
				   redirect('admin/dashboard/');
                }
            }
            
        }
    }
    
    /*
    this checks to see if the admin is logged in
    we can provide a link to redirect to, and for the login page, we have $default_redirect,
    this way we can check if they are already logged in, but we won't get stuck in an infinite loop if it returns false.
    */
    function is_logged_in($redirect = false, $default_redirect = true)
    {
    
        //var_dump($this->CI->session->userdata('session_id'));

        //$redirect allows us to choose where a customer will get redirected to after they login
        //$default_redirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.

        $admin = $this->CI->session->userdata('admin');
        
        if (!$admin)
        {
            //check the cookie
            if(isset($_COOKIE['Admin']))
            {
                //the cookie is there, lets log the customer back in.
                $info = $this->aes256Decrypt(base64_decode($_COOKIE['Admin']));
                $cred = json_decode($info, true);

                if(is_array($cred))
                {
                    if( $this->login_admin($cred['username'], $cred['password']) )
                    {
                        return $this->is_logged_in($redirect, $default_redirect);
                    }
                }
            }

            if ($redirect)
            {
                $this->CI->session->set_flashdata('redirect', $redirect);
            }
                
            if ($default_redirect)
            {   
                redirect('admin/login');
            }
            
            return false;
        }
        else
        {
            return true;
        }
    }
    /*
    this function does the logging in.
    */
    function login_admin($username, $password, $remember=false)
    {
     
        // make sure the username doesn't go into the query as false or 0
        // if(!$username)
        // {
        //     return false;
        // }

        $this->CI->db->select('*');
        $this->CI->db->where('status_users', '1');
		$this->CI->db->where("(email='$username' OR username='$username')", NULL, FALSE);
		//$this->CI->db->where('username', $username);
        $this->CI->db->where('password', sha1(md5($password)));
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('users');
        $result = $result->row_array();
        // echo print_r($password);
        // echo print_r($password);
        // echo print_r($result);
        // die;
        if (sizeof($result) > 0)
        {
            $this->CI->session->set_userdata('username', $result->username);
            $this->CI->session->set_userdata('id_users', $result->id_users);
            $this->CI->session->set_userdata('nama_depan', $result->nama_depan);
            $this->CI->session->set_userdata('nama_belakang', $result->nama_belakang);
            $this->CI->session->set_userdata('foto', $result->foto);
            // $admin = array();
            // $admin['admin'] = array();
            // $admin['admin']['id_users'] = $result['id_users'];
            // $admin['admin']['level_users'] = $result['level_users'];
            // $admin['admin']['nama_depan'] = $result['nama_depan'];
            // $admin['admin']['nama_belakang'] = $result['nama_belakang'];
            // $admin['admin']['email'] = $result['email'];
            // $admin['admin']['username'] = $result['username'];

            // if($remember)
            // {
            //     $loginCred = json_encode(array('username'=>$username, 'password'=>$password));
            //     $loginCred = base64_encode($this->aes256Encrypt($loginCred));
            //     //remember the user for 6 months
            //     $this->generateCookie($loginCred, strtotime('+6 months'));
            // }

            // $this->CI->session->set_userdata($admin);
            echo print_r($this->CI->session->userdata('username'));
            die;
            return true;
            
        }
        else
        {
            return false;
        }
    }
    
    private function generateCookie($data, $expire)
    {
        setcookie('Admin', $data, $expire, '/', $_SERVER['HTTP_HOST']);
    }

    private function aes256Encrypt($data)
    {
        $key = config_item('encryption_key');
        if (32 !== strlen($key)) {
            $key = hash('SHA256', $key, true);
        }
        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    }

    private function aes256Decrypt($data)
    {
        $key = config_item('encryption_key');
        if (32 !== strlen($key)) {
            $key = hash('SHA256', $key, true);
        }
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]);
        return substr($data, 0, -$padding);
    }

    /*
    this function does the logging out
    */
    function logout()
    {
        $this->CI->session->unset_userdata('admin');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
    }

    /*
    This function resets the admins password and usernames them a copy
    */
    function reset_password($username)
    {
        $admin = $this->get_admin_by_username($username);
        if ($admin)
        {
            $this->CI->load->helper('string');
            $this->CI->load->library('email');
            
            $new_password       = random_string('alnum', 8);
            $admin['password']  = sha1(md5($new_password));
            // $this->save_admin($admin);
            $this->save($admin);
            
            $this->CI->email->from(config_item('email'), config_item('site_name'));
            $this->CI->email->to($admin['email']);
            $this->CI->email->subject(config_item('site_name').': Admin Password Reset');
            $this->CI->email->message('Your password has been reset to '. $new_password .'.');
            $this->CI->email->send();
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /*
    This function gets the admin by their username address and returns the values in an array
    it is not intended to be called outside this class
    */
    private function get_admin_by_username($username)
    {
        $this->CI->db->select('*');
        $this->CI->db->where('username', $username);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('admin');
        $result = $result->row_array();

        if (sizeof($result) > 0)
        {
            return $result; 
        }
        else
        {
            return false;
        }
    }
    
    /*
    This function takes admin array and inserts/updates it to the database
    */
    function save($admin)
    {
        if ($admin['id_users'])
        {
            $this->CI->db->where('id_users', $admin['id_users']);
            $this->CI->db->update('users', $admin);
        }
        else
        {
            $this->CI->db->insert('users', $admin);
        }
    }
    
    
    /*
    This function gets a complete list of all admin
    */
    function get_admin_list()
    {
        $this->CI->db->select('*');
        $this->CI->db->order_by('nama_depan', 'ASC');
        $this->CI->db->order_by('nama_belakang', 'ASC');
        $this->CI->db->order_by('email', 'ASC');
        $this->CI->db->order_by('username', 'ASC');
        $result = $this->CI->db->get('users');
        $result = $result->result();
        
        return $result;
    }

    /*
    This function gets an individual admin
    */
    function get_admin($id_users)
    {
        $this->CI->db->select('*');
        $this->CI->db->where('id_users', $id_users);
        $result = $this->CI->db->get('users');
        $result = $result->row();

        return $result;
    }       
    
    function check_id($str)
    {
        $this->CI->db->select('id_users');
        $this->CI->db->from('users');
        $this->CI->db->where('id_users', $str);
        $count = $this->CI->db->count_all_results();
        
        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }   
    }
    
    function check_username($str, $id_users=false)
    {
        $this->CI->db->select('username');
        $this->CI->db->from('users');
        $this->CI->db->where('username', $str);
        if ($id_users)
        {
            $this->CI->db->where('id_users !=', $id_users);
        }
        $count = $this->CI->db->count_all_results();
        
        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function delete($id_users)
    {
        if ($this->check_id($id_users))
        {
            $admin  = $this->get_admin($id_users);
            $this->CI->db->where('id_users', $id_users);
            $this->CI->db->limit(1);
            $this->CI->db->delete('admin');

            return $admin->nama_belakang.' '.$admin->nama_depan.' has been removed.';
        }
        else
        {
            return 'The admin could not be found.';
        }
    }
}