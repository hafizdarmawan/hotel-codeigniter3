<?php
class Tamu extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      $this->load->model('back/tamu_model');
      belum_login_admin();
      cek_session_admin();
   }

   function index()
   {
      $admin = $this->session->userdata('admin');
      $data['total_tamu'] = $this->tamu_model->view('tamu')->result();
      $data['tamu_aktif'] = $this->tamu_model->view_where('tamu', "status = '1'")->result();
      $data['tamu_tidak'] = $this->tamu_model->view_where('tamu', "status = '0'")->result();
      $data['booking_hari_ini'] = $this->tamu_model->get_booking_hari_ini();
      $data['page_title']  = 'Tamu Hotel';
      $data['orders']      =   $this->tamu_model->get_orders();
      $data['income']      =   $this->tamu_model->get_total_income();
      $data['guests']   = $this->tamu_model->get_all();
      $this->template->load('back/template/template', 'back/customer/list', $data);
   }

   public function ajax_list()
   {
      $list = $this->tamu_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $guest) {
         if ($guest->status == 1) {
            $status_   =   '<a class="btn btn-sm btn-success shadow" href="' . site_url('admin/customer/status_ubah/' . $guest->id_tamu) . '" ><i class="fas fa-check"></i> Aktif</a>';
         } else {
            $status_   =
            $status_   =   '<a class="btn btn-sm btn-danger shadow" href="' . site_url('admin/customer/status_ubah/' . $guest->id_tamu) . '" ><i class="fas fa-times"></i> Non-aktif</a>';;
         }
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = $guest->nama_depan . " " . $guest->nama_belakang;
         $row[] = $guest->email;
         // $row[] = $guest->status;
         $options   =   '<div class="" style="float:right;">'.$status_.' <a class="btn btn-sm btn-warning shadow" href="' . site_url('admin/customer/ubah/' . $guest->id_tamu) . '"><i class="fa fa-edit"></i> ' . 'Ubah' . '</a><a class="btn btn-sm btn-primary m-1 shadow" href="' . site_url('admin/customer/view/' . $guest->id_tamu) . '"><i class="fa fa-eye"></i>' . ' Detail Tamu' . '</a></div>';
         $row[] =   $options;
         // $options   =   '<div class="" style="float:right;"><a class="btn btn-sm btn-secondary" href="' . site_url('admin/customer/status_ubah/' . $guest->id_tamu) . '" >' . $status_ . '</a><a class="btn btn-sm btn-primary m-1" href="' . site_url('admin/customer/view/' . $guest->id_tamu) . '"><i class="fa fa-eye"></i>' . ' Detail' . '</a><a class="btn btn-sm btn-warning" href="' . site_url('admin/customer/ubah/' . $guest->id_tamu) . '"><i class="fa fa-edit"></i> ' . 'Ubah' . '</a><a class="btn btn-sm btn-danger tombol-hapus m-1" href="' . site_url('admin/customer/hapus/' . $guest->id_tamu) . '" onclick="return areyousure(this);"><i class="fa fa-trash"></i> ' . 'Hapus' . '</a> </div>';
         // $row[] =   $options;
         $data[] = $row;
      }
      //echo '<pre>'; print_r($this->tamu_model->count_filtered());die;
      $output = array(
         "draw" => $_POST['draw'],
         "recordsTotal" => $this->tamu_model->count_all(),
         // "recordsFiltered" => count($this->tamu_model->get_datatables()),
         "data" => $data,
      );
      echo json_encode($output);
   }

   function ubah($id_tamu = null){
      $data['tamu']        = $this->tamu_model->view_where('tamu', "id_tamu = '$id_tamu'")->row();
      $data['page_title']   = 'Ubah Data Tamu';
      $this->template->load('back/template/template', 'back/customer/form_ubah', $data);
   }

   function ubah_aksi(){
      $this->_validation();
      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('message', 'swal("Gagal", "Data tamu gagal diubah", "error");');
         $this->ubah();
      } else {
         $data = array(
            'nama_depan'                          => $this->db->escape_str($this->input->post('nama_depan')),
            'nama_belakang'                       => $this->db->escape_str($this->input->post('nama_belakang')),
            'tempat_lahir'                        => $this->db->escape_str($this->input->post('tempat_lahir')),
            'tanggal_lahir'                       => $this->db->escape_str($this->input->post('tanggal_lahir')),
            'jenis_kelamin'                       => $this->db->escape_str($this->input->post('jenis_kelamin')),
            'email'                               => $this->db->escape_str($this->input->post('email')),
            'no_telepon'                          => $this->db->escape_str($this->input->post('no_telepon')),
            'alamat'                              => $this->db->escape_str($this->input->post('alamat')),
            'diubah'                             => date('Y-m-d H:i:s'),
         );
         $password             = $this->db->escape_str($this->input->post('password'));
         if ($password) {
            $data['password'] = $this->db->escape_str(sha1(md5($this->input->post('password'))));
         }
         $where = array('id_tamu' => $this->db->escape_str($this->input->post('id_tamu')));
         $this->tamu_model->update('tamu', $data,$where);
         $this->session->set_flashdata('message', 'swal("Berhasil", "Data tamu berhasil diubah", "success");');
         redirect(base_url('admin/customer'));
      }
   }

   function _validation(){
      $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'trim|required', array(
         'required' => 'Nama Depan Wajib Di isi.',
      ));
      $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'trim|required', array(
         'required' => 'Nama Belakang Wajib Di isi.',
      ));

      // $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array(
      //    'required' => 'Tempat Lahir Wajib Di isi.',
      // ));
      // $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required', array(
      //    'required' => 'Tanggal Lahir Wajib Di isi.',
      // ));

      // $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', array(
      //    'required' => 'Jenis Kelamin Wajib Di isi.'
      // ));

      // if ($this->input->post('password') != '' || $this->input->post('konfirmasi_pass') != '') {
      //    $this->form_validation->set_rules('password', 'Password','required|min_length[6]', array(
      //       'required' => 'Email Wajib Di isi.',
      //       'min_length' => 'Maksimal 6 Karakter',
      //    ));
      //    $this->form_validation->set_rules('konfirmasi_pass', 'Konfirmasi Password','required|matches[password]', array(
      //       'required' => 'Email Wajib Di isi.',
      //       'matches' => 'Password tidak sama'
      //    ));
      // }

      // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array(
      //    'required' => 'Alamat Wajib Di isi.',
      // ));
   }

   function detail($id_tamu)
   {
      $data['tamu']        = $this->tamu_model->view_where('tamu',"id_tamu = '$id_tamu'")->row();
      $data['payments']    =    $this->tamu_model->get_payments($id_tamu);
      $data['bookings']    =   $this->tamu_model->get_bookings($id_tamu);
      $data['page_title']  = 'Data Tamu';
      $this->template->load('back/template/template', 'back/customer/view', $data);;
   }

   function hapus($id_tamu = false)
   {
      if ($id_tamu) {
         $guest   = $this->tamu_model->view_where('tamu',"id_tamu = '$id_tamu'")->row();
         if (!$guest) {
            $this->session->set_flashdata('message', 'swal("error", "Data tidak ditemukan", "error");');
            redirect('admin/guests');
         } else {
            $file = BASEPATH . '../assets/img/guests/' . $guest->gambar;
            if (file_exists($file)) {
               unlink($file);
            }
            $where = array('id_tamu'=> $id_tamu);
            $delete   = $this->tamu_model->delete('tamu',$where);
            $this->session->set_flashdata('message', 'swal("Berhasil", "Data tamu Berhasil dihapus", "success");');
            redirect('admin/customer');
         }
      } else {
          $this->session->set_flashdata('message', 'swal("error", "Data tamu tidak ditemukan", "error");');
         redirect('admin/customer');
      }
   }
 

   function status_ubah($id_tamu)
   {
      $tamu = $this->tamu_model->view_where('tamu', "id_tamu = '$id_tamu'")->row(); 
      if ($tamu->status == 1) {
         $save['status']    =  '0';
         $save['id_tamu']   =  $id_tamu;
         $this->session->set_flashdata('message', 'swal("info", "Tamu di Non-aktifkan", "info");');
      }
      if ($tamu->status == 0) {
         $save['status']   = '1';
         $save['id_tamu']  =   $id_tamu;
         $this->session->set_flashdata('message', 'swal("info", "Tamu di Aktif", "info");');
      }
      if (!empty($save)) {
         $this->tamu_model->save($save);
      }
      redirect('admin/customer');
   }
 
}
