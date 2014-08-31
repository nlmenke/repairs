<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Messages
| Category:     Models
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      02/25/2014
| Description:  Gathers messages from the database.
*/

class Message_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // -------------------------------------------------------------------

    /**
     * @param $user_id
     *
     * @return mixed
     */
    function get_all_messages($user_id) {
        $this->db->join('messages', 'messages_users.message_id = messages.id');
        $this->db->where('messages_users.user_id', $user_id);
        $this->db->order_by('completed', 'ASC');
        $this->db->order_by('sent', 'ASC');

        $query = $this->db->get('messages_users');

        return $query->result();
    }

    // -------------------------------------------------------------------

    /**
     * @param        $user_id
     * @param string $type
     *
     * @return mixed
     */
    function get_messages($user_id, $type = 'all') {
        $this->db->join('messages', 'messages_users.message_id = messages.id');
        $this->db->where('messages_users.to_id', $user_id);
        if($type != 'all') {
            $this->db->where('type', $type);
        }
        $this->db->where('completed', null);
        $this->db->order_by('sent', 'ASC');

        $query = $this->db->get('messages_users');

        return $query->result();
    }

    // -------------------------------------------------------------------

    /**
     * @param $message_id
     *
     * @return mixed
     */
    function get_message($message_id) {
        $this->db->join('messages', 'messages_users.message_id = messages.id');
        $this->db->where('messages_users.message_id', $message_id);

        $query = $this->db->get('messages_users');

        return $query->row();
    }
}

/* End of file messages_model.php */
/* Location: ./application/models/messages_model.php */