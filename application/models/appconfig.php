<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         AppConfig
| Category:     Models
| Author:       N.L.Menke
|               nick.m@gamersorlando.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      04/01/2013
| Description:  Gathers information from database about the company and
|               application.
*/

class Appconfig extends CI_Model {

    /**
     * @param $key
     *
     * @return bool
     */
    function exists($key) {
        $this->db->from('app_config');
        $this->db->where('app_config.key', $key);
        $query = $this->db->get();

        return ($query->num_rows() == 1);
    }

    /**
     * @return mixed
     */
    function get_all() {
        $this->db->from('app_config');
        $this->db->order_by('key', 'asc');

        return $this->db->get();
    }

    /**
     * @param $key
     *
     * @return string
     */
    function get($key) {
        $query = $this->db->get_where('app_config', array('key' => $key), 1);

        if($query->num_rows() == 1) {
            return $query->row()->value;
        }

        return '';
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    function save($key, $value) {
        $config_data = array(
            'key'   => $key,
            'value' => $value
        );

        if(!$this->exists($key)) {
            return $this->db->insert('app_config', $config_data);
        }

        $this->db->where('key', $key);

        return $this->db->update('app_config', $config_data);
    }

    /**
     * @param $data
     *
     * @return bool
     */
    function batch_save($data) {
        $success = true;

        // Run these queries as a transaction, we want to make sure we do all or nothing
        $this->db->trans_start();
        foreach($data as $key => $value) {
            if(!$this->save($key, $value)) {
                $success = false;
                break;
            }
        }

        $this->db->trans_complete();

        return $success;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    function delete($key) {
        return $this->db->delete('app_config', array('key' => $key));
    }

    /**
     * @return mixed
     */
    function delete_all() {
        return $this->db->empty_table('app_config');
    }
}

/* End of file appconfig.php */
/* Location: ./application/models/appconfig.php */