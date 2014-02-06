<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			App Version
| Category:		Helpers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs/
| Created:		04/01/2013
| Description:	Compiles version information.
*/

if(!function_exists('app_version')) {
	function app_version($full = NULL) {
		$version = APP_MAJOR_VER.'.'.APP_MINOR_VER;
		
		if($full != NULL) {
			$version .= '.'.APP_PATCH_VER;
			
			if(APP_STATUS == 'dev') {
				$version .= 'dev';
			} elseif(APP_STATUS == 'alpha') {
				$version .= '&alpha;';
			} elseif(APP_STATUS == 'beta') {
				$version .= '&beta;';
			}
		}
		
		return $version;
	}
}

/* End of file app_version_helper.php */
/* Location: ./application/helpers/app_version_helper.php */