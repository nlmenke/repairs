<?php
/*
| Name:         Errors
| Category:     Controllers / Errors
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      02/25/2014
| Description:  Allows for custom 404 page.
*/

class Errors extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Error 404
     *  - The requested file was not found.
     */
    public function error_404() {
        $data['message'] = 'The page you requested was not found.';
        $this->load->view('error/404', $data);
    }
}

/* End of file error_404.php */
/* Location: ./application/controllers/error_404.php */