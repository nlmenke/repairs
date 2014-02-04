<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Load Config
| Category:		Hooks
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Loads configuration from database into global CI config.
*/

function load_config() {
	
	$CI =& get_instance();
	foreach($CI->Appconfig->get_all()->result() as $app_config) {
		$CI->config->set_item($app_config->key, $app_config->value);
	}
	
	if($CI->config->item('timezone')) {
		date_default_timezone_set($CI->config->item('timezone'));
	} else {
		date_default_timezone_set('America/New_York');
	}
}

/* End of file load_config.php */
/* Location: ./application/hooks/load_config.php */