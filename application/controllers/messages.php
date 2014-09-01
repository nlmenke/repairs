<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Messages
| Category:     Controllers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      02/25/2014
| Description:  Allows for messages to be sent to users so they know what
|               needs to be done that day.
*/

class Messages extends Security_Controller {

    function __construct() {
        parent::__construct();

        $this->load->language('messages');
    }

    // -------------------------------------------------------------------

    /**
     * Shows all messages send to the user.
     *
     * /messages/
     */
    function index() {
        $user = $this->ion_auth->user()->row();
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } elseif(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee

            // breadcrumbs
            $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.config_item('company'), base_url());
            $this->breadcrumb->append_crumb(lang('messages'), 'messages');

            $data['page_title'] = 'Messages';
            $this->load->view('messages/customer', $data);
        } else {
            // user is admin or employee
            $data['calls'] = $this->message_model->get_messages($user->id, 'call');
            $data['fixes'] = $this->message_model->get_messages($user->id, 'fix');
            $data['miscs'] = $this->message_model->get_messages($user->id, 'misc');

            // breadcrumbs
            $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.config_item('company'), base_url());
            $this->breadcrumb->append_crumb(lang('messages'), 'messages');

            // view
            $data['page_title'] = 'Messages';
            $this->load->view('messages/employee', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * View a single message.
     *
     * /messages/<$message_id>/
     *
     * @param $message_id
     */
    function view($message_id) {
        if($message_id == '') {
            redirect('messages');
        }

        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } else {
            // user is logged in
            $message_info         = $this->message_model->get_message($message_id);
            $data['message_info'] = $message_info;

            // breadcrumbs
            $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.config_item('company'), base_url());
            $this->breadcrumb->append_crumb(lang('messages'), 'messages');
            $this->breadcrumb->append_crumb($message_info->title, 'messages/view/'.$message_id);

            // view
            $data['page_title'] = 'Message';
            $this->load->view('messages/message', $data);
        }
    }

    // -------------------------------------------------------------------

    /**
     * Refreshes the message list, showing any changes.
     *  - This page redirects to the full list of messages.
     */
    function refresh_messages() {
        if(!$this->ion_auth->logged_in()) {
            // user is not logged in
            redirect('auth/login');
        } elseif(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('employee')) {
            // user is not admin or employee

        } else {
            // user is admin or employee

        }
    }
}

/* End of file messages.php */
/* Location: ./application/controllers/messages.php */