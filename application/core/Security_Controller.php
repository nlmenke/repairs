<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Security Controller
| Category:		Core / Controllers
| Author:		N.L.Menke
| 				nick.m@gamersorlando.com
| 				@NLMenke
| Location:		https://github.com/nlmenke/repairs
| Created:		08/26/2012
| Edited:		04/01/2013
| Description:	Controllers that are considered secure should extend
| 				Security_Controller. This prevents non-admin/non-employees
| 				from accessing secure sections of the system.
*/

class Security_Controller extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		
		if(!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
	}
}

/* End of file Security_Controller.php */
/* Location: ./application/core/Security_Controller.php */