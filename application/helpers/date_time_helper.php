<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function date_time_convert($str){
$CI = get_instance();
$CI = get_instance();
$settings	=	get_setting();
	if($settings->format_waktu==1){
		return $str = date("".$settings->format_tanggal." h:i a",strtotime($str));
	}
	if($settings->format_waktu==2){
		return $str = date("".$settings->format_tanggal." H:i",strtotime($str));
	}
}

function date_convert($str){
$CI = get_instance();
$settings	=	get_setting();
return $str = date("".$settings->format_tanggal."",strtotime($str));
}
?>