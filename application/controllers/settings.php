<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Settings
| Category:     Controllers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     https://github.com/nlmenke/repairs/
| Created:      02/25/2014
| Description:  Allows for updating of settings for the application.
*/

class Settings extends Security_Controller {

    function __construct() {
        parent::__construct();

        $this->load->language('settings');
    }

    /**
     * Settings page.
     *
     * /settings/
     */
    function index() {

        // breadcrumbs
        $this->breadcrumb->append_crumb('<i class="fa fa-home"></i> '.$this->config->item('company'), base_url());
        $this->breadcrumb->append_crumb(lang('settings_settings'), 'settings');

        $data['page_title'] = 'Settings';
        $this->load->view('settings', $data);
    }

    /**
     * Saves settings.
     */
    function save() {
        $this->load->helper('directory');
        $valid_languages = directory_map(APPPATH.'language/', 1);
        $batch_save_data = array(
            'company'                => $this->input->post('company'),
            'address'                => $this->input->post('address'),
            'phone'                  => strip_phone($this->input->post('phone')),
            'fax'                    => strip_phone($this->input->post('fax')),
            'email'                  => $this->input->post('email'),
            'website'                => $this->input->post('website'),
            'website_on_receipt'     => $this->input->post('website_on_receipt'),
            'facebook'               => $this->input->post('facebook'),
            'facebook_on_receipt'    => $this->input->post('facebook_on_receipt'),
            'google_plus'            => $this->input->post('google_plus'),
            'google_plus_on_receipt' => $this->input->post('google_plus_on_receipt'),
            'twitter'                => $this->input->post('twitter'),
            'twitter_on_receipt'     => $this->input->post('twitter_on_receipt'),
            'url_repair_log'         => $this->input->post('url_repair_log'),
            'url_point_of_sale'      => $this->input->post('url_point_of_sale'),
            'language'               => in_array($this->input->post('language'), $valid_languages) ? $this->input->post('language') : 'english',
            'timezone'               => $this->input->post('timezone'),
            'date_format'            => $this->input->post('date_format'),
            'time_format'            => $this->input->post('time_format'),
            'repairs_per_page'       => $this->input->post('repairs_per_page'),
            'warranty_type'          => $this->input->post('warranty_type'),
            'repair_contract'        => $this->input->post('repair_contract'),
            'repair_contract_full'   => $this->input->post('repair_contract_full'),
        );

        if($this->Appconfig->batch_save($batch_save_data)) {
            echo json_encode(array(
                'success' => true,
                'message' => lang('config_saved_successfully')
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => lang('config_saved_unsuccessfully')
            ));
        }
    }

    /**
     * Backup all information in the database.
     */
    function backup() {
        $this->load->helper('download');
        $this->load->dbutil();
        $prefs  = array(
            'format'     => 'txt',
            // gzip, zip, txt
            'add_drop'   => false,
            // Whether to add DROP TABLE statements to backup file
            'add_insert' => true,
            // Whether to add INSERT data to backup file
            'newline'    => "\n"
            // Newline character used in backup file
        );
        $backup = & $this->dbutil->backup($prefs);
        $backup = 'SET FOREIGN_KEY_CHECKS=0;'."\n".$backup."\n".'SET FOREIGN_KEY_CHECKS=1;';
        force_download('repairs.sql', $backup);
    }

    /**
     * Optimise the database.
     */
    function optimize() {
        $this->load->dbutil();
        $this->dbutil->optimize_database();
        echo json_encode(array(
            'success' => true,
            'message' => lang('config_database_optimize_successfully')
        ));
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */