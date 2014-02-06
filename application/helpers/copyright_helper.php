<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Copyright
| Category:		Helpers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		08/26/2012
| Description:	Adds a copyright date span (ie: 2010-2011) if
| 				$creation_year is set to a year. Otherwise, the copyright
| 				date is set to the current year.
*/

if(!function_exists('copyright')) {
	function copyright($creation_year = NULL) {
		$copyright = $creation_year;
		if($creation_year == '') {
			$copyright .= date('Y');
		} else if($creation_year != date('Y')) {
			$copyright .= '-'.date('Y');
		}
		return 'Copyright &copy; '.$copyright.', '.config_item('company');
	}
}

/* End of file copyright_helper.php */
/* Location: ./application/helpers/copyright_helper.php */