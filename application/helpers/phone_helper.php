<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Phone Number
| Category:		Helpers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Formats phone numbers to an easy-to-read configuration.
*/

if(!function_exists('format_phone')) {
	function format_phone($phone) {
		$number = explode('/', $phone);
		$phones = array();
		
		foreach($number as $phone) {
			$phone = preg_replace('/[^0-9*]/', '', $phone);
			
			if(strlen($phone) == 7) {
				$phones[] = preg_replace('/([0-9*]{3})([0-9*]{4})/', '$1-$2', $phone);
			} elseif(strlen($phone) == 10) {
				$phones[] = preg_replace('/([0-9*]{3})([0-9*]{3})([0-9*]{4})/', '($1) $2-$3', $phone);
			} elseif(strlen($phone) == 11) {
				$phones[] = preg_replace('/([0-9*]{1})([0-9*]{3})([0-9*]{3})([0-9*]{4})/', '$1 ($2) $3-$4', $phone);
			} else {
				$phones[] = $phone;
			}
		}
		$numbers = implode(' / ', $phones);
		return $numbers;
	}
}

if(!function_exists('strip_phone')) {
	function strip_phone($phone) {
		$number = explode('/', $phone);
		$phones = array();
		
		foreach($number as $phone) {
			$phone = preg_replace('/[^0-9]/', '', $phone);
			
			$phones[] = $phone;
		}
		$numbers = implode(' / ', $phones);
		return $numbers;
	}
}


/* End of file phone_helper.php */
/* Location: ./application/helpers/phone_helper.php */