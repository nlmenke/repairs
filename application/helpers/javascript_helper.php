<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Javascript
| Category:		Helpers
| Author(s):	Isern Palaus <ipalaus@ipalaus.es>
| 				David Mulder <david@greatslovakia.com>
| Description:	Generates a script inclusion of a JavaScript file. Based
| 				on the CodeIgniters original Link Tag.
*/

if(!function_exists('script_tag')) {
	function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE) {
		$CI =& get_instance();
		
		$script = '<script';
		
		if(is_array($src)) {
			foreach($src as $k => $v) {
				if($k == 'src' AND strpos($v, '://') === FALSE) {
					if($index_page === TRUE) {
						$script .= ' src="'.$CI->config->site_url($v).'"';
					} else {
						$script .= ' src="'.$CI->config->slash_item('base_url').$v.'"';
					}
				} else {
					$script .= $k.'="'.$v.'"';
				}
			}
			
			$script .= '></script>';
		} else {
			if(strpos($src, '://') !== FALSE) {
				$script .= ' src="'.$src.'" ';
			} elseif($index_page === TRUE) {
				$script .= ' src="'.$CI->config->site_url($src).'" ';
			} else {
				$script .= ' src="'.$CI->config->slash_item('base_url').$src.'" ';
			}
			
			$script .= 'language="'.$language.'" type="'.$type.'"';
			
			$script .= ' /></script>';
		}
		
		return $script;
	}
}

/* End of file javascript_helper.php */
/* Location: ./application/helpers/javascript_helper.php */