<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         MY Controller
| Category:     Core / Controllers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs
| Created:      08/26/2012
| Edited:       04/01/2013
| Description:  Class to extend the CodeIgniter Controller Class. All
|               controllers should extend this class.
*/

class MY_Controller extends CI_Controller {

    protected $data = array();
    protected $page_title;

    public function __construct() {
        parent::__construct();

        if($this->ion_auth->logged_in()) {
            // load user data
            $user         = $this->ion_auth->user()->row();
            $data['user'] = $user;

            $messages         = $this->message_model->get_messages($user->id);
            $data['messages'] = $messages;

            $this->load->vars($data);
        }
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */