<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Assets
| Package:		Gamers Orlando
| Category:		Helpers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		http://repairs.gamersorlando.com/
| Created:		10/26/2012
| Description:	Holds the list of CSS and JS files used on various pages.
*/

$ci =& get_instance();
$ci->load->helper('javascript');

if(!function_exists('get_css_files')) {
	function get_css_files() {
		$css = base_url().'assets/css/';
		$cssmin = base_url().'assets/css/minified/';
		if(APPLICATION_STATUS == 'dev') {
			return array(
				array('path' => $css.'repairs.css', 'media' => 'all'),
				array('path' => $css.'print.css', 'media' => 'print')
			);
		} else {
			return array(
				array('path' => $cssmin.'repairs.min.css', 'media' => 'all'),
				array('path' => $cssmin.'print.min.css', 'media' => 'print')
			);
		}
	}
}

if(!function_exists('get_form_css_files')) {
	function get_form_css_files() {
		$css = base_url().'assets/css/';
		$cssmin = base_url().'assets/css/minified/';
		if(APPLICATION_STATUS == 'dev') {
			return array(
				array('path' => $css.'repairs.css', 'media' => 'all'),
				array('path' => $css.'print.css', 'media' => 'print'),
				array('path' => $css.'jquery/jquery.ui.all.css', 'media' => 'screen')
			);
		} else {
			return array(
				array('path' => $cssmin.'repairs.min.css', 'media' => 'all'),
				array('path' => $cssmin.'print.min.css', 'media' => 'print'),
				array('path' => $cssmin.'jquery/jquery.ui.all.min.css', 'media' => 'screen')
			);
		}
	}
}

if(!function_exists('get_js_files')) {
	function get_js_files() {
		$js = base_url().'assets/js/';
		$jsmin = base_url().'assets/js/minified/';
		if(APPLICATION_STATUS == 'dev') {
			return array(
				
			);
		} else {	
			return array(
				
			);
		}
	}
}

if(!function_exists('get_form_js_files')) {
	function get_form_js_files() {
		$js = base_url().'assets/js/';
		$jsmin = base_url().'assets/js/minified/';
		if(APPLICATION_STATUS == 'dev') {
			return array(
				array('path' => $js.'jquery/jquery-1.9.0.js'),
				array('path' => $js.'jquery/jquery.ui.core.js'),
				array('path' => $js.'jquery/jquery.ui.widget.js'),
				array('path' => $js.'jquery/jquery.ui.position.js'),
				array('path' => $js.'jquery/jquery.ui.tooltip.js'),
				array('path' => $js.'jquery/jquery.ui.datepicker.js'),
				array('path' => $js.'common.js')
			);
		} else {	
			return array(
				array('path' => $jsmin.'jquery/jquery-1.9.0.min.js'),
				array('path' => $jsmin.'jquery/jquery.ui.core.min.js'),
				array('path' => $jsmin.'jquery/jquery.ui.widget.min.js'),
				array('path' => $jsmin.'jquery/jquery.ui.position.min.js'),
				array('path' => $jsmin.'jquery/jquery.ui.tooltip.min.js'),
				array('path' => $jsmin.'jquery/jquery.ui.datepicker.min.js'),
				array('path' => $js.'common.js')
			);
		}
	}
}

/* End of file assets_helper.php */
/* Location: ./application/helpers/assets_helper.php */