<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('Cronjob/transaksi_model');
   }
   public function index()
   {
      $data = $this->transaksi_model->get_data();
      
      foreach($data as $dt){
         $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($dt->tgl_order);
         $months = floor($seconds / (3600 * 24 * 30));
         $day = floor($seconds / (3600 * 24));
         $hours = floor($seconds / 3600);
         $mins = floor(($seconds - ($hours * 3600)) / 60);
         // $secs = floor($seconds % 60);

         // if ($seconds < 60)
         //    $time = $secs . " seconds ago";
         // else if ($seconds < 60 * 60)
         //    $time = $mins . " min ago";
         // else if ($seconds < 24 * 60 * 60)
         //    $time = $hours . " hours ago";
         // else if ($seconds < 24 * 60 * 60)
         //    $time = $day . " day ago";
         // else
         //    $time = $months . " month ago";
         // echo '<pre>';
         // print_r($dt->nama_depan);

         if($months >= 1){
            echo 'update bulan';
         }else if($day >= 1){
            echo 'update hari';
         }else if($hours >= 1){
            echo 'update jam';
            $where = array('id_tamu'=>$dt->id_tamu);
            $data = array(
               'status' => '4'
            );
            $this->transaksi_model->update('orders',$data,$where);

            // $this->transaksi_model->update()
         }else if($mins > 30){
            echo 'update min';
         }else{
            echo 'tidak di update';
         }
      }
   }

}
//Update data attribut
// $ID_att = $this->input->post('ID_att');
// $result = array();
// foreach ($ID_att as $key => $val) {
//    $result[] = array(
//       "ID" => $ID_att[$key],
//       "nama_attribut"  => $_POST['name_attribut'][$key],
//       "value"  => $_POST['value_attribut'][$key]
//    );
// }
// $this->db->update_batch('dt_attribut', $result, 'ID');