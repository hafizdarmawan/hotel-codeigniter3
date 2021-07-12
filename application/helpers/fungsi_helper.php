<?php error_reporting(0);
function sudah_login_admin()
{
   $ci = &get_instance();
   $user_session = $ci->session->userdata('id_user');
   if ($user_session) {
      redirect('admin/dashboard');
   }
}

// function untuk membatasi login
function belum_login_admin()
{
   $ci = &get_instance();
   $user_session = $ci->session->userdata('id_user');
   if (!$user_session) {
      redirect(base_url('admin/login'));
   }
}

function sudah_login_tamu()
{
   $ci = &get_instance();
   $user_session = $ci->session->userdata('id_tamu');
   if ($user_session) {
      redirect('home');
   }
}
// function untuk membatasi login

function belum_login_tamu()
{
   $ci = &get_instance();
   $user_session = $ci->session->userdata('id_tamu');
   if (!$user_session) {
      redirect(base_url('home'));
   }
}

// function untuk membatasi login
function cek_admin()
{
   $ci = &get_instance();
   $ci->load->library('fungsi');
   if ($ci->fungsi->user_login()->level_users != 1) {
      redirect(base_url('admin/dashboard'));
   }
}

function cek_admin_resepsionis()
{
   $ci = &get_instance();
   $ci->load->library('fungsi');
   if ($ci->fungsi->user_login()->level_users != 1 && $ci->fungsi->user_login()->level_users = !2 && $ci->fungsi->user_login()->level_users = !3) {
      redirect(base_url('main'));
   }
}

function indo_currency($value)
{
   return 'Rp. ' . number_format($value, 0, ",", ".");
}
function indo_date($date)
{
   $d = substr($date, 8, 2);
   $m = substr($date, 5, 2);
   $y = substr($date, 0, 4);
   return $d . '/' . $m . '/' . $y;
}


function cek_session()
{
   $ci = &get_instance();
   $session = $ci->session->userdata('level_users');
   if (empty($session)) {
      redirect(base_url());
   }
}

function cek_session_admin()
{
   $CI = &get_instance();
   $session = $CI->session->userdata('level_users');
   if (empty($session)) {
      redirect('admin/login');
   } else if ($session !== '1') {
      redirect('admin/dashboard');
   }
}

function cek_session_resepsionis()
{
   $ci = &get_instance();
   $session = $ci->session->userdata('level_users');
   if (empty($session)) {
      redirect('admin/logout');
   } else if ($session !== 2 || $session !== 1 ) {
      //  redirect('admin/dashboard');
   }
}


function filter($str)
{
   return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
}

function acakangkahuruf($panjang)
{
   $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   $string = '';
   for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $string .= $karakter{
         $pos};
   }
   return $string;
}

function rupiah($total)
{
   return number_format($total, 0, ",", ".");
}

function tgl_indo($tgl)
{
   $tanggal = substr($tgl, 8, 2);
   $bulan = getBulan(substr($tgl, 5, 2));
   $tahun = substr($tgl, 0, 4);
   return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_simpan($tgl)
{
   $tanggal = substr($tgl, 0, 2);
   $bulan = substr($tgl, 3, 2);
   $tahun = substr($tgl, 6, 4);
   return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_view($tgl)
{
   $tanggal = substr($tgl, 8, 2);
   $bulan = substr($tgl, 5, 2);
   $tahun = substr($tgl, 0, 4);
   return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_grafik($tgl)
{
   $tanggal = substr($tgl, 8, 2);
   $bulan = getBulan(substr($tgl, 5, 2));
   $tahun = substr($tgl, 0, 4);
   return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function generateRandomString($length = 10)
{
   return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function seo_title($s)
{
   $c = array(' ');
   $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
   $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
   $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
   return $s;
}

function hari_ini($w)
{
   $seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
   $hari_ini = $seminggu[$w];
   return $hari_ini;
}

function tgl_indoo($tgl)
{
   $bulan = getBulanbaru(substr($tgl, 5, 2));
   $tahun = substr($tgl, 0, 4);
   return $bulan . ' ' . $tahun;
}

function tgl_indoos($tgl)
{
   $bulan = substr($tgl, 0, 2);
   $tahun = substr($tgl, 3, 4);
   return $tahun . '-' . $bulan;
}

function tgl_indoose($tgl)
{
   $bulan = substr($tgl, 5, 2);
   $tahun = substr($tgl, 0, 4);
   return $bulan . '-' . $tahun;
}

function getBulanbaru($bln)
{
   switch ($bln) {
      case 1:
         return "Januari";
         break;
      case 2:
         return "Februari";
         break;
      case 3:
         return "Maret";
         break;
      case 4:
         return "April";
         break;
      case 5:
         return "Mei";
         break;
      case 6:
         return "Juni";
         break;
      case 7:
         return "Juli";
         break;
      case 8:
         return "Agustus";
         break;
      case 9:
         return "September";
         break;
      case 10:
         return "Oktober";
         break;
      case 11:
         return "November";
         break;
      case 12:
         return "Desember";
         break;
   }
}

function getBulan($bln)
{
   switch ($bln) {
      case 1:
         return "Jan";
         break;
      case 2:
         return "Feb";
         break;
      case 3:
         return "Mar";
         break;
      case 4:
         return "Apr";
         break;
      case 5:
         return "Mei";
         break;
      case 6:
         return "Jun";
         break;
      case 7:
         return "Jul";
         break;
      case 8:
         return "Agu";
         break;
      case 9:
         return "Sep";
         break;
      case 10:
         return "Okt";
         break;
      case 11:
         return "Nov";
         break;
      case 12:
         return "Des";
         break;
   }
}

function cek_terakhir($datetime, $full = false)
{
   $today = time();
   $createdday = strtotime($datetime);
   $datediff = abs($today - $createdday);
   $difftext = "";
   $years = floor($datediff / (365 * 60 * 60 * 24));
   $months = floor(($datediff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
   $days = floor(($datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
   $hours = floor($datediff / 3600);
   $minutes = floor($datediff / 60);
   $seconds = floor($datediff);
   //year checker  
   if ($difftext == "") {
      if ($years > 1)
         $difftext = $years . " Tahun";
      elseif ($years == 1)
         $difftext = $years . " Tahun";
   }
   //month checker  
   if ($difftext == "") {
      if ($months > 1)
         $difftext = $months . " Bulan";
      elseif ($months == 1)
         $difftext = $months . " Bulan";
   }
   //month checker  
   if ($difftext == "") {
      if ($days > 1)
         $difftext = $days . " Hari";
      elseif ($days == 1)
         $difftext = $days . " Hari";
   }
   //hour checker  
   if ($difftext == "") {
      if ($hours > 1)
         $difftext = $hours . " Jam";
      elseif ($hours == 1)
         $difftext = $hours . " Jam";
   }
   //minutes checker  
   if ($difftext == "") {
      if ($minutes > 1)
         $difftext = $minutes . " Menit";
      elseif ($minutes == 1)
         $difftext = $minutes . " Menit";
   }
   //seconds checker  
   if ($difftext == "") {
      if ($seconds > 1)
         $difftext = $seconds . " Detik";
      elseif ($seconds == 1)
         $difftext = $seconds . " Detik";
   }
   return $difftext;
}

function terbilang($x)
{
   $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
   if ($x < 12)
      return " " . $abil[$x];
   elseif ($x < 20)
      return Terbilang($x - 10) . " Belas";
   elseif ($x < 100)
      return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
   elseif ($x < 200)
      return " Seratus" . Terbilang($x - 100);
   elseif ($x < 1000)
      return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
   elseif ($x < 2000)
      return " Seribu" . Terbilang($x - 1000);
   elseif ($x < 1000000)
      return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
   elseif ($x < 1000000000)
      return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
