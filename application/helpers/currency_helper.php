<?php
		function rate_exchange($amount)
		{	$CI =& get_instance();
			$result	= 1;
			return round($price =$result*$amount,2);
		}	
		function get_currency_unit(){
			$CI =& get_instance();
			$result = $CI->session->userdata('currency_result');
			if(empty($result)){
				$result	=1;
			}
			return $result;
		}
		
		function rate_exchange_order($amount){
			return round($price =$amount);
		}
?>